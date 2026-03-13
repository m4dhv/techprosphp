<?php
/**
 * Template Name: Full Width Hero
 *
 *
 * - Hero image spans full viewport (use the page's Featured Image)
 * - Anything added in the WordPress page editor appears below
 *
 * @package TechPros
 */
get_header();
?>
<main class="tp-page-content" style="padding-top: 0; min-height: 80vh;">
  <section class="tp-hero">
    <div class="tp-hero__grid"></div>
    <div class="tp-hero__content tp-fadein">
      <nav class="tp-hero__breadcrumb">
        <a href="<?php echo home_url(); ?>">Home</a> &rsaquo;
        <span><?php echo esc_html( get_the_title() ); ?></span>
      </nav>
      <span class="label" style="display:inline-block;margin-bottom:16px;color:var(--color-accent);">
        <?php echo esc_html( get_post_meta( get_the_ID(), 'hero_label', true ) ?: 'Know more about our' ); ?>
      </span>
      <h1 class="tp-hero__title"><?php the_title(); ?></h1>
    </div>
  </section>
<style>
/* ── Hero ─────────────────────────────────────────────────────── */
.tp-hero { position:relative;min-height:480px;background:var(--color-primary);overflow:hidden;display:flex;align-items:center; }
.tp-hero__grid { position:absolute;inset:0;background-image:linear-gradient(rgba(0,194,255,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(0,194,255,.04) 1px,transparent 1px);background-size:60px 60px;pointer-events:none; }
.tp-hero__content { position:relative;z-index:1;padding:80px max(40px,calc((100vw - 1280px) / 2 + 40px)); }
.tp-hero__breadcrumb { font-size:.875rem;color:rgba(255,255,255,.5);margin-bottom:20px; }
.tp-hero__breadcrumb a { color:rgba(255,255,255,.5);text-decoration:none; }
.tp-hero__breadcrumb a:hover { color:rgba(255,255,255,.85); }
.tp-hero__breadcrumb span { color:rgba(255,255,255,.8); }
.tp-hero__title { color:#fff;font-family:var(--font-display);font-size:clamp(2.2rem,3.5vw,3.5rem);line-height:1.15;margin:0 0 20px; }
.tp-hero__desc { color:rgba(255,255,255,.75);font-size:1.1rem;line-height:1.7;max-width:480px;margin:0; }
@keyframes tp-fadein { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:translateY(0)} }
.tp-fadein { animation:tp-fadein .7s ease both; }
@media (max-width: 768px) { .tp-hero__content { padding: 60px 24px; } }

.tp-hero-banner {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.tp-hero-banner img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}

/* Vignette so the nav stays readable */
.tp-hero-banner::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(10, 15, 46, 0.50) 0%,
        rgba(10, 15, 46, 0.08) 45%,
        rgba(10, 15, 46, 0.08) 60%,
        rgba(10, 15, 46, 0.40) 100%
    );
}

/* WordPress editor content sits below the hero */
.tp-page-content {
    background: var(--color-white, #fff);
}

.tp-page-content .entry-content {
    max-width: 860px;
    margin: 0 auto;
    padding: 72px 24px;
    line-height: 1.9;
}
</style>

<section class="tp-hero-banner">
    <?php
    if ( has_post_thumbnail() ) {
        the_post_thumbnail( 'full', [ 'alt' => get_the_title() ] );
    } else {
        // Fallback: bundled hero image placed in /images/hero-default.png
        echo '<img src="' . esc_url( get_template_directory_uri() . '/images/hero-default.png' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
    }
    ?>
</section>
 <div class="entry-content">
                <?php the_content(); ?>
            </div>

<?php while ( have_posts() ) : the_post(); ?>
    <?php if ( ! empty( trim( strip_tags( get_the_content() ) ) ) ) : ?>

    <?php endif; ?>
<?php endwhile; ?>
</main>

<?php get_footer(); ?>  