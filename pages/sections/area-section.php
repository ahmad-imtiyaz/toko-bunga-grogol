<?php
/* ================================================================
   AREA PENGIRIMAN SECTION — Pagination per 9
================================================================ */
?>

<style>
  @keyframes pin-pulse {
    0%   { transform: scale(1);   opacity: .8; }
    50%  { transform: scale(1.5); opacity: 0;  }
    100% { transform: scale(1);   opacity: 0;  }
  }
  @keyframes pin-float {
    0%,100% { transform: translateY(0); }
    50%      { transform: translateY(-5px); }
  }
  @keyframes dash-move {
    to { stroke-dashoffset: -20; }
  }
  @keyframes fadeInCard {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .pin-ring { animation: pin-pulse 2s ease-out infinite; }
  .pin-dot  { animation: pin-float 3s ease-in-out infinite; }
  .map-line { stroke-dasharray: 6 4; animation: dash-move 2s linear infinite; }

  /* Staggered animation delay untuk pin */
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
  .area-card.animate-in {
    animation: fadeInCard .35s ease both;
  }

  /* ── Pagination Styles ── */
  .area-pagination {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin-top: 32px;
    flex-wrap: wrap;
  }
  .area-page-btn {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(255,255,255,.04);
    color: rgba(255,255,255,.5);
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
    transition: all .2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
  }
  .area-page-btn:hover {
    border-color: rgba(245,197,24,.4);
    color: #F5C518;
    background: rgba(245,197,24,.08);
  }
  .area-page-btn.is-active {
    background: #F5C518;
    border-color: #F5C518;
    color: #0B1F4A;
    box-shadow: 0 4px 16px rgba(245,197,24,.3);
    cursor: default;
  }
  .area-page-btn:disabled,
  .area-page-btn[disabled] {
    opacity: .3;
    cursor: not-allowed;
    pointer-events: none;
  }
  .area-page-dots {
    color: rgba(255,255,255,.3);
    font-size: 13px;
    padding: 0 2px;
  }
  .area-page-info {
    text-align: center;
    margin-top: 10px;
    font-size: 11px;
    color: rgba(255,255,255,.3);
    letter-spacing: .05em;
  }

  /* Hide pin-wraps yang tidak tampil di halaman ini */
  .pin-map-container .pin-wrap { display: none; }
  .pin-map-container .pin-wrap.visible { display: flex; }
</style>

<!-- ============================================================
     AREA PENGIRIMAN SECTION
============================================================ -->
<section id="area" class="py-20 relative overflow-hidden"
         style="background: #081729;">

  <div class="absolute top-0 left-0 w-full h-px"
       style="background: linear-gradient(90deg, transparent, rgba(245,197,24,.3), transparent);"></div>

  <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full pointer-events-none"
       style="background: radial-gradient(circle, rgba(245,197,24,.05) 0%, transparent 65%); filter: blur(40px);"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">

    <!-- Header -->
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

    <!-- VISUAL PETA ABSTRAK -->
    <div class="relative w-full rounded-3xl mb-12 overflow-hidden"
         style="height: 280px; background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.07);">

      <svg class="absolute inset-0 w-full h-full opacity-10" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <pattern id="map-grid" width="40" height="40" patternUnits="userSpaceOnUse">
            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(245,197,24,.4)" stroke-width=".5"/>
          </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#map-grid)"/>
      </svg>

      <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg" style="overflow:visible;">
        <line class="map-line" x1="14%" y1="42%" x2="34%" y2="62%" stroke="rgba(245,197,24,.25)" stroke-width="1.5"/>
        <line class="map-line" x1="34%" y1="62%" x2="52%" y2="38%" stroke="rgba(245,197,24,.25)" stroke-width="1.5"/>
        <line class="map-line" x1="52%" y1="38%" x2="70%" y2="65%" stroke="rgba(245,197,24,.25)" stroke-width="1.5"/>
        <line class="map-line" x1="34%" y1="62%" x2="20%" y2="76%" stroke="rgba(245,197,24,.15)" stroke-width="1"/>
        <line class="map-line" x1="52%" y1="38%" x2="78%" y2="48%" stroke="rgba(245,197,24,.15)" stroke-width="1"/>
      </svg>

      <?php
      $pin_positions = [
        ['left'=>'14%', 'top'=>'42%'],
        ['left'=>'34%', 'top'=>'62%'],
        ['left'=>'52%', 'top'=>'38%'],
        ['left'=>'70%', 'top'=>'65%'],
        ['left'=>'20%', 'top'=>'76%'],
        ['left'=>'78%', 'top'=>'48%'],
      ];
      ?>

      <!-- Wrapper semua pin — JS akan kontrol mana yang visible -->
      <div class="pin-map-container absolute inset-0">
        <?php foreach ($locations as $idx => $loc):
          $pos = $pin_positions[$idx % count($pin_positions)];
        ?>
        <div class="pin-wrap absolute z-10 flex flex-col items-center"
             data-loc-index="<?= $idx ?>"
             style="left: <?= $pos['left'] ?>; top: <?= $pos['top'] ?>; transform: translate(-50%,-100%);">
          <div class="pin-dot relative flex flex-col items-center cursor-pointer group/pin">
            <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 whitespace-nowrap
                        bg-[#0B1F4A] border border-[#F5C518]/30 text-white text-[10px] font-bold
                        px-2.5 py-1 rounded-full opacity-0 group-hover/pin:opacity-100 transition-opacity duration-200 z-20
                        pointer-events-none">
              <?= e($loc['name']) ?>
            </div>
            <div class="w-8 h-8 rounded-full flex items-center justify-center shadow-lg relative z-10"
                 style="background: #F5C518; border: 2px solid #0B1F4A;">
              <svg class="w-3.5 h-3.5" fill="#0B1F4A" viewBox="0 0 24 24">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
              </svg>
            </div>
            <div class="w-0.5 h-3" style="background: #F5C518; opacity: .6;"></div>
          </div>
          <div class="pin-ring absolute w-10 h-10 rounded-full border-2 border-[#F5C518]"
               style="top: -4px; left: 50%; transform: translateX(-50%);"></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2">
        <div class="w-1.5 h-1.5 rounded-full bg-[#F5C518] animate-pulse"></div>
        <span class="text-[11px] font-bold uppercase tracking-widest text-white/30">
          Grogol & Sekitarnya
        </span>
        <div class="w-1.5 h-1.5 rounded-full bg-[#F5C518] animate-pulse"></div>
      </div>

      <div class="absolute top-4 right-4 flex items-center gap-2 px-3 py-1.5 rounded-full"
           style="background: rgba(245,197,24,.1); border: 1px solid rgba(245,197,24,.25);">
        <span class="text-sm">🛵</span>
        <span class="text-[11px] font-bold text-[#F5C518]">Antar Kapanpun & Dimanapun</span>
      </div>

    </div><!-- /peta abstrak -->

    <!-- KARTU LOKASI — dirender oleh JS -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4" id="area-cards-grid">
      <!-- Kartu di-inject JS -->
    </div>

    <!-- PAGINATION -->
    <div class="area-pagination" id="area-pagination"></div>
    <p class="area-page-info" id="area-page-info"></p>

    <!-- Footer note -->
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

<!-- ============================================================
     PAGINATION JAVASCRIPT
============================================================ -->
<script>
(function () {
  const PER_PAGE = 9;
  let currentPage = 1;

  /* ── Data locations dari PHP ── */
  const locations = <?= json_encode(array_values(array_map(function($loc) {
    return [
      'name'    => $loc['name'],
      'address' => $loc['address'] ?? '',
      'slug'    => $loc['slug'] ?? '',
    ];
  }, $locations))) ?>;

  const BASE_URL = '<?= BASE_URL ?>';

  const totalPages = Math.ceil(locations.length / PER_PAGE);

  /* ── Render kartu ── */
  function renderCards(page) {
    const grid  = document.getElementById('area-cards-grid');
    const start = (page - 1) * PER_PAGE;
    const slice = locations.slice(start, start + PER_PAGE);

    grid.innerHTML = slice.map(function (loc, i) {
      var href = loc.slug ? (BASE_URL + '/' + loc.slug + '/') : '#';
      return [
        '<a href="' + href + '" class="area-card group block rounded-2xl p-5 no-underline animate-in" style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);animation-delay:' + (i * 0.05) + 's">',
          '<div class="flex items-start gap-3 mb-3">',
            '<div class="area-pin-icon w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 transition-all duration-300" style="background:rgba(245,197,24,.12);border:1px solid rgba(245,197,24,.2);">',
              '<svg class="w-4 h-4 text-[#F5C518]" fill="currentColor" viewBox="0 0 24 24">',
                '<path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>',
              '</svg>',
            '</div>',
            '<div>',
              '<div class="font-serif font-bold text-white text-sm leading-tight">' + loc.name + '</div>',
            '</div>',
          '</div>',
          (loc.address ? '<p class="text-white/40 text-[12px] leading-relaxed line-clamp-2 mb-3">' + loc.address + '</p>' : ''),
          '<div class="flex items-center gap-1 text-[11px] font-bold text-[#F5C518]/60 group-hover:text-[#F5C518] transition-colors duration-200">',
            'Lihat layanan di sini',
            '<svg class="w-3 h-3 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">',
              '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>',
            '</svg>',
          '</div>',
        '</a>',
      ].join('');
    }).join('');
  }

  /* ── Render pin di peta (hanya pin halaman aktif, maks 6) ── */
  function renderPins(page) {
    var allPins  = document.querySelectorAll('.pin-map-container .pin-wrap');
    var start    = (page - 1) * PER_PAGE;
    var visRange = [];
    for (var i = start; i < Math.min(start + 6, locations.length); i++) {
      visRange.push(i);
    }
    allPins.forEach(function (pin) {
      var idx = parseInt(pin.getAttribute('data-loc-index'), 10);
      pin.classList.toggle('visible', visRange.indexOf(idx) !== -1);
    });
  }

  /* ── Render pagination ── */
  function renderPagination(page) {
    var pg   = document.getElementById('area-pagination');
    var info = document.getElementById('area-page-info');
    var html = '';

    // Tombol Prev
    html += '<button class="area-page-btn" ' +
      (page === 1 ? 'disabled' : 'onclick="areaGoPage(' + (page - 1) + ')"') +
      '>' +
      '<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>' +
      '</button>';

    // Nomor halaman
    for (var i = 1; i <= totalPages; i++) {
      var isActive   = i === page;
      var nearActive = Math.abs(i - page) <= 1;
      var isEdge     = i === 1 || i === totalPages;

      if (isEdge || nearActive) {
        html += '<button class="area-page-btn' + (isActive ? ' is-active' : '') + '"' +
          (isActive ? '' : ' onclick="areaGoPage(' + i + ')"') +
          '>' + i + '</button>';
      } else if (Math.abs(i - page) === 2) {
        html += '<span class="area-page-dots">…</span>';
      }
    }

    // Tombol Next
    html += '<button class="area-page-btn" ' +
      (page === totalPages ? 'disabled' : 'onclick="areaGoPage(' + (page + 1) + ')"') +
      '>' +
      '<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>' +
      '</button>';

    pg.innerHTML   = html;

    var startNum   = (page - 1) * PER_PAGE + 1;
    var endNum     = Math.min(page * PER_PAGE, locations.length);
    info.textContent = 'Menampilkan ' + startNum + '–' + endNum + ' dari ' + locations.length + ' area';
  }

  /* ── Public: ganti halaman ── */
  window.areaGoPage = function (page) {
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    renderCards(currentPage);
    renderPins(currentPage);
    renderPagination(currentPage);
    /* Scroll ke atas section, bukan top halaman */
    var section = document.getElementById('area');
    if (section) {
      section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  };

  /* ── Init ── */
  renderCards(currentPage);
  renderPins(currentPage);
  renderPagination(currentPage);

})();
</script>