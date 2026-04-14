<?php
/* ================================================================
   KEUNGGULAN SECTION — Diagonal Slash Photo Grid
   Tema navy + gold | Desktop: gambar kiri | konten kanan
   Mobile: stack vertikal
================================================================ */
?>

<style>
  .slash-1 { clip-path: polygon(0 0, 88% 0, 100% 100%, 0 100%); }
  .slash-2 { clip-path: polygon(12% 0, 100% 0, 100% 100%, 0 100%); }
  .slash-3 { clip-path: polygon(0 0, 88% 0, 100% 100%, 0 100%); }
  .slash-4 { clip-path: polygon(12% 0, 100% 0, 100% 100%, 0 100%); }

  .slash-img {
    transition: transform .6s cubic-bezier(.4,0,.2,1), filter .4s ease;
  }
  .slash-wrap:hover .slash-img {
    transform: scale(1.07);
    filter: brightness(1.1);
  }
  .slash-wrap::after {
    content: '';
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity .3s ease;
    background: linear-gradient(135deg, rgba(245,197,24,.18) 0%, transparent 60%);
    pointer-events: none;
  }
  .slash-wrap:hover::after { opacity: 1; }

  /* Sticky photo grid desktop */
  @media (min-width: 768px) {
    .keunggulan-photo-col {
      position: sticky;
      top: 6rem;
      align-self: start;
    }
  }

  /* SEO text styling */
  .seo-block p {
    color: rgba(255,255,255,.55);
    font-size: 14px;
    line-height: 1.8;
    margin-bottom: 1rem;
  }
  .seo-block strong {
    color: rgba(255,255,255,.85);
    font-weight: 600;
  }
  .seo-block a {
    color: #F5C518;
    text-decoration: underline;
    text-underline-offset: 2px;
    transition: color .2s;
  }
  .seo-block a:hover { color: #fff; }

  /* Feature divider */
  .feat-divider {
    height: 1px;
    background: rgba(255,255,255,.06);
    margin-left: 56px;
  }
</style>

<!-- ============================================================
     KEUNGGULAN / TENTANG SECTION
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
    <div class="grid md:grid-cols-2 gap-12 lg:gap-20 items-start">

      <!-- ══════════════════════════════════
           KIRI — Diagonal Photo Grid (Sticky Desktop)
      ══════════════════════════════════ -->
      <div class="keunggulan-photo-col">
        <div class="grid grid-cols-2 gap-3 md:gap-4 relative">

          <!-- Foto 1 -->
          <div class="slash-wrap relative overflow-hidden rounded-2xl shadow-2xl group"
               style="aspect-ratio: 4/5;">
            <img src="<?= BASE_URL ?>/assets/images/biru 1.jpg"
                 class="slash-img slash-1 w-full h-full object-cover"
                 alt="Buket bunga Grogol" loading="lazy">
            <div class="slash-1 absolute inset-0"
                 style="background: linear-gradient(to top, rgba(8,23,41,.6) 0%, transparent 50%);"></div>
          </div>

          <!-- Foto 2 -->
          <div class="slash-wrap relative overflow-hidden rounded-2xl shadow-2xl mt-8 md:mt-10 group"
               style="aspect-ratio: 4/5;">
            <img src="<?= BASE_URL ?>/assets/images/biru 2.jpg"
                 class="slash-img slash-2 w-full h-full object-cover"
                 alt="Bunga pernikahan Grogol" loading="lazy">
            <div class="slash-2 absolute inset-0"
                 style="background: linear-gradient(to top, rgba(8,23,41,.6) 0%, transparent 50%);"></div>
          </div>

          <!-- Foto 3 -->
          <div class="slash-wrap relative overflow-hidden rounded-2xl shadow-2xl -mt-8 md:-mt-10 group"
               style="aspect-ratio: 4/5;">
            <img src="<?= BASE_URL ?>/assets/images/biru 3.jpg"
                 class="slash-img slash-3 w-full h-full object-cover"
                 alt="Rangkaian bunga segar Grogol" loading="lazy">
            <div class="slash-3 absolute inset-0"
                 style="background: linear-gradient(to top, rgba(8,23,41,.6) 0%, transparent 50%);"></div>
          </div>

          <!-- Foto 4 -->
          <div class="slash-wrap relative overflow-hidden rounded-2xl shadow-2xl group"
               style="aspect-ratio: 4/5;">
            <img src="<?= BASE_URL ?>/assets/images/biru 4.jpg"
                 class="slash-img slash-4 w-full h-full object-cover"
                 alt="Toko bunga Grogol terpercaya" loading="lazy">
            <div class="slash-4 absolute inset-0"
                 style="background: linear-gradient(to top, rgba(8,23,41,.6) 0%, transparent 50%);"></div>
          </div>

          <!-- Badge stats mengambang -->
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

        <!-- ── BLOK SEO TEKS ── -->
        <div class="seo-block mb-10">

          <p>
            Selamat datang di <strong><?= e(setting('site_name')) ?></strong> — <strong>toko bunga online Indonesia</strong> yang hadir khusus untuk wilayah Grogol dan sekitarnya. Sebagai <strong>florist online terpercaya</strong> dengan pengalaman lebih dari 10 tahun, kami telah melayani ribuan pelanggan dengan satu komitmen utama: menghadirkan rangkaian bunga berkualitas tinggi, pengiriman cepat, dan harga yang bersahabat. Pelajari lebih lanjut tentang kami di <a href="https://tokobungagrogol.com/#tentang">halaman tentang kami</a>.
          </p>

          <p>
            Kami hadir sebagai solusi terbaik bagi Anda yang mencari <strong>buket bunga online same day delivery seluruh Indonesia</strong>. Setiap momen berharga — ulang tahun, pernikahan, wisuda, perpisahan, hari jadi, maupun ungkapan simpati — layak dirayakan dengan bunga indah yang tiba tepat waktu. Mulai dari mawar merah elegan, buket bunga matahari ceria, hingga rangkaian lily putih yang mewah, semuanya tersedia dan siap dikirim dari Grogol ke seluruh penjuru Indonesia. Cek selengkapnya di <a href="https://tokobungagrogol.com/#layanan">halaman layanan kami</a>.
          </p>

          <p>
            Sebagai <strong>toko bunga terdekat online</strong> yang berbasis di Grogol, kami memahami kebutuhan pelanggan di wilayah Jakarta Barat dan sekitarnya. Namun lebih dari itu, kami juga beroperasi sebagai <strong>florist nasional kirim ke rumah, kantor &amp; hotel</strong> yang melayani pengiriman ke seluruh kota besar di Indonesia — Jakarta, Surabaya, Bandung, Bali, Medan, Makassar, dan masih banyak lagi. Tidak perlu khawatir soal jarak — cukup pesan dari smartphone Anda, dan kami yang urus selebihnya. Pastikan area Anda sudah terjangkau dengan melihat <a href="https://tokobungagrogol.com/#area">area pengiriman kami</a>.
          </p>

          <p>
            Bagi Anda yang membutuhkan bunga segera, layanan <strong>kirim bunga online seluruh Indonesia</strong> kami hadir dengan sistem pemrosesan pesanan yang cepat dan responsif. Begitu pesanan masuk dan pembayaran dikonfirmasi, tim florist kami langsung bekerja menyiapkan rangkaian bunga terbaik untuk Anda. Dengan estimasi waktu pengiriman yang transparan dan layanan fast response, kejutan indah Anda tidak akan terlambat. Kami bangga menjadi pilihan <strong>toko bunga online Indonesia kirim cepat seluruh kota</strong> yang dapat diandalkan kapan pun Anda membutuhkannya.
          </p>

          <p>
            Kami mengoperasikan <strong>toko bunga 24 jam online</strong> yang siap menerima pesanan kapan saja — pagi, siang, sore, malam, bahkan dini hari sekalipun. Tim customer service kami selalu siap membantu Anda menemukan pilihan bunga yang paling tepat, termasuk di hari libur nasional dan akhir pekan. Dengan sistem pemesanan yang mudah melalui website kami, Anda bisa memesan dalam hitungan menit tanpa perlu keluar rumah. Ini adalah arti sesungguhnya dari kemudahan berbelanja bunga di era digital.
          </p>

          <p>
            Berbeda dengan banyak toko konvensional yang terbatas area, kami hadir sebagai <strong>florist Indonesia murah dan premium</strong> yang tidak mengorbankan kualitas demi harga. Setiap bunga yang masuk ke workshop kami telah melalui seleksi ketat oleh tim florist berpengalaman. Kami bekerja sama dengan supplier bunga segar terpercaya yang menjamin kesegaran dan daya tahan bunga tinggi, sehingga buket yang diterima oleh orang tersayang Anda selalu tampil prima dan mekar sempurna.
          </p>

          <p>
            Keunggulan kami sebagai <strong>buket bunga online terbaik kualitas premium</strong> bukan hanya pada tampilan yang memukau, tetapi juga pada perhatian kami terhadap setiap detail — mulai dari pemilihan bunga, teknik merangkai, pemilihan wrapping, hingga pengemasan akhir yang aman untuk pengiriman. Setiap buket dikerjakan dengan penuh cinta dan profesionalisme oleh tim florist kami yang berpengalaman. Ingin tahu apa kata pelanggan kami? Baca langsung <a href="https://tokobungagrogol.com/#testimoni">testimoni pelanggan setia kami</a>.
          </p>

          <p>
            Sebagai <strong>toko bunga online harga terjangkau kirim cepat</strong>, kami menyediakan berbagai pilihan harga mulai dari ekonomis hingga premium. Harga mulai Rp 300.000 sudah bisa Anda dapatkan rangkaian bunga segar berkualitas tinggi yang dikerjakan langsung oleh florist profesional kami. Anda bisa menyesuaikan pilihan sesuai budget dan kebutuhan acara — tidak ada minimal order untuk pengiriman dalam kota, dan kami selalu memberikan nilai terbaik untuk setiap rupiah yang Anda keluarkan.
          </p>

          <p>
            Kami juga melayani kebutuhan korporat — dekorasi meja resepsionis, pengiriman bunga ucapan selamat untuk mitra bisnis, hingga rangkaian untuk acara internal perusahaan. Dengan jaringan pengiriman yang luas dan armada yang handal, kami siap menangani pesanan dalam jumlah besar dengan harga spesial dan layanan yang tetap profesional. Grand opening, seminar, pelantikan, anniversary perusahaan — semua kebutuhan bunga korporat Anda bisa kami tangani dengan standar terbaik.
          </p>

          <p>
            Kami juga terus mengikuti tren desain rangkaian bunga modern agar pilihan yang tersedia selalu relevan dengan selera pelanggan masa kini. Mulai dari buket bergaya Korean style yang kekinian, wrapping premium minimalis yang elegan, bunga papan yang megah, standing flower mewah, hingga hampers bunga kombinasi hadiah spesial — semuanya dapat Anda pesan dengan mudah. Dapatkan inspirasi terbaru dan tips merawat bunga dari <a href="https://tokobungagrogol.com/blog/">blog bunga kami</a> yang selalu diperbarui.
          </p>

          <p>
            Kami percaya bahwa bunga adalah bahasa universal yang mampu mewakili berbagai emosi — ucapan selamat, permintaan maaf, rasa rindu, dukungan, hingga ungkapan cinta yang tulus. Karena itu, setiap pesanan yang masuk selalu kami tangani secara istimewa. Tim kami akan memastikan jenis bunga, komposisi warna, kartu ucapan custom, hingga detail pengemasan disiapkan dengan teliti agar pesan yang ingin Anda sampaikan dapat diterima dengan sempurna oleh penerima.
          </p>

          <p>
            Bagi pelanggan yang baru pertama kali memesan secara online, proses pemesanan di website kami dibuat sesederhana mungkin. Anda cukup memilih kategori produk, menentukan desain favorit, mengisi alamat tujuan, lalu menyelesaikan pembayaran. Setelah itu, tim kami memproses pesanan dan memberikan update status secara berkala. Masih ada pertanyaan? Kunjungi <a href="https://tokobungagrogol.com/#faq">halaman FAQ kami</a> untuk jawaban lengkap seputar pemesanan, pengiriman, dan metode pembayaran yang tersedia.
          </p>

          <p>
            Selain tampilan yang cantik, daya tahan bunga juga menjadi prioritas utama kami. Oleh sebab itu, kami memberikan penanganan khusus mulai dari proses penyimpanan, perakitan, hingga pengiriman menggunakan teknik florist profesional yang menjaga bunga tetap segar lebih lama. Kepuasan pelanggan selalu menjadi alasan utama kami untuk terus berkembang — dan itulah mengapa banyak pelanggan kembali memesan berulang kali serta merekomendasikan layanan kami kepada keluarga, teman, dan rekan kerja mereka.
          </p>

          <p>
  Kami juga memahami bahwa setiap pelanggan memiliki kebutuhan yang berbeda-beda. Ada yang membutuhkan buket sederhana namun elegan, ada pula yang mencari rangkaian mewah untuk acara penting dan momen spesial. Karena itu, kami menyediakan layanan konsultasi personal agar setiap pesanan benar-benar sesuai dengan tujuan, karakter penerima, serta anggaran yang Anda siapkan. Dengan bantuan tim florist berpengalaman, Anda tidak perlu bingung menentukan pilihan terbaik.
</p>

<p>
  Tidak hanya fokus pada keindahan rangkaian, kami juga memperhatikan keamanan selama proses pengiriman. Setiap bunga dikemas dengan rapi menggunakan material pelindung yang sesuai agar tetap aman saat perjalanan. Untuk area Grogol, Jakarta Barat, maupun pengiriman ke kota lain di Indonesia, kami berusaha memastikan bunga tiba dalam kondisi segar, utuh, dan siap memberikan kesan terbaik kepada penerima.
</p>

<p>
  Seiring berkembangnya kebutuhan pelanggan, kami terus meningkatkan kualitas layanan mulai dari kecepatan respon, variasi produk, metode pembayaran, hingga sistem pemesanan yang lebih praktis. Kami ingin setiap orang dapat merasakan mudahnya memesan bunga secara online tanpa rasa khawatir. Ketika Anda membutuhkan hadiah yang berkesan, kejutan romantis, atau ungkapan perhatian yang tulus, florist kami di Grogol siap membantu mewujudkannya dengan pelayanan terbaik.
</p>

        </div>
        <!-- ── END BLOK SEO TEKS ── -->

        <!-- Divider tipis -->
        <div style="height:1px; background: rgba(255,255,255,.08); margin-bottom: 1.5rem;"></div>

        <!-- Feature list -->
        <div class="space-y-5">
          <?php
          $features = [
            ['icon'=>'🌺','title'=>'Bunga 100% Segar',
             'desc'=>'Kami hanya menggunakan bunga segar yang dipilih setiap hari dari pasar bunga terbaik.'],
            ['icon'=>'⚡','title'=>'Pengiriman Cepat 2–4 Jam',
             'desc'=>'Armada pengiriman kami siap mengantar ke seluruh Grogol & Indonesia dengan cepat dan aman.'],
            ['icon'=>'✏️','title'=>'Desain Custom Gratis',
             'desc'=>'Tim florist kami siap membuat rangkaian sesuai keinginan dan budget Anda — konsultasi gratis!'],
            ['icon'=>'💰','title'=>'Harga Terjangkau',
             'desc'=>'Harga mulai Rp 300.000 dengan kualitas premium. Florist murah terpercaya se-Indonesia.'],
            ['icon'=>'🕐','title'=>'Layanan 24/7',
             'desc'=>'Toko bunga 24 jam online — siap menerima pesanan kapan saja, termasuk malam hari dan hari libur.'],
          ];
          foreach ($features as $idx => $f): ?>

          <div class="flex gap-4 group/feat">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-xl flex-shrink-0 transition-all duration-300 group-hover/feat:scale-110"
                 style="background: rgba(245,197,24,.1); border: 1px solid rgba(245,197,24,.2);">
              <?= $f['icon'] ?>
            </div>
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
          <div class="feat-divider"></div>
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