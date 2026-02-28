

<!-- ============================================================
     TESTIMONIAL SECTION
============================================================ -->
<?php
/* ================================================================
   TESTIMONI SECTION — Carousel
   Tema: navy + gold, konsisten dengan seluruh halaman
   Auto-play + drag/swipe support
================================================================ */
?>

<style>
  /* ── Carousel track ── */
  .testi-track {
    display: flex;
    transition: transform .5s cubic-bezier(.4,0,.2,1);
    will-change: transform;
  }

  .testi-slide {
    flex: 0 0 100%;
    padding: 0 8px;
  }

  @media (min-width: 768px) {
    .testi-slide { flex: 0 0 50%; }
  }
  @media (min-width: 1024px) {
    .testi-slide { flex: 0 0 33.333%; }
  }

  /* ── Card ── */
  .testi-card {
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 20px;
    padding: 28px;
    height: 100%;
    position: relative;
    transition: border-color .3s ease, box-shadow .3s ease;
  }
  .testi-card:hover {
    border-color: rgba(245,197,24,.3);
    box-shadow: 0 16px 48px rgba(0,0,0,.3);
  }

  /* Quote mark dekoratif */
  .testi-quote {
    position: absolute;
    top: 16px;
    right: 20px;
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 72px;
    line-height: 1;
    color: rgba(245,197,24,.1);
    pointer-events: none;
    user-select: none;
  }

  /* ── Dot indicator ── */
  .testi-dot {
    width: 6px;
    height: 6px;
    border-radius: 100px;
    background: rgba(255,255,255,.2);
    transition: all .3s ease;
    cursor: pointer;
  }
  .testi-dot.active {
    width: 24px;
    background: #F5C518;
  }

  /* ── Nav button ── */
  .testi-nav {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(255,255,255,.05);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all .25s ease;
    flex-shrink: 0;
  }
  .testi-nav:hover {
    background: #F5C518;
    border-color: #F5C518;
  }
  .testi-nav:hover svg {
    stroke: #0B1F4A;
  }
  .testi-nav svg {
    stroke: rgba(255,255,255,.7);
    transition: stroke .25s ease;
  }

  /* Avatar inisial */
  .testi-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(245,197,24,.15);
    border: 1.5px solid rgba(245,197,24,.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Playfair Display', Georgia, serif;
    font-weight: 700;
    font-size: 16px;
    color: #F5C518;
    flex-shrink: 0;
  }

  /* Fade edge kiri kanan (desktop) */
  .testi-fade-left {
    background: linear-gradient(to right, #0B1F4A, transparent);
  }
  .testi-fade-right {
    background: linear-gradient(to left, #0B1F4A, transparent);
  }
</style>

<!-- ============================================================
     TESTIMONI SECTION
============================================================ -->
<section id="testimoni" class="py-20 relative overflow-hidden"
         style="background: #0B1F4A;">

  <!-- Dekorasi top line -->
  <div class="absolute top-0 left-0 w-full h-px"
       style="background: linear-gradient(90deg, transparent, rgba(245,197,24,.3), transparent);"></div>

  <!-- Glow background -->
  <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[500px] h-64 pointer-events-none"
       style="background: radial-gradient(ellipse, rgba(245,197,24,.06) 0%, transparent 70%); filter: blur(40px);"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">

    <!-- ── Header ── -->
    <div class="mb-12">
      <div>
        <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-5">
          <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#F5C518]"></span>
          Apa Kata Mereka
        </div>
        <h2 class="font-serif text-3xl md:text-4xl font-black text-white mt-2 mb-3">
          Testimoni Pelanggan
        </h2>
        <p class="text-white/45 max-w-md text-[15px] leading-relaxed">
          Kepercayaan pelanggan adalah motivasi terbesar kami untuk terus memberikan yang terbaik.
        </p>
      </div>


    </div>

    <!-- ── Carousel Wrapper ── -->
    <div class="relative">

      <!-- Fade edges (desktop only) -->
      <div class="testi-fade-left absolute left-0 top-0 bottom-0 w-12 z-10 pointer-events-none hidden md:block"></div>
      <div class="testi-fade-right absolute right-0 top-0 bottom-0 w-12 z-10 pointer-events-none hidden md:block"></div>

      <!-- Overflow container -->
      <div class="overflow-hidden" id="testi-overflow">
        <div class="testi-track" id="testi-track">

          <?php foreach ($testimonials as $t): ?>
          <div class="testi-slide">
            <div class="testi-card">

              <!-- Quote dekoratif -->
              <div class="testi-quote">"</div>

              <!-- Bintang -->
              <div class="flex gap-0.5 mb-4">
                <?php for ($s = 0; $s < (int)$t['rating']; $s++): ?>
                <span class="text-[#F5C518] text-sm leading-none">★</span>
                <?php endfor; ?>
                <?php for ($s = (int)$t['rating']; $s < 5; $s++): ?>
                <span class="text-white/15 text-sm leading-none">★</span>
                <?php endfor; ?>
              </div>

              <!-- Isi testimoni -->
              <p class="text-white/65 text-[13px] leading-[1.8] mb-6 relative z-10">
                "<?= e($t['content']) ?>"
              </p>

              <!-- Author -->
              <div class="flex items-center gap-3 mt-auto">
                <div class="testi-avatar">
                  <?= strtoupper(substr($t['name'], 0, 1)) ?>
                </div>
                <div>
                  <div class="font-bold text-white text-sm">
                    <?= e($t['name']) ?>
                  </div>
                  <div class="text-white/35 text-[11px] mt-0.5">
                    <?= e($t['location']) ?>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <?php endforeach; ?>

        </div><!-- /testi-track -->
      </div><!-- /overflow -->

    </div><!-- /carousel wrapper -->

    <!-- ── Dot indicators + nav mobile ── -->
    <div class="flex items-center justify-center gap-4 mt-8">

      <!-- Nav kiri -->
      <button class="testi-nav" id="testi-prev-m" aria-label="Sebelumnya">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
        </svg>
      </button>

      <!-- Dots -->
      <div class="flex items-center gap-2" id="testi-dots"></div>

      <!-- Nav kanan -->
      <button class="testi-nav" id="testi-next-m" aria-label="Berikutnya">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
        </svg>
      </button>

    </div>

  </div>
</section>

<script>
(function() {
  const track      = document.getElementById('testi-track');
  const overflow   = document.getElementById('testi-overflow');
  const dotsWrap   = document.getElementById('testi-dots');
  const slides     = track.querySelectorAll('.testi-slide');
  const total      = slides.length;

  let current   = 0;
  let autoTimer = null;
  let startX    = 0;
  let isDragging = false;

  // Berapa slide terlihat per breakpoint
  function visibleCount() {
    if (window.innerWidth >= 1024) return 3;
    if (window.innerWidth >= 768)  return 2;
    return 1;
  }

  // Max index yang bisa dicapai
  function maxIndex() {
    return Math.max(0, total - visibleCount());
  }

  // Pindah ke index tertentu
  function goTo(idx) {
    current = Math.max(0, Math.min(idx, maxIndex()));
    const slideW = slides[0].offsetWidth;
    track.style.transform = `translateX(-${current * slideW}px)`;
    updateDots();
  }

  // Buat dots
  function buildDots() {
    dotsWrap.innerHTML = '';
    const count = maxIndex() + 1;
    for (let i = 0; i < count; i++) {
      const d = document.createElement('button');
      d.className = 'testi-dot' + (i === current ? ' active' : '');
      d.addEventListener('click', () => { goTo(i); resetAuto(); });
      dotsWrap.appendChild(d);
    }
  }

  function updateDots() {
    dotsWrap.querySelectorAll('.testi-dot').forEach((d, i) => {
      d.classList.toggle('active', i === current);
    });
  }

  // Auto-play
  function startAuto() {
    autoTimer = setInterval(() => {
      goTo(current >= maxIndex() ? 0 : current + 1);
    }, 4000);
  }
  function resetAuto() {
    clearInterval(autoTimer);
    startAuto();
  }

  // Nav buttons — hanya tombol bawah (mobile & desktop)
  ['testi-prev-m'].forEach(id => {
    document.getElementById(id)?.addEventListener('click', () => {
      goTo(current <= 0 ? maxIndex() : current - 1);
      resetAuto();
    });
  });
  ['testi-next-m'].forEach(id => {
    document.getElementById(id)?.addEventListener('click', () => {
      goTo(current >= maxIndex() ? 0 : current + 1);
      resetAuto();
    });
  });

  // Touch / drag swipe
  overflow.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
  overflow.addEventListener('touchend', e => {
    const diff = startX - e.changedTouches[0].clientX;
    if (Math.abs(diff) > 50) {
      goTo(diff > 0 ? current + 1 : current - 1);
      resetAuto();
    }
  });

  // Mouse drag
  overflow.addEventListener('mousedown', e => { isDragging = true; startX = e.clientX; });
  overflow.addEventListener('mouseup', e => {
    if (!isDragging) return;
    isDragging = false;
    const diff = startX - e.clientX;
    if (Math.abs(diff) > 50) {
      goTo(diff > 0 ? current + 1 : current - 1);
      resetAuto();
    }
  });
  overflow.addEventListener('mouseleave', () => { isDragging = false; });

  // Pause saat hover
  overflow.addEventListener('mouseenter', () => clearInterval(autoTimer));
  overflow.addEventListener('mouseleave', () => startAuto());

  // Rebuild saat resize
  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      goTo(Math.min(current, maxIndex()));
      buildDots();
    }, 150);
  });

  // Init
  buildDots();
  goTo(0);
  startAuto();
})();
</script>