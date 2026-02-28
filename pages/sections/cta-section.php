
<!-- ============================================================
     CTA BANNER SECTION
============================================================ -->
<?php
/* ================================================================
   CTA SECTION — Cinematic Banner
   Background foto bunga + overlay navy gelap
   Teks dramatis di tengah + dua tombol
================================================================ */
?>

<style>
  /* Parallax subtle di scroll */
  .cta-bg {
    background-attachment: fixed;
    background-size: cover;
    background-position: center;
    transition: filter .3s ease;
  }

  /* Shimmer animasi pada garis gold */
  @keyframes shimmer-line {
    0%   { background-position: -200% center; }
    100% { background-position: 200% center; }
  }
  .gold-shimmer-line {
    background: linear-gradient(90deg,
      transparent 0%,
      rgba(245,197,24,.8) 40%,
      rgba(255,220,80,1) 50%,
      rgba(245,197,24,.8) 60%,
      transparent 100%
    );
    background-size: 200% auto;
    animation: shimmer-line 3s linear infinite;
  }

  /* Teks headline gradient gold */
  .cta-headline {
    background: linear-gradient(135deg, #FFFFFF 0%, #F5C518 50%, #FFE066 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  /* Particle bunga kecil melayang */
  @keyframes petal-float {
    0%   { transform: translateY(0) rotate(0deg);   opacity: 0; }
    10%  { opacity: .6; }
    90%  { opacity: .3; }
    100% { transform: translateY(-120px) rotate(180deg); opacity: 0; }
  }
  .petal {
    position: absolute;
    font-size: 18px;
    animation: petal-float linear infinite;
    pointer-events: none;
    user-select: none;
  }
</style>

<!-- ============================================================
     CTA CINEMATIC SECTION
============================================================ -->
<section class="relative overflow-hidden" style="min-height: 520px;">

  <!-- Background foto bunga dengan parallax -->
  <div class="cta-bg absolute inset-0"
       style="background-image: url('<?= BASE_URL ?>/assets/images/banner.png');"></div>

  <!-- Overlay gradient navy berlapis — dramatis -->
  <div class="absolute inset-0"
       style="background: linear-gradient(160deg,
         rgba(8,23,41,.92) 0%,
         rgba(11,31,74,.85) 40%,
         rgba(8,23,41,.95) 100%
       );"></div>

  <!-- Overlay grain texture subtle -->
  <div class="absolute inset-0 opacity-[0.04]"
       style="background-image: url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22300%22 height=%22300%22><filter id=%22n%22><feTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 stitchTiles=%22stitch%22/></filter><rect width=%22300%22 height=%22300%22 filter=%22url(%23n)%22 opacity=%221%22/></svg>');"></div>

  <!-- Garis gold atas -->
  <div class="absolute top-0 left-0 w-full h-[2px]">
    <div class="gold-shimmer-line w-full h-full"></div>
  </div>

  <!-- Garis gold bawah -->
  <div class="absolute bottom-0 left-0 w-full h-[2px]">
    <div class="gold-shimmer-line w-full h-full"></div>
  </div>

  <!-- Petals melayang (dekoratif) -->
  <span class="petal" style="left:8%;  bottom:0; animation-duration:8s;  animation-delay:0s;">🌸</span>
  <span class="petal" style="left:22%; bottom:0; animation-duration:11s; animation-delay:2s;">🌺</span>
  <span class="petal" style="left:45%; bottom:0; animation-duration:9s;  animation-delay:1s; font-size:12px;">✿</span>
  <span class="petal" style="left:65%; bottom:0; animation-duration:13s; animation-delay:3s;">🌸</span>
  <span class="petal" style="left:82%; bottom:0; animation-duration:10s; animation-delay:1.5s; font-size:14px;">🌺</span>
  <span class="petal" style="left:92%; bottom:0; animation-duration:7s;  animation-delay:4s; font-size:11px;">✿</span>

  <!-- Glow tengah -->
  <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
    <div class="w-[500px] h-[300px] rounded-full"
         style="background: radial-gradient(ellipse, rgba(245,197,24,.08) 0%, transparent 70%); filter: blur(40px);"></div>
  </div>

  <!-- ── KONTEN ── -->
  <div class="relative z-10 max-w-4xl mx-auto px-4 py-24 text-center flex flex-col items-center">

    <!-- Overline badge -->
    <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-8">
      <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#F5C518] animate-pulse"></span>
      Siap Memesan?
    </div>

    <!-- Headline dramatis -->
    <h2 class="cta-headline font-serif text-4xl md:text-5xl lg:text-6xl font-black leading-tight mb-6 max-w-2xl">
      Pesan Bunga Segar<br>Untuk Momen Spesialmu
    </h2>

    <!-- Garis dekoratif -->
    <div class="flex items-center gap-4 mb-6">
      <div class="h-px w-16 md:w-24" style="background: rgba(245,197,24,.3);"></div>
      <span class="text-[#F5C518] text-lg">✦</span>
      <div class="h-px w-16 md:w-24" style="background: rgba(245,197,24,.3);"></div>
    </div>

    <p class="text-white/60 text-base md:text-lg leading-relaxed mb-10 max-w-xl">
      Hubungi kami sekarang dan dapatkan bunga segar terbaik dengan pengiriman cepat ke seluruh Grogol.
    </p>

    <!-- Tombol CTA -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center w-full sm:w-auto">

      <!-- WA — utama gold -->
      <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya ingin memesan bunga dari Toko Bunga Grogol!') ?>"
         target="_blank"
         class="inline-flex items-center justify-center gap-2.5 font-bold text-[#0B1F4A] px-8 py-4 rounded-full no-underline transition hover:-translate-y-1 hover:shadow-[0_16px_40px_rgba(245,197,24,.5)] text-[15px]"
         style="background: #F5C518;">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
          <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/>
        </svg>
        Pesan Sekarang via WhatsApp
      </a>

      <!-- Telepon — outline -->
      <a href="tel:<?= e(setting('whatsapp_number')) ?>"
         class="inline-flex items-center justify-center gap-2.5 font-semibold text-white px-8 py-4 rounded-full no-underline transition hover:-translate-y-1 hover:bg-white/20 text-[15px]"
         style="border: 1.5px solid rgba(255,255,255,.25); background: rgba(255,255,255,.08); backdrop-filter: blur(8px);">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/>
        </svg>
        Telepon Langsung
      </a>

    </div>

    <!-- Trust badges bawah -->
    <div class="flex flex-wrap items-center justify-center gap-4 mt-10">
      <div class="flex items-center gap-1.5 text-white/35 text-[11px] font-semibold">
        <span class="text-[#F5C518]">✓</span> Respon Cepat
      </div>
      <div class="w-px h-3 bg-white/15"></div>
      <div class="flex items-center gap-1.5 text-white/35 text-[11px] font-semibold">
        <span class="text-[#F5C518]">✓</span> Bunga Segar Dijamin
      </div>
      <div class="w-px h-3 bg-white/15"></div>
      <div class="flex items-center gap-1.5 text-white/35 text-[11px] font-semibold">
        <span class="text-[#F5C518]">✓</span> Pengiriman Tepat Waktu
      </div>
      <div class="w-px h-3 bg-white/15"></div>
      <div class="flex items-center gap-1.5 text-white/35 text-[11px] font-semibold">
        <span class="text-[#F5C518]">✓</span> Buka 24 Jam
      </div>
    </div>

  </div>
</section>

