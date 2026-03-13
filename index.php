<?php get_header(); ?>

<!-- HERO -->
<section id="hero">
  <div class="hero-bg-grid"></div>
  <div class="hero-bg-orb-1"></div>
  <div class="hero-bg-orb-2"></div>
  <div class="container">
    <div class="hero-inner">
      <div class="hero-content">
        <div class="hero-badge">
          <span class="dot"></span>
          <span><?php echo nexaflow_hero('hero_badge', 'Trusted by 500+ Global Clients'); ?></span>
        </div>
        <h1 class="hero-title">
          <?php echo nexaflow_hero('hero_title_1', 'Intelligent BPO'); ?><br>
          <?php echo nexaflow_hero('hero_title_2', 'Solutions for'); ?><br>
          <span class="highlight"><?php echo nexaflow_hero('hero_title_highlight', 'Modern Business'); ?></span>
        </h1>
        <p class="hero-desc"><?php echo nexaflow_hero('hero_desc', 'We help enterprises streamline operations, reduce costs, and accelerate growth with AI-powered business process outsourcing and digital transformation.'); ?></p>
        <div class="hero-actions">
          <a href="<?php echo esc_url(get_theme_mod('hero_cta_1_url', '#contact')); ?>" class="btn btn-primary">
            <?php echo nexaflow_hero('hero_cta_1_text', 'Get Started'); ?> →
          </a>
          <a href="<?php echo esc_url(get_theme_mod('hero_cta_2_url', '#services')); ?>" class="btn btn-outline">
            <?php echo nexaflow_hero('hero_cta_2_text', 'Explore Services'); ?>
          </a>
        </div>
        <div class="hero-stats" data-aos="fade-up">
          <?php
          $stats = [
            ['stat_clients_num',   '500+', 'stat_clients_lbl',   'Clients Worldwide'],
            ['stat_retention_num', '98%',  'stat_retention_lbl', 'Retention Rate'],
            ['stat_cost_num',      '40%',  'stat_cost_lbl',      'Cost Reduction'],
          ];
          foreach ($stats as [$nk, $nd, $lk, $ld]) : ?>
          <div class="stat-item">
            <div class="num"><?php echo nexaflow_hero($nk, $nd); ?></div>
            <div class="lbl"><?php echo nexaflow_hero($lk, $ld); ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Dashboard Visual (static — decorative) -->
      <div class="hero-visual">
        <div class="dashboard-card">
          <div class="dashboard-header">
            <span class="dashboard-title"><?php echo nexaflow_hero('hero_dashboard_title', 'Operations Dashboard'); ?></span>
            <span class="live-badge">Live</span>
          </div>
          <div class="metrics-grid">
            <div class="metric-box">
              <div class="m-val">94.7<span style="font-size:1rem;color:rgba(255,255,255,0.4)">%</span></div>
              <div class="m-label">CSAT Score</div>
              <div class="m-trend">↑ 3.2% this month</div>
            </div>
            <div class="metric-box">
              <div class="m-val">12.3<span style="font-size:1rem;color:rgba(255,255,255,0.4)">s</span></div>
              <div class="m-label">Avg Handle Time</div>
              <div class="m-trend">↓ 18% vs target</div>
            </div>
            <div class="metric-box">
              <div class="m-val">8.4<span style="font-size:1rem;color:rgba(255,255,255,0.4)">K</span></div>
              <div class="m-label">Tickets Resolved</div>
              <div class="m-trend">↑ 12% vs last week</div>
            </div>
            <div class="metric-box">
              <div class="m-val">$2.1<span style="font-size:1rem;color:rgba(255,255,255,0.4)">M</span></div>
              <div class="m-label">Cost Saved YTD</div>
              <div class="m-trend">↑ 41% vs forecast</div>
            </div>
          </div>
          <div class="chart-bar-wrap">
            <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
              <span style="color:rgba(255,255,255,0.5);font-size:0.8125rem;font-weight:600;">Weekly Performance</span>
              <span style="color:var(--color-accent);font-size:0.8125rem;font-weight:600;">+23% ↑</span>
            </div>
            <div class="chart-bars">
              <?php
              foreach ([55,70,45,80,65,90,75,85,70,95,80,100] as $i => $h) {
                $active = ($i === 11) ? ' active' : '';
                echo "<div class='bar{$active}' style='height:{$h}%;animation-delay:".($i*0.05)."s'></div>";
              }
              ?>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:8px;">
              <?php foreach (['Mon','Tue','Wed','Thu','Fri','Sat','Sun','Mon','Tue','Wed','Thu','Fri'] as $d) : ?>
              <span style="color:rgba(255,255,255,0.25);font-size:0.625rem;"><?php echo $d; ?></span>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="floating-card floating-card-1">
            <div class="fc-icon green">✓</div>
            <div class="fc-text">
              <div class="fc-title">SLA Achieved</div>
              <div class="fc-sub">99.4% uptime this quarter</div>
            </div>
          </div>
          <div class="floating-card floating-card-2">
            <div class="fc-icon orange">🤖</div>
            <div class="fc-text">
              <div class="fc-title">AI Automating</div>
              <div class="fc-sub">34% of routine tasks</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- TECHNOLOGIES WE USE -->
<section id="clients">
  <div class="container">
    <h2 data-aos="fade-up" class="clients-label"><?php echo esc_html(get_theme_mod('clients_label', 'Technology Stack')); ?></h2>
    <div data-aos="fade-up" class="logos-track">
      <?php
      $raw     = get_theme_mod('clients_list', 'Python, PHP, GoLang, AWS, Microsoft Azure, Swift, SQL, and many more...');
      $clients = array_filter(array_map('trim', explode(',', $raw)));

      // Changed: Loop through the array once instead of merging it with itself
      foreach ($clients as $c) {
        echo "<span class='client-logo'>" . esc_html($c) . "</span>";
      }
      ?>
    </div>
  </div>
</section>
</section>
<!-- SERVICES -->
<section id="services" class="section-pad">
  <div class="container">

    <div class="section-header reveal" style="text-align:center;">
      <span class="label"><?php echo esc_html(get_theme_mod('services_label', 'What We Do')); ?></span>
      <h2><?php echo wp_kses(get_theme_mod('services_title', 'End-to-End Business<br>Process Solutions'), ['br'=>[]]); ?></h2>
      <p style="max-width:600px;margin:0 auto;"><?php echo esc_html(get_theme_mod('services_desc', 'From customer experience to back-office operations, we deliver measurable results across every business function. Over 9+ services as listed on our services page.')); ?></p>
    </div>

    <div class="services-preview-grid reveal">
      <?php
      $preview = [
        ['🤖', 'AI & Automation'],
        ['☁️', 'Cloud'],
        ['🔒', 'Cybersecurity'],
        ['🏢', 'Enterprise Solutions'],
      ];
      foreach ($preview as [$icon, $title]) : ?>
        <div class="services-preview-pill">
          <span class="pill-icon"><?php echo esc_html($icon); ?></span>
          <span><?php echo esc_html($title); ?></span>
        </div>
      <?php endforeach; ?>
    </div>

    <div style="text-align:center;margin-top:48px;" class="reveal">
      <a class="btn btn-primary" href="<?php echo esc_url(home_url('/index.php/our-services')); ?>">Explore All Services →</a>
    </div>

  </div>
</section>

<style>
.services-preview-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 14px;
  margin-top: 48px;
}
.services-preview-pill {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #161B39;
  color: #fff;
  padding: 12px 22px;
  border-radius: 50px;
  font-size: 0.95rem;
  font-family: var(--font-display);
  transition: background 0.22s ease, transform 0.22s ease, box-shadow 0.22s ease;
  cursor: default;
}
.services-preview-pill:hover {
  background: #0d1025;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.3);
}
.pill-icon {
  font-size: 1.15rem;
  line-height: 1;
}
</style>

<!-- INDUSTRIES -->
<section id="industries" class="section-pad">
  <div class="container">
    <div class="section-header reveal">
      <span class="label">Industries We Serve</span>
      <h2><?php echo wp_kses(get_theme_mod('industries_section_title', 'Deep Domain Expertise<br>Across Key Verticals'), ['br'=>[]]); ?></h2>
      <p>We understand the unique challenges of your industry and deliver solutions built for your specific context.</p>
    </div>
    <div class="industries-grid">
      <?php
      $raw_json   = get_theme_mod('industries_json', '');
      $industries = $raw_json ? json_decode($raw_json, true) : null;
      if (!is_array($industries)) {
        $industries = [
          ['🏦','Banking & Finance','Risk, compliance, and digital banking'],
          ['🏥','Healthcare','Patient services, billing & compliance'],
          ['🛒','Retail & E-Commerce','CX, fulfillment & supply chain'],
          ['✈️','Travel & Hospitality','Booking, loyalty & support'],
        ];
        $industries = array_map(fn($r) => ['icon'=>$r[0],'title'=>$r[1],'description'=>$r[2]], $industries);
      }
      $industries_url = home_url('/index.php/industries');
      foreach ($industries as $i => $ind) :
      ?>
      <a href="<?php echo esc_url($industries_url); ?>" class="industry-card reveal" style="transition-delay:<?php echo $i*0.1; ?>s">
        <div class="industry-icon"><?php echo esc_html($ind['icon']); ?></div>
        <h4><?php echo esc_html($ind['title']); ?></h4>
        <p><?php echo esc_html($ind['description']); ?></p>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="industries-teaser-cta reveal">
      <a class="btn btn-primary" href="<?php echo esc_url(home_url('/index.php/industries')); ?>" class="btn btn-secondary">
        Explore All Industries →
      </a>
    </div>
  </div>
</section>
 
<style>
a.industry-card {
  display: block;
  text-decoration: none;
  cursor: pointer;
}
a.industry-card h4 { color: #ffffff; }
a.industry-card p  { color: #848D8C; }
 
.industries-teaser-cta {
  text-align: center;
  margin-top: 48px;
}
</style>
 
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




<!-- TESTIMONIALS -->
<section id="testimonials" class="section-pad">
  <div class="container">
    <div class="section-header reveal">
      <span class="label">Client Stories</span>
      <h2><?php echo esc_html(get_theme_mod('testimonials_title', 'What Our Clients Say')); ?></h2>
      <p><?php echo esc_html(get_theme_mod('testimonials_desc', "Don't take our word for it. Here's what business leaders say about working with TechPros.")); ?></p>
    </div>
    <div class="testimonials-grid">
      <?php
      $posts = get_posts(['post_type'=>'testimonial','posts_per_page'=>-1,'orderby'=>'menu_order','post_status'=>'publish']);
      if ($posts) :
        foreach ($posts as $i => $post) :
          $rating   = get_post_meta($post->ID, 'testimonial_rating', true) ?: 5;
          $aname    = get_post_meta($post->ID, 'testimonial_author_name', true) ?: $post->post_title;
          $arole    = get_post_meta($post->ID, 'testimonial_author_role', true);
          $acompany = get_post_meta($post->ID, 'testimonial_author_company', true);
          $stars    = str_repeat('★', intval($rating));
          $initials = implode('', array_map(fn($w) => strtoupper($w[0]), array_slice(explode(' ', $aname), 0, 2)));
      ?>
      <div class="testimonial-card reveal" style="transition-delay:<?php echo $i*0.15; ?>s">
        <div class="stars"><?php echo $stars; ?></div>
<div class="testimonial-text">
    <?php echo apply_filters('the_content', $post->post_content); ?>
</div>
        <div class="testimonial-author">
          <div class="author-avatar"><?php echo esc_html(substr($initials,0,2)); ?></div>
          <div>
            <div class="author-name"><?php echo esc_html($aname); ?></div>
            <div class="author-role"><?php echo esc_html(($arole ? $arole.', ' : '') . $acompany); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach;
      else :
        $defaults = [
          ['★★★★★','TechPros transformed our customer service operations completely. Response time dropped by 60% and CSAT jumped from 74% to 94% within 6 months. Remarkable execution.','Sarah Mitchell','Chief Operations Officer, FinCorp Global'],
          ['★★★★★','Their AI automation solution eliminated 70% of our manual data processing tasks. The ROI was evident in the first quarter — a 3.2x return on investment. Highly recommend.','David Chen','VP of Technology, RetailMax Inc'],
          ['★★★★★','Working with TechPros felt like having an extension of our own team. They understood our healthcare compliance needs deeply and delivered flawlessly. True partners.','Dr. Priya Sharma','Director of Operations, MedCare Systems'],
        ];
        foreach ($defaults as $i => [$stars, $text, $name, $role]) :
          $initials = implode('', array_map(fn($w) => $w[0], explode(' ', $name)));
      ?>
      <div class="testimonial-card reveal" style="transition-delay:<?php echo $i*0.15; ?>s">
        <div class="stars"><?php echo $stars; ?></div>
        <p class="testimonial-text">"<?php echo esc_html($text); ?>"</p>
        <div class="testimonial-author">
          <div class="author-avatar"><?php echo substr($initials,0,2); ?></div>
          <div>
            <div class="author-name"><?php echo $name; ?></div>
            <div class="author-role"><?php echo $role; ?></div>
          </div>
        </div>
      </div>
      <?php endforeach;
      endif; ?>
    </div>
  </div>
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
        <a href="<?php echo esc_url(get_theme_mod('cta_btn_1_url', '#contact')); ?>" class="btn btn-primary" style="font-size:1rem;padding:16px 36px;">
          <?php echo nexaflow_hero('cta_btn_1_text', 'Get Free Consultation'); ?> →
        </a>
        <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/','',get_theme_mod('contact_phone','+18001234567'))); ?>" class="btn btn-outline" style="font-size:1rem;padding:16px 36px;">
          📞 <?php echo esc_html(get_theme_mod('contact_phone', '+1 800 123 4567')); ?>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- CONTACT FORM -->
<section id="contact" class="section-pad" style="background:var(--color-light);">
  <div class="container">
    <div style="max-width:640px;margin:0 auto;text-align:center;" class="reveal">
      <span class="label" style="display:block;margin-bottom:16px;">Contact Us</span>
      <h2 style="color:var(--color-primary);margin-bottom:16px;"><?php echo nexaflow_hero('contact_title', 'Get in Touch'); ?></h2>
      <p style="margin-bottom:48px;"><?php echo nexaflow_hero('contact_subtitle', 'Fill out the form and our team will reach out within 24 hours.'); ?></p>
    </div>
    <div style="max-width:700px;margin:0 auto;background:white;border-radius:24px;padding:48px;box-shadow:var(--shadow-md);" class="reveal">
      <?php if (function_exists('wpcf7_contact_form')) : ?>
        <?php echo do_shortcode('[contact-form-7 id="1" title="Contact form 1"]'); ?>
      <?php else : ?>
      <?php echo do_shortcode('[wpforms id="225"]'); ?>
      <?php endif; ?>
    </div>
  </div>
</section>


<?php get_footer(); ?>
