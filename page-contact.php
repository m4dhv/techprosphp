<?php
/**
 * Template Name: Contact Us
 * The template for displaying the Contact Us page.
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
      <span class="label tp-hero__label">Get in Touch</span>
      <h1 class="tp-hero__title"><?php the_title(); ?></h1>
      <p class="tp-hero__desc">Our team of experts is ready to help you optimise your business operations with intelligent automation.</p>
    </div>
  </section>

  <section id="contact" class="section-pad contact-section">
    <div class="container">
      <div class="contact-grid">
        
        <!-- Left: contact info -->
        <div class="reveal contact-info">
          <h2 class="contact-info__heading">Let's discuss your next project</h2>
          
          <div class="contact-info__items">

            <div class="contact-info__item">
              <div class="contact-info__icon">📍</div>
              <div>
                <h4 class="contact-info__label">Visit Us</h4>
                <p class="contact-info__text">
                  <?php echo esc_html(get_theme_mod('contact_address_1', 'New York, NY 10001')); ?><br>
                  <?php echo esc_html(get_theme_mod('contact_address_2', 'London, UK')); ?>
                </p>
              </div>
            </div>

            <div class="contact-info__item">
              <div class="contact-info__icon">📧</div>
              <div>
                <h4 class="contact-info__label">Email Us</h4>
                <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'hello@techpros.com')); ?>" class="contact-info__link contact-info__link--accent">
                  <?php echo esc_html(get_theme_mod('contact_email', 'hello@techpros.com')); ?>
                </a>
              </div>
            </div>

            <div class="contact-info__item">
              <div class="contact-info__icon">📞</div>
              <div>
                <h4 class="contact-info__label">Call Us</h4>
                <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', get_theme_mod('contact_phone', '+18001234567'))); ?>" class="contact-info__link contact-info__link--primary">
                  <?php echo esc_html(get_theme_mod('contact_phone', '+1 800 123 4567')); ?>
                </a>
              </div>
            </div>

          </div>
        </div>

        <!-- Right: form -->
        <div class="reveal reveal-delay-1 contact-form-card">
          <?php echo do_shortcode('[wpforms id="219"]'); ?>
        </div>

      </div>
    </div>
  </section>
</main>

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
  width: 100%;
  box-sizing: border-box;
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
.tp-hero__label {
  display: inline-block;
  margin-bottom: 16px;
  color: var(--color-accent);
}
.tp-hero__title {
  color: #ffffff;
  font-family: var(--font-display);
  font-size: clamp(2rem, 5vw, 3.5rem);
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

/* ── Contact section ──────────────────────────────────────────── */
.contact-section {
  background: #ffffff;
}

/* Two-column grid — controlled entirely by CSS, not inline styles */
.contact-grid {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 80px;
  align-items: start;
}

/* Info column */
.contact-info__heading {
  font-family: var(--font-display);
  color: var(--color-primary);
  font-size: 2.5rem;
  margin-bottom: 40px;
  line-height: 1.2;
}
.contact-info__items {
  display: grid;
  gap: 32px;
}
.contact-info__item {
  display: flex;
  gap: 20px;
  align-items: flex-start;
}
.contact-info__icon {
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  background: var(--color-light);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.25rem;
}
.contact-info__label {
  color: var(--color-primary);
  margin-bottom: 4px;
}
.contact-info__text {
  color: var(--color-gray);
  font-size: 0.9375rem;
  margin: 0;
}
.contact-info__link {
  font-weight: 500;
  text-decoration: none;
}
.contact-info__link--accent  { color: var(--color-accent); }
.contact-info__link--primary { color: var(--color-primary); font-weight: 600; }

/* Form card */
.contact-form-card {
  background: white;
  padding: 48px;
  border-radius: 48px;
  box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
}

/* ── Header override ──────────────────────────────────────────── */
#site-header:not(.scrolled) {
  background: var(--color-primary) !important;
  box-shadow: none !important;
}

/* ── Tablet (≤ 1024px) ────────────────────────────────────────── */
@media (max-width: 1024px) {
  .contact-grid {
    grid-template-columns: 1fr;
    gap: 48px;
  }
  .contact-info__heading {
    font-size: 2rem;
    margin-bottom: 28px;
  }
}

/* ── Mobile (≤ 768px) ─────────────────────────────────────────── */
@media (max-width: 768px) {
  /* Hero */
  .tp-hero {
    min-height: auto;
  }
  .tp-hero__content {
    padding: 48px 20px;
  }
  .tp-hero__desc {
    font-size: 1rem;
  }

  /* Contact grid */
  .contact-grid {
    gap: 36px;
  }

  /* Info */
  .contact-info__heading {
    font-size: 1.6rem;
    margin-bottom: 24px;
  }
  .contact-info__items {
    gap: 24px;
  }

  /* Form card — reduce padding and soften radius on small screens */
  .contact-form-card {
    padding: 24px 20px;
    border-radius: 24px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
  }

  /* Prevent any wide container from causing horizontal scroll */
  .container {
    padding-left: 16px !important;
    padding-right: 16px !important;
  }
}

/* ── Small mobile (≤ 480px) ───────────────────────────────────── */
@media (max-width: 480px) {
  .contact-form-card {
    padding: 20px 16px;
    border-radius: 16px;
  }
  .contact-info__heading {
    font-size: 1.4rem;
  }
  .contact-info__icon {
    width: 40px;
    height: 40px;
    font-size: 1rem;
  }
}
</style>

<?php get_footer(); ?>
