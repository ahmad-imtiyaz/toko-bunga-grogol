

<!-- ============================================================
     PRODUK SECTION
============================================================ -->
<?php
/* ================================================================
   PRODUK SECTION — Dark Card + Hover Reveal
   Tema: navy + gold, konsisten dengan hero & layanan
   Desktop: grid 4 kolom
   Mobile : grid 2 kolom
================================================================ */
?>

<style>
  /* Slide-up overlay saat hover */
  .prod-overlay {
    transform: translateY(100%);
    transition: transform .35s cubic-bezier(.4,0,.2,1);
  }
  .prod-card:hover .prod-overlay {
    transform: translateY(0);
  }

  /* Zoom gambar saat hover */
  .prod-img {
    transition: transform .6s cubic-bezier(.4,0,.2,1);
  }
  .prod-card:hover .prod-img {
    transform: scale(1.08);
  }

  /* Shimmer gold di border card saat hover */
  .prod-card {
    transition: box-shadow .3s ease, border-color .3s ease;
  }
  .prod-card:hover {
    box-shadow: 0 0 0 1.5px rgba(245,197,24,.45), 0 20px 60px rgba(0,0,0,.5);
  }
</style>

<!-- ============================================================
     PRODUK SECTION
============================================================ -->
<section id="produk" class="py-20 relative overflow-hidden"
         style="background: #081729;">

  <!-- Dekorasi top line -->
  <div class="absolute top-0 left-0 w-full h-px"
       style="background: linear-gradient(90deg, transparent, rgba(245,197,24,.3), transparent);"></div>

  <!-- Glow accent -->
  <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full pointer-events-none"
       style="background: radial-gradient(circle, rgba(245,197,24,.06) 0%, transparent 70%); filter: blur(60px);"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4">

    <!-- ── Header ── -->
    <div class="text-center mb-14">
      <div class="inline-flex items-center gap-2 bg-[#F5C518]/10 border border-[#F5C518]/25 rounded-full px-4 py-1.5 text-[11px] font-bold tracking-widest uppercase text-[#F5C518] mb-5">
        <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#F5C518]"></span>
        Koleksi Terbaik Kami
      </div>
      <h2 class="font-serif text-3xl md:text-4xl font-black text-white mt-2 mb-4">
        Produk Unggulan
      </h2>
      <p class="text-white/45 max-w-xl mx-auto text-[15px] leading-relaxed">
        Setiap rangkaian bunga dibuat dengan penuh cinta menggunakan bunga segar pilihan terbaik.
      </p>
    </div>

    <!-- ── Grid Produk ── -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5">
      <?php foreach ($products as $prod):
        $img     = imgUrl($prod['image'], 'product');
        $wa_prod = urlencode("Halo, saya tertarik memesan *{$prod['name']}* seharga " . rupiah($prod['price']) . ". Apakah masih tersedia?");
      ?>

      <div class="prod-card group relative rounded-2xl overflow-hidden cursor-pointer"
           style="background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.07);">

        <!-- Gambar -->
        <div class="relative overflow-hidden aspect-[3/4]">
          <img src="<?= e($img) ?>"
               alt="<?= e($prod['name']) ?> Grogol"
               class="prod-img w-full h-full object-cover"
               loading="lazy">

          <!-- Gradient gelap permanen di bawah gambar -->
          <div class="absolute inset-0"
               style="background: linear-gradient(to top, rgba(8,23,41,.95) 0%, rgba(8,23,41,.2) 50%, transparent 100%);"></div>

          <!-- Badge kategori -->
          <?php if (!empty($prod['cat_name'])): ?>
          <span class="absolute top-3 left-3 text-[10px] font-bold tracking-wider uppercase px-2.5 py-1 rounded-full"
                style="background: rgba(245,197,24,.15); border: 1px solid rgba(245,197,24,.3); color: #F5C518; backdrop-filter: blur(8px);">
            <?= e($prod['cat_name']) ?>
          </span>
          <?php endif; ?>

          <!-- Info nama + harga (selalu terlihat di bawah gambar) -->
          <div class="absolute bottom-0 left-0 right-0 p-4 z-10">
            <h3 class="font-serif font-bold text-white text-sm md:text-base leading-tight line-clamp-2 mb-1">
              <?= e($prod['name']) ?>
            </h3>
            <span class="font-bold text-[#F5C518] text-sm">
              <?= rupiah($prod['price']) ?>
            </span>
          </div>

          <!-- ── HOVER OVERLAY: slide up dari bawah ── -->
          <div class="prod-overlay absolute inset-0 z-20 flex flex-col justify-end p-4"
               style="background: linear-gradient(to top, rgba(8,23,41,1) 0%, rgba(8,23,41,.92) 60%, rgba(8,23,41,.5) 100%);">

            <!-- Nama -->
            <h3 class="font-serif font-bold text-white text-sm md:text-base leading-tight line-clamp-2 mb-1">
              <?= e($prod['name']) ?>
            </h3>

            <!-- Deskripsi singkat -->
            <?php if (!empty($prod['description'])): ?>
            <p class="text-white/55 text-[11px] leading-relaxed line-clamp-2 mb-3">
              <?= e($prod['description']) ?>
            </p>
            <?php endif; ?>

            <!-- Harga + Tombol -->
            <div class="flex items-center justify-between gap-2">
              <span class="font-black text-[#F5C518] text-base font-serif">
                <?= rupiah($prod['price']) ?>
              </span>
              <a href="<?= e($wa_url) ?>?text=<?= $wa_prod ?>" target="_blank"
                 class="inline-flex items-center gap-1.5 text-[#0B1F4A] font-bold text-[11px] px-3.5 py-2 rounded-full no-underline transition hover:brightness-110"
                 style="background: #F5C518;"
                 onclick="event.stopPropagation()">
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

    <!-- ── CTA Bawah ── -->
    <div class="text-center mt-12">
      <a href="<?= e($wa_url) ?>?text=<?= urlencode('Halo, saya ingin melihat katalog bunga lengkap Toko Bunga Grogol.') ?>"
         target="_blank"
         class="inline-flex items-center gap-2.5 font-bold text-[#0B1F4A] px-8 py-3.5 rounded-full no-underline transition hover:-translate-y-1 hover:shadow-[0_12px_32px_rgba(245,197,24,.4)]"
         style="background: #F5C518;">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
          <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/>
        </svg>
        Lihat Semua Produk via WhatsApp
      </a>
    </div>

  </div>
</section>