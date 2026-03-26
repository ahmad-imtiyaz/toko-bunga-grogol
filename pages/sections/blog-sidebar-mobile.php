<?php
// blog-sidebar-mobile.php — Grogol theme (dark navy + gold)

$mob_categories = db()->query("
    SELECT * FROM categories
    WHERE status = 'active' AND (parent_id IS NULL OR parent_id = 0)
    ORDER BY urutan ASC, id ASC
")->fetchAll();

$mob_products = db()->query("
    SELECT p.* FROM products p
    WHERE p.status = 'active'
    ORDER BY p.id ASC LIMIT 20
")->fetchAll();
?>

<div style="background:#081729;border-top:1px solid rgba(245,197,24,.15);padding:28px 20px 44px;">
  <div style="max-width:640px;margin:0 auto;display:flex;flex-direction:column;gap:16px;">

    <!-- CTA WA -->
    <div style="background:linear-gradient(135deg,rgba(245,197,24,.15) 0%,rgba(245,197,24,.05) 100%);border:1px solid rgba(245,197,24,.25);border-radius:14px;padding:20px;text-align:center;">
      <div style="font-size:28px;margin-bottom:8px;">💬</div>
      <p style="font-family:'Playfair Display',Georgia,serif;font-weight:700;color:#fff;font-size:15px;margin-bottom:4px;">Mau Pesan Bunga?</p>
      <p style="font-size:12px;color:rgba(255,255,255,.4);margin-bottom:14px;">Konsultasi gratis. Siap 24 jam!</p>
      <a href="<?= e($wa_url) ?>" target="_blank"
         style="display:block;background:#F5C518;color:#0B1F4A;font-size:13px;font-weight:800;padding:12px;border-radius:30px;text-decoration:none;letter-spacing:.03em;">
        Chat WhatsApp Sekarang
      </a>
    </div>

    <!-- Slider Kategori Produk -->
    <?php if (!empty($mob_categories)): ?>
    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(245,197,24,.15);border-radius:14px;overflow:hidden;">
      <div style="padding:14px 18px 10px;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:center;justify-content:space-between;">
        <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:14px;font-weight:700;color:#fff;">Kategori Bunga</h3>
        <div style="display:flex;gap:4px;">
          <button onclick="slideCatMobGrogol(-1)"
                  style="width:26px;height:26px;border-radius:50%;background:rgba(245,197,24,.1);border:1px solid rgba(245,197,24,.25);color:#F5C518;font-size:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;">‹</button>
          <button onclick="slideCatMobGrogol(1)"
                  style="width:26px;height:26px;border-radius:50%;background:rgba(245,197,24,.1);border:1px solid rgba(245,197,24,.25);color:#F5C518;font-size:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;">›</button>
        </div>
      </div>
      <div style="padding:12px;">
        <div style="overflow:hidden;" id="cat-mob-track-grogol">
          <div id="cat-mob-inner-grogol" style="display:flex;gap:8px;transition:transform .3s ease;">
            <?php foreach ($mob_categories as $sc):
              $cat_img = !empty($sc['image']) && file_exists(UPLOAD_DIR . $sc['image'])
                         ? UPLOAD_URL . $sc['image']
                         : 'https://images.unsplash.com/photo-1490750967868-88df5691cc69?w=120&h=120&fit=crop';
            ?>
            <a href="<?= BASE_URL ?>/<?= e($sc['slug']) ?>/"
               style="flex-shrink:0;width:calc(33.333% - 6px);text-align:center;text-decoration:none;display:block;">
              <div style="aspect-ratio:1/1;border-radius:10px;overflow:hidden;margin-bottom:6px;border:1px solid rgba(245,197,24,.12);">
                <img src="<?= e($cat_img) ?>" alt="<?= e($sc['name']) ?>"
                     style="width:100%;height:100%;object-fit:cover;" loading="lazy">
              </div>
              <p style="font-size:10px;font-weight:600;color:rgba(255,255,255,.7);line-height:1.3;display:-webkit-box;-webkit-line-clamp:2;line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                <?= e($sc['name']) ?>
              </p>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <div id="cat-mob-dots-grogol" style="display:flex;justify-content:center;gap:5px;margin-top:10px;"></div>
      </div>
    </div>
    <?php endif; ?>

    <!-- Produk Searchable -->
    <?php if (!empty($mob_products)): ?>
    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(245,197,24,.15);border-radius:14px;overflow:hidden;">
      <div style="padding:14px 18px 10px;border-bottom:1px solid rgba(255,255,255,.06);">
        <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:14px;font-weight:700;color:#fff;">Produk Kami</h3>
      </div>
      <div style="padding:10px 14px 8px;">
        <input type="text" id="mob-prod-search-grogol"
               placeholder="Cari produk..."
               style="width:100%;padding:8px 14px;font-size:13px;border:1px solid rgba(245,197,24,.2);border-radius:30px;outline:none;color:#fff;background:rgba(255,255,255,.06);">
      </div>
      <div id="mob-prod-list-grogol" style="padding:4px 10px 10px;max-height:260px;overflow-y:auto;">
        <?php foreach ($mob_products as $prod):
          $thumb = !empty($prod['image']) && file_exists(UPLOAD_DIR . $prod['image'])
                   ? UPLOAD_URL . $prod['image']
                   : 'https://images.unsplash.com/photo-1487530811015-780780dde0e4?w=80&h=80&fit=crop';
          $wa_prod = urlencode("Halo, saya tertarik memesan *{$prod['name']}*. Apakah masih tersedia?");
        ?>
        <a href="<?= e($wa_url) ?>?text=<?= $wa_prod ?>" target="_blank"
           class="mob-prod-item-grogol"
           data-name="<?= strtolower(e($prod['name'])) ?>"
           style="display:flex;align-items:center;gap:10px;padding:8px;border-radius:10px;text-decoration:none;margin-bottom:2px;transition:background .2s;"
           onmouseover="this.style.background='rgba(245,197,24,.07)';"
           onmouseout="this.style.background='transparent';">
          <img src="<?= e($thumb) ?>" alt="<?= e($prod['name']) ?>"
               style="width:44px;height:44px;border-radius:8px;object-fit:cover;flex-shrink:0;border:1px solid rgba(245,197,24,.12);">
          <div style="flex:1;min-width:0;">
            <p style="font-size:12px;font-weight:600;color:rgba(255,255,255,.8);line-height:1.3;display:-webkit-box;-webkit-line-clamp:2;line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:3px;"><?= e($prod['name']) ?></p>
            <p style="font-size:11px;font-weight:700;color:#F5C518;"><?= rupiah($prod['price']) ?></p>
          </div>
          <svg style="width:16px;height:16px;flex-shrink:0;color:#22c55e;opacity:.7;" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.126 1.533 5.861L0 24l6.305-1.508A11.954 11.954 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 01-5.002-1.374l-.36-.214-3.735.893.944-3.639-.234-.374A9.818 9.818 0 1112 21.818z"/>
          </svg>
        </a>
        <?php endforeach; ?>
        <p id="mob-prod-nores-grogol" style="display:none;text-align:center;font-size:12px;color:rgba(255,255,255,.2);padding:12px 0;">Produk tidak ditemukan</p>
      </div>
    </div>
    <?php endif; ?>

    <!-- Kategori Artikel pills -->
    <div style="background:rgba(255,255,255,.04);border:1px solid rgba(245,197,24,.15);border-radius:14px;overflow:hidden;">
      <div style="padding:14px 18px 10px;border-bottom:1px solid rgba(255,255,255,.06);">
        <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:14px;font-weight:700;color:#fff;">Kategori Artikel</h3>
      </div>
      <div style="padding:8px 10px;display:flex;flex-wrap:wrap;gap:6px;">
        <a href="<?= BASE_URL ?>/blog/"
           style="font-size:11px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;
                  border:1px solid <?= !$filter_cat ? '#F5C518' : 'rgba(245,197,24,.25)' ?>;
                  background:<?= !$filter_cat ? '#F5C518' : 'transparent' ?>;
                  color:<?= !$filter_cat ? '#0B1F4A' : 'rgba(255,255,255,.4)' ?>;">
          Semua
        </a>
        <?php foreach ($blog_cats as $bc): $act = ($filter_cat === $bc['slug']); ?>
        <a href="<?= BASE_URL ?>/blog/?kategori=<?= e($bc['slug']) ?>"
           style="font-size:11px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;
                  border:1px solid <?= $act ? '#F5C518' : 'rgba(245,197,24,.25)' ?>;
                  background:<?= $act ? '#F5C518' : 'transparent' ?>;
                  color:<?= $act ? '#0B1F4A' : 'rgba(255,255,255,.4)' ?>;">
          <?= e($bc['name']) ?> <span style="opacity:.6;">(<?= $bc['total'] ?>)</span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Area Pengiriman -->
    <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:16px 18px;">
      <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:14px;font-weight:700;color:#F5C518;margin-bottom:12px;">📍 Area Pengiriman</h3>
      <div style="display:flex;flex-wrap:wrap;gap:6px;">
        <?php foreach ($locations as $l): ?>
        <a href="<?= BASE_URL ?>/<?= e($l['slug']) ?>/"
           style="display:inline-flex;align-items:center;gap:5px;font-size:11px;color:rgba(255,255,255,.45);text-decoration:none;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);padding:4px 12px;border-radius:20px;">
          <span style="width:3px;height:3px;border-radius:50%;background:rgba(245,197,24,.4);display:inline-block;flex-shrink:0;"></span>
          <?= e($l['name']) ?>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
</div>

<script>
/* Mobile product search */
(function(){
  const input = document.getElementById('mob-prod-search-grogol');
  const items = document.querySelectorAll('.mob-prod-item-grogol');
  const noRes = document.getElementById('mob-prod-nores-grogol');
  if (!input) return;
  input.addEventListener('input', function(){
    const q = this.value.toLowerCase().trim();
    let vis = 0;
    items.forEach(item => {
      const show = !q || item.dataset.name.includes(q);
      item.style.display = show ? '' : 'none';
      if (show) vis++;
    });
    noRes.style.display = vis > 0 ? 'none' : 'block';
  });
})();

/* Mobile category slider — 3 per page */
(function(){
  const inner  = document.getElementById('cat-mob-inner-grogol');
  const dotsEl = document.getElementById('cat-mob-dots-grogol');
  if (!inner) return;

  const items   = inner.querySelectorAll('a');
  const perPage = 3;
  const pages   = Math.ceil(items.length / perPage);
  let current   = 0;

  for (let i = 0; i < pages; i++) {
    const d = document.createElement('button');
    d.style.cssText = `width:${i===0?'16px':'6px'};height:6px;border-radius:3px;border:none;cursor:pointer;transition:all .25s ease;background:${i===0?'#F5C518':'rgba(245,197,24,.2)'};padding:0;`;
    d.onclick = () => goTo(i);
    dotsEl.appendChild(d);
  }

  function goTo(idx) {
    current = Math.max(0, Math.min(idx, pages - 1));
    const trackW = inner.parentElement.offsetWidth;
    inner.style.transform = `translateX(-${current * (trackW + 8)}px)`;
    dotsEl.querySelectorAll('button').forEach((d, i) => {
      d.style.width      = i === current ? '16px' : '6px';
      d.style.background = i === current ? '#F5C518' : 'rgba(245,197,24,.2)';
    });
  }

  window.slideCatMobGrogol = function(dir) { goTo(current + dir); };
})();
</script>

<style>
#mob-prod-list-grogol::-webkit-scrollbar { width:3px; }
#mob-prod-list-grogol::-webkit-scrollbar-track { background:rgba(255,255,255,.04); border-radius:3px; }
#mob-prod-list-grogol::-webkit-scrollbar-thumb { background:rgba(245,197,24,.3); border-radius:3px; }
#mob-prod-list-grogol::-webkit-scrollbar-thumb:hover { background:#F5C518; }
</style>