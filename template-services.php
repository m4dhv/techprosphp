<?php
/**
 * Template Name: Services Page
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
        <?php echo esc_html( get_post_meta( get_the_ID(), 'hero_label', true ) ?: 'What We Do' ); ?>
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
/* ── Hero ─────────────────────────────────────────────────────── */
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

/* Breadcrumb */
.tp-hero__breadcrumb {
  font-size: 0.875rem;
  color: rgba(255,255,255,0.5);
  margin-bottom: 20px;
}
.tp-hero__breadcrumb a {
  color: rgba(255,255,255,0.5);
  text-decoration: none;
}
.tp-hero__breadcrumb a:hover {
  color: rgba(255,255,255,0.85);
}
.tp-hero__breadcrumb span {
  color: rgba(255,255,255,0.8);
}

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

/* ── Fade-in on load ──────────────────────────────────────────── */
@keyframes tp-fadein {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}
.tp-fadein {
  animation: tp-fadein 0.7s ease both;
}

@media (max-width: 768px) {
  .tp-hero__content { padding: 60px 24px; }
}
</style>

<section id="services" class="section-pad">
  <div class="container">
    <div class="section-header reveal">
      <span class="label"><?php echo esc_html(get_theme_mod('services_label', 'Our goals')); ?></span>
      <h2><?php echo wp_kses(get_theme_mod('services_title', 'End-to-End Business<br>Process Solutions'), ['br'=>[]]); ?></h2>
      <p><?php echo esc_html(get_theme_mod('services_desc', 'From customer experience to back-office operations, we deliver measurable results across every business function.')); ?></p>
    </div>
    <div class="services-grid">
      <?php
      $posts = get_posts(['post_type'=>'service','posts_per_page'=>-1,'orderby'=>'menu_order','post_status'=>'publish']);
      if ($posts) :
        foreach ($posts as $i => $post) :
          $icon  = get_post_meta($post->ID, 'service_icon', true) ?: '🔧';
          $link  = get_post_meta($post->ID, 'service_link_url', true) ?: '#contact';
          $label = get_post_meta($post->ID, 'service_link_label', true) ?: 'Learn more';
          $desc  = $post->post_excerpt ?: wp_trim_words(strip_tags($post->post_content), 20);
      ?>
      <div class="service-card reveal" style="transition-delay:<?php echo $i*0.1; ?>s">
        <div class="service-icon"><?php echo esc_html($icon); ?></div>
        <h3><?php echo esc_html($post->post_title); ?></h3>
        <p><?php echo esc_html($desc); ?></p>
        <a href="<?php echo esc_url($link); ?>" class="service-link"><?php echo esc_html($label); ?> →</a>
      </div>
      <?php endforeach;
      else :
        $defaults = [
          ['🤖', 'Artificial Intelligence and Automation', 'service_ai',   'Harness the power of AI, machine learning, and advanced analytics to unlock insights and drive data-led decisions across your enterprise.'],
          ['⚙️', 'Business Analytics',               'service_cbo',   'Reimagine operations with AI-infused intelligent processes that deliver efficiency, resilience, and continuous improvement at scale.'],
          ['☁️', 'Cloud Infrastructure',              'service_cloud', 'Accelerate your cloud journey with end-to-end migration, modernisation, and managed cloud services across all major platforms.'],
          ['💡', 'Consulting Operations',             'service_con',   'Strategic advisory and transformation consulting that helps organisations navigate complexity and realise sustainable growth.'],
          ['🔒', 'Cybersecurity',                     'service_cyber', 'Protect your digital estate with end-to-end cybersecurity services—from threat intelligence and risk management to compliance and response.'],
          ['📊', 'Data Analytics',                    'service_data',  'Turn raw data into actionable insights with end-to-end data analytics services—from data collection and processing to visualization, predictive modeling, and strategic decision-making.'],
          ['🏢', 'Enterprise Solutions',              'service_es',    'Deploy and optimise leading ERP, CRM, and enterprise platforms to streamline processes and unlock business value organisation-wide.'],
          ['🏭', 'Industrial Autonomy and Engineering','service_iae',  'Drive smart manufacturing and engineering excellence through industrial IoT, digital twins, and autonomous systems integration.'],
          ['🌐', 'Network Solutions and Services',    'service_net',   'Design, deploy, and manage next-generation networks that deliver the connectivity, reliability, and performance your business demands.'],
        ];
        foreach ($defaults as $i => [$icon, $title, $key, $desc]) :
          $service_title = get_theme_mod("{$key}_title", $title);
          $service_slug  = sanitize_title($service_title);
          $service_url   = home_url('/index.php/' . $service_slug);
      ?>
      <div class="service-card reveal" style="transition-delay:<?php echo $i*0.1; ?>s">
        <div class="service-icon"><?php echo esc_html(get_theme_mod("{$key}_icon", $icon)); ?></div>
        <h3><?php echo esc_html($service_title); ?></h3>
        <p><?php echo esc_html(get_theme_mod("{$key}_desc", $desc)); ?></p>
        <a href="<?php echo esc_url($service_url); ?>" class="service-link">Learn more →</a>
      </div>
      <?php endforeach;
      endif; ?>
    </div>
  </div>
</section>

<style>
.service-card {
  background-color: #161B39;
  transition: background-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
}
.service-card:hover {
  background-color: #0d1025;
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
}
.service-card h3 { color: #ffffff; }
.service-card p  { color: #848D8C; }
</style>

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
