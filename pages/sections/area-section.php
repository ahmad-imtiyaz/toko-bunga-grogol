

<!-- ============================================================
     AREA PENGIRIMAN SECTION
============================================================ -->
<?php
/* ================================================================
   AREA PENGIRIMAN SECTION — Abstract Pin Map + Card List
   Pendekatan 2: visual peta abstrak atas + kartu lokasi bawah
   Responsif mobile & desktop
================================================================ */
?>

<style>
  /* ── Pin pulse animation ── */
  @keyframes pin-pulse {
    0%   { transform: scale(1);   opacity: .8; }
    50%  { transform: scale(1.5); opacity: 0;  }
    100% { transform: scale(1);   opacity: 0;  }
  }
  @keyframes pin-float {
    0%,100% { transform: translateY(0); }
    50%      { transform: translateY(-5px); }
  }

  .pin-ring {
    animation: pin-pulse 2s ease-out infinite;
  }
  .pin-dot {
    animation: pin-float 3s ease-in-out infinite;
  }

  /* Delay tiap pin beda-beda biar ga seragam */
  .pin-wrap:nth-child(1) .pin-ring { animation-delay: 0s; }
  .pin-wrap:nth-child(2) .pin-ring { animation-delay: .4s; }
  .pin-wrap:nth-child(3) .pin-ring { animation-delay: .8s; }
  .pin-wrap:nth-child(4) .pin-ring { animation-delay: 1.2s; }
  .pin-wrap:nth-child(5) .pin-ring { animation-delay: 1.6s; }
  .pin-wrap:nth-child(6) .pin-ring { animation-delay: 0.2s; }
  .pin-wrap:nth-child(1) .pin-dot  { animation-delay: 0s; }
  .pin-wrap:nth-child(2) .pin-dot  { animation-delay: .5s; }
  .pin-wrap:nth-child(3) .pin-dot  { animation-delay: 1s; }
  .pin-wrap:nth-child(4) .pin-dot  { animation-delay: 1.5s; }
  .pin-wrap:nth-child(5) .pin-dot  { animation-delay: .3s; }
  .pin-wrap:nth-child(6) .pin-dot  { animation-delay: .7s; }

  /* ── Garis koneksi antar pin (SVG) ── */
  .map-line {
    stroke-dasharray: 6 4;
    animation: dash-move 2s linear infinite;
  }
  @keyframes dash-move {
    to { stroke-dashoffset: -20; }
  }

  /* ── Card area hover ── */
  .area-card {
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
  }
  .area-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 48px rgba(0,0,0,.4);
    border-color: rgba(245,197,24,.4) !important;
  }
  .area-card:hover .area-pin-icon {
    background: #F5C518 !important;
    color: #0B1F4A !important;
  }
</style>

<!-- ============================================================
     AREA PENGIRIMAN SECTION
============================================================ -->
<section id="area" class="py-20 relative overflow-hidden"
         style="background: #081729;">

  <!-- Dekorasi top line -->
  <div class="absolute top-0 left-0 w-full h-px"
       style="background: linear-gradient(90deg, transparent, rgba(245,197,24,.3), transparent);"></div>

  <!-- Background glow -->
  <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full pointer-events-none"
       style="background: radial-gradient(circle, rgba(245,197,24,.05) 0%, transparent 65%); filter: blur(40px);"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">

    <!-- ── Header ── -->
    <div class="text-center mb-12">
      <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-5">
        <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#F5C518]"></span>
        Jangkauan Layanan
      </div>
      <h2 class="font-serif text-3xl md:text-4xl font-black text-white mt-2 mb-4">
        Area Pengiriman Grogol
      </h2>
      <p class="text-white/45 max-w-xl mx-auto text-[15px] leading-relaxed">
        Kami melayani pengiriman bunga ke seluruh kecamatan di Grogol dengan cepat dan terpercaya.
      </p>
    </div>

    <!-- ════════════════════════════════════
         VISUAL PETA ABSTRAK
    ════════════════════════════════════ -->
    <div class="relative w-full rounded-3xl mb-12 overflow-hidden"
         style="height: 280px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.07);">

      <!-- Grid lines latar (efek peta) -->
      <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <pattern id="map-grid" width="40" height="40" patternUnits="userSpaceOnUse">
            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(245,197,24,.4)" stroke-width=".5"/>
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#map-grid)"/>
      </svg>

      <!-- Garis koneksi antar pin (SVG overlay) -->
      <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" style="overflow:visible;">
        <!-- Garis-garis koneksi — posisi disesuaikan dengan pin di bawah -->
        <line class="map-line" x1="14%" y1="42%" x2="34%" y2="62%" stroke="rgba(245,197,24,.25)" stroke-width="1.5"/>
        <line class="map-line" x1="34%" y1="62%" x2="52%" y2="38%" stroke="rgba(245,197,24,.25)" stroke-width="1.5"/>
        <line class="map-line" x1="52%" y1="38%" x2="70%" y2="65%" stroke="rgba(245,197,24,.25)" stroke-width="1.5"/>
        <line class="map-line" x1="34%" y1="62%" x2="20%" y2="76%" stroke="rgba(245,197,24,.15)" stroke-width="1"/>
        <line class="map-line" x1="52%" y1="38%" x2="78%" y2="48%" stroke="rgba(245,197,24,.15)" stroke-width="1"/>
      </svg>

      <!-- Pin-pin lokasi -->
      <!-- Posisi pakai % agar responsif -->
      <?php
      // Posisi pin di peta abstrak (% dari kiri & atas)
      // Top mulai 40%+ agar tidak nabrak badge "Antar 2-4 Jam" di pojok kanan atas
      $pin_positions = [
        ['left'=>'14%',  'top'=>'42%'],
        ['left'=>'34%',  'top'=>'62%'],
        ['left'=>'52%',  'top'=>'38%'],
        ['left'=>'70%',  'top'=>'65%'],
        ['left'=>'20%',  'top'=>'76%'],
        ['left'=>'78%',  'top'=>'48%'],
      ];
      foreach ($locations as $idx => $loc):
        $pos = $pin_positions[$idx % count($pin_positions)];
      ?>
      <div class="pin-wrap absolute z-10 flex flex-col items-center"
           style="left: <?= $pos['left'] ?>; top: <?= $pos['top'] ?>; transform: translate(-50%,-100%);">

        <!-- Pin icon + float -->
        <div class="pin-dot relative flex flex-col items-center cursor-pointer group/pin">

          <!-- Tooltip nama lokasi -->
          <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 whitespace-nowrap
                      bg-[#0B1F4A] border border-[#F5C518]/30 text-white text-[10px] font-bold
                      px-2.5 py-1 rounded-full opacity-0 group-hover/pin:opacity-100 transition-opacity duration-200 z-20
                      pointer-events-none">
            <?= e($loc['name']) ?>
          </div>

          <!-- Icon pin -->
          <div class="w-8 h-8 rounded-full flex items-center justify-center shadow-lg relative z-10"
               style="background: #F5C518; border: 2px solid #0B1F4A;">
            <svg class="w-3.5 h-3.5" fill="#0B1F4A" viewBox="0 0 24 24">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
          </div>

          <!-- Tangkai pin -->
          <div class="w-0.5 h-3" style="background: #F5C518; opacity: .6;"></div>
        </div>

        <!-- Pulse ring -->
        <div class="pin-ring absolute w-10 h-10 rounded-full border-2 border-[#F5C518]"
             style="top: -4px; left: 50%; transform: translateX(-50%);"></div>

      </div>
      <?php endforeach; ?>

      <!-- Label "Grogol & Sekitarnya" di tengah bawah -->
      <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2">
        <div class="w-1.5 h-1.5 rounded-full bg-[#F5C518] animate-pulse"></div>
        <span class="text-[11px] font-bold uppercase tracking-widest text-white/30">
          Grogol & Sekitarnya
        </span>
        <div class="w-1.5 h-1.5 rounded-full bg-[#F5C518] animate-pulse"></div>
      </div>

      <!-- Delivery badge pojok kanan atas -->
      <div class="absolute top-4 right-4 flex items-center gap-2 px-3 py-1.5 rounded-full"
           style="background: rgba(245,197,24,.1); border: 1px solid rgba(245,197,24,.25);">
        <span class="text-sm">🛵</span>
        <span class="text-[11px] font-bold text-[#F5C518]">Antar Kapanpun & Dimanapun</span>
      </div>

    </div><!-- /peta abstrak -->

    <!-- ════════════════════════════════════
         KARTU LOKASI
    ════════════════════════════════════ -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
      <?php foreach ($locations as $idx => $loc): ?>

      <a href="<?= BASE_URL ?>/<?= e($loc['slug']) ?>/"
         class="area-card group block rounded-2xl p-5 no-underline"
         style="background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);">

        <div class="flex items-start gap-3 mb-3">
          <!-- Pin icon -->
          <div class="area-pin-icon w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-300"
               style="background: rgba(245,197,24,.12); border: 1px solid rgba(245,197,24,.2);">
            <svg class="w-4 h-4 text-[#F5C518]" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
            </svg>
          </div>

          <div>
            <div class="font-serif font-bold text-white text-sm leading-tight">
              <?= e($loc['name']) ?>
            </div>
            <!-- Estimasi waktu -->
            <!-- <div class="text-[10px] font-semibold text-[#F5C518]/70 mt-0.5">
               2–4 Jam
            </div> -->
          </div>
        </div>

        <!-- Alamat -->
        <?php if (!empty($loc['address'])): ?>
        <p class="text-white/40 text-[12px] leading-relaxed line-clamp-2 mb-3">
          <?= e($loc['address']) ?>
        </p>
        <?php endif; ?>

        <!-- CTA -->
        <div class="flex items-center gap-1 text-[11px] font-bold text-[#F5C518]/60 group-hover:text-[#F5C518] transition-colors duration-200">
          Lihat layanan di sini
          <svg class="w-3 h-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
          </svg>
        </div>

      </a>

      <?php endforeach; ?>
    </div>

    <!-- ── Footer note ── -->
    <div class="text-center mt-10">
      <p class="text-white/35 text-sm">
        Tidak menemukan area Anda?
        <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, apakah ada layanan pengiriman ke area saya?') ?>"
           target="_blank"
           class="text-[#F5C518] font-semibold hover:underline transition ml-1">
          Hubungi kami via WhatsApp →
        </a>
      </p>
    </div>

  </div>
</section>