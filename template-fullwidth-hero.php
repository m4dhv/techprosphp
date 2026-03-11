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
<main class="tp-page-content style="padding-top: 0; min-height: 80vh;">

    <section style="background: var(--color-primary); padding: 80px 0; position: relative; overflow: hidden;">

    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(0,194,255,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(0,194,255,0.04) 1px,transparent 1px);background-size:60px 60px;"></div>

    <div class="container" style="position:relative;z-index:1; text-align: center;">

<span class="label" style="display:inline-block; margin-bottom:16px; color: var(--color-accent);"><?php echo esc_html( get_post_meta( get_the_ID(), 'hero_label', true ) ?: 'know more about our' ); ?></span>      <h1 style="color: white; font-family: var(--font-display); font-size: 3.5rem; margin: 0;"><?php the_title(); ?></h1>

    </div>

  </section>

           

        </main>
<style>
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

<?php get_footer(); ?>  