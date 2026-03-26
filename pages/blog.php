<?php
require_once __DIR__ . '/../includes/config.php';

$meta_title    = 'Blog - ' . setting('site_name');
$meta_desc     = 'Artikel, tips, dan inspirasi seputar bunga dari ' . setting('site_name') . '.';
$meta_keywords = 'blog bunga, tips bunga, inspirasi rangkaian, florist grogol';

$filter_cat = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
$search     = isset($_GET['q'])        ? trim($_GET['q'])        : '';

$per_page    = 9;
$page        = max(1, (int)($_GET['page'] ?? 1));
$offset      = ($page - 1) * $per_page;

$where  = ["b.status = 'active'"];
$params = [];
if ($filter_cat) { $where[] = 'bc.slug = ?'; $params[] = $filter_cat; }
if ($search)     { $where[] = '(b.title LIKE ? OR b.excerpt LIKE ?)'; $params[] = "%$search%"; $params[] = "%$search%"; }
$where_sql = implode(' AND ', $where);

$count_stmt = db()->prepare("SELECT COUNT(*) FROM blogs b LEFT JOIN blog_categories bc ON b.blog_category_id = bc.id WHERE $where_sql");
$count_stmt->execute($params);
$total      = (int)$count_stmt->fetchColumn();
$total_page = (int)ceil($total / $per_page);

$stmt = db()->prepare("
    SELECT b.*, bc.name AS cat_name, bc.slug AS cat_slug
    FROM blogs b
    LEFT JOIN blog_categories bc ON b.blog_category_id = bc.id
    WHERE $where_sql
    ORDER BY b.urutan ASC, b.created_at DESC
    LIMIT $per_page OFFSET $offset
");
$stmt->execute($params);
$blogs = $stmt->fetchAll();

$blog_cats = db()->query("
    SELECT bc.*, COUNT(b.id) AS total
    FROM blog_categories bc
    LEFT JOIN blogs b ON b.blog_category_id = bc.id AND b.status = 'active'
    WHERE bc.status = 'active'
    GROUP BY bc.id ORDER BY bc.urutan ASC
")->fetchAll();

$locations = db()->query("SELECT * FROM locations WHERE status='active' ORDER BY id")->fetchAll();
$wa_url    = setting('whatsapp_url');

require __DIR__ . '/../includes/header.php';
?>

<style>
@keyframes shimmer-x{0%{background-position:-200% center}100%{background-position:200% center}}
@keyframes ticker{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.gold-line-blog{height:1px;background:linear-gradient(90deg,transparent,#F5C518,#FFE066,#F5C518,transparent);background-size:200% auto;animation:shimmer-x 3s linear infinite;}
.blog-ticker-inner{animation:ticker 22s linear infinite;display:flex;white-space:nowrap;}
@media(max-width:1023px){
  #blog-sidebar-desktop-wrap{display:none !important;}
  #blog-main-grid{grid-template-columns:1fr !important;}
}
@media(min-width:1024px){
  #blog-sidebar-mobile-wrap{display:none !important;}
}
</style>

<!-- ════ HERO ════ -->
<section style="background:#081729;position:relative;overflow:hidden;padding:72px 24px 68px;text-align:center;">
  <div style="position:absolute;inset:0;opacity:.035;background-image:radial-gradient(circle,#F5C518 1px,transparent 1px);background-size:36px 36px;pointer-events:none;"></div>
  <div style="position:absolute;top:0;right:0;width:500px;height:500px;background:radial-gradient(circle,rgba(245,197,24,.07) 0%,transparent 65%);pointer-events:none;"></div>

  <svg style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;" viewBox="0 0 800 320" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
    <circle cx="80" cy="80" r="180" fill="none" stroke="#F5C518" stroke-width="0.5" opacity="0.06"/>
    <circle cx="80" cy="80" r="120" fill="none" stroke="#F5C518" stroke-width="0.5" opacity="0.05"/>
    <circle cx="720" cy="260" r="160" fill="none" stroke="#F5C518" stroke-width="0.5" opacity="0.05"/>
    <line x1="0" y1="160" x2="220" y2="80" stroke="#F5C518" stroke-width="0.5" opacity="0.06" stroke-dasharray="4 8"/>
    <line x1="580" y1="20" x2="800" y2="130" stroke="#F5C518" stroke-width="0.5" opacity="0.06" stroke-dasharray="4 8"/>
    <circle cx="200" cy="40" r="3" fill="#F5C518" opacity="0.2"/>
    <circle cx="600" cy="280" r="3" fill="#F5C518" opacity="0.2"/>
    <circle cx="720" cy="60" r="2" fill="#F5C518" opacity="0.15"/>
    <circle cx="50" cy="260" r="2" fill="#F5C518" opacity="0.12"/>
  </svg>

  <div style="position:relative;z-index:2;max-width:620px;margin:0 auto;">

    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(245,197,24,.1);border:1px solid rgba(245,197,24,.25);border-radius:20px;padding:5px 16px;margin-bottom:18px;">
      <span style="width:7px;height:7px;border-radius:50%;background:#F5C518;display:inline-block;"></span>
      <span style="font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#F5C518;">Artikel &amp; Inspirasi</span>
    </div>

    <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:clamp(32px,6vw,52px);font-weight:900;color:#fff;line-height:1.15;margin-bottom:12px;letter-spacing:-1px;">
      Blog <span style="color:#F5C518;">Bunga</span><br>Florist Grogol
    </h1>

    <p style="font-size:14px;color:rgba(255,255,255,.45);line-height:1.75;margin-bottom:28px;max-width:440px;margin-left:auto;margin-right:auto;">
      Tips merawat bunga, inspirasi rangkaian, dan informasi seputar dunia florist dari <?= e(setting('site_name')) ?>.
    </p>

    <form method="GET" action="<?= BASE_URL ?>/blog/" style="display:flex;max-width:460px;margin:0 auto;border-radius:12px;overflow:hidden;border:1.5px solid rgba(245,197,24,.3);background:rgba(255,255,255,.05);">
      <input type="text" name="q" value="<?= e($search) ?>" placeholder="Cari artikel, tips, inspirasi..."
             style="flex:1;padding:13px 18px;font-size:14px;background:transparent;color:#fff;border:none;outline:none;min-width:0;">
      <button type="submit" style="padding:13px 22px;background:#F5C518;color:#0B1F4A;font-size:13px;font-weight:800;border:none;cursor:pointer;white-space:nowrap;letter-spacing:.03em;">
        Cari
      </button>
    </form>

    <div style="display:flex;justify-content:center;gap:28px;margin-top:22px;align-items:center;">
      <div style="text-align:center;">
        <div style="font-family:'Playfair Display',Georgia,serif;font-size:20px;font-weight:900;color:#F5C518;"><?= $total ?></div>
        <div style="font-size:11px;color:rgba(255,255,255,.3);margin-top:2px;letter-spacing:.06em;">Artikel</div>
      </div>
      <div style="width:1px;background:rgba(245,197,24,.2);height:36px;"></div>
      <div style="text-align:center;">
        <div style="font-family:'Playfair Display',Georgia,serif;font-size:20px;font-weight:900;color:#F5C518;"><?= count($blog_cats) ?></div>
        <div style="font-size:11px;color:rgba(255,255,255,.3);margin-top:2px;letter-spacing:.06em;">Kategori</div>
      </div>
      <div style="width:1px;background:rgba(245,197,24,.2);height:36px;"></div>
      <div style="text-align:center;">
        <div style="font-family:'Playfair Display',Georgia,serif;font-size:20px;font-weight:900;color:#F5C518;">Gratis</div>
        <div style="font-size:11px;color:rgba(255,255,255,.3);margin-top:2px;letter-spacing:.06em;">Untuk semua</div>
      </div>
    </div>
  </div>

  <div class="gold-line-blog" style="position:absolute;bottom:0;left:0;right:0;"></div>
</section>

<!-- ════ TICKER ════ -->
<div style="background:#F5C518;overflow:hidden;padding:10px 0;">
  <div class="blog-ticker-inner">
    <?php for ($r = 0; $r < 2; $r++): ?>
    <?php foreach ($blog_cats as $bc): ?>
    <a href="<?= BASE_URL ?>/blog/?kategori=<?= e($bc['slug']) ?>/"
       style="display:inline-flex;align-items:center;gap:10px;margin:0 20px;color:#0B1F4A;font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;text-decoration:none;white-space:nowrap;opacity:.8;">
      <span style="width:4px;height:4px;border-radius:50%;background:rgba(11,31,74,.35);display:inline-block;flex-shrink:0;"></span>
      <?= e($bc['name']) ?>
    </a>
    <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>

<!-- ════ MAIN CONTENT ════ -->
<section style="background:#0B1F4A;padding:40px 0 60px;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div id="blog-main-grid" style="display:grid;grid-template-columns:1fr 300px;gap:40px;align-items:start;">

      <!-- ══ ARTIKEL ══ -->
      <div style="min-width:0;">

        <!-- Filter pills -->
        <div style="display:flex;gap:6px;flex-wrap:wrap;margin-bottom:24px;">
          <a href="<?= BASE_URL ?>/blog/"
             style="font-size:11px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;border:1px solid <?= !$filter_cat ? '#F5C518' : 'rgba(245,197,24,.25)' ?>;background:<?= !$filter_cat ? '#F5C518' : 'transparent' ?>;color:<?= !$filter_cat ? '#0B1F4A' : 'rgba(255,255,255,.4)' ?>;">
            Semua
          </a>
          <?php foreach ($blog_cats as $bc): $active = $filter_cat === $bc['slug']; ?>
          <a href="<?= BASE_URL ?>/blog/?kategori=<?= e($bc['slug']) ?>"
             style="font-size:11px;font-weight:700;padding:5px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;border:1px solid <?= $active ? '#F5C518' : 'rgba(245,197,24,.25)' ?>;background:<?= $active ? '#F5C518' : 'transparent' ?>;color:<?= $active ? '#0B1F4A' : 'rgba(255,255,255,.4)' ?>;">
            <?= e($bc['name']) ?> <span style="opacity:.6;">(<?= $bc['total'] ?>)</span>
          </a>
          <?php endforeach; ?>
        </div>

        <?php if ($search): ?>
        <p style="font-size:13px;color:rgba(255,255,255,.4);margin-bottom:20px;">
          Hasil: <strong style="color:#F5C518;">"<?= e($search) ?>"</strong> — <?= $total ?> artikel.
          <a href="<?= BASE_URL ?>/blog/" style="color:#F5C518;margin-left:8px;">Reset</a>
        </p>
        <?php endif; ?>

        <?php if (empty($blogs)): ?>
        <div style="text-align:center;padding:60px 0;color:rgba(255,255,255,.25);">
          <div style="font-size:48px;margin-bottom:12px;">📝</div>
          <p style="font-size:15px;">Belum ada artikel ditemukan.</p>
        </div>
        <?php else: ?>

        <div style="height:1px;background:linear-gradient(90deg,rgba(245,197,24,.4),transparent);margin-bottom:4px;"></div>

        <div style="display:flex;flex-direction:column;">
          <?php
          $cat_badge_styles = [
            'informasi'  => 'background:rgba(245,197,24,.12);color:#F5C518;border:1px solid rgba(245,197,24,.25);',
            'tips'       => 'background:rgba(29,158,117,.12);color:#5DCAA5;border:1px solid rgba(29,158,117,.25);',
            'pernikahan' => 'background:rgba(212,83,126,.12);color:#ED93B1;border:1px solid rgba(212,83,126,.25);',
            'dekorasi'   => 'background:rgba(239,159,39,.12);color:#EF9F27;border:1px solid rgba(239,159,39,.25);',
            'perawatan'  => 'background:rgba(93,202,165,.12);color:#5DCAA5;border:1px solid rgba(93,202,165,.25);',
          ];

          foreach ($blogs as $blog):
            $thumb = !empty($blog['thumbnail']) && file_exists(UPLOAD_DIR . $blog['thumbnail'])
                     ? UPLOAD_URL . $blog['thumbnail']
                     : 'https://images.unsplash.com/photo-1487530811015-780780dde0e4?w=400&h=280&fit=crop';

            $updated    = $blog['updated_at'] ?? $blog['created_at'];
            $date_label = date('d M Y', strtotime($updated));

            $content_text = strip_tags($blog['content'] ?? '');
            $char_count   = mb_strlen($content_text);
            $char_label   = $char_count >= 1000 ? round($char_count / 1000, 1) . 'k karakter' : $char_count . ' karakter';
            $read_min     = max(1, ceil($char_count / 1000));

            $cat_key     = strtolower($blog['cat_slug'] ?? '');
            $badge_style = $cat_badge_styles[$cat_key] ?? 'background:rgba(245,197,24,.12);color:#F5C518;border:1px solid rgba(245,197,24,.25);';
          ?>
          <article style="display:flex;flex-direction:row;align-items:stretch;padding:20px 0;border-bottom:1px solid rgba(255,255,255,.06);">

            <a href="<?= BASE_URL ?>/blog/<?= e($blog['slug']) ?>/"
               style="flex-shrink:0;width:190px;height:130px;border-radius:10px;overflow:hidden;position:relative;display:block;background:rgba(255,255,255,.05);border:1px solid rgba(245,197,24,.1);">
              <img src="<?= e($thumb) ?>" alt="<?= e($blog['title']) ?>"
                   style="width:100%;height:100%;object-fit:cover;" loading="lazy">
              <span style="position:absolute;bottom:8px;right:8px;background:rgba(0,0,0,.7);color:#F5C518;font-size:10px;font-weight:700;padding:2px 8px;border-radius:20px;">
                <?= $read_min ?> mnt
              </span>
            </a>

            <div style="flex:1;padding-left:18px;display:flex;flex-direction:column;justify-content:space-between;min-width:0;">
              <div>
                <div style="display:flex;gap:6px;align-items:center;flex-wrap:wrap;margin-bottom:8px;">
                  <?php if ($blog['cat_name']): ?>
                  <a href="<?= BASE_URL ?>/blog/?kategori=<?= e($blog['cat_slug']) ?>"
                     style="font-size:10px;font-weight:700;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:.05em;text-decoration:none;<?= $badge_style ?>">
                    <?= e($blog['cat_name']) ?>
                  </a>
                  <?php endif; ?>
                  <span style="font-size:10px;background:rgba(255,255,255,.06);color:rgba(255,255,255,.3);padding:2px 8px;border-radius:20px;border:1px solid rgba(255,255,255,.08);">
                    <?= $char_label ?>
                  </span>
                </div>

                <h2 style="font-family:'Playfair Display',Georgia,serif;font-size:15px;font-weight:700;color:#fff;line-height:1.4;margin-bottom:6px;display:-webkit-box;-webkit-line-clamp:2;line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                  <a href="<?= BASE_URL ?>/blog/<?= e($blog['slug']) ?>/" style="color:inherit;text-decoration:none;">
                    <?= e($blog['title']) ?>
                  </a>
                </h2>

                <?php if ($blog['excerpt']): ?>
                <p style="font-size:12px;color:rgba(255,255,255,.35);line-height:1.6;margin:0;display:-webkit-box;-webkit-line-clamp:2;line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                  <?= e($blog['excerpt']) ?>
                </p>
                <?php endif; ?>
              </div>

              <div style="display:flex;align-items:center;gap:10px;margin-top:10px;flex-wrap:wrap;">
                <span style="font-size:11px;color:rgba(255,255,255,.25);">Diperbarui <?= $date_label ?></span>
                <span style="width:3px;height:3px;border-radius:50%;background:rgba(255,255,255,.15);"></span>
                <a href="<?= BASE_URL ?>/blog/<?= e($blog['slug']) ?>/"
                   style="font-size:11px;font-weight:700;color:#F5C518;text-decoration:none;letter-spacing:.03em;">
                  Baca selengkapnya →
                </a>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>

        <?php if ($total_page > 1): ?>
        <div style="display:flex;justify-content:center;gap:6px;margin-top:32px;flex-wrap:wrap;">
          <?php for ($p = 1; $p <= $total_page; $p++):
            $query  = array_filter(['kategori' => $filter_cat, 'q' => $search, 'page' => $p > 1 ? $p : null]);
            $qs     = $query ? '?' . http_build_query($query) : '';
            $is_cur = $p === $page;
          ?>
          <a href="<?= BASE_URL ?>/blog/<?= $qs ?>"
             style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:50%;font-size:13px;font-weight:700;text-decoration:none;transition:all .2s;
                    <?= $is_cur ? 'background:#F5C518;color:#0B1F4A;' : 'background:rgba(255,255,255,.06);color:rgba(255,255,255,.5);border:1px solid rgba(245,197,24,.2);' ?>">
            <?= $p ?>
          </a>
          <?php endfor; ?>
        </div>
        <?php endif; ?>

        <?php endif; ?>
      </div>

      <!-- ════ SIDEBAR DESKTOP ════ -->
      <aside id="blog-sidebar-desktop-wrap" style="position:sticky;top:90px;">
        <?php include __DIR__ . '/sections/blog-sidebar.php'; ?>
      </aside>

    </div>
  </div>
</section>

<!-- ════ SIDEBAR MOBILE ════ -->
<section id="blog-sidebar-mobile-wrap">
  <?php include __DIR__ . '/sections/blog-sidebar-mobile.php'; ?>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>