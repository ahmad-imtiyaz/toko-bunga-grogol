<?php
// blog-sidebar.php — Grogol theme (dark navy + gold)
// Variabel tersedia: $blog_cats, $locations, $wa_url, $filter_cat

$sidebar_recent = db()->query("
    SELECT b.title, b.slug, b.thumbnail, b.created_at, bc.name AS cat_name
    FROM blogs b
    LEFT JOIN blog_categories bc ON b.blog_category_id = bc.id
    WHERE b.status = 'active'
    ORDER BY b.created_at DESC LIMIT 5
")->fetchAll();

$sidebar_categories = db()->query("
    SELECT * FROM categories
    WHERE status = 'active' AND (parent_id IS NULL OR parent_id = 0)
    ORDER BY urutan ASC, id ASC
")->fetchAll();

$sidebar_products = db()->query("
    SELECT p.*, c.name AS cat_name FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.status = 'active'
    ORDER BY p.id ASC LIMIT 30
")->fetchAll();
?>

<div style="display:flex;flex-direction:column;gap:14px;">

  <!-- ── Kategori Artikel ── -->
  <div style="background:rgba(255,255,255,.04);border:1px solid rgba(245,197,24,.15);border-radius:14px;overflow:hidden;">
    <div style="padding:14px 18px 10px;border-bottom:1px solid rgba(255,255,255,.06);">
      <p style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:rgba(245,197,24,.5);margin-bottom:3px;">Filter</p>
      <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:14px;font-weight:700;color:#fff;">Kategori Artikel</h3>
    </div>
    <div style="padding:8px 10px;max-height:220px;overflow-y:auto;">
      <a href="<?= BASE_URL ?>/blog/"
         style="display:flex;align-items:center;justify-content:space-between;padding:7px 10px;border-radius:8px;text-decoration:none;margin-bottom:2px;
                background:<?= !$filter_cat ? 'rgba(245,197,24,.12)' : 'transparent' ?>;
                color:<?= !$filter_cat ? '#F5C518' : 'rgba(255,255,255,.45)' ?>;">
        <span style="font-size:12px;font-weight:600;">Semua Artikel</span>
        <span style="font-size:10px;background:rgba(255,255,255,.07);padding:1px 7px;border-radius:10px;color:rgba(255,255,255,.3);">
          <?= array_sum(array_column($blog_cats, 'total')) ?>
        </span>
      </a>
      <?php foreach ($blog_cats as $bc): $act = ($filter_cat === $bc['slug']); ?>
      <a href="<?= BASE_URL ?>/blog/?kategori=<?= e($bc['slug']) ?>"
         style="display:flex;align-items:center;justify-content:space-between;padding:7px 10px;border-radius:8px;text-decoration:none;margin-bottom:2px;
                background:<?= $act ? 'rgba(245,197,24,.12)' : 'transparent' ?>;
                color:<?= $act ? '#F5C518' : 'rgba(255,255,255,.45)' ?>;">
        <span style="font-size:12px;font-weight:<?= $act ? '700' : '500' ?>;"><?= e($bc['name']) ?></span>
        <span style="font-size:10px;background:rgba(255,255,255,.07);padding:1px 7px;border-radius:10px;color:rgba(255,255,255,.3);"><?= $bc['total'] ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- ── Slider Kategori Produk ── -->
  <?php if (!empty($sidebar_categories)): ?>
  <div style="background:rgba(255,255,255,.04);border:1px solid rgba(245,197,24,.15);border-radius:14px;overflow:hidden;">
    <div style="padding:14px 18px 10px;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:center;justify-content:space-between;">
      <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:14px;font-weight:700;color:#fff;">Kategori Bunga</h3>
      <div style="display:flex;gap:4px;">
        <button onclick="slideCatGrogol(-1)"
                style="width:26px;height:26px;border-radius:50%;background:rgba(245,197,24,.1);border:1px solid rgba(245,197,24,.25);color:#F5C518;font-size:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;"
                onmouseover="this.style.background='#F5C518';this.style.color='#0B1F4A';"
                onmouseout="this.style.background='rgba(245,197,24,.1)';this.style.color='#F5C518';">‹</button>
        <button onclick="slideCatGrogol(1)"
                style="width:26px;height:26px;border-radius:50%;background:rgba(245,197,24,.1);border:1px solid rgba(245,197,24,.25);color:#F5C518;font-size:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;"
                onmouseover="this.style.background='#F5C518';this.style.color='#0B1F4A';"
                onmouseout="this.style.background='rgba(245,197,24,.1)';this.style.color='#F5C518';">›</button>
      </div>
    </div>
    <div style="padding:12px;">
      <div style="overflow:hidden;" id="cat-slider-track-grogol">
        <div id="cat-slider-inner-grogol" style="display:flex;gap:8px;transition:transform .3s ease;will-change:transform;">
          <?php foreach ($sidebar_categories as $sc):
            $cat_img = !empty($sc['image']) && file_exists(UPLOAD_DIR . $sc['image'])
                       ? UPLOAD_URL . $sc['image']
                       : 'https://images.unsplash.com/photo-1490750967868-88df5691cc69?w=120&h=120&fit=crop';
          ?>
          <a href="<?= BASE_URL ?>/<?= e($sc['slug']) ?>/"
             style="flex-shrink:0;width:calc(50% - 4px);text-align:center;text-decoration:none;display:block;">
            <div style="aspect-ratio:1/1;border-radius:10px;overflow:hidden;margin-bottom:7px;border:1px solid rgba(245,197,24,.12);transition:border-color .2s;"
                 onmouseover="this.style.borderColor='rgba(245,197,24,.45)';this.querySelector('img').style.transform='scale(1.07)';"
                 onmouseout="this.style.borderColor='rgba(245,197,24,.12)';this.querySelector('img').style.transform='scale(1)';">
              <img src="<?= e($cat_img) ?>" alt="<?= e($sc['name']) ?>"
                   style="width:100%;height:100%;object-fit:cover;transition:transform .5s ease;" loading="lazy">
            </div>
            <p style="font-size:11px;font-weight:600;color:rgba(255,255,255,.75);line-height:1.3;display:-webkit-box;-webkit-line-clamp:2;line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;padding:0 4px;">
              <?= e($sc['name']) ?>
            </p>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <div id="cat-dots-grogol" style="display:flex;justify-content:center;gap:5px;margin-top:10px;"></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- ── Produk Searchable ── -->
  <?php if (!empty($sidebar_products)): ?>
  <div style="background:rgba(255,255,255,.04);border:1px solid rgba(245,197,24,.15);border-radius:14px;overflow:hidden;">
    <div style="padding:14px 18px 10px;border-bottom:1px solid rgba(255,255,255,.06);">
      <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:14px;font-weight:700;color:#fff;">Produk Kami</h3>
    </div>
    <div style="padding:10px 14px 8px;">
      <input type="text" id="sidebar-prod-search-grogol"
             placeholder="Cari produk..."
             style="width:100%;padding:8px 14px;font-size:13px;border:1px solid rgba(245,197,24,.2);border-radius:30px;outline:none;color:#fff;background:rgba(255,255,255,.06);transition:border-color .2s,box-shadow .2s;"
             onfocus="this.style.borderColor='rgba(245,197,24,.5)';this.style.boxShadow='0 0 0 3px rgba(245,197,24,.08)';"
             onblur="this.style.borderColor='rgba(245,197,24,.2)';this.style.boxShadow='none';">
    </div>
    <div id="sidebar-prod-list-grogol" style="padding:4px 10px 10px;max-height:280px;overflow-y:auto;">
      <?php foreach ($sidebar_products as $prod):
        $thumb = !empty($prod['image']) && file_exists(UPLOAD_DIR . $prod['image'])
                 ? UPLOAD_URL . $prod['image']
                 : 'https://images.unsplash.com/photo-1487530811015-780780dde0e4?w=80&h=80&fit=crop';
        $wa_prod = urlencode("Halo, saya tertarik memesan *{$prod['name']}*. Apakah masih tersedia?");
      ?>
      <a href="<?= e($wa_url) ?>?text=<?= $wa_prod ?>" target="_blank"
         class="sidebar-prod-item-grogol"
         data-name="<?= strtolower(e($prod['name'])) ?>"
         style="display:flex;align-items:center;gap:10px;padding:8px;border-radius:10px;text-decoration:none;margin-bottom:2px;transition:background .2s ease;"
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
      <p id="sidebar-prod-nores-grogol" style="display:none;text-align:center;font-size:12px;color:rgba(255,255,255,.2);padding:12px 0;">Produk tidak ditemukan</p>
    </div>
  </div>
  <?php endif; ?>

  <!-- ── CTA WhatsApp ── -->
  <div style="background:linear-gradient(135deg,rgba(245,197,24,.15) 0%,rgba(245,197,24,.05) 100%);border:1px solid rgba(245,197,24,.25);border-radius:14px;padding:18px;text-align:center;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-30px;right:-30px;width:100px;height:100px;background:radial-gradient(circle,rgba(245,197,24,.1) 0%,transparent 65%);pointer-events:none;"></div>
    <div style="font-size:26px;margin-bottom:8px;">💬</div>
    <p style="font-family:'Playfair Display',Georgia,serif;font-weight:700;color:#fff;font-size:14px;margin-bottom:4px;">Mau Pesan Bunga?</p>
    <p style="font-size:11px;color:rgba(255,255,255,.35);margin-bottom:14px;line-height:1.5;">Konsultasi gratis via WhatsApp. Siap 24 jam!</p>
    <a href="<?= e($wa_url) ?>" target="_blank"
       style="display:block;background:#F5C518;color:#0B1F4A;font-size:12px;font-weight:800;padding:10px;border-radius:30px;text-decoration:none;letter-spacing:.03em;">
      Chat WhatsApp Sekarang
    </a>
  </div>

  <!-- ── Artikel Terbaru ── -->
  <?php if (!empty($sidebar_recent)): ?>
  <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:14px;overflow:hidden;">
    <div style="padding:12px 16px 10px;border-bottom:1px solid rgba(255,255,255,.06);">
      <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:13px;font-weight:700;color:#fff;">Artikel Terbaru</h3>
    </div>
    <div style="padding:8px 12px;">
      <?php foreach ($sidebar_recent as $sr):
        $sr_thumb = !empty($sr['thumbnail']) && file_exists(UPLOAD_DIR . $sr['thumbnail'])
                    ? UPLOAD_URL . $sr['thumbnail']
                    : 'https://images.unsplash.com/photo-1487530811015-780780dde0e4?w=80&h=80&fit=crop';
      ?>
      <a href="<?= BASE_URL ?>/blog/<?= e($sr['slug']) ?>/"
         style="display:flex;gap:10px;align-items:flex-start;padding:8px 0;border-bottom:1px solid rgba(255,255,255,.05);text-decoration:none;">
        <div style="flex-shrink:0;width:48px;height:48px;border-radius:8px;overflow:hidden;border:1px solid rgba(245,197,24,.1);">
          <img src="<?= e($sr_thumb) ?>" alt="" style="width:100%;height:100%;object-fit:cover;" loading="lazy">
        </div>
        <div style="flex:1;min-width:0;">
          <?php if ($sr['cat_name']): ?>
          <span style="font-size:9px;font-weight:700;color:rgba(245,197,24,.55);text-transform:uppercase;letter-spacing:.06em;"><?= e($sr['cat_name']) ?></span>
          <?php endif; ?>
          <p style="font-size:12px;font-weight:600;color:rgba(255,255,255,.7);line-height:1.35;margin-top:2px;display:-webkit-box;-webkit-line-clamp:2;line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;"><?= e($sr['title']) ?></p>
          <p style="font-size:10px;color:rgba(255,255,255,.25);margin-top:3px;"><?= date('d M Y', strtotime($sr['created_at'])) ?></p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- ── Area Pengiriman ── -->
  <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:14px 16px;">
    <h3 style="font-family:'Playfair Display',Georgia,serif;font-size:13px;font-weight:700;color:#F5C518;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
      <span>📍</span> Area Pengiriman
    </h3>
    <div style="display:flex;flex-direction:column;gap:3px;">
      <?php foreach ($locations as $l): ?>
      <a href="<?= BASE_URL ?>/<?= e($l['slug']) ?>/"
         style="font-size:12px;color:rgba(255,255,255,.4);text-decoration:none;padding:4px 0;display:flex;align-items:center;gap:8px;">
        <span style="width:4px;height:4px;border-radius:50%;background:rgba(245,197,24,.35);flex-shrink:0;display:inline-block;"></span>
        <?= e($l['name']) ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>

</div>

<!-- ── Scripts ── -->
<script>
/* Product search */
(function(){
  const input = document.getElementById('sidebar-prod-search-grogol');
  const items = document.querySelectorAll('.sidebar-prod-item-grogol');
  const noRes = document.getElementById('sidebar-prod-nores-grogol');
  if (!input) return;
  input.addEventListener('input', function(){
    const q = this.value.toLowerCase().trim();
    let visible = 0;
    items.forEach(item => {
      const show = !q || item.dataset.name.includes(q);
      item.style.display = show ? '' : 'none';
      if (show) visible++;
    });
    noRes.style.display = visible > 0 ? 'none' : 'block';
  });
})();

/* Category slider */
(function(){
  const inner  = document.getElementById('cat-slider-inner-grogol');
  const dotsEl = document.getElementById('cat-dots-grogol');
  if (!inner) return;

  const items   = inner.querySelectorAll('a');
  const perPage = 2;
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

  window.slideCatGrogol = function(dir) { goTo(current + dir); };
})();
</script>

<style>
#sidebar-prod-list-grogol::-webkit-scrollbar { width:3px; }
#sidebar-prod-list-grogol::-webkit-scrollbar-track { background:rgba(255,255,255,.04); border-radius:3px; }
#sidebar-prod-list-grogol::-webkit-scrollbar-thumb { background:rgba(245,197,24,.3); border-radius:3px; }
#sidebar-prod-list-grogol::-webkit-scrollbar-thumb:hover { background:#F5C518; }
</style>