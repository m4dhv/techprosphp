<?php
/**
 * Template Name: Contact Us
 * The template for displaying the Contact Us page.
 */

get_header(); ?>

<main style="padding-top: 0; min-height: 80vh;">
    <section style="background: var(--color-primary); padding: 80px 0; position: relative; overflow: hidden;">
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(0,194,255,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(0,194,255,0.04) 1px,transparent 1px);background-size:60px 60px;"></div>
    <div class="container" style="position:relative;z-index:1; text-align: center;">
      <span class="label" style="display:inline-block; margin-bottom:16px; color: var(--color-accent);">Get in Touch</span>
      <h1 style="color: white; font-family: var(--font-display); font-size: 3.5rem; margin: 0;"><?php the_title(); ?></h1>
    </div>
  </section>

  <section id="contact" class="section-pad">
    <div class="container">
      <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 80px; align-items: start;">
        
        <div class="reveal">
          <h2 style="font-family: var(--font-display); color: var(--color-primary); font-size: 2.5rem; margin-bottom: 24px;">Let's discuss your next project</h2>
          <p style="color: var(--color-gray); margin-bottom: 40px; font-size: 1.125rem;">Our team of experts is ready to help you optimize your business operations with intelligent automation.</p>
          
          <div style="display: grid; gap: 32px;">
            <div style="display: flex; gap: 20px;">
              <div style="width: 48px; height: 48px; background: var(--color-light); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">📍</div>
              <div>
                <h4 style="color: var(--color-primary); margin-bottom: 4px;">Visit Us</h4>
                <p style="color: var(--color-gray); font-size: 0.9375rem;">
                  <?php echo esc_html(get_theme_mod('contact_address_1', 'New York, NY 10001')); ?><br>
                  <?php echo esc_html(get_theme_mod('contact_address_2', 'London, UK')); ?>
                </p>
              </div>
            </div>

            <div style="display: flex; gap: 20px;">
              <div style="width: 48px; height: 48px; background: var(--color-light); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">📧</div>
              <div>
                <h4 style="color: var(--color-primary); margin-bottom: 4px;">Email Us</h4>
                <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'hello@techpros.com')); ?>" style="color: var(--color-accent); font-weight: 500; text-decoration: none;">
                  <?php echo esc_html(get_theme_mod('contact_email', 'hello@techpros.com')); ?>
                </a>
              </div>
            </div>

            <div style="display: flex; gap: 20px;">
              <div style="width: 48px; height: 48px; background: var(--color-light); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">📞</div>
              <div>
                <h4 style="color: var(--color-primary); margin-bottom: 4px;">Call Us</h4>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', get_theme_mod('contact_phone', '+18001234567'))); ?>" style="color: var(--color-primary); font-weight: 600; text-decoration: none;">
                  <?php echo esc_html(get_theme_mod('contact_phone', '+1 800 123 4567')); ?>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="reveal reveal-delay-1" style="background: white; padding: 48px; border-radius: 48px; box-shadow: 0 12px 20px rgba(0, 0, 0, 0.6);">
          <form id="nexaflow-contact" style="display: grid; gap: 24px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
              <div>
                <label style="display:block;font-size:0.875rem;font-weight:600;color:var(--color-primary);margin-bottom:8px;">Full Name</label>
                <input type="text" name="name" placeholder="John Doe" required style="width:100%;padding:14px 16px;border:1.5px solid var(--color-gray-light);border-radius:8px;font-family:var(--font-body);font-size:1rem;outline:none;">
              </div>
              <div>
                <label style="display:block;font-size:0.875rem;font-weight:600;color:var(--color-primary);margin-bottom:8px;">Email Address</label>
                <input type="email" name="email" placeholder="john@company.com" required style="width:100%;padding:14px 16px;border:1.5px solid var(--color-gray-light);border-radius:8px;font-family:var(--font-body);font-size:1rem;outline:none;">
              </div>
            </div>
            <div>
              <label style="display:block;font-size:0.875rem;font-weight:600;color:var(--color-primary);margin-bottom:8px;">Service Interest</label>
              <select name="service" style="width:100%;padding:14px 16px;border:1.5px solid var(--color-gray-light);border-radius:8px;font-family:var(--font-body);font-size:1rem;outline:none;background:white;cursor:pointer;">
                <option>Select a service</option>
                <?php
                $svc_posts = get_posts(['post_type'=>'service','posts_per_page'=>-1,'orderby'=>'menu_order']);
                if ($svc_posts) foreach ($svc_posts as $s) echo '<option>'.esc_html($s->post_title).'</option>';
                else foreach (['Customer Experience','Finance & Accounting','AI & Automation','Data Analytics','HR Outsourcing','IT Services'] as $s) echo "<option>{$s}</option>";
                ?>
              </select>
            </div>
            <div>
              <label style="display:block;font-size:0.875rem;font-weight:600;color:var(--color-primary);margin-bottom:8px;">Message</label>
              <textarea name="message" rows="5" placeholder="Tell us about your business challenges..." style="width:100%;padding:14px 16px;border:1.5px solid var(--color-gray-light);border-radius:8px;font-family:var(--font-body);font-size:1rem;outline:none;resize:vertical;"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;font-size:1.125rem;padding:16px;">
              Send Message
            </button>
          </form>
        </div>

      </div>
    </div>
  </section>
  <section class="bottom-contact-image" style="width: 100%; margin-top: 60px; line-height: 0;">

        <img src="<?php echo get_template_directory_uri(); ?>/images/contact-bottom.png" 
             alt="Contact Us" 
             style="width: 100%; height: auto; position: relative; z-index: 2;"
             class="reveal">
    
  </section>
</main>

<style>
  @media (max-width: 1024px) {
    #contact > .container > div { grid-template-columns: 1fr !!important; gap: 60px !!important; }
  }
  /* Force header to be transparent at the very top of this page */
#site-header:not(.scrolled) {
    background: transparent !important;
    box-shadow: none !important;
}

/* Ensure nav links are white/visible against the dark hero background */
#site-header:not(.scrolled) .logo-text,
#site-header:not(.scrolled) nav ul li a {
    color: white !important;
}

/* Fix for the CTA button in the header at the top */
#site-header:not(.scrolled) .btn-outline {
    border-color: rgba(255,255,255,0.3) !important;
    color: white !important;
}
</style>

<?php get_footer(); ?>