<?php
/**
 * Template Name: Services Page
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
<span class="label" style="display:inline-block; margin-bottom:16px; color: var(--color-accent);"><?php echo esc_html( get_post_meta( get_the_ID(), 'hero_label', true ) ?: 'What We Do' ); ?></span>      <h1 style="color: white; font-family: var(--font-display); font-size: 3.5rem; margin: 0;"><?php the_title(); ?></h1>
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
        // Fallback: bundled hero image placed in /images/services.png
        echo '<img src="' . esc_url( get_template_directory_uri() . '/images/services.png' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
    }
    ?>
</section>
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
          ['☁️', 'Cloud Infrastructure',                                        'service_cloud', 'Accelerate your cloud journey with end-to-end migration, modernisation, and managed cloud services across all major platforms.'],
          ['💡', 'Consulting Operations',                                   'service_con',   'Strategic advisory and transformation consulting that helps organisations navigate complexity and realise sustainable growth.'],
          ['🔒', 'Cybersecurity',                                'service_cyber', 'Protect your digital estate with end-to-end cybersecurity services—from threat intelligence and risk management to compliance and response.'],
          ['📊', 'Data Analytics', 'service_data', 'Turn raw data into actionable insights with end-to-end data analytics services—from data collection and processing to visualization, predictive modeling, and strategic decision-making.'],
          ['🏢', 'Enterprise Solutions',                         'service_es',    'Deploy and optimise leading ERP, CRM, and enterprise platforms to streamline processes and unlock business value organisation-wide.'],
          ['🏭', 'Industrial Autonomy and Engineering',            'service_iae',   'Drive smart manufacturing and engineering excellence through industrial IoT, digital twins, and autonomous systems integration.'],
          ['🌐', 'Network Solutions and Services',               'service_net',   'Design, deploy, and manage next-generation networks that deliver the connectivity, reliability, and performance your business demands.'],
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
.service-card h3 {
  color: #ffffff;
}
.service-card p {
  color: #848D8C;
}
</style>
</section>


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

<?php get_footer(); ?>  