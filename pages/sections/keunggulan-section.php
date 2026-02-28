
<?php
/* ================================================================
   KEUNGGULAN SECTION — Diagonal Slash Photo Grid
   Foto dipotong diagonal berselang-seling, tema navy + gold
   Desktop: gambar kiri | konten kanan
   Mobile : stack vertikal
================================================================ */
?>

<style>
  /* ── Diagonal clip-path untuk tiap foto ── */

  /* Foto 1: miring kanan atas ke kiri bawah */
  .slash-1 {
    clip-path: polygon(0 0, 88% 0, 100% 100%, 0 100%);
  }
  /* Foto 2: kebalikan — miring kiri atas ke kanan bawah */
  .slash-2 {
    clip-path: polygon(12% 0, 100% 0, 100% 100%, 0 100%);
  }
  /* Foto 3: sama dengan slash-1 */
  .slash-3 {
    clip-path: polygon(0 0, 88% 0, 100% 100%, 0 100%);
  }
  /* Foto 4: sama dengan slash-2 */
  .slash-4 {
    clip-path: polygon(12% 0, 100% 0, 100% 100%, 0 100%);
  }

  /* Hover: sedikit zoom + brightness */
  .slash-img {
    transition: transform .6s cubic-bezier(.4,0,.2,1), filter .4s ease;
  }
  .slash-wrap:hover .slash-img {
    transform: scale(1.07);
    filter: brightness(1.1);
  }

  /* Gold line aksen di tiap foto */
  .slash-wrap::after {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity .3s ease;
    background: linear-gradient(135deg, rgba(245,197,24,.18) 0%, transparent 60%);
    pointer-events: none;
  }
  .slash-wrap:hover::after {
    opacity: 1;
  }
</style>

<!-- ============================================================
     KEUNGGULAN SECTION
============================================================ -->
<section id="tentang" class="py-20 relative overflow-hidden"
         style="background: #0B1F4A;">

  <!-- Dekorasi top line -->
  <div class="absolute top-0 left-0 w-full h-px"
       style="background: linear-gradient(90deg, transparent, rgba(245,197,24,.3), transparent);"></div>

  <!-- Glow kiri -->
  <div class="absolute top-1/2 left-0 -translate-y-1/2 w-80 h-80 rounded-full pointer-events-none"
       style="background: radial-gradient(circle, rgba(245,197,24,.07) 0%, transparent 70%); filter: blur(60px);"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-12 lg:gap-20 items-center">

      <!-- ══════════════════════════════════
           KIRI — Diagonal Photo Grid
      ══════════════════════════════════ -->
      <div class="grid grid-cols-2 gap-3 md:gap-4">

        <!-- Foto 1 — slash kanan, offset atas -->
        <div class="slash-wrap relative overflow-hidden rounded-2xl shadow-2xl group"
             style="aspect-ratio: 4/5;">
          <img src="<?= BASE_URL ?>/assets/images/biru 1.jpg"
               class="slash-img slash-1 w-full h-full object-cover"
               alt="Buket bunga Grogol" loading="lazy">
          <div class="slash-1 absolute inset-0"
               style="background: linear-gradient(to top, rgba(8,23,41,.6) 0%, transparent 50%);"></div>
        </div>

        <!-- Foto 2 — slash kiri, turun -->
        <div class="slash-wrap relative overflow-hidden rounded-2xl shadow-2xl mt-8 md:mt-10 group"
             style="aspect-ratio: 4/5;">
          <img src="<?= BASE_URL ?>/assets/images/biru 2.jpg"
               class="slash-img slash-2 w-full h-full object-cover"
               alt="Bunga pernikahan Grogol" loading="lazy">
          <div class="slash-2 absolute inset-0"
               style="background: linear-gradient(to top, rgba(8,23,41,.6) 0%, transparent 50%);"></div>
        </div>

        <!-- Foto 3 — slash kanan, naik -->
        <div class="slash-wrap relative overflow-hidden rounded-2xl shadow-2xl -mt-8 md:-mt-10 group"
             style="aspect-ratio: 4/5;">
          <img src="<?= BASE_URL ?>/assets/images/biru 3.jpg"
               class="slash-img slash-3 w-full h-full object-cover"
               alt="Rangkaian bunga segar" loading="lazy">
          <div class="slash-3 absolute inset-0"
               style="background: linear-gradient(to top, rgba(8,23,41,.6) 0%, transparent 50%);"></div>
        </div>

        <!-- Foto 4 — slash kiri, normal -->
        <div class="slash-wrap relative overflow-hidden rounded-2xl shadow-2xl group"
             style="aspect-ratio: 4/5;">
          <img src="<?= BASE_URL ?>/assets/images/biru 4.jpg"
               class="slash-img slash-4 w-full h-full object-cover"
               alt="Toko bunga Grogol" loading="lazy">
          <div class="slash-4 absolute inset-0"
               style="background: linear-gradient(to top, rgba(8,23,41,.6) 0%, transparent 50%);"></div>
        </div>

        <!-- Badge stats mengambang di antara foto -->
        <div class="absolute hidden md:flex flex-col items-center justify-center w-20 h-20 rounded-full z-20"
             style="
               left: 50%; top: 50%;
               transform: translate(-140%, -50%);
               background: #F5C518;
               border: 4px solid #0B1F4A;
               box-shadow: 0 8px 32px rgba(245,197,24,.5);
             ">
          <span class="font-serif text-lg font-black text-[#0B1F4A] leading-none">10+</span>
          <span class="text-[8px] font-bold text-[#0B1F4A]/70 uppercase tracking-wide">Tahun</span>
        </div>

      </div>

      <!-- ══════════════════════════════════
           KANAN — Konten Keunggulan
      ══════════════════════════════════ -->
      <div>

        <!-- Overline -->
        <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-6">
          <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#F5C518]"></span>
          Kenapa Pilih Kami?
        </div>

        <h2 class="font-serif text-3xl md:text-4xl font-black text-white mt-2 mb-5 leading-tight">
          Florist Terpercaya<br>di Grogol
        </h2>

        <p class="text-white/55 leading-relaxed mb-10 text-[15px]">
          <?= e(setting('about_text')) ?>
        </p>

        <!-- Feature list -->
        <div class="space-y-5">
          <?php
          $features = [
            ['icon'=>'🌺','title'=>'Bunga 100% Segar',
             'desc'=>'Kami hanya menggunakan bunga segar yang dipilih setiap hari dari pasar bunga terbaik.'],
            ['icon'=>'⚡','title'=>'Pengiriman Cepat 2–4 Jam',
             'desc'=>'Armada pengiriman kami siap mengantar ke seluruh Grogol dengan cepat dan aman.'],
            ['icon'=>'✏️','title'=>'Desain Custom',
             'desc'=>'Tim florist kami siap membuat rangkaian sesuai keinginan dan budget Anda.'],
            ['icon'=>'💰','title'=>'Harga Terjangkau',
             'desc'=>'Harga mulai Rp 300.000 dengan kualitas premium yang tidak mengecewakan.'],
            ['icon'=>'🕐','title'=>'Layanan 24/7',
             'desc'=>'Kami siap menerima pesanan kapan saja, termasuk malam hari dan hari libur.'],
          ];
          foreach ($features as $idx => $f): ?>

          <div class="flex gap-4 group/feat">
            <!-- Icon box -->
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-xl flex-shrink-0 transition-all duration-300 group-hover/feat:scale-110"
                 style="background: rgba(245,197,24,.1); border: 1px solid rgba(245,197,24,.2);">
              <?= $f['icon'] ?>
            </div>
            <!-- Teks -->
            <div class="pt-0.5">
              <div class="font-bold text-white text-sm mb-0.5 transition-colors duration-200 group-hover/feat:text-[#F5C518]">
                <?= $f['title'] ?>
              </div>
              <div class="text-white/45 text-[13px] leading-relaxed">
                <?= $f['desc'] ?>
              </div>
            </div>
          </div>

          <?php if ($idx < count($features) - 1): ?>
          <!-- Divider tipis -->
          <div style="height:1px; background: rgba(255,255,255,.06); margin-left: 56px;"></div>
          <?php endif; ?>

          <?php endforeach; ?>
        </div>

        <!-- CTA -->
        <div class="mt-10">
          <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya ingin konsultasi tentang pesanan bunga.') ?>"
             target="_blank"
             class="inline-flex items-center gap-2.5 font-bold text-[#0B1F4A] px-7 py-3.5 rounded-full no-underline transition hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(245,197,24,.4)]"
             style="background: #F5C518;">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
              <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/>
            </svg>
            Konsultasi Gratis
          </a>
        </div>

      </div>
    </div>
  </div>
</section>