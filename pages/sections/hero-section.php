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
          <span class="bg-[#F5C518]/10 border border-[#F5C518]/20 text-[#F5C518] text-[11px] font-semibold px-3.5 py-1.5 rounded-full">● Antar 2–4 Jam</span>
          <span class="bg-[#F5C518]/10 border border-[#F5C518]/20 text-[#F5C518] text-[11px] font-semibold px-3.5 py-1.5 rounded-full">● Bunga Segar</span>
          <span class="bg-[#F5C518]/10 border border-[#F5C518]/20 text-[#F5C518] text-[11px] font-semibold px-3.5 py-1.5 rounded-full">● Custom Design</span>
          <span class="bg-[#F5C518]/10 border border-[#F5C518]/20 text-[#F5C518] text-[11px] font-semibold px-3.5 py-1.5 rounded-full">● Buka 24 Jam</span>
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

        <!-- Gambar 1 — bannersub.png: landscape, atas -->
        <div class="hero-img-main img-card absolute top-0 left-0 z-20 w-full overflow-hidden rounded-2xl border border-white/10"
             style="height: 260px; box-shadow: -4px 8px 40px rgba(0,0,0,.45);">
          <img src="<?= BASE_URL ?>/assets/images/bannersub.png" alt="Hand Bouquet Grogol"
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
            <img src="<?= BASE_URL ?>/assets/images/1a.jpg" alt="Wedding Flower Grogol"
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
            <span class="font-serif text-2xl lg:text-3xl font-black text-white leading-none">12</span>
            <span class="text-[10px] font-semibold uppercase tracking-widest text-white/40 mt-1">Kecamatan</span>
          </div>
        </div>

        <!-- Divider -->
        <div class="hidden lg:block w-px h-12 bg-white/10"></div>
<!-- Mini Review -->
<div id="mini-review"
  class="flex items-start gap-3 bg-[#F5C518]/[0.07] border border-[#F5C518]/15 rounded-2xl px-5 py-4 flex-1 min-w-[240px] max-w-sm">

  <div>
    <div id="mini-stars" class="text-[#F5C518] text-xs mb-1.5"></div>

    <p id="mini-content"
       class="text-[12px] text-white/65 italic leading-relaxed mb-1.5">
    </p>

    <span id="mini-author"
          class="text-[11px] font-bold text-[#F5C518]"></span>
  </div>

</div>
<!-- slider script card mini -->

<script>
const testimonials = <?= json_encode($testimonials) ?>;
</script>

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