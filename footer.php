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
          <a href="<?php echo esc_url(get_theme_mod('social_instagram','#')); ?>" class="social-link" aria-label="Instagram" target="_blank" rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
          </a>
          <a href="<?php echo esc_url(get_theme_mod('social_facebook','#')); ?>" class="social-link" aria-label="Facebook" target="_blank" rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="<?php echo esc_url(get_theme_mod('social_twitter','#')); ?>" class="social-link" aria-label="Twitter / X" target="_blank" rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a href="<?php echo esc_url(get_theme_mod('social_youtube','#')); ?>" class="social-link" aria-label="YouTube" target="_blank" rel="noopener">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
          </a>
        </div>
      </div>

      <div class="footer-col">
        <h5><a href="<?php echo esc_url(home_url('/index.php/our-services')); ?>">Services</a></h5>
        <ul>
          <li>
          <a href="<?php echo esc_url(home_url('/index.php/our-services/artificial-intelligence-and-automation')); ?>">
            AI &amp; Automation
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/index.php/our-services/business-analytics')); ?>">
            Business Analytics
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/index.php/cloud-infrastructure')); ?>">
            Cloud Infrastructure
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/index.php/our-services/consulting-operations')); ?>">
            Consulting &amp; Ops
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/index.php/our-services/cybersecurity')); ?>">
            Cybersecurity
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/index.php/our-services/data-analytics')); ?>">
            Data Analytics
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/index.php/our-services/enterprise-solutions')); ?>">
            Enterprise Solutions
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/index.php/our-services/industrial-autonomy-and-engineering')); ?>">
            Industrial Autonomy
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/index.php/our-services/network-solutions')); ?>">
            Network Solutions &amp; Services
          </a>
        </li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>Company</h5>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/index.php/about')); ?>">About Us</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/softwares')); ?>">Softwares</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/industries')); ?>">Industries</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/privacy-policy')); ?>">Privacy Policy</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/feedback')); ?>">Feedback</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/our-services')); ?>">Services</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h5>Contact</h5>
        <ul>
          <li><a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/','',get_theme_mod('contact_phone','+18001234567'))); ?>">
            <?php echo esc_html(get_theme_mod('contact_phone','+1 800 123 4567')); ?></a></li>
          <li><a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email','hello@techpros.com')); ?>">
            <?php echo esc_html(get_theme_mod('contact_email','hello@techpros.com')); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/contact')); ?>">Contact Us</a></li>
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

<button id="scrollTopBtn" onclick="window.scrollTo({top:0,behavior:'smooth'})" style="position:fixed;bottom:2rem;right:2rem;background:#000;color:#fff;border:none;border-radius:50%;width:64px;height:64px;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.3);z-index:9999;display:none;align-items:center;justify-content:center;" onmouseover="this.style.background='#333'" onmouseout="this.style.background='#000'"><svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg></button>
<script>var b=document.getElementById('scrollTopBtn');window.onscroll=function(){b.style.display=window.scrollY>300?'flex':'none'};</script>

<?php wp_footer(); ?>
<script>
AOS.init({
  duration: 800,
  once: true
});
</script>
</body>
</html>
</html>