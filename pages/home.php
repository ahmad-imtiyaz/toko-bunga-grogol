
<?php
require_once __DIR__ . '/../includes/config.php';

// SEO Meta
$meta_title    = setting('meta_title_home');
$meta_desc     = setting('meta_desc_home');
$meta_keywords = setting('meta_keywords_home');

// Data
$categories = db()->query("SELECT * FROM categories WHERE status='active' ORDER BY id")->fetchAll();
$products   = db()->query("SELECT p.*, c.name as cat_name FROM products p LEFT JOIN categories c ON p.category_id=c.id WHERE p.status='active' ORDER BY p.id LIMIT 8")->fetchAll();
$locations  = db()->query("SELECT * FROM locations WHERE status='active' ORDER BY id")->fetchAll();
$testimonials = db()->query("SELECT * FROM testimonials WHERE status='active' ORDER BY urutan LIMIT 6")->fetchAll();
$faqs       = db()->query("SELECT * FROM faqs WHERE status='active' ORDER BY urutan LIMIT 8")->fetchAll();
$wa_url     = setting('whatsapp_url');
$wa_msg     = urlencode('Halo, saya ingin memesan bunga. Mohon info produk dan harga yang tersedia.');

// Category icons mapping
$cat_icons = ['🌸','🕊️','💍','💐','🌿','🎊','🎁','🌼'];

require __DIR__ . '/../includes/header.php';
?>
<!-- ============================================================
     HERO SECTION — Bento Grid
============================================================ -->
<?php
/* ================================================================
   HERO SECTION — Opsi B "Overlapping Float" (versi rectangular)
   Teks kiri & kanan, 2 gambar persegi panjang di tengah
================================================================ */
?>

<!-- ============================================================
     HERO SECTION
============================================================ -->
<?php
/* ================================================================
   HERO SECTION — Tailwind CSS Version
   Desktop: Teks kiri | Dua gambar kanan (portrait overlapping)
            Stats + Review di bawah (full width)
   Mobile : Stack vertikal semua
================================================================ */
?>

<!-- Minimal CSS tambahan: hanya untuk animasi & blob -->
<style>
  @keyframes hero-pulse {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:.35; transform:scale(1.5); }
  }
  @keyframes hero-ticker {
    from { transform:translateX(0); }
    to   { transform:translateX(-33.333%); }
  }
  .hero-pulse     { animation: hero-pulse 2s infinite; }
  .ticker-track   { animation: hero-ticker 35s linear infinite; }

  .blob-gold {
    position:absolute; inset:auto; top:-160px; right:-80px;
    width:480px; height:480px; border-radius:50%; pointer-events:none;
    background:radial-gradient(circle, rgba(245,197,24,.13) 0%, transparent 70%);
    filter:blur(80px);
  }
  .blob-blue {
    position:absolute; inset:auto; bottom:-80px; left:-60px;
    width:360px; height:360px; border-radius:50%; pointer-events:none;
    background:radial-gradient(circle, rgba(30,58,138,.5) 0%, transparent 70%);
    filter:blur(80px);
  }

  .img-card       { transition: transform .4s ease; }
  .img-card:hover { transform: translateY(-6px); }
  .img-card:hover img { transform: scale(1.05); }
  .img-card img   { transition: transform .5s ease; }

  /* ── MOBILE: gambar stack, terpisah, badge pindah ke pojok atas sub ── */
  @media (max-width: 1023px) {
    .hero-images-wrap {
      position: static !important;
      height: auto !important;
      display: flex !important;
      flex-direction: column;
      gap: 16px;
      max-width: 100%;
    }
    .hero-img-main {
      position: static !important;
      width: 100% !important;
      height: 200px !important;
    }
    .hero-img-sub-wrap {
      position: relative;
      width: 72%;
      align-self: flex-end;
    }
    .hero-img-sub {
      position: static !important;
      width: 100% !important;
      height: 160px !important;
    }
    /* Badge: pojok kiri atas kotak kecil */
    .hero-badge {
      position: absolute !important;
      top: -22px !important;
      left: 14px !important;
      bottom: auto !important;
      right: auto !important;
      transform: none !important;
      width: 52px !important;
      height: 52px !important;
    }
  }
</style>

<section id="hero" class="relative overflow-hidden bg-[#0B1F4A] min-h-screen flex flex-col justify-center pt-24 pb-0">

  <!-- Ambient blobs -->
  <div class="blob-gold"></div>
  <div class="blob-blue"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 w-full">

    <!-- ════════════════════════════════════════════
         BARIS 1 — Teks Kiri | Gambar Kanan
    ════════════════════════════════════════════ -->
    <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16 py-10 lg:py-16">

      <!-- ── KIRI: Headline + CTA ── -->
      <div class="flex-1 flex flex-col">

        <!-- Overline badge -->
        <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-6 w-fit">
          <span class="hero-pulse inline-block w-1.5 h-1.5 rounded-full bg-[#F5C518]"></span>
          Florist Terpercaya Grogol
        </div>

        <!-- Headline -->
        <h1 class="font-serif text-4xl lg:text-5xl xl:text-6xl font-black leading-[1.1] text-white mb-5">
          <?= e(setting('hero_title')) ?>
        </h1>

        <!-- Subtitle -->
        <p class="text-[15px] leading-[1.8] text-white/60 mb-7 max-w-sm">
          <?= e(setting('hero_subtitle')) ?>
        </p>

        <!-- USP chips -->
        <div class="flex flex-wrap gap-2 mb-8">
          <span class="bg-[#F5C518]/10 border border-[#F5C518]/20 text-[#F5C518] text-[11px] font-semibold px-3.5 py-1.5 rounded-full">⚡ Antar 2–4 Jam</span>
          <span class="bg-[#F5C518]/10 border border-[#F5C518]/20 text-[#F5C518] text-[11px] font-semibold px-3.5 py-1.5 rounded-full">🌸 Bunga Segar</span>
          <span class="bg-[#F5C518]/10 border border-[#F5C518]/20 text-[#F5C518] text-[11px] font-semibold px-3.5 py-1.5 rounded-full">✏️ Custom Design</span>
          <span class="bg-[#F5C518]/10 border border-[#F5C518]/20 text-[#F5C518] text-[11px] font-semibold px-3.5 py-1.5 rounded-full">🕐 Buka 24 Jam</span>
        </div>

        <!-- CTA buttons -->
        <div class="flex flex-col sm:flex-row items-start gap-3">
          <a href="<?= e($wa_url) ?>?text=<?= $wa_msg ?>" target="_blank"
             class="inline-flex items-center gap-2.5 bg-[#F5C518] text-[#0B1F4A] font-bold text-[14px] px-6 py-3.5 rounded-full transition hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(245,197,24,.4)] no-underline">
            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
              <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/>
            </svg>
            Pesan via WhatsApp
          </a>
          <a href="#produk"
             class="inline-flex items-center gap-2 border border-white/20 text-white/70 font-semibold text-[13px] px-5 py-3.5 rounded-full transition hover:border-[#F5C518] hover:text-[#F5C518] no-underline">
            Lihat Produk ↓
          </a>
        </div>

      </div>

      <!-- ── KANAN: Dua Gambar ── -->
      <!-- Desktop: landscape atas + portrait bawah kanan overlapping -->
      <!-- Mobile : stack vertikal terpisah, badge di pojok atas kotak kecil -->
      <div class="hero-images-wrap relative shrink-0 w-full max-w-[480px] lg:max-w-[520px]"
           style="height: 420px;">

        <!-- Gambar 1 — banner.png: landscape, atas -->
        <div class="hero-img-main img-card absolute top-0 left-0 z-20 w-full overflow-hidden rounded-2xl border border-white/10"
             style="height: 260px; box-shadow: -4px 8px 40px rgba(0,0,0,.45);">
          <img src="<?= BASE_URL ?>/assets/images/banner.png" alt="Hand Bouquet Grogol"
               class="w-full h-full object-cover block" loading="eager">
          <div class="absolute bottom-3 left-3 bg-[#0B1F4A]/90 backdrop-blur text-[#F5C518] text-[10px] font-bold tracking-wide px-3 py-1.5 rounded-full border border-[#F5C518]/25 whitespace-nowrap">
            Toko Bunga Grogol
          </div>
        </div>

        <!-- Wrapper kotak kecil (relative di mobile agar badge bisa absolute di dalamnya) -->
        <div class="hero-img-sub-wrap lg:contents">

          <!-- Gambar 2 — bannersub.png: portrait, bawah kanan, menjorok -->
          <div class="hero-img-sub img-card overflow-hidden rounded-2xl border border-white/10 lg:absolute lg:z-30"
               style="bottom: 0; right: -20px; width: 44%; height: 210px; box-shadow: 6px 6px 40px rgba(0,0,0,.4);">
            <img src="<?= BASE_URL ?>/assets/images/bannersub.png" alt="Wedding Flower Grogol"
                 class="w-full h-full object-cover block" loading="eager">
            <div class="absolute bottom-3 left-3 bg-[#0B1F4A]/90 backdrop-blur text-[#F5C518] text-[10px] font-bold tracking-wide px-3 py-1.5 rounded-full border border-[#F5C518]/25 whitespace-nowrap">
              Nikmati Pesona Indahnya
            </div>
          </div>

          <!-- Badge 10+ Tahun:
               Desktop → titik pertemuan kedua gambar (absolute dari .hero-images-wrap)
               Mobile  → pojok kiri atas kotak kecil (absolute dari .hero-img-sub-wrap via CSS) -->
          <div class="hero-badge absolute z-40 w-16 h-16 rounded-full bg-[#F5C518] border-4 border-[#0B1F4A] flex flex-col items-center justify-center text-center"
               style="bottom: 120px; right: calc(44% - 8px); box-shadow: 0 8px 28px rgba(245,197,24,.55);">
            <span class="font-serif text-base font-black text-[#0B1F4A] leading-none">10+</span>
            <span class="text-[8px] font-bold text-[#0B1F4A]/70 uppercase tracking-wide">Tahun</span>
          </div>

        </div>

      </div>
    </div>

    <!-- ════════════════════════════════════════════
         BARIS 2 — Stats + Review (di bawah, full width)
         Berlaku di mobile & desktop
    ════════════════════════════════════════════ -->
    <div class="border-t border-white/[0.08] pt-8 pb-10">
      <div class="flex flex-col sm:flex-row flex-wrap items-start sm:items-center gap-6 lg:gap-10">

        <!-- Mulai dari harga -->
        <div class="shrink-0">
          <p class="text-xs text-white/50 font-medium mb-0.5">Mulai dari</p>
          <p class="font-serif text-2xl lg:text-3xl font-black text-[#F5C518]">Rp 300.000</p>
        </div>

        <!-- Divider -->
        <div class="hidden sm:block w-px h-12 bg-white/10"></div>

        <!-- Stats 3 item -->
        <div class="flex items-center gap-6 lg:gap-10">
          <div class="flex flex-col">
            <span class="font-serif text-2xl lg:text-3xl font-black text-white leading-none">
              500<sup class="text-sm text-[#F5C518]">+</sup>
            </span>
            <span class="text-[10px] font-semibold uppercase tracking-widest text-white/40 mt-1">Pelanggan Puas</span>
          </div>
          <div class="w-px h-10 bg-white/10"></div>
          <div class="flex flex-col">
            <span class="font-serif text-2xl lg:text-3xl font-black text-white leading-none">
              24<sup class="text-sm text-[#F5C518]">H</sup>
            </span>
            <span class="text-[10px] font-semibold uppercase tracking-widest text-white/40 mt-1">Siap Antar</span>
          </div>
          <div class="w-px h-10 bg-white/10"></div>
          <div class="flex flex-col">
            <span class="font-serif text-2xl lg:text-3xl font-black text-white leading-none">6</span>
            <span class="text-[10px] font-semibold uppercase tracking-widest text-white/40 mt-1">Kecamatan</span>
          </div>
        </div>

        <!-- Divider -->
        <div class="hidden lg:block w-px h-12 bg-white/10"></div>

        <!-- Mini Review -->
        <div class="flex items-start gap-3 bg-[#F5C518]/[0.07] border border-[#F5C518]/15 rounded-2xl px-5 py-4 flex-1 min-w-[240px] max-w-sm">
          <div>
            <div class="text-[#F5C518] text-xs mb-1.5">★★★★★</div>
            <p class="text-[12px] text-white/65 italic leading-relaxed mb-1.5">
              "Bunganya selalu segar dan cantik, pengiriman tepat waktu!"
            </p>
            <span class="text-[11px] font-bold text-[#F5C518]">— Sari D., Grogol</span>
          </div>
        </div>

      </div>
    </div>

  </div>

  <!-- ── TICKER ── -->
  <div class="border-t border-[#F5C518]/[0.12] bg-[#F5C518]/[0.04] py-3 overflow-hidden shrink-0" aria-hidden="true">
    <div class="ticker-track flex w-max">
      <?php
      $tickers = ['🌸 Hand Bouquet Premium','📋 Bunga Papan Ucapan','💍 Wedding Decoration',
                  '🕊️ Duka Cita','🎓 Buket Wisuda','⚡ Pengiriman 2–4 Jam',
                  '✏️ Custom Design','💰 Mulai Rp 300.000'];
      for ($i = 0; $i < 3; $i++):
        foreach ($tickers as $t): ?>
        <span class="inline-flex items-center gap-3.5 px-8 whitespace-nowrap text-xs font-semibold text-white/40">
          <span class="text-[#F5C518] text-[10px]">✦</span>
          <?= $t ?>
        </span>
      <?php endforeach; endfor; ?>
    </div>
  </div>

</section>

<!-- ============================================================
     LAYANAN SECTION
============================================================ -->
<section id="layanan" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-14">
      <span class="text-sage text-sm font-semibold uppercase tracking-widest">Apa yang Kami Tawarkan</span>
      <h2 class="font-serif text-3xl md:text-4xl font-bold text-navy mt-2 mb-4">Layanan Kami</h2>
      <p class="text-gray-500 max-w-xl mx-auto">Kami menyediakan berbagai jenis rangkaian bunga segar berkualitas tinggi untuk setiap momen spesial Anda di Grogol.</p>
    </div>

    <?php
    // Ambil hanya kategori INDUK (parent_id IS NULL atau 0)
    $parent_cats = array_filter($categories, fn($c) => empty($c['parent_id']) || $c['parent_id'] == 0);
    $parent_cats = array_values($parent_cats);

    // Ambil sub-kategori dan kelompokkan per parent_id
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

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
      <?php
      $fallback_colors = ['#FFF0F3','#F0FFF4','#F0F8FF','#FFFBF0','#F8F0FF','#F0FFFC','#FFF8F0','#F5F0FF'];
      foreach ($parent_cats as $i => $cat):
        $has_img   = !empty($cat['image']);
        $img_url   = $has_img ? e(imgUrl($cat['image'], 'category')) : '';
        $children  = $subs_by_parent[$cat['id']] ?? [];
        $has_subs  = !empty($children);
      ?>

      <div class="group relative rounded-2xl overflow-visible border border-gray-100 hover:border-sage/40 hover:shadow-lg transition-all duration-300 text-center layanan-card"
           style="<?= !$has_img ? 'background:' . $fallback_colors[$i % count($fallback_colors)] : '' ?>; min-height: 160px;">

        <?php if ($has_img): ?>
        <div class="absolute inset-0 overflow-hidden rounded-2xl">
          <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
               style="background-image: url('<?= $img_url ?>')"></div>
          <div class="absolute inset-0 bg-navy/40 group-hover:bg-navy/50 transition-all duration-300 rounded-2xl"></div>
        </div>
        <?php endif; ?>

        <!-- Content utama -->
        <div class="relative z-10 p-6 flex flex-col items-center justify-center h-full cursor-pointer"
             style="min-height:160px"
             <?= $has_subs ? 'onclick="toggleLayananSub(this)"' : '' ?>>

          <?php if (!empty($cat['icon'])): ?>
          <div class="text-3xl mb-3"><?= e($cat['icon']) ?></div>
          <?php endif; ?>

          <h3 class="font-serif font-semibold text-base md:text-lg <?= $has_img ? 'text-white bg-black/40' : 'text-navy' ?> px-3 py-1 rounded-lg <?= $has_img ? 'backdrop-blur-sm' : '' ?>">
            <?= e($cat['name']) ?>
          </h3>

          <?php if ($has_subs): ?>
          <!-- Tombol expand — ada sub kategori -->
          <div class="mt-3 flex items-center gap-1 text-xs font-medium transition opacity-0 group-hover:opacity-100 <?= $has_img ? 'text-white/90' : 'text-sage' ?>">
            Lihat kategori
            <svg class="w-3.5 h-3.5 sub-arrow transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>
          <?php else: ?>
          <!-- Langsung link — tidak ada sub kategori -->
          <a href="<?= BASE_URL ?>/<?= e($cat['slug']) ?>/"
             class="mt-3 text-xs font-medium transition opacity-0 group-hover:opacity-100 <?= $has_img ? 'text-white/90' : 'text-sage' ?>"
             onclick="event.stopPropagation()">
            Lihat selengkapnya →
          </a>
          <?php endif; ?>
        </div>

        <?php if ($has_subs): ?>
        <!-- ── Sub-kategori dropdown panel ── -->
        <div class="layanan-sub hidden absolute left-0 right-0 top-full mt-2 bg-white border border-gray-100 rounded-2xl shadow-xl z-50 p-3 text-left"
             onclick="event.stopPropagation()">
          <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider px-2 mb-2">
            Pilih kategori <?= e($cat['name']) ?>
          </p>
          <?php foreach ($children as $ch): ?>
          <a href="<?= BASE_URL ?>/<?= e($ch['slug']) ?>/"
             class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-sage/10 hover:text-sage transition text-sm font-medium text-gray-700">
            <span class="w-1.5 h-1.5 rounded-full bg-sage/40 flex-shrink-0"></span>
            <?= e($ch['name']) ?>
          </a>
          <?php endforeach; ?>
          <!-- Link ke halaman induk juga -->
          <div class="border-t border-gray-100 mt-2 pt-2">
            <a href="<?= BASE_URL ?>/<?= e($cat['slug']) ?>/"
               class="flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-navy/5 text-xs font-semibold text-navy/50 hover:text-navy transition">
              Lihat semua <?= e($cat['name']) ?> →
            </a>
          </div>
        </div>
        <?php endif; ?>

      </div><!-- /layanan-card -->
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
/* Pastikan card bisa overflow untuk dropdown */
#layanan .grid { overflow: visible; }
.layanan-card  { position: relative; }
.layanan-sub   { min-width: 220px; }

/* Animasi dropdown */
.layanan-sub.show {
  display: block !important;
  animation: subDropIn .18s ease;
}
@keyframes subDropIn {
  from { opacity:0; transform:translateY(-6px); }
  to   { opacity:1; transform:translateY(0); }
}
</style>

<script>
// Toggle sub-kategori panel
function toggleLayananSub(trigger) {
  const card = trigger.closest('.layanan-card');
  const sub  = card.querySelector('.layanan-sub');
  if (!sub) return;

  const isOpen = sub.classList.contains('show');

  // Tutup semua panel lain dulu
  document.querySelectorAll('.layanan-sub.show').forEach(el => el.classList.remove('show'));
  document.querySelectorAll('.sub-arrow.rotate-180').forEach(el => el.classList.remove('rotate-180'));

  if (!isOpen) {
    sub.classList.add('show');
    trigger.querySelector('.sub-arrow')?.classList.add('rotate-180');
  }
}

// Tutup panel saat klik di luar
document.addEventListener('click', function(e) {
  if (!e.target.closest('.layanan-card')) {
    document.querySelectorAll('.layanan-sub.show').forEach(el => el.classList.remove('show'));
    document.querySelectorAll('.sub-arrow.rotate-180').forEach(el => el.classList.remove('rotate-180'));
  }
});
</script>

<!-- ============================================================
     PRODUK SECTION
============================================================ -->
<section id="produk" class="py-20 bg-cream">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-14">
      <span class="text-sage text-sm font-semibold uppercase tracking-widest">Koleksi Terbaik Kami</span>
      <h2 class="font-serif text-3xl md:text-4xl font-bold text-navy mt-2 mb-4">Produk Unggulan</h2>
      <p class="text-gray-500 max-w-xl mx-auto">Setiap rangkaian bunga dibuat dengan penuh cinta menggunakan bunga segar pilihan terbaik.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
      <?php foreach ($products as $prod): ?>
      <?php
        $img = imgUrl($prod['image'], 'product');
        $wa_prod = urlencode("Halo, saya tertarik memesan *{$prod['name']}* seharga " . rupiah($prod['price']) . ". Apakah masih tersedia?");
      ?>
      <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 group border border-gray-100 hover:border-sage/30">
        <!-- Image -->
        <div class="relative overflow-hidden aspect-[4/3]">
          <img src="<?= e($img) ?>"
               alt="<?= e($prod['name']) ?> Grogol"
               class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
               loading="lazy">
          <?php if ($prod['cat_name']): ?>
          <span class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm text-sage text-xs font-semibold px-2.5 py-1 rounded-full">
            <?= e($prod['cat_name']) ?>
          </span>
          <?php endif; ?>
        </div>
        <!-- Content -->
        <div class="p-4">
          <h3 class="font-serif font-semibold text-navy text-sm leading-tight mb-1 line-clamp-2">
            <?= e($prod['name']) ?>
          </h3>
          <p class="text-gray-400 text-xs mb-3 line-clamp-2"><?= e($prod['description']) ?></p>
          <div class="flex items-center justify-between">
            <span class="font-bold text-sage text-sm"><?= rupiah($prod['price']) ?></span>
            <a href="<?= e($wa_url) ?>?text=<?= $wa_prod ?>" target="_blank"
               class="bg-sage hover:bg-sage-dark text-white text-xs font-semibold px-3 py-1.5 rounded-full transition">
              Pesan
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- CTA -->
    <div class="text-center mt-10">
      <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya ingin melihat katalog bunga lengkap Toko Bunga Grogol.') ?>" target="_blank"
         class="inline-flex items-center gap-2 bg-navy hover:bg-navy-dark text-white font-semibold px-8 py-3.5 rounded-full transition shadow">
        Lihat Semua Produk via WA →
      </a>
    </div>
  </div>
</section>

<!-- ============================================================
     KEUNGGULAN SECTION
============================================================ -->
<section id="tentang" class="py-20 bg-white relative overflow-hidden">
  <div class="absolute top-0 right-0 w-80 h-80 bg-sage/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
  <div class="max-w-7xl mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-16 items-center">
     <!-- Image grid aesthetic -->
<div class="grid grid-cols-2 gap-4">
  
  <div class="relative group overflow-hidden rounded-2xl shadow-lg">
    <img src="<?= BASE_URL ?>/assets/images/1d.jpg"
         class="w-full aspect-square object-cover transition duration-700 group-hover:scale-110"
         alt="Buket bunga">
    <div class="absolute inset-0 bg-gradient-to-t from-pink-200/30 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
  </div>

  <div class="relative group overflow-hidden rounded-2xl shadow-lg mt-8">
    <img src="<?= BASE_URL ?>/assets/images/2d.jpg"
         class="w-full aspect-square object-cover transition duration-700 group-hover:scale-110"
         alt="Buket bunga">
    <div class="absolute inset-0 bg-gradient-to-t from-pink-200/30 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
  </div>

  <div class="relative group overflow-hidden rounded-2xl shadow-lg -mt-8">
    <img src="<?= BASE_URL ?>/assets/images/3d.jpg"
         class="w-full aspect-square object-cover transition duration-700 group-hover:scale-110"
         alt="Buket bunga">
    <div class="absolute inset-0 bg-gradient-to-t from-pink-200/30 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
  </div>

  <div class="relative group overflow-hidden rounded-2xl shadow-lg">
    <img src="<?= BASE_URL ?>/assets/images/4d.jpg"
         class="w-full aspect-square object-cover transition duration-700 group-hover:scale-110"
         alt="Buket bunga">
    <div class="absolute inset-0 bg-gradient-to-t from-pink-200/30 to-transparent opacity-0 group-hover:opacity-100 transition"></div>
  </div>

</div>

      <!-- Content -->
      <div>
        <span class="text-sage text-sm font-semibold uppercase tracking-widest">Kenapa Pilih Kami?</span>
        <h2 class="font-serif text-3xl md:text-4xl font-bold text-navy mt-2 mb-4">Florist Terpercaya di Grogol</h2>
        <p class="text-gray-600 leading-relaxed mb-8"><?= e(setting('about_text')) ?></p>

        <div class="space-y-5">
          <?php
          $features = [
            ['icon'=>'🌺','title'=>'Bunga 100% Segar','desc'=>'Kami hanya menggunakan bunga segar yang dipilih setiap hari dari pasar bunga terbaik.'],
            ['icon'=>'⚡','title'=>'Pengiriman Cepat 2-4 Jam','desc'=>'Armada pengiriman kami siap mengantar ke seluruh Grogol dengan cepat dan aman.'],
            ['icon'=>'✏️','title'=>'Desain Custom','desc'=>'Tim florist kami siap membuat rangkaian sesuai keinginan dan budget Anda.'],
            ['icon'=>'💰','title'=>'Harga Terjangkau','desc'=>'Harga mulai Rp 300.000 dengan kualitas premium yang tidak mengecewakan.'],
            ['icon'=>'🕐','title'=>'Layanan 24/7','desc'=>'Kami siap menerima pesanan kapan saja, termasuk malam hari dan hari libur.'],
          ];
          foreach ($features as $f): ?>
          <div class="flex gap-4">
            <div class="w-11 h-11 rounded-xl bg-cream flex items-center justify-center text-xl flex-shrink-0"><?= $f['icon'] ?></div>
            <div>
              <div class="font-semibold text-navy text-sm"><?= $f['title'] ?></div>
              <div class="text-gray-500 text-sm mt-0.5"><?= $f['desc'] ?></div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     AREA PENGIRIMAN SECTION
============================================================ -->
<section id="area" class="py-20 bg-navy text-white relative overflow-hidden">
  <div class="absolute inset-0 opacity-5">
    <div class="absolute top-10 left-10 text-9xl">🌸</div>
    <div class="absolute bottom-10 right-10 text-9xl">🌺</div>
  </div>
  <div class="relative max-w-7xl mx-auto px-4">
    <div class="text-center mb-14">
      <span class="text-sky text-sm font-semibold uppercase tracking-widest">Jangkauan Layanan</span>
      <h2 class="font-serif text-3xl md:text-4xl font-bold text-white mt-2 mb-4">Area Pengiriman Grogol</h2>
      <p class="text-gray-300 max-w-xl mx-auto">Kami melayani pengiriman bunga ke seluruh kecamatan di Grogol dengan cepat dan terpercaya.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
      <?php foreach ($locations as $loc): ?>
      <a href="<?= BASE_URL ?>/<?= e($loc['slug']) ?>/"
         class="group bg-white/10 hover:bg-white/20 border border-white/10 hover:border-sky/40 rounded-2xl p-5 transition-all duration-300">
        <div class="flex items-center gap-3 mb-2">
          <div class="w-8 h-8 bg-sage/30 rounded-full flex items-center justify-center text-sm">📍</div>
          <div class="font-serif font-semibold text-white"><?= e($loc['name']) ?></div>
        </div>
        <p class="text-gray-300 text-xs leading-relaxed line-clamp-2"><?= e($loc['address']) ?></p>
        <div class="mt-3 text-sky text-xs font-medium group-hover:underline">
          Lihat layanan di <?= e($loc['name']) ?> →
        </div>
      </a>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-10">
      <p class="text-gray-300 text-sm">Tidak menemukan area Anda? <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, apakah ada layanan pengiriman ke area saya?') ?>" target="_blank" class="text-sky underline hover:text-white transition">Hubungi kami via WhatsApp</a></p>
    </div>
  </div>
</section>

<!-- ============================================================
     TESTIMONIAL SECTION
============================================================ -->
<section id="testimoni" class="py-20 bg-cream">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-14">
      <span class="text-sage text-sm font-semibold uppercase tracking-widest">Apa Kata Mereka</span>
      <h2 class="font-serif text-3xl md:text-4xl font-bold text-navy mt-2 mb-4">Testimoni Pelanggan</h2>
      <p class="text-gray-500 max-w-xl mx-auto">Kepercayaan pelanggan adalah motivasi terbesar kami untuk terus memberikan yang terbaik.</p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($testimonials as $t): ?>
      <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md transition border border-gray-100 relative">
        <!-- Quote mark -->
        <div class="absolute top-4 right-5 text-5xl text-sage/10 font-serif leading-none">"</div>
        <!-- Stars -->
        <div class="flex gap-0.5 mb-4">
          <?php for ($s = 0; $s < (int)$t['rating']; $s++): ?>
          <span class="text-gold text-sm">★</span>
          <?php endfor; ?>
        </div>
        <p class="text-gray-600 text-sm leading-relaxed mb-5">"<?= e($t['content']) ?>"</p>
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-sage/20 flex items-center justify-center font-serif font-bold text-sage">
            <?= strtoupper(substr($t['name'], 0, 1)) ?>
          </div>
          <div>
            <div class="font-semibold text-navy text-sm"><?= e($t['name']) ?></div>
            <div class="text-gray-400 text-xs"><?= e($t['location']) ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============================================================
     FAQ SECTION
============================================================ -->
<section id="faq" class="py-20 bg-white">
  <!-- FAQ Schema -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      <?php foreach ($faqs as $i => $faq): ?>
      {
        "@type": "Question",
        "name": "<?= addslashes($faq['question']) ?>",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "<?= addslashes($faq['answer']) ?>"
        }
      }<?= $i < count($faqs)-1 ? ',' : '' ?>
      <?php endforeach; ?>
    ]
  }
  </script>

  <div class="max-w-4xl mx-auto px-4">
    <div class="text-center mb-14">
      <span class="text-sage text-sm font-semibold uppercase tracking-widest">Ada Pertanyaan?</span>
      <h2 class="font-serif text-3xl md:text-4xl font-bold text-navy mt-2 mb-4">FAQ</h2>
      <p class="text-gray-500">Jawaban atas pertanyaan yang paling sering ditanyakan kepada kami.</p>
    </div>

    <div class="space-y-3" id="faq-list">
      <?php foreach ($faqs as $i => $faq): ?>
      <div class="border border-gray-100 rounded-xl overflow-hidden bg-cream/50" x-data="{open:false}">
        <button onclick="toggleFaq(this)"
                class="w-full flex items-center justify-between px-6 py-4 text-left font-semibold text-navy hover:text-sage transition text-sm md:text-base">
          <?= e($faq['question']) ?>
          <svg class="w-5 h-5 flex-shrink-0 transition-transform faq-icon text-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
        <div class="faq-answer hidden px-6 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4">
          <?= e($faq['answer']) ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-10">
      <p class="text-gray-500 text-sm mb-4">Masih ada pertanyaan lain?</p>
      <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya punya pertanyaan tentang Toko Bunga Grogol.') ?>" target="_blank"
         class="inline-flex items-center gap-2 bg-sage hover:bg-sage-dark text-white font-semibold px-7 py-3.5 rounded-full transition shadow">
        💬 Tanya via WhatsApp
      </a>
    </div>
  </div>
</section>

<!-- ============================================================
     CTA BANNER SECTION
============================================================ -->
<section class="py-16 bg-gradient-to-r from-sage to-sage-dark text-white relative overflow-hidden">
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-0 left-0 text-8xl">🌸</div>
    <div class="absolute bottom-0 right-10 text-8xl">💐</div>
    <div class="absolute top-5 right-1/3 text-6xl">🌺</div>
  </div>
  <div class="relative max-w-4xl mx-auto px-4 text-center">
    <h2 class="font-serif text-3xl md:text-4xl font-bold mb-4">Siap Memesan Bunga?</h2>
    <p class="text-white/80 text-lg mb-8 max-w-xl mx-auto">Hubungi kami sekarang dan dapatkan bunga segar terbaik dengan pengiriman cepat ke seluruh Grogol.</p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya ingin memesan bunga dari Toko Bunga Grogol!') ?>" target="_blank"
         class="inline-flex items-center justify-center gap-3 bg-white text-sage font-bold px-8 py-4 rounded-full text-base hover:bg-cream transition shadow-lg">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/></svg>
        Pesan Sekarang via WhatsApp
      </a>
      <a href="tel:<?= e(setting('whatsapp_number')) ?>"
         class="inline-flex items-center justify-center gap-2 bg-white/20 hover:bg-white/30 text-white border border-white/40 font-semibold px-8 py-4 rounded-full text-base transition">
        📞 Telepon Langsung
      </a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
  // Slider Hero
let index = 0;
const slider = document.getElementById('heroSlider');
if (slider) {
  const totalSlides = slider.children.length;
  setInterval(() => {
    index = (index + 1) % totalSlides;
    slider.style.transform = `translateX(-${index * 100}%)`;
  }, 5000);
}

//lain
function toggleFaq(btn) {
  const answer = btn.nextElementSibling;
  const icon   = btn.querySelector('.faq-icon');
  answer.classList.toggle('hidden');
  icon.style.transform = answer.classList.contains('hidden') ? '' : 'rotate(180deg)';
}
</script>