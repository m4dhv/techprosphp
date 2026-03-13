<?php
/**
 * Template Name: About Us
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
      <span class="label" style="display:inline-block; margin-bottom:16px; color: var(--color-accent);">
        <?php echo esc_html( get_post_meta( get_the_ID(), 'hero_label', true ) ?: 'Who We Are' ); ?>
      </span>
      <h1 class="tp-hero__title"><?php the_title(); ?></h1>
      <?php
        $hero_desc = get_post_meta( get_the_ID(), 'hero_description', true );
        if ( $hero_desc ) : ?>
          <p class="tp-hero__desc"><?php echo esc_html( $hero_desc ); ?></p>
      <?php endif; ?>
    </div>
  </section>
<style>
/* ── Hero (matches industries template) ──────────────────────── */
.tp-hero {
  position: relative;
  min-height: 480px;
  background: var(--color-primary);
  overflow: hidden;
  display: flex;
  align-items: center;
}
.tp-hero__grid {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(0,194,255,0.04) 1px, transparent 1px),
    linear-gradient(90deg, rgba(0,194,255,0.04) 1px, transparent 1px);
  background-size: 60px 60px;
  pointer-events: none;
}
.tp-hero__content {
  position: relative;
  z-index: 1;
  padding: 80px max(40px, calc((100vw - 1280px) / 2 + 40px));
}
.tp-hero__breadcrumb {
  font-size: 0.875rem;
  color: rgba(255,255,255,0.5);
  margin-bottom: 20px;
}
.tp-hero__breadcrumb a {
  color: rgba(255,255,255,0.5);
  text-decoration: none;
}
.tp-hero__breadcrumb a:hover { color: rgba(255,255,255,0.85); }
.tp-hero__breadcrumb span   { color: rgba(255,255,255,0.8); }
.tp-hero__title {
  color: #ffffff;
  font-family: var(--font-display);
  font-size: clamp(2.2rem, 3.5vw, 3.5rem);
  line-height: 1.15;
  margin: 0 0 20px;
}
.tp-hero__desc {
  color: rgba(255,255,255,0.75);
  font-size: 1.1rem;
  line-height: 1.7;
  max-width: 480px;
  margin: 0;
}
@keyframes tp-fadein {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}
.tp-fadein { animation: tp-fadein 0.7s ease both; }
@media (max-width: 768px) {
  .tp-hero__content { padding: 60px 24px; }
}

/* ── Feature image banner ─────────────────────────────────────── */
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
        // Fallback: bundled hero image placed in /images/about.png
        echo '<img src="' . esc_url( get_template_directory_uri() . '/images/about.png' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
    }
    ?>
</section>
 <div class="entry-content">
                <?php the_content(); ?>
            </div>
<!-- ABOUT -->
<!-- ABOUT -->
<section id="about" class="section-pad">
  <div class="container">
    <div class="about-grid">
      <div class="about-visual reveal">
        <div class="about-image-wrap">
          <div class="about-image-inner">🏢</div>
        </div>
        <div class="about-badge-float">
          <div>
            <div class="badge-num"><?php echo nexaflow_hero('about_years_num', '20+'); ?></div>
            <div class="badge-lbl"><?php echo nexaflow_hero('about_years_lbl', 'Years of Industry Expertise'); ?></div>
          </div>
        </div>
      </div>
      <div class="about-content reveal reveal-delay-1">
        <span class="label"><?php echo nexaflow_hero('about_label', 'Why TechPros'); ?></span>
        <h2><?php echo nexaflow_hero('about_title', "We're Not Just an Outsourcing Company"); ?></h2>
        <p><?php echo nexaflow_hero('about_desc', "We're your strategic growth partner. With deep domain expertise, cutting-edge technology, and a global delivery model, we help you achieve operational excellence while you focus on what matters most — your core business."); ?></p>
        <div class="feature-list">
          <?php
          $feature_defaults = [
            1 => ['🌍','Global Delivery Network','32 delivery centers across 18 countries, ensuring 24/7 support and business continuity.'],
            2 => ['🔬','Technology-First Approach','Proprietary AI and automation tools that drive 40% faster processing and 60% cost reduction.'],
            3 => ['📋','ISO 27001 & SOC 2 Certified','Rigorous security standards and compliance frameworks across all service lines.'],
            4 => ['📈','Outcome-Based Pricing','Pay for results, not headcount. SLA-backed commitments with full transparency.'],
          ];
          for ($i = 1; $i <= 4; $i++) :
            $icon  = get_theme_mod("feature_{$i}_icon",  $feature_defaults[$i][0]);
            $title = get_theme_mod("feature_{$i}_title", $feature_defaults[$i][1]);
            $desc  = get_theme_mod("feature_{$i}_desc",  $feature_defaults[$i][2]);
          ?>
          <div class="feature-item">
            <div class="feature-check"><?php echo esc_html($icon); ?></div>
            <div class="feature-text">
              <strong><?php echo esc_html($title); ?></strong>
              <span><?php echo esc_html($desc); ?></span>
            </div>
          </div>
          <?php endfor; ?>
        </div>
        <a href="<?php echo esc_url(get_theme_mod('about_cta_url', '#contact')); ?>" class="btn btn-dark">
          <?php echo nexaflow_hero('about_cta_text', 'Schedule a Discovery Call'); ?> →
        </a>
      </div>
    </div>
  </div>
</section>
<?php
// Stats section — defaults hardcoded, overridable via Custom Fields (stat_N_number / stat_N_label)
$default_stats = [
    [ 'number' => '500+',  'label' => 'Clients Worldwide' ],
    [ 'number' => '40%',   'label' => 'Average Cost Reduction' ],
    [ 'number' => '12+',   'label' => 'Years of Experience' ],
    [ 'number' => '99.8%', 'label' => 'Client Retention Rate' ],
];
$id = get_the_ID();
?>
<section class="tp-stats-bar">
    <div class="container tp-stats-grid">
        <?php foreach ( $default_stats as $i => $s ) :
            $n = $i + 1;
            $number = get_post_meta( $id, "stat_{$n}_number", true ) ?: $s['number'];
            $label  = get_post_meta( $id, "stat_{$n}_label",  true ) ?: $s['label'];
        ?>
        <div class="tp-stat">
            <span class="tp-stat-number"><?php echo esc_html( $number ); ?></span>
            <span class="tp-stat-label"><?php echo esc_html( $label ); ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<style>
.tp-stats-bar { background: var(--color-primary); padding: 56px 0; }
.tp-stats-grid { display: flex; justify-content: center; gap: 48px; flex-wrap: wrap; }
.tp-stat { text-align: center; }
.tp-stat-number { display: block; font-family: var(--font-display); font-size: 2.8rem; font-weight: 700; color: var(--color-accent, #00c2ff); }
.tp-stat-label { display: block; color: rgba(255,255,255,0.75); font-size: .95rem; margin-top: 4px; }
</style>

<?php while ( have_posts() ) : the_post(); ?>
    <?php if ( ! empty( trim( strip_tags( get_the_content() ) ) ) ) : ?>

    <?php endif; ?>
<?php endwhile; ?>
<!-- CTA -->
<section id="cta">
  <div class="container">
    <div class="cta-inner reveal">
      <span class="label" style="color:var(--color-accent);display:block;margin-bottom:20px;">
        <?php echo nexaflow_hero('cta_label', 'Ready to Transform?'); ?>
      </span>
      <h2><?php echo wp_kses(get_theme_mod('cta_title', "Let's Build Your<br>Operational Advantage"), ['br'=>[]]); ?></h2>
      <p><?php echo esc_html(get_theme_mod('cta_desc', 'Schedule a free 30-minute consultation with our solutions team. No commitment, no hard sell — just a conversation about your goals.')); ?></p>
      <div class="cta-actions">
        <a href="<?php echo esc_url(home_url('/index.php/contact')); ?>" class="btn btn-primary" style="font-size:1rem;padding:16px 36px;">
          <?php echo nexaflow_hero('cta_btn_1_text', 'Get Free Consultation'); ?> →
        </a>
       
      </div>
    </div>
  </div>
</section>
</main>

<?php get_footer(); ?>  