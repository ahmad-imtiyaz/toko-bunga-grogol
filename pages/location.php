<?php
require_once __DIR__ . '/../includes/config.php';

$meta_title    = $location['meta_title']       ?: 'Toko Bunga ' . $location['name'] . ' - Florist Grogol Terpercaya';
$meta_desc     = $location['meta_description'] ?: '';
$meta_keywords = 'toko bunga ' . strtolower($location['name']) . ', florist ' . strtolower($location['name']) . ', bunga Grogol';

$all_cats_raw = db()->query("SELECT * FROM categories WHERE status='active' ORDER BY urutan ASC, id ASC")->fetchAll();
$all_cats = []; $all_cats_subs = [];
foreach ($all_cats_raw as $ac) {
    $pid = $ac['parent_id'] ?? null;
    if ($pid === null || $pid == 0) $all_cats[] = $ac;
    else $all_cats_subs[$pid][] = $ac;
}

$products  = db()->query("SELECT p.*, c.name as cat_name FROM products p LEFT JOIN categories c ON p.category_id=c.id WHERE p.status='active' ORDER BY RAND() LIMIT 8")->fetchAll();
$locations = db()->query("SELECT * FROM locations WHERE status='active' ORDER BY id")->fetchAll();
$faqs      = db()->query("SELECT * FROM faqs WHERE status='active' ORDER BY urutan LIMIT 6")->fetchAll();
$wa_url    = setting('whatsapp_url');

$min_price = !empty($products) ? min(array_column($products, 'price')) : 300000;

require __DIR__ . '/../includes/header.php';
?>

<style>
/* ══════════════════════════════════════════
   LOCATION PAGE — Navy + Gold, Local Feel
══════════════════════════════════════════ */
@keyframes ticker {
  from { transform: translateX(0); }
  to   { transform: translateX(-50%); }
}
.loc-ticker-inner { animation: ticker 20s linear infinite; display:flex; white-space:nowrap; }

@keyframes shimmer-x {
  0%   { background-position: -200% center; }
  100% { background-position: 200% center; }
}
.gold-line {
  height: 1px;
  background: linear-gradient(90deg, transparent, #F5C518, #FFE066, #F5C518, transparent);
  background-size: 200% auto;
  animation: shimmer-x 3s linear infinite;
}

@keyframes fadeUp {
  from { opacity:0; transform:translateY(24px); }
  to   { opacity:1; transform:translateY(0); }
}
.reveal       { animation: fadeUp .6s ease both; }
.reveal-1     { animation-delay:.1s; }
.reveal-2     { animation-delay:.2s; }
.reveal-3     { animation-delay:.3s; }
.reveal-4     { animation-delay:.45s; }

.stat-num {
  font-family:'Playfair Display',serif;
  background: linear-gradient(135deg,#F5C518 0%,#FFE066 50%,#F5C518 100%);
  -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
}

/* Hero diagonal — KEBALIKAN dari category (kanan ke kiri) */
.diagonal-cut-r { clip-path: polygon(0 0, 100% 0, 100% 100%, 0 85%); }

/* ── Layanan grid cards (UNIK: icon-forward, no image bg) ── */
.loc-layanan-card {
  transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
}
.loc-layanan-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 48px rgba(0,0,0,.4);
  border-color: rgba(245,197,24,.4) !important;
}
.loc-layanan-icon {
  transition: transform .3s ease;
}
.loc-layanan-card:hover .loc-layanan-icon { transform: scale(1.2) rotate(-5deg); }

/* ── Product card (sama dengan category) ── */
.cat-prod-overlay { transform:translateY(100%); transition:transform .38s cubic-bezier(.4,0,.2,1); }
.cat-prod-card:hover .cat-prod-overlay { transform:translateY(0); }
.cat-prod-img { transition:transform .6s cubic-bezier(.4,0,.2,1); }
.cat-prod-card:hover .cat-prod-img { transform:scale(1.08); }
.cat-prod-card { transition:box-shadow .3s ease; }
.cat-prod-card:hover { box-shadow:0 0 0 1.5px rgba(245,197,24,.5), 0 24px 64px rgba(0,0,0,.5); }

/* ── FAQ accordion ── */
.faq-body { max-height:0; overflow:hidden; transition:max-height .35s ease; }
.faq-body.open { max-height:400px; }
.faq-btn .faq-chevron { transition:transform .25s; }
.faq-btn.open .faq-chevron { transform:rotate(180deg); }

/* ── Location pills sidebar ── */
.area-pill { transition:all .2s ease; }
.area-pill:hover, .area-pill.active {
  background:rgba(245,197,24,.15) !important;
  border-color:rgba(245,197,24,.4) !important;
  color:#F5C518 !important;
}

/* ── Sidebar accordion ── */
.sidebar-acc-content { max-height:0; overflow:hidden; transition:max-height .3s ease; }
.sidebar-acc-content.open { max-height:600px; }
.sidebar-acc-btn.open .acc-chevron { transform:rotate(180deg); }

/* ── Harga table rows ── */
.price-row { transition:background .15s; }
.price-row:hover { background:rgba(245,197,24,.06); }

/* Pin pulse animation */
@keyframes pin-pulse {
  0%,100% { box-shadow:0 0 0 0 rgba(245,197,24,.4); }
  50%     { box-shadow:0 0 0 8px rgba(245,197,24,0); }
}
.pin-dot { animation: pin-pulse 2s ease infinite; }
</style>

<!-- ════════════════════════════════════════════════
     HERO — Diagonal KANAN (kebalikan category)
════════════════════════════════════════════════ -->
<section class="relative overflow-hidden diagonal-cut-r"
         style="min-height:540px; padding-top:100px; background:#081729;">

  <!-- Dot pattern bg -->
  <div class="absolute inset-0 opacity-[0.035]"
       style="background-image:radial-gradient(circle,#F5C518 1px,transparent 1px); background-size:36px 36px;"></div>
  <!-- Gold glow kanan -->
  <div class="absolute top-0 right-0 w-[500px] h-[500px] pointer-events-none"
       style="background:radial-gradient(circle,rgba(245,197,24,.08) 0%,transparent 65%); filter:blur(40px);"></div>

  <!-- Gold line atas -->
  <div class="absolute bottom-0 left-0 right-0 gold-line" style="z-index:5;"></div>

  <!-- Breadcrumb -->
  <div class="relative z-10 max-w-7xl mx-auto px-4 pt-4 mb-10 reveal reveal-1">
    <nav class="flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest">
      <a href="<?= BASE_URL ?>/" class="text-white/35 hover:text-[#F5C518] transition">Beranda</a>
      <span class="text-white/20">—</span>
      <a href="<?= BASE_URL ?>/#area" class="text-white/35 hover:text-[#F5C518] transition">Area Kirim</a>
      <span class="text-white/20">—</span>
      <span class="text-[#F5C518]/70"><?= e($location['name']) ?></span>
    </nav>
  </div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 pb-32">
    <div class="grid md:grid-cols-2 gap-10 items-center">

      <!-- Kiri: teks -->
      <div>
        <div class="reveal reveal-1 inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-6">
          <span class="pin-dot w-2 h-2 rounded-full bg-[#F5C518] inline-block flex-shrink-0"></span>
          📍 <?= e($location['name']) ?>, Grogol
        </div>

        <h1 class="reveal reveal-2 font-serif text-4xl md:text-5xl lg:text-[56px] font-black text-white leading-tight mb-5">
          Toko Bunga<br>
          <span style="color:#F5C518;"><?= e($location['name']) ?></span>
        </h1>

        <p class="reveal reveal-3 text-white/50 text-base md:text-lg leading-relaxed mb-8 max-w-md">
          <?= !empty($location['meta_description']) ? e($location['meta_description']) : 'Florist ' . e($location['name']) . ' terpercaya — karangan bunga papan, hand bouquet, wedding, duka cita. Pengiriman cepat 2–4 jam ke seluruh ' . e($location['name']) . '.' ?>
        </p>

        <!-- Stats -->
        <div class="reveal reveal-3 flex flex-wrap items-center gap-6 mb-8">
          <div>
            <div class="stat-num text-3xl font-black">10+</div>
            <div class="text-[10px] font-bold uppercase tracking-widest text-white/35 mt-0.5">Tahun Berpengalaman</div>
          </div>
          <div class="w-px h-10" style="background:rgba(255,255,255,.1);"></div>
          <div>
            <div class="stat-num text-3xl font-black">2–4<span class="text-lg">Jam</span></div>
            <div class="text-[10px] font-bold uppercase tracking-widest text-white/35 mt-0.5">Pengiriman</div>
          </div>
          <div class="w-px h-10" style="background:rgba(255,255,255,.1);"></div>
          <div>
            <div class="stat-num text-2xl font-black"><?= 'Rp ' . number_format($min_price/1000,0,',','.') . 'rb' ?></div>
            <div class="text-[10px] font-bold uppercase tracking-widest text-white/35 mt-0.5">Mulai dari</div>
          </div>
        </div>

        <!-- CTA -->
        <div class="reveal reveal-4 flex flex-wrap gap-3">
          <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya ingin memesan bunga di ' . $location['name'] . ', Grogol.') ?>"
             target="_blank"
             class="inline-flex items-center gap-2.5 font-bold text-[#0B1F4A] px-7 py-3.5 rounded-full no-underline transition hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(245,197,24,.45)]"
             style="background:#F5C518;">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
              <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/>
            </svg>
            Pesan Sekarang
          </a>
          <a href="tel:<?= e(setting('whatsapp_number')) ?>"
             class="inline-flex items-center gap-2 font-semibold text-white px-7 py-3.5 rounded-full no-underline transition hover:bg-white/10"
             style="border:1.5px solid rgba(255,255,255,.2);">
            📞 <?= e(setting('phone_display')) ?>
          </a>
        </div>
      </div>

      <!-- Kanan: Info card mengambang — UNIK untuk location page -->
      <div class="reveal reveal-4 hidden md:block">
        <div class="rounded-3xl p-6 relative overflow-hidden"
             style="background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.1);">
          <!-- Gold accent sudut -->
          <div class="absolute top-0 right-0 w-24 h-24"
               style="background:linear-gradient(225deg,rgba(245,197,24,.15) 0%,transparent 60%);"></div>

          <p class="text-[11px] font-bold uppercase tracking-widest text-[#F5C518]/60 mb-4">Info Pengiriman</p>

          <div class="space-y-3 mb-5">
            <div class="flex items-center gap-3 py-2.5 border-b" style="border-color:rgba(255,255,255,.07);">
              <span class="text-lg flex-shrink-0">📍</span>
              <div>
                <p class="text-[11px] text-white/35 uppercase tracking-wider">Lokasi</p>
                <p class="text-white/80 text-sm font-semibold"><?= e($location['name']) ?>, Grogol</p>
              </div>
            </div>
            <div class="flex items-center gap-3 py-2.5 border-b" style="border-color:rgba(255,255,255,.07);">
              <span class="text-lg flex-shrink-0">⚡</span>
              <div>
                <p class="text-[11px] text-white/35 uppercase tracking-wider">Estimasi Pengiriman</p>
                <p class="text-white/80 text-sm font-semibold">2–4 Jam</p>
              </div>
            </div>
            <div class="flex items-center gap-3 py-2.5 border-b" style="border-color:rgba(255,255,255,.07);">
              <span class="text-lg flex-shrink-0">⏰</span>
              <div>
                <p class="text-[11px] text-white/35 uppercase tracking-wider">Jam Operasional</p>
                <p class="text-white/80 text-sm font-semibold"><?= e(setting('jam_buka')) ?></p>
              </div>
            </div>
            <div class="flex items-center gap-3 py-2.5">
              <span class="text-lg flex-shrink-0">💐</span>
              <div>
                <p class="text-[11px] text-white/35 uppercase tracking-wider">Harga Mulai</p>
                <p class="text-[#F5C518] text-sm font-black font-serif"><?= rupiah($min_price) ?></p>
              </div>
            </div>
          </div>

          <a href="<?= e($wa_url) ?>" target="_blank"
             class="flex items-center justify-center gap-2 font-bold text-[#0B1F4A] py-3 rounded-2xl no-underline transition hover:brightness-110"
             style="background:#F5C518;">
            Chat WhatsApp
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     TICKER — Area lain bergerak (gold, pakai lokasi)
════════════════════════════════════════════════ -->
<div class="overflow-hidden py-3" style="background:#F5C518;">
  <div class="loc-ticker-inner">
    <?php for ($r = 0; $r < 2; $r++): ?>
    <?php foreach ($locations as $l): ?>
    <a href="<?= BASE_URL ?>/<?= e($l['slug']) ?>/"
       class="inline-flex items-center gap-3 mx-6 text-[#0B1F4A] font-bold text-[11px] uppercase tracking-widest no-underline hover:opacity-70 transition flex-shrink-0
              <?= $l['id'] == $location['id'] ? 'opacity-100' : 'opacity-75' ?>">
      <span class="text-[#0B1F4A]/40">📍</span>
      <?= e($l['name']) ?>
    </a>
    <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>

<!-- ════════════════════════════════════════════════
     LAYANAN SECTION — UNIK: Icon cards besar
     "Layanan Bunga di Toko Bunga Grogol Jakarta Barat"
════════════════════════════════════════════════ -->
<section class="py-20 relative overflow-hidden" style="background:#0B1F4A;">

  <div class="absolute top-0 left-0 w-full h-px gold-line"></div>
  <div class="absolute inset-0 opacity-[0.03]"
       style="background-image:radial-gradient(circle,#F5C518 1px,transparent 1px); background-size:40px 40px;"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-5">
        <span class="w-1.5 h-1.5 rounded-full bg-[#F5C518] inline-block"></span>
        Tersedia di <?= e($location['name']) ?>
      </div>
      <!-- JUDUL UNIK untuk location -->
      <h2 class="font-serif text-3xl md:text-4xl font-black text-white">
        Layanan Bunga di<br>
        <span style="color:#F5C518;">Toko Bunga Grogol <?= e($location['name']) ?></span>
      </h2>
      <p class="text-white/40 mt-3 max-w-lg mx-auto text-[15px]">
        Semua kebutuhan bunga Anda tersedia dan siap dikirim ke <?= e($location['name']) ?>
      </p>
    </div>

    <!-- Icon cards — layout berbeda dari category (bukan bento, tapi equal grid dengan icon besar) -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
      <?php foreach ($all_cats as $i => $cat):
        $has_img = !empty($cat['image']);
        $subs    = $all_cats_subs[$cat['id']] ?? [];
      ?>
      <a href="<?= BASE_URL ?>/<?= e($cat['slug']) ?>/"
         class="loc-layanan-card group rounded-2xl p-5 no-underline flex flex-col gap-3"
         style="background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.07);">

        <!-- Icon besar atau thumbnail kecil -->
        <?php if ($has_img): ?>
        <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0 loc-layanan-icon">
          <img src="<?= e(imgUrl($cat['image'], 'category')) ?>"
               alt="<?= e($cat['name']) ?>"
               class="w-full h-full object-cover">
        </div>
        <?php elseif (!empty($cat['icon'])): ?>
        <div class="text-3xl loc-layanan-icon w-fit"><?= e($cat['icon']) ?></div>
        <?php else: ?>
        <div class="w-10 h-10 rounded-xl loc-layanan-icon flex items-center justify-center text-[#F5C518] font-black text-lg"
             style="background:rgba(245,197,24,.1);">✦</div>
        <?php endif; ?>

        <div class="flex-1">
          <h3 class="font-serif font-bold text-white text-sm leading-tight mb-1 group-hover:text-[#F5C518] transition">
            <?= e($cat['name']) ?>
          </h3>
          <?php if (!empty($subs)): ?>
          <p class="text-white/35 text-[11px]"><?= count($subs) ?> sub-kategori</p>
          <?php endif; ?>
        </div>

        <div class="flex items-center gap-1 text-[11px] font-bold uppercase tracking-wider text-[#F5C518]/50 group-hover:text-[#F5C518] transition">
          Lihat
          <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     PRODUK — sama dengan category.php
════════════════════════════════════════════════ -->
<section id="produk" class="py-20 relative overflow-hidden" style="background:#081729;">

  <div class="absolute top-0 left-0 w-full h-px gold-line"></div>
  <div class="absolute bottom-0 left-0 w-96 h-96 rounded-full pointer-events-none"
       style="background:radial-gradient(circle,rgba(245,197,24,.05) 0%,transparent 70%); filter:blur(60px);"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">
    <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-12">
      <div>
        <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-4">
          <span class="w-1.5 h-1.5 rounded-full bg-[#F5C518] inline-block"></span>
          Produk Populer di <?= e($location['name']) ?>
        </div>
        <h2 class="font-serif text-3xl md:text-4xl font-black text-white">
          Bunga Favorit Pelanggan
        </h2>
      </div>
      <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya ingin melihat katalog bunga untuk ' . $location['name'] . '.') ?>"
         target="_blank"
         class="inline-flex items-center gap-2 font-bold text-[#0B1F4A] px-5 py-2.5 rounded-full no-underline transition hover:brightness-110 flex-shrink-0"
         style="background:#F5C518; font-size:13px;">
        Lihat Semua via WA →
      </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5">
      <?php foreach ($products as $prod):
        $img     = imgUrl($prod['image'], 'product');
        $wa_prod = urlencode("Halo, saya tertarik memesan *{$prod['name']}* untuk dikirim ke {$location['name']}. Apakah tersedia?");
      ?>
      <div class="cat-prod-card group relative rounded-2xl overflow-hidden cursor-pointer"
           style="background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.07);">
        <div class="relative overflow-hidden aspect-[3/4]">
          <img src="<?= e($img) ?>"
               alt="<?= e($prod['name']) ?> <?= e($location['name']) ?>"
               class="cat-prod-img w-full h-full object-cover" loading="lazy">
          <div class="absolute inset-0"
               style="background:linear-gradient(to top,rgba(8,23,41,.95) 0%,rgba(8,23,41,.15) 55%,transparent 100%);"></div>
          <?php if (!empty($prod['cat_name'])): ?>
          <span class="absolute top-3 left-3 text-[10px] font-bold tracking-wider uppercase px-2.5 py-1 rounded-full"
                style="background:rgba(245,197,24,.15); border:1px solid rgba(245,197,24,.3); color:#F5C518; backdrop-filter:blur(8px);">
            <?= e($prod['cat_name']) ?>
          </span>
          <?php endif; ?>
          <div class="absolute bottom-0 left-0 right-0 p-4 z-10">
            <h3 class="font-serif font-bold text-white text-sm leading-tight line-clamp-2 mb-1"><?= e($prod['name']) ?></h3>
            <span class="font-bold text-[#F5C518] text-sm"><?= rupiah($prod['price']) ?></span>
          </div>
          <div class="cat-prod-overlay absolute inset-0 z-20 flex flex-col justify-end p-4"
               style="background:linear-gradient(to top,rgba(8,23,41,1) 0%,rgba(8,23,41,.92) 55%,rgba(8,23,41,.5) 100%);">
            <h3 class="font-serif font-bold text-white text-sm leading-tight line-clamp-2 mb-1"><?= e($prod['name']) ?></h3>
            <?php if (!empty($prod['description'])): ?>
            <p class="text-white/50 text-[11px] leading-relaxed line-clamp-2 mb-3"><?= e($prod['description']) ?></p>
            <?php endif; ?>
            <div class="flex items-center justify-between gap-2">
              <span class="font-black text-[#F5C518] text-base font-serif"><?= rupiah($prod['price']) ?></span>
              <a href="<?= e($wa_url) ?>?text=<?= $wa_prod ?>" target="_blank"
                 class="inline-flex items-center gap-1.5 text-[#0B1F4A] font-bold text-[11px] px-3.5 py-2 rounded-full no-underline transition hover:brightness-110"
                 style="background:#F5C518;" onclick="event.stopPropagation()">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                  <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/>
                </svg>
                Pesan
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ════════════════════════════════════════════════
     SEO + FAQ — UNIK: harga table + FAQ accordion
     "Toko Bunga Grogol Jakarta Barat Terpercaya"
════════════════════════════════════════════════ -->
<section class="py-20 relative overflow-hidden" style="background:#0B1F4A;">

  <div class="absolute top-0 left-0 w-full h-px gold-line"></div>
  <div class="absolute inset-0 opacity-[0.025]"
       style="background-image:radial-gradient(circle,#F5C518 1px,transparent 1px); background-size:48px 48px;"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-16 items-start">

      <!-- Kiri: SEO content + Harga table -->
      <div>
        <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-6">
          <span class="w-1.5 h-1.5 rounded-full bg-[#F5C518] inline-block"></span>
          Tentang Kami
        </div>

        <!-- JUDUL UNIK untuk location -->
        <h2 class="font-serif text-2xl md:text-3xl font-black text-white mb-5 leading-tight">
          Toko Bunga <?= e($location['name']) ?><br>
          <span style="color:#F5C518;">Terpercaya & Berpengalaman</span>
        </h2>

        <?php if (!empty($location['content'])): ?>
        <div class="text-white/50 leading-relaxed text-[15px] mb-6">
          <?= $location['content'] ?>
        </div>
        <?php endif; ?>

        <p class="text-white/45 text-[15px] leading-relaxed mb-8">
          Sebagai <strong class="text-white/80">toko bunga <?= e(strtolower($location['name'])) ?></strong> yang telah melayani pelanggan lebih dari 10 tahun, kami memahami setiap momen memerlukan rangkaian bunga yang tepat. Tim florist profesional siap membantu 24 jam.
        </p>

        <!-- Harga table — UNIK untuk location page -->
        <h3 class="font-serif text-xl font-black text-white mb-4">Daftar Harga</h3>
        <div class="rounded-2xl overflow-hidden mb-8"
             style="border:1px solid rgba(255,255,255,.08);">
          <?php
          $price_list = [
            ['Hand Bouquet',        'Rp 300.000', '💐'],
            ['Karangan Bunga Papan','Rp 350.000', '🌸'],
            ['Standing Flower',     'Rp 500.000', '🌿'],
            ['Bunga Pernikahan',    'Rp 800.000', '💍'],
            ['Bunga Duka Cita',     'Rp 350.000', '🕊️'],
            ['Parcel Bunga',        'Rp 400.000', '🎁'],
          ];
          foreach ($price_list as $i => $row): ?>
          <div class="price-row flex items-center justify-between px-4 py-3 <?= $i < count($price_list)-1 ? 'border-b' : '' ?>"
               style="border-color:rgba(255,255,255,.06);">
            <div class="flex items-center gap-3">
              <span class="text-base flex-shrink-0"><?= $row[2] ?></span>
              <span class="text-white/65 text-[13px] font-medium"><?= $row[0] ?></span>
            </div>
            <span class="font-black text-[#F5C518] text-[13px] font-serif">Mulai <?= $row[1] ?></span>
          </div>
          <?php endforeach; ?>
        </div>

        <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya ingin memesan bunga di ' . $location['name'] . '. Mohon info harga dan ketersediaannya.') ?>"
           target="_blank"
           class="inline-flex items-center gap-2.5 font-bold text-[#0B1F4A] px-7 py-3.5 rounded-full no-underline transition hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(245,197,24,.4)]"
           style="background:#F5C518;">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/>
          </svg>
          Pesan via WhatsApp
        </a>
      </div>

      <!-- Kanan: FAQ + Area lain + Layanan -->
      <div class="space-y-6">

        <!-- FAQ accordion — UNIK untuk location -->
        <?php if (!empty($faqs)): ?>
        <div class="rounded-2xl overflow-hidden"
             style="background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.07);">
          <div class="px-6 pt-5 pb-3">
            <div class="flex items-center gap-2 mb-1">
              <span class="text-[#F5C518]">❓</span>
              <h3 class="font-serif font-black text-white text-lg">FAQ — <?= e($location['name']) ?></h3>
            </div>
            <p class="text-white/35 text-[12px]">Pertanyaan umum dari pelanggan kami</p>
          </div>
          <div class="divide-y" style="border-color:rgba(255,255,255,.06);">
            <?php foreach ($faqs as $i => $faq): ?>
            <div>
              <button onclick="toggleLocFaq(this)"
                      class="faq-btn w-full flex items-start justify-between gap-3 px-6 py-4 text-left <?= $i === 0 ? 'open' : '' ?>">
                <span class="text-white/70 text-[13px] font-medium leading-snug flex-1">
                  <span class="text-[#F5C518]/50 font-black mr-2 text-[11px]"><?= str_pad($i+1,2,'0',STR_PAD_LEFT) ?>.</span>
                  <?= e($faq['question']) ?>
                </span>
                <svg class="faq-chevron w-4 h-4 text-white/25 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>
              <div class="faq-body px-6 pb-4 <?= $i === 0 ? 'open' : '' ?>">
                <p class="text-white/45 text-[13px] leading-relaxed"><?= e($faq['answer']) ?></p>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- Area lain — pills -->
        <div class="rounded-2xl p-5" style="background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.07);">
          <div class="flex items-center gap-2 mb-4">
            <span class="text-[#F5C518]">📍</span>
            <h3 class="font-serif font-black text-white">Area Lainnya</h3>
          </div>
          <div class="flex flex-wrap gap-2">
            <?php foreach ($locations as $l): ?>
            <a href="<?= BASE_URL ?>/<?= e($l['slug']) ?>/"
               class="area-pill inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[12px] font-semibold no-underline transition
                      <?= $l['id'] == $location['id'] ? 'active' : 'text-white/55' ?>"
               style="background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.08);
                      <?= $l['id'] == $location['id'] ? 'background:rgba(245,197,24,.15); border-color:rgba(245,197,24,.4); color:#F5C518;' : '' ?>">
              <span class="w-1 h-1 rounded-full <?= $l['id'] == $location['id'] ? 'bg-[#F5C518]' : 'bg-white/25' ?> flex-shrink-0 inline-block"></span>
              <?= e($l['name']) ?>
            </a>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Layanan sidebar accordion -->
        <div class="rounded-2xl p-5" style="background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.07);">
          <h3 class="font-serif font-black text-white mb-4">Layanan Kami</h3>
          <div class="space-y-1">
            <?php foreach ($all_cats as $c):
              $c_subs  = $all_cats_subs[$c['id']] ?? [];
              $has_sub = !empty($c_subs);
            ?>
            <?php if ($has_sub): ?>
            <div>
              <button onclick="toggleSidebarAcc(this)"
                      class="sidebar-acc-btn w-full flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-white/5 transition"
                      style="background:transparent; border:none; cursor:pointer;">
                <span class="text-[13px] font-medium text-white/55 transition text-left"><?= e($c['name']) ?></span>
                <svg class="acc-chevron w-3.5 h-3.5 text-white/25 transition-transform flex-shrink-0"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>
              <div class="sidebar-acc-content pl-3 border-l border-[#F5C518]/15 ml-4 mt-1">
                <a href="<?= BASE_URL ?>/<?= e($c['slug']) ?>/"
                   class="block px-3 py-1.5 text-[11px] font-bold text-[#F5C518]/50 hover:text-[#F5C518] no-underline transition">
                  Lihat semua <?= e($c['name']) ?> →
                </a>
                <?php foreach ($c_subs as $sub): ?>
                <a href="<?= BASE_URL ?>/<?= e($sub['slug']) ?>/"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-[12px] no-underline text-white/45 hover:text-[#F5C518] transition">
                  <span class="w-1 h-1 rounded-full bg-white/20 flex-shrink-0 inline-block"></span>
                  <?= e($sub['name']) ?>
                </a>
                <?php endforeach; ?>
              </div>
            </div>
            <?php else: ?>
            <a href="<?= BASE_URL ?>/<?= e($c['slug']) ?>/"
               class="flex items-center justify-between px-3 py-2.5 rounded-xl no-underline hover:bg-white/5 transition group/cat">
              <span class="text-[13px] font-medium text-white/55 group-hover/cat:text-[#F5C518] transition"><?= e($c['name']) ?></span>
              <svg class="w-3.5 h-3.5 text-white/20 group-hover/cat:text-[#F5C518] transition"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </a>
            <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- WA Card -->
        <div class="rounded-2xl p-6 text-center"
             style="background:linear-gradient(135deg,rgba(245,197,24,.12) 0%,rgba(245,197,24,.04) 100%); border:1px solid rgba(245,197,24,.2);">
          <div class="text-4xl mb-3">💬</div>
          <p class="font-serif font-bold text-white text-lg mb-1">Siap Pesan?</p>
          <p class="text-white/40 text-sm mb-5">Respon dalam hitungan menit, 24 jam</p>
          <a href="<?= e($wa_url) ?>" target="_blank"
             class="inline-flex items-center justify-center gap-2 font-bold text-[#0B1F4A] px-6 py-3 rounded-full w-full no-underline transition hover:brightness-110"
             style="background:#F5C518;">
            Chat WhatsApp Sekarang
          </a>
        </div>

      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
// FAQ accordion
function toggleLocFaq(btn) {
  const body   = btn.nextElementSibling;
  const isOpen = body.classList.contains('open');
  document.querySelectorAll('.faq-body.open').forEach(el => el.classList.remove('open'));
  document.querySelectorAll('.faq-btn.open').forEach(el => el.classList.remove('open'));
  if (!isOpen) { btn.classList.add('open'); body.classList.add('open'); }
}

// Sidebar accordion
function toggleSidebarAcc(btn) {
  const content = btn.nextElementSibling;
  const isOpen  = content.classList.contains('open');
  document.querySelectorAll('.sidebar-acc-content.open').forEach(el => el.classList.remove('open'));
  document.querySelectorAll('.sidebar-acc-btn.open').forEach(el => el.classList.remove('open'));
  if (!isOpen) { btn.classList.add('open'); content.classList.add('open'); }
}
</script>