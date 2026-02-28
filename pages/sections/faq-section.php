
<!-- ============================================================
     FAQ SECTION
============================================================ -->
<?php
/* ================================================================
   FAQ SECTION — Split Layout
   Kiri: headline + deskripsi + CTA WA
   Kanan: accordion FAQ
   JSON-LD schema tetap valid untuk SEO
================================================================ */
?>

<!-- FAQ Schema — tetap untuk SEO -->
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

<style>
  /* Accordion answer */
  .faq-body {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows .35s cubic-bezier(.4,0,.2,1);
  }
  .faq-body.open {
    grid-template-rows: 1fr;
  }
  .faq-body-inner {
    overflow: hidden;
  }

  /* Icon rotate */
  .faq-icon {
    transition: transform .3s cubic-bezier(.4,0,.2,1);
    flex-shrink: 0;
  }
  .faq-item.open .faq-icon {
    transform: rotate(180deg);
  }

  /* Card hover */
  .faq-item {
    transition: border-color .25s ease, box-shadow .25s ease;
  }
  .faq-item:hover {
    border-color: rgba(245,197,24,.25) !important;
  }
  .faq-item.open {
    border-color: rgba(245,197,24,.35) !important;
    box-shadow: 0 8px 32px rgba(0,0,0,.25);
  }

  /* Number dekoratif */
  .faq-num {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 11px;
    font-weight: 900;
    color: rgba(245,197,24,.4);
    letter-spacing: .05em;
    min-width: 28px;
    padding-top: 1px;
  }
  .faq-item.open .faq-num {
    color: #F5C518;
  }
</style>

<!-- ============================================================
     FAQ SECTION
============================================================ -->
<section id="faq" class="py-20 relative overflow-hidden"
         style="background: #081729;">

  <!-- Dekorasi top line -->
  <div class="absolute top-0 left-0 w-full h-px"
       style="background: linear-gradient(90deg, transparent, rgba(245,197,24,.3), transparent);"></div>

  <!-- Glow kiri -->
  <div class="absolute top-1/2 left-0 -translate-y-1/2 w-72 h-72 rounded-full pointer-events-none"
       style="background: radial-gradient(circle, rgba(245,197,24,.06) 0%, transparent 70%); filter: blur(60px);"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">

    <div class="grid md:grid-cols-2 gap-12 lg:gap-20 items-start">

      <!-- ══════════════════════════════
           KIRI — Headline + CTA
      ══════════════════════════════ -->
      <div class="md:sticky md:top-28">

        <!-- Overline -->
        <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-6">
          <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#F5C518]"></span>
          Ada Pertanyaan?
        </div>

        <h2 class="font-serif text-3xl md:text-4xl lg:text-5xl font-black text-white leading-tight mb-5">
          Pertanyaan yang<br>
          <span style="color: #F5C518;">Sering Ditanyakan</span>
        </h2>

        <p class="text-white/50 text-[15px] leading-relaxed mb-8 max-w-sm">
          Temukan jawaban atas pertanyaan umum seputar layanan, pengiriman, dan pemesanan bunga di Toko Bunga Grogol.
        </p>

        <!-- Stats kecil -->
        <div class="flex items-center gap-6 mb-10 pb-10"
             style="border-bottom: 1px solid rgba(255,255,255,.07);">
          <div>
            <div class="font-serif text-2xl font-black text-white">
              <?= count($faqs) ?>
            </div>
            <div class="text-[10px] font-bold uppercase tracking-widest text-white/35 mt-0.5">
              <?= count($faqs) > 1 ? 'Pertanyaan' : 'Pertanyaan' ?>
            </div>
          </div>
          <div class="w-px h-10" style="background: rgba(255,255,255,.08);"></div>
          <div>
            <div class="font-serif text-2xl font-black text-white">24/7</div>
            <div class="text-[10px] font-bold uppercase tracking-widest text-white/35 mt-0.5">
              Siap Bantu
            </div>
          </div>
          <div class="w-px h-10" style="background: rgba(255,255,255,.08);"></div>
          <div>
            <div class="font-serif text-2xl font-black text-white">Free</div>
            <div class="text-[10px] font-bold uppercase tracking-widest text-white/35 mt-0.5">
              Konsultasi
            </div>
          </div>
        </div>

        <!-- CTA WA -->
        <div class="flex flex-col gap-3 items-start">
          <p class="text-white/40 text-sm">Masih ada pertanyaan lain?</p>
          <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya punya pertanyaan tentang Toko Bunga Grogol.') ?>"
             target="_blank"
             class="inline-flex items-center gap-2.5 font-bold text-[#0B1F4A] px-6 py-3.5 rounded-full no-underline transition hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(245,197,24,.4)]"
             style="background: #F5C518;">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
              <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/>
            </svg>
            Tanya via WhatsApp
          </a>
        </div>

      </div>

      <!-- ══════════════════════════════
           KANAN — Accordion FAQ
      ══════════════════════════════ -->
      <div class="space-y-3">

        <?php foreach ($faqs as $i => $faq): ?>
        <div class="faq-item rounded-2xl overflow-hidden cursor-pointer"
             style="background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);"
             onclick="toggleFaqNew(this)">

          <!-- Trigger -->
          <div class="flex items-start gap-4 px-5 py-4 md:px-6 md:py-5">

            <!-- Nomor -->
            <span class="faq-num">
              <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
            </span>

            <!-- Pertanyaan -->
            <span class="flex-1 font-semibold text-white text-sm md:text-[15px] leading-snug pr-2">
              <?= e($faq['question']) ?>
            </span>

            <!-- Icon -->
            <svg class="faq-icon w-5 h-5 mt-0.5" style="color: rgba(245,197,24,.5);"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </div>

          <!-- Answer body -->
          <div class="faq-body">
            <div class="faq-body-inner">
              <div class="px-5 pb-5 md:px-6 md:pb-6 pl-[52px]"
                   style="border-top: 1px solid rgba(255,255,255,.06);">
                <p class="text-white/55 text-[13px] leading-[1.85] pt-4">
                  <?= e($faq['answer']) ?>
                </p>
              </div>
            </div>
          </div>

        </div>
        <?php endforeach; ?>

      </div>

    </div>
  </div>
</section>

<script>
function toggleFaqNew(item) {
  const body    = item.querySelector('.faq-body');
  const isOpen  = item.classList.contains('open');

  // Tutup semua
  document.querySelectorAll('.faq-item.open').forEach(el => {
    el.classList.remove('open');
    el.querySelector('.faq-body').classList.remove('open');
  });

  // Buka yang diklik (kalau belum open)
  if (!isOpen) {
    item.classList.add('open');
    body.classList.add('open');
  }
}

// Buka item pertama by default
document.addEventListener('DOMContentLoaded', function() {
  const first = document.querySelector('.faq-item');
  if (first) toggleFaqNew(first);
});
</script>
