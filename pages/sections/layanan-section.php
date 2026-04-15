
<!-- ============================================================
     LAYANAN SECTION
============================================================ -->
<?php
/* ================================================================
   LAYANAN SECTION — Bento Grid Asimetris
   Konsisten dengan tema navy + gold hero section
   Desktop: grid asimetris (kartu besar + kecil)
   Mobile : 2 kolom seragam, rapi
================================================================ */

// Ambil hanya kategori INDUK
$parent_cats = array_filter($categories, fn($c) => empty($c['parent_id']) || $c['parent_id'] == 0);
$parent_cats = array_values($parent_cats);

// Ambil sub-kategori
$sub_cats = db()->query("
    SELECT * FROM categories
    WHERE parent_id IS NOT NULL AND parent_id != 0 AND status = 'active'
    ORDER BY urutan ASC, id ASC
")->fetchAll();

$subs_by_parent = [];
foreach ($sub_cats as $sc) {
    $subs_by_parent[$sc['parent_id']][] = $sc;
}


?>

<style>
  section#produk {
  position: relative;
  z-index: 1; /* lebih rendah dari dropdown layanan */
}

section#layanan {
  position: relative;
  z-index: 2; /* lebih tinggi */
}
  /* Tambah di bagian <style> section layanan */
.bento-grid {
  overflow: visible !important;
}

.layanan-card {
  overflow: visible !important;
}
  /* Tambah di CSS layanan */
.layanan-card:has(.layanan-sub.show) {
  z-index: 300;
}
  /* Dropdown sub-kategori */
  .layanan-sub { display: none; }
  .layanan-sub.show {
    display: block;
    animation: subDropIn .18s ease;
  }
  @keyframes subDropIn {
    from { opacity:0; transform:translateY(-6px); }
    to   { opacity:1; transform:translateY(0); }
  }
  .sub-arrow { transition: transform .2s; }
  .sub-arrow.open { transform: rotate(180deg); }

  /* Pastikan grid overflow visible untuk dropdown */
  #layanan .bento-grid { overflow: visible; }
</style>

<!-- ============================================================
     LAYANAN SECTION
============================================================ -->
<section id="layanan" class="py-20 bg-[#0B1F4A] relative overflow-visible">

  <!-- Dekorasi background subtle -->
  <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#F5C518]/30 to-transparent"></div>
  <div class="absolute inset-0 opacity-[0.03]"
       style="background-image: radial-gradient(circle, #F5C518 1px, transparent 1px); background-size: 40px 40px;"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">

    <!-- Header -->
    <div class="text-center mb-14">
      <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-5">
        <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#F5C518]"></span>
        Apa yang Kami Tawarkan
      </div>
      <h2 class="font-serif text-3xl md:text-4xl font-black text-white mt-2 mb-4">Layanan Kami</h2>
      <p class="text-white/50 max-w-xl mx-auto text-[15px] leading-relaxed">
        Kami menyediakan berbagai jenis rangkaian bunga segar berkualitas tinggi untuk setiap momen spesial Anda di Grogol.
      </p>
    </div>

    <!-- ── BENTO GRID ── -->
    <div class="bento-grid grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">
      <?php foreach ($parent_cats as $i => $cat):
        $slot      = $i % 6;
        $has_img   = !empty($cat['image']);
        $img_url   = $has_img ? e(imgUrl($cat['image'], 'category')) : '';
        $children  = $subs_by_parent[$cat['id']] ?? [];
        $has_subs  = !empty($children);

        // Warna fallback kalau tidak ada gambar (gold-tinted)
        $fallback_bg = [
          'rgba(245,197,24,.08)',
          'rgba(255,255,255,.04)',
          'rgba(245,197,24,.06)',
          'rgba(255,255,255,.03)',
          'rgba(245,197,24,.10)',
          'rgba(255,255,255,.05)',
        ];
        $bg = $fallback_bg[$i % count($fallback_bg)];
      ?>

      <!-- Kartu <?= $i ?> — slot <?= $slot ?> -->
      <div class="layanan-card group relative rounded-2xl overflow-visible min-h-[260px] md:min-h-[300px] transition-all duration-300 cursor-pointer"
           style="<?= $has_img ? '' : "background: $bg;" ?> border: 1px solid rgba(255,255,255,.08);"
           <?= $has_subs ? 'onclick="toggleLayananSub(this)"' : '' ?>>

        <!-- Background gambar -->
        <?php if ($has_img): ?>
        <div class="absolute inset-0 overflow-hidden rounded-2xl">
          <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-110"
               style="background-image: url('<?= $img_url ?>')"></div>
          <!-- Overlay gradient gold-navy -->
          <div class="absolute inset-0 rounded-2xl transition-all duration-300"
               style="background: linear-gradient(160deg, rgba(11,31,74,.25) 0%, rgba(11,31,74,.75) 100%);"></div>
          <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"
               style="background: linear-gradient(160deg, rgba(245,197,24,.15) 0%, rgba(11,31,74,.8) 100%);"></div>
        </div>
        <?php endif; ?>

        <!-- Aksen garis gold di sudut kiri atas -->
        <div class="absolute top-0 left-0 w-8 h-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20">
          <div class="absolute top-3 left-3 w-4 h-[2px] bg-[#F5C518]"></div>
          <div class="absolute top-3 left-3 w-[2px] h-4 bg-[#F5C518]"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 p-5 md:p-6 flex flex-col justify-end h-full" style="min-height: inherit;">

          <!-- Icon -->
          <?php if (!empty($cat['icon'])): ?>
          <div class="text-2xl md:text-3xl mb-3 transition-transform duration-300 group-hover:-translate-y-1 w-fit">
            <?= e($cat['icon']) ?>
          </div>
          <?php endif; ?>

          <!-- Nama layanan -->
<h3 class="font-serif font-bold text-base md:text-lg leading-tight mb-2
           <?= $has_img ? 'text-white' : 'text-white/90' ?>">
            <?= e($cat['name']) ?>
          </h3>

       <?php if (!empty($cat['description'])): ?>
<p class="text-white/60 text-[13px] leading-relaxed mb-3 line-clamp-2">
  <?= e($cat['description']) ?>
</p>
<?php endif; ?>

          <!-- CTA -->
          <?php if ($has_subs): ?>
          <div class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-[#F5C518] mt-1 transition-all duration-200 opacity-60 group-hover:opacity-100">
            Lihat kategori
            <svg class="sub-arrow w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
          <?php else: ?>
          <a href="<?= BASE_URL ?>/<?= e($cat['slug']) ?>/"
             class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-[#F5C518] mt-1 transition-all duration-200 opacity-60 group-hover:opacity-100 no-underline"
             onclick="event.stopPropagation()">
            Lihat selengkapnya
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
          </a>
          <?php endif; ?>
        </div>

        <!-- ── Sub-kategori dropdown ── -->
        <?php if ($has_subs): ?>
        <div class="layanan-sub absolute left-0 right-0 top-full mt-2 rounded-2xl z-[999] p-3 text-left"
             style="background: #0f2860; border: 1px solid rgba(245,197,24,.2); box-shadow: 0 20px 60px rgba(0,0,0,.5);"
             onclick="event.stopPropagation()">

          <p class="text-[10px] text-[#F5C518]/60 font-bold uppercase tracking-widest px-2 mb-2">
            Pilih kategori <?= e($cat['name']) ?>
          </p>

          <?php foreach ($children as $ch): ?>
          <a href="<?= BASE_URL ?>/<?= e($ch['slug']) ?>/"
             class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl transition text-sm font-medium text-white/75 hover:text-[#F5C518] hover:bg-[#F5C518]/08 no-underline"
             style="cursor:pointer;">
            <span class="w-1.5 h-1.5 rounded-full bg-[#F5C518]/40 flex-shrink-0"></span>
            <?= e($ch['name']) ?>
          </a>
          <?php endforeach; ?>

          <div class="border-t mt-2 pt-2" style="border-color: rgba(255,255,255,.06);">
            <a href="<?= BASE_URL ?>/<?= e($cat['slug']) ?>/"
               class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-bold text-[#F5C518]/50 hover:text-[#F5C518] transition no-underline">
              Lihat semua <?= e($cat['name']) ?> →
            </a>
          </div>
        </div>
        <?php endif; ?>

      </div><!-- /layanan-card -->
      <?php endforeach; ?>

    </div><!-- /bento-grid -->

  </div>
</section>

<script>
function toggleLayananSub(card) {
  const sub = card.querySelector('.layanan-sub');
  if (!sub) return;

  const isOpen = sub.classList.contains('show');

  // Tutup semua
  document.querySelectorAll('.layanan-sub.show').forEach(el => el.classList.remove('show'));
  document.querySelectorAll('.sub-arrow.open').forEach(el => el.classList.remove('open'));

  if (!isOpen) {
    sub.classList.add('show');
    card.querySelector('.sub-arrow')?.classList.add('open');
  }
}

// Tutup saat klik luar
document.addEventListener('click', function(e) {
  if (!e.target.closest('.layanan-card')) {
    document.querySelectorAll('.layanan-sub.show').forEach(el => el.classList.remove('show'));
    document.querySelectorAll('.sub-arrow.open').forEach(el => el.classList.remove('open'));
  }
});
</script>