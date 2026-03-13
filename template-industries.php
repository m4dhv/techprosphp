<?php
/**
 * Template Name: Industries Page
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
        <?php echo esc_html( get_post_meta( get_the_ID(), 'hero_label', true ) ?: 'Industries We Serve' ); ?>
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

<!-- Industries -->
<section id="industries" class="section-pad">
  <div class="container">
    <div class="section-header reveal">
      <span class="label"><?php echo esc_html( get_theme_mod( 'industries_label', 'Industries We Serve' ) ); ?></span>
      <h2><?php echo wp_kses( get_theme_mod( 'industries_section_title', 'Deep Domain Expertise<br>Across Key Verticals' ), ['br'=>[]] ); ?></h2>
      <p><?php echo esc_html( get_theme_mod( 'industries_desc', 'We understand the unique challenges of your industry and deliver solutions built for your specific context.' ) ); ?></p>
    </div>
    <div class="industries-grid">
      <?php
      $posts = get_posts(['post_type'=>'industry','posts_per_page'=>-1,'orderby'=>'menu_order','post_status'=>'publish']);
      if ( $posts ) :
        foreach ( $posts as $i => $post ) :
          $icon   = get_post_meta( $post->ID, 'industry_icon', true ) ?: '🏢';
          $desc   = $post->post_excerpt ?: wp_trim_words( strip_tags( $post->post_content ), 20 );
          $detail = get_post_meta( $post->ID, 'industry_detail', true );
      ?>
      <div class="industry-card reveal" style="transition-delay:<?php echo $i * 0.1; ?>s">
        <div class="service-icon"><?php echo esc_html( $icon ); ?></div>
        <h3><?php echo esc_html( $post->post_title ); ?></h3>
        <p><?php echo esc_html( $desc ); ?></p>
        <?php if ( $detail ) : ?>
          <p class="industry-card__detail"><?php echo esc_html( $detail ); ?></p>
        <?php endif; ?>
      </div>
      <?php endforeach;
      else :
        // Fallback: theme_mod JSON or hardcoded defaults
        $raw_json   = get_theme_mod( 'industries_json', '' );
        $industries = $raw_json ? json_decode( $raw_json, true ) : null;

        if ( ! is_array( $industries ) ) {
          $industries = [
            [
              'icon'   => '🏦',
              'title'  => 'Banking & Finance',
              'key'    => 'ind_banking',
              'description' => 'Modernise core banking, risk management, and compliance operations with AI-driven automation and real-time analytics.',
              'detail' => 'From fraud detection and KYC automation to digital lending and wealth management platforms, we help financial institutions move faster while staying compliant.',
            ],
            [
              'icon'   => '🏥',
              'title'  => 'Healthcare',
              'key'    => 'ind_health',
              'description' => 'Streamline patient services, medical billing, claims adjudication, and regulatory compliance across providers and payers.',
              'detail' => 'Our solutions reduce administrative burden, accelerate reimbursements, and improve care coordination — so your teams can focus on patients, not paperwork.',
            ],
            [
              'icon'   => '🛒',
              'title'  => 'Retail & E-Commerce',
              'key'    => 'ind_retail',
              'description' => 'Elevate customer experience, optimise fulfillment, and build supply chain resilience across every sales channel.',
              'detail' => 'We help retailers unify online and in-store operations, reduce returns, and personalise engagement at scale through intelligent data platforms.',
            ],
            [
              'icon'   => '✈️',
              'title'  => 'Travel & Hospitality',
              'key'    => 'ind_travel',
              'description' => 'Deliver seamless booking experiences, dynamic loyalty programmes, and 24/7 multilingual guest support.',
              'detail' => 'From revenue management and ancillary upsell to post-stay follow-up and crisis response, we keep travellers happy at every touchpoint.',
            ],
            [
              'icon'   => '📡',
              'title'  => 'Telecom & Media',
              'key'    => 'ind_telecom',
              'description' => 'Reduce churn, protect revenue, and automate subscriber lifecycle management for telecoms and media organisations.',
              'detail' => 'We support everything from first-call resolution and network fault management to content operations and digital ad operations at scale.',
            ],
            [
              'icon'   => '🏭',
              'title'  => 'Manufacturing',
              'key'    => 'ind_mfg',
              'description' => 'Optimise supply chains, procurement workflows, and production operations with intelligent factory and IoT solutions.',
              'detail' => 'We connect shop-floor data to enterprise systems, enabling predictive maintenance, real-time inventory visibility, and supplier collaboration.',
            ],
            [
              'icon'   => '🏛️',
              'title'  => 'Government',
              'key'    => 'ind_gov',
              'description' => 'Modernise citizen-facing services, back-office operations, and compliance frameworks for public sector organisations.',
              'detail' => 'We deliver scalable digital platforms that improve service delivery, reduce processing times, and meet the strictest data security and audit requirements.',
            ],
            [
              'icon'   => '🎓',
              'title'  => 'Education',
              'key'    => 'ind_edu',
              'description' => 'Transform admissions, learning management, and student support services for institutions of all sizes.',
              'detail' => 'From enrolment automation and virtual tutoring to alumni engagement and institutional analytics, we help educators focus on outcomes that matter.',
            ],
          ];
        }

        foreach ( $industries as $i => $ind ) :
          $key    = $ind['key'] ?? 'ind_' . $i;
          $icon   = get_theme_mod( "{$key}_icon",   $ind['icon'] );
          $title  = get_theme_mod( "{$key}_title",  $ind['title'] );
          $desc   = get_theme_mod( "{$key}_desc",   $ind['description'] );
          $detail = get_theme_mod( "{$key}_detail", $ind['detail'] );
      ?>
      <div class="industry-card reveal" style="transition-delay:<?php echo $i * 0.1; ?>s">
        <div class="service-icon"><?php echo esc_html( $icon ); ?></div>
        <h3><?php echo esc_html( $title ); ?></h3>
        <p><?php echo esc_html( $desc ); ?></p>
        <p class="industry-card__detail"><?php echo esc_html( $detail ); ?></p>
      </div>
      <?php endforeach;
      endif; ?>
    </div>
  </div>
</section>

<style>
/* ── Industries grid — 3 columns ─────────────────────────────── */
.industries-grid {
  grid-template-columns: repeat(3, 1fr) !important;
}
@media (max-width: 900px) {
  .industries-grid { grid-template-columns: repeat(2, 1fr) !important; }
}
@media (max-width: 580px) {
  .industries-grid { grid-template-columns: 1fr !important; }
}

/* ── Industries section — white background ────────────────────── */
#industries {
  background-color: #ffffff;
}
#industries .section-header .label {
  color: var(--color-accent);
}
#industries .section-header h2 {
  color: #0d1025;
}
#industries .section-header p {
  color: #4b5563;
}

/* ── Cards — identical to .service-card ───────────────────────── */
.industry-card {
  background-color: #161B39;
  transition: background-color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
}
.industry-card:hover {
  background-color: #0d1025;
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
}
.industry-card h3          { color: #ffffff; }
.industry-card p           { color: #848D8C; }
.industry-card__detail     { color: #848D8C; margin-top: 10px; font-size: 0.9rem; line-height: 1.65; }
</style>

<!-- CTA -->
<section id="cta">
  <div class="container">
    <div class="cta-inner reveal">
      <span class="label" style="color:var(--color-accent);display:block;margin-bottom:20px;">
        <?php echo nexaflow_hero( 'cta_label', 'Ready to Transform?' ); ?>
      </span>
      <h2><?php echo wp_kses( get_theme_mod( 'cta_title', "Let's Build Your<br>Operational Advantage" ), ['br'=>[]] ); ?></h2>
      <p><?php echo esc_html( get_theme_mod( 'cta_desc', 'Schedule a free 30-minute consultation with our solutions team. No commitment, no hard sell — just a conversation about your goals.' ) ); ?></p>
      <div class="cta-actions">
        <a href="<?php echo esc_url( home_url( '/index.php/contact' ) ); ?>" class="btn btn-primary" style="font-size:1rem;padding:16px 36px;">
          <?php echo nexaflow_hero( 'cta_btn_1_text', 'Get Free Consultation' ); ?> →
        </a>
      </div>
    </div>
  </div>
</section>
</main>

<?php get_footer(); ?>
