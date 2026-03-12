<?php
/**
 * Template Name: Software Shop
 * @package TechPros
 */
get_header();

$search    = isset($_GET['s'])         ? sanitize_text_field($_GET['s'])        : '';
$cat_slug  = isset($_GET['swcat'])     ? sanitize_text_field($_GET['swcat'])    : '';
$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price'])           : '';
$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price'])           : '';
$orderby   = isset($_GET['orderby'])   ? sanitize_text_field($_GET['orderby'])  : 'newest';
$paged     = isset($_GET['pg'])        ? max(1, intval($_GET['pg']))            : 1;
$base_url  = strtok(get_permalink(), '?');

$args = ['post_type' => 'product', 'posts_per_page' => 12, 'paged' => $paged, 's' => $search];

if ($cat_slug)
    $args['tax_query'] = [['taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => $cat_slug]];

if ($min_price !== '' || $max_price !== '')
    $args['meta_query'] = [['key' => '_price', 'value' => [$min_price ?: 0, $max_price ?: 999999], 'type' => 'NUMERIC', 'compare' => 'BETWEEN']];

switch ($orderby) {
    case 'price_asc':  $args['orderby'] = 'meta_value_num'; $args['order'] = 'ASC';  $args['meta_key'] = '_price'; break;
    case 'price_desc': $args['orderby'] = 'meta_value_num'; $args['order'] = 'DESC'; $args['meta_key'] = '_price'; break;
    case 'title_asc':  $args['orderby'] = 'title'; $args['order'] = 'ASC';  break;
    case 'title_desc': $args['orderby'] = 'title'; $args['order'] = 'DESC'; break;
    default:           $args['orderby'] = 'date';  $args['order'] = 'DESC'; break;
}

$products = new WP_Query($args);
$sw_cats  = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => true]);
?>

<!-- Hero -->
<section style="background:var(--color-primary);padding:80px 0;position:relative;overflow:hidden;text-align:center;">
  <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(0,194,255,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(0,194,255,.04) 1px,transparent 1px);background-size:60px 60px;"></div>
  <div class="container" style="position:relative;z-index:1;">
    <span style="display:inline-block;margin-bottom:16px;color:var(--color-accent);font-size:.75rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;">
      <?php echo esc_html(get_post_meta(get_the_ID(), 'hero_label', true) ?: 'Browse Our'); ?>
    </span>
    <h1 style="color:#fff;font-family:var(--font-display);font-size:3.5rem;margin:0 0 16px;"><?php the_title(); ?></h1>
    <p style="color:rgba(255,255,255,.65);margin:0;">
      <?php echo esc_html(get_post_meta(get_the_ID(), 'hero_subtitle', true) ?: 'Powerful tools to accelerate your business.'); ?>
    </p>
  </div>
</section>

<!-- Shop -->
<main style="background:#fff;padding:48px 0 80px;">
  <div class="container">
    <form method="GET" action="<?php echo esc_url($base_url); ?>" id="sw-form">
    <div style="display:grid;grid-template-columns:240px 1fr;gap:36px;align-items:start;">

      <!-- ── LEFT SIDEBAR ── -->
      <aside>

        <!-- Search -->
        <div style="margin-bottom:28px;">
          <div style="display:flex;border:1.5px solid #e2e8f0;border-radius:10px;overflow:hidden;">
            <input type="text" name="s" value="<?php echo esc_attr($search); ?>" placeholder="Search here"
                   style="flex:1;height:42px;padding:0 14px;border:none;outline:none;font-size:.875rem;color:#1e293b;">
            <button type="submit" style="height:42px;width:42px;border:none;background:#fff;cursor:pointer;color:#94a3b8;font-size:1rem;">🔍</button>
          </div>
        </div>

        <!-- Filter by price -->
        <div style="margin-bottom:28px;">
          <h4 style="font-size:.85rem;font-weight:700;color:#1e293b;margin:0 0 14px;text-transform:uppercase;letter-spacing:.06em;">Filter by price</h4>
          <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;">
            <input type="number" name="min_price" placeholder="Min" value="<?php echo esc_attr($min_price); ?>"
                   style="width:90px;height:36px;padding:0 10px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:.82rem;color:#475569;">
            <span style="color:#94a3b8;font-size:.8rem;">—</span>
            <input type="number" name="max_price" placeholder="Max" value="<?php echo esc_attr($max_price); ?>"
                   style="width:90px;height:36px;padding:0 10px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:.82rem;color:#475569;">
          </div>
          <button type="submit" style="height:36px;padding:0 20px;border-radius:8px;border:none;background:#3b82f6;color:#fff;font-size:.82rem;font-weight:600;cursor:pointer;">Filter</button>
        </div>

        <hr style="border:none;border-top:1px solid #f1f5f9;margin-bottom:24px;">

        <!-- Categories -->
        <div style="margin-bottom:28px;">
          <h4 style="font-size:.85rem;font-weight:700;color:#1e293b;margin:0 0 14px;text-transform:uppercase;letter-spacing:.06em;">Categories</h4>
          <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:2px;">
            <li>
              <a href="<?php echo esc_url(remove_query_arg('swcat')); ?>"
                 style="display:flex;justify-content:space-between;padding:7px 10px;border-radius:7px;font-size:.875rem;text-decoration:none;
                        color:<?php echo !$cat_slug ? '#3b82f6' : '#475569'; ?>;
                        background:<?php echo !$cat_slug ? '#eff6ff' : 'transparent'; ?>;
                        font-weight:<?php echo !$cat_slug ? '600' : '400'; ?>;">
                All
              </a>
            </li>
            <?php if (!is_wp_error($sw_cats)) foreach ($sw_cats as $cat):
              $active = $cat_slug === $cat->slug;
            ?>
              <li>
                <a href="<?php echo esc_url(add_query_arg('swcat', $cat->slug, remove_query_arg('pg'))); ?>"
                   style="display:flex;justify-content:space-between;padding:7px 10px;border-radius:7px;font-size:.875rem;text-decoration:none;
                          color:<?php echo $active ? '#3b82f6' : '#475569'; ?>;
                          background:<?php echo $active ? '#eff6ff' : 'transparent'; ?>;
                          font-weight:<?php echo $active ? '600' : '400'; ?>;">
                  <span><?php echo esc_html($cat->name); ?></span>
                  <span style="color:#94a3b8;font-size:.78rem;"><?php echo $cat->count; ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <!-- Clear filters -->
        <?php if ($search || $cat_slug || $min_price !== '' || $max_price !== ''): ?>
          <a href="<?php echo esc_url($base_url); ?>"
             style="display:inline-block;font-size:.8rem;color:#ef4444;text-decoration:none;">✕ Clear all filters</a>
        <?php endif; ?>

      </aside>

      <!-- ── RIGHT: results ── -->
      <div>

        <!-- Top bar: count + sort -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
          <span style="font-size:.85rem;color:#94a3b8;">
            <?php echo $products->found_posts; ?> result<?php echo $products->found_posts !== 1 ? 's' : ''; ?>
          </span>
          <select name="orderby" onchange="this.form.submit()"
                  style="height:36px;padding:0 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:.82rem;color:#475569;background:#fff;cursor:pointer;">
            <option value="newest"     <?php selected($orderby,'newest');     ?>>Newest</option>
            <option value="price_asc"  <?php selected($orderby,'price_asc');  ?>>Price: Low → High</option>
            <option value="price_desc" <?php selected($orderby,'price_desc'); ?>>Price: High → Low</option>
            <option value="title_asc"  <?php selected($orderby,'title_asc');  ?>>Name: A → Z</option>
            <option value="title_desc" <?php selected($orderby,'title_desc'); ?>>Name: Z → A</option>
          </select>
        </div>

        <!-- Grid -->
        <?php if ($products->have_posts()): ?>
          <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:18px;">
            <?php while ($products->have_posts()): $products->the_post();
              global $product; $product = wc_get_product(get_the_ID());
              if (!$product) continue;
              $cats = wp_get_post_terms(get_the_ID(), 'product_cat', ['fields' => 'names']);
            ?>
              <div style="border:1.5px solid #e2e8f0;border-radius:12px;overflow:hidden;background:#fff;transition:box-shadow .2s,transform .2s;"
                   onmouseover="this.style.boxShadow='0 8px 30px rgba(0,0,0,.09)';this.style.transform='translateY(-3px)'"
                   onmouseout="this.style.boxShadow='';this.style.transform=''">
                <a href="<?php the_permalink(); ?>" style="display:block;aspect-ratio:16/9;overflow:hidden;background:#f8fafc;">
                  <?php if (has_post_thumbnail()): the_post_thumbnail('medium', ['style' => 'width:100%;height:100%;object-fit:cover;display:block;']);
                  else: ?><div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:2.2rem;">💾</div><?php endif; ?>
                </a>
                <div style="padding:14px;">
                  <?php if (!empty($cats) && !is_wp_error($cats)): ?>
                    <span style="font-size:.68rem;font-weight:600;color:#06b6d4;text-transform:uppercase;letter-spacing:.07em;"><?php echo esc_html($cats[0]); ?></span>
                  <?php endif; ?>
                  <h3 style="font-size:.9rem;font-weight:700;color:#1e293b;margin:5px 0 5px;">
                    <a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a>
                  </h3>
                  <p style="font-size:.78rem;color:#64748b;margin:0 0 12px;line-height:1.45;">
                    <?php echo wp_trim_words(get_the_excerpt() ?: strip_tags(get_the_content()), 10, '…'); ?>
                  </p>
                  <div style="display:flex;align-items:center;justify-content:space-between;padding-top:10px;border-top:1px solid #f1f5f9;">
                    <span style="font-weight:700;color:#1e293b;font-size:.9rem;"><?php echo $product->get_price_html(); ?></span>
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                       style="padding:6px 12px;border-radius:7px;background:#3b82f6;color:#fff;font-size:.75rem;font-weight:600;text-decoration:none;">
                      <?php echo esc_html($product->add_to_cart_text()); ?> →
                    </a>
                  </div>
                </div>
              </div>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>

          <?php if ($products->max_num_pages > 1): ?>
            <div style="display:flex;justify-content:center;gap:8px;margin-top:36px;flex-wrap:wrap;">
              <?php echo paginate_links(['base' => add_query_arg('pg','%#%'), 'format' => '', 'current' => $paged, 'total' => $products->max_num_pages, 'prev_text' => '← Prev', 'next_text' => 'Next →']); ?>
            </div>
          <?php endif; ?>

        <?php else: ?>
          <div style="text-align:center;padding:60px 0;color:#94a3b8;">
            <div style="font-size:2.5rem;margin-bottom:12px;">🔭</div>
            <h3 style="color:#1e293b;margin-bottom:8px;">No software found</h3>
            <p>Try adjusting your filters or <a href="<?php echo esc_url($base_url); ?>" style="color:#3b82f6;">clear all</a>.</p>
          </div>
        <?php endif; ?>

      </div><!-- /right -->
    </div><!-- /grid -->
    </form>
  </div>
</main>

<style>
@media (max-width: 768px) {
  .container > form > div { grid-template-columns: 1fr !important; }
  aside { border-bottom: 1px solid #e2e8f0; padding-bottom: 24px; }
}
</style>

<?php get_footer(); ?>
