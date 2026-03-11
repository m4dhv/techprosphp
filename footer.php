<footer id="site-footer">
  <div class="container">
    <div class="footer-grid">

      <div class="footer-brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
          <div class="logo-mark" style="width:36px;height:36px;font-size:1rem;">
            <?php echo esc_html(substr(get_bloginfo('name'), 0, 1)); ?>
          </div>
          <span class="logo-text"><?php bloginfo('name'); ?></span>
        </a>
        <p><?php echo esc_html(get_theme_mod('footer_tagline','Transforming business operations with intelligent automation, AI-driven insights, and world-class outsourcing solutions.')); ?></p>
        <div class="social-links">
          <a href="<?php echo esc_url(get_theme_mod('social_linkedin','#')); ?>" class="social-link" aria-label="LinkedIn"  target="_blank" rel="noopener">in</a>
          <a href="<?php echo esc_url(get_theme_mod('social_twitter','#'));  ?>" class="social-link" aria-label="Twitter"   target="_blank" rel="noopener">𝕏</a>
          <a href="<?php echo esc_url(get_theme_mod('social_facebook','#')); ?>" class="social-link" aria-label="Facebook"  target="_blank" rel="noopener">f</a>
          <a href="<?php echo esc_url(get_theme_mod('social_youtube','#'));  ?>" class="social-link" aria-label="YouTube"   target="_blank" rel="noopener">▶</a>
        </div>
      </div>

      <div class="footer-col">
        <h5>Services</h5>
        <ul>
          <?php
          $svc = get_posts(['post_type'=>'service','posts_per_page'=>6,'orderby'=>'menu_order']);
          if ($svc) foreach ($svc as $s) echo '<li><a href="'.get_permalink($s->ID).'">'.esc_html($s->post_title).'</a></li>';
          else foreach (['Customer Experience','Finance & Accounting','HR Outsourcing','IT Services','Data Analytics','AI Automation'] as $s)
            echo "<li><a href='#services'>{$s}</a></li>";
          ?>
        </ul>
      </div>

      <div class="footer-col">
        <h5>Company</h5>
        <ul>
          <li><a href="#about">About Us</a></li>
          <li><a href="#industries">Industries</a></li>
          <li><a href="<?php echo esc_url(get_post_type_archive_link('service')); ?>">Case Studies</a></li>
          <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Insights</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/privacy-policy')); ?>">Privacy Policy</a></li>
          <li><a href="#">Careers</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/feedback')); ?>">Feedback</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/contact')); ?>">Contact</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>Contact</h5>
        <ul>
          <li><a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/','',get_theme_mod('contact_phone','+18001234567'))); ?>">
            <?php echo esc_html(get_theme_mod('contact_phone','+1 800 123 4567')); ?></a></li>
          <li><a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email','hello@nexaflow.com')); ?>">
            <?php echo esc_html(get_theme_mod('contact_email','hello@nexaflow.com')); ?></a></li>
          <li><?php echo esc_html(get_theme_mod('contact_address_1','New York, NY 10001')); ?></li>
          <li><?php echo esc_html(get_theme_mod('contact_address_2','London, UK')); ?></li>
        </ul>
      </div>

    </div>

    <div class="footer-bottom">
      <p>© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
      <p style="display:flex;gap:24px;">
        <a href="#" style="color:rgba(255,255,255,0.3);font-size:0.875rem;transition:color 0.3s" onmouseover="this.style.color='rgba(255,255,255,0.6)'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">Privacy Policy</a>
        <a href="#" style="color:rgba(255,255,255,0.3);font-size:0.875rem;transition:color 0.3s" onmouseover="this.style.color='rgba(255,255,255,0.6)'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">Terms of Service</a>
        <a href="#" style="color:rgba(255,255,255,0.3);font-size:0.875rem;transition:color 0.3s" onmouseover="this.style.color='rgba(255,255,255,0.6)'" onmouseout="this.style.color='rgba(255,255,255,0.3)'">Cookie Policy</a>
      </p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
