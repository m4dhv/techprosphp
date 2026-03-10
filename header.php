<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="overlay" id="overlay"></div>

<nav class="mobile-menu" id="mobile-menu" aria-label="Mobile navigation">
  <button class="mobile-close" id="mobile-close" aria-label="Close menu">✕</button>
  <ul>
    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
    <li><a href="#services">Services</a></li>
    <li><a href="#about">About Us</a></li>
    <li><a href="#industries">Industries</a></li>
    <li><a href="#testimonials">Clients</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
  <a href="#contact" class="btn btn-primary" style="justify-content:center;">
    <?php echo nexaflow_hero('hero_cta_1_text', 'Get Started'); ?>
  </a>
</nav>

<header id="site-header">
  <div class="container">
    <div class="nav-inner">

      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
        <?php if (has_custom_logo()) :
          the_custom_logo();
        else : ?>
        <div class="logo-mark"><?php echo esc_html(substr(get_bloginfo('name'), 0, 1)); ?></div>
        <span class="logo-text"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
      </a>

      <nav aria-label="Primary navigation">
        <?php if (has_nav_menu('primary')) :
          wp_nav_menu(['theme_location'=>'primary','container'=>false,'items_wrap'=>'<ul>%3$s</ul>']);
        else : ?>
        <ul>
          <li><a href="#services">Services</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#industries">Industries</a></li>
          <li><a href="#testimonials">Clients</a></li>
        </ul>
        <?php endif; ?>
      </nav>

      <div class="nav-cta">
        <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/','',get_theme_mod('contact_phone','+18001234567'))); ?>"
           class="btn btn-outline" style="padding:10px 20px;font-size:0.875rem;">
          📞 <?php echo esc_html(get_theme_mod('contact_phone', '+1 800 123 4567')); ?>
        </a>
        <a href="<?php echo esc_url(get_theme_mod('hero_cta_1_url','#contact')); ?>"
           class="btn btn-primary" style="padding:10px 24px;font-size:0.875rem;">
          <?php echo nexaflow_hero('hero_cta_1_text', 'Get Started'); ?> →
        </a>
      </div>

      <button class="hamburger" id="hamburger" aria-label="Open menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>

    </div>
  </div>
</header>
