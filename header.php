<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php bloginfo('description'); ?>">
  <?php wp_head(); ?>
  <style>
    /* ── Reset / Base ─────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --c-bg:        #0a0e1a;
      --c-surface:   #111827;
      --c-border:    rgba(255,255,255,.08);
      --c-primary:   #3b82f6;
      --c-primary-h: #60a5fa;
      --c-text:      #f1f5f9;
      --c-muted:     #94a3b8;
      --c-accent:    #06b6d4;
      --nav-h:       72px;
      --mega-radius: 16px;
      --transition:  220ms cubic-bezier(.4,0,.2,1);
      --font-sans:   'DM Sans', system-ui, sans-serif;
      --font-display:'Space Grotesk', var(--font-sans);
    }

    body { font-family: var(--font-sans); background: var(--c-bg); color: var(--c-text); }

    /* Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap');
    
    a { text-decoration: none; color: inherit; }
    ul { list-style: none; }

    /* ── Header shell ─────────────────────────────────────── */
    #site-header {
      position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
      height: var(--nav-h);
      background: rgba(10,14,26,.85);
      backdrop-filter: blur(18px) saturate(160%);
      -webkit-backdrop-filter: blur(18px) saturate(160%);
      border-bottom: 1px solid var(--c-border);
      transition: box-shadow var(--transition);
    }
    #site-header.scrolled {
      box-shadow: 0 8px 40px rgba(0,0,0,.45);
    }

    .container { max-width: 1320px; margin: 0 auto; padding: 0 24px; }

    .nav-inner {
      display: flex; align-items: center; gap: 32px;
      height: var(--nav-h);
    }

    /* ── Logo ─────────────────────────────────────────────── */
    .site-logo {
      display: flex; align-items: center; gap: 10px;
      flex-shrink: 0; font-family: var(--font-display);
    }
    .site-logo img { height: 36px; width: auto; }
    .logo-mark {
      width: 36px; height: 36px; border-radius: 8px;
      background: linear-gradient(135deg, var(--c-primary), var(--c-accent));
      display: flex; align-items: center; justify-content: center;
      font-weight: 700; font-size: 1.1rem; color: #fff;
    }
    .logo-text { font-size: 1.15rem; font-weight: 700; letter-spacing: -.02em; }

    /* ── Primary nav ──────────────────────────────────────── */
    #primary-nav { flex: 1; display: flex; justify-content: center; }
    #primary-nav > ul {
      display: flex; align-items: center; gap: 4px;
    }
    #primary-nav > ul > li { position: relative; }
    #primary-nav > ul > li > a {
      display: flex; align-items: center; gap: 5px;
      padding: 8px 14px; border-radius: 8px;
      font-size: .9rem; font-weight: 500; color: var(--c-muted);
      transition: color var(--transition), background var(--transition);
      white-space: nowrap;
    }
    #primary-nav > ul > li > a:hover,
    #primary-nav > ul > li.active > a {
      color: var(--c-text);
      background: rgba(255,255,255,.06);
    }
    .dropdown-arrow {
      font-size: .65rem; opacity: .6;
      transition: transform var(--transition);
      display: inline-block;
    }
    li.has-mega:hover .dropdown-arrow,
    li.has-mega:focus-within .dropdown-arrow { transform: rotate(180deg); }

    /* ── Mega Menu panel ──────────────────────────────────── */
    /* Hover bridge — fills the gap so mouse movement doesn't break hover */
li.has-mega::after {
  content: '';
  position: absolute;
  top: 100%;
  left: -20px;
  right: -20px;
  height: 16px;
  background: transparent;
}
    .mega-menu {
      position: absolute;
      top: calc(100% + 4px);
      left: 50%; transform: translateX(-50%) translateY(8px);
      width: 780px;
      background: var(--c-surface);
      border: 1px solid var(--c-border);
      border-radius: var(--mega-radius);
      box-shadow: 0 24px 80px rgba(0,0,0,.55);
      padding: 28px;
      display: grid;
      grid-template-columns: 220px 1fr;
      gap: 24px;
      opacity: 0; visibility: hidden; pointer-events: none;
      transform: translateX(-50%) translateY(8px);
      transition: opacity var(--transition), transform var(--transition), visibility var(--transition);
    }
    li.has-mega:hover .mega-menu,
    li.has-mega:focus-within .mega-menu {
      opacity: 1; visibility: visible; pointer-events: auto;
      transform: translateX(-50%) translateY(0);
    }

    /* Arrow pip */
    .mega-menu::before {
      content: '';
      position: absolute; top: -7px; left: 50%; transform: translateX(-50%);
      width: 14px; height: 14px;
      background: var(--c-surface);
      border-left: 1px solid var(--c-border);
      border-top: 1px solid var(--c-border);
      border-radius: 3px 0 0 0;
      rotate: 45deg;
    }

    /* Featured / left column */
    .mega-featured {
      background: linear-gradient(160deg, rgba(59,130,246,.15) 0%, rgba(6,182,212,.08) 100%);
      border: 1px solid rgba(59,130,246,.2);
      border-radius: 12px;
      padding: 20px;
      display: flex; flex-direction: column; justify-content: space-between;
    }
    .mega-featured-label {
      font-size: .7rem; font-weight: 600; letter-spacing: .1em;
      text-transform: uppercase; color: var(--c-primary); margin-bottom: 8px;
    }
    .mega-featured-title {
      font-family: var(--font-display);
      font-size: 1.15rem; font-weight: 700; line-height: 1.3;
      color: var(--c-text); margin-bottom: 10px;
    }
    .mega-featured-desc { font-size: .82rem; color: var(--c-muted); line-height: 1.55; margin-bottom: 18px; }
    .mega-featured-link {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: .82rem; font-weight: 600; color: var(--c-primary);
      transition: gap var(--transition), color var(--transition);
    }
    .mega-featured-link:hover { gap: 10px; color: var(--c-primary-h); }

    /* Right column grid */
    .mega-links {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4px;
      align-content: start;
    }
    .mega-link-item a {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 12px; border-radius: 10px;
      transition: background var(--transition);
    }
    .mega-link-item a:hover { background: rgba(255,255,255,.05); }
    .mega-link-icon {
      flex-shrink: 0; width: 34px; height: 34px; border-radius: 8px;
      background: rgba(255,255,255,.06);
      display: flex; align-items: center; justify-content: center;
      font-size: 1rem;
    }
    .mega-link-text { display: flex; flex-direction: column; gap: 2px; }
    .mega-link-name { font-size: .85rem; font-weight: 600; color: var(--c-text); }
    .mega-link-desc { font-size: .75rem; color: var(--c-muted); line-height: 1.4; }

    /* Mega footer bar */
    .mega-footer {
      grid-column: 1 / -1;
      border-top: 1px solid var(--c-border);
      padding-top: 16px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .mega-footer-text { font-size: .8rem; color: var(--c-muted); }
    .mega-footer-cta {
      font-size: .8rem; font-weight: 600; color: var(--c-primary);
      display: flex; align-items: center; gap: 5px;
      transition: gap var(--transition);
    }
    .mega-footer-cta:hover { gap: 9px; }

    /* ── Simple dropdown (non-mega) ───────────────────────── */
    .dropdown-menu {
      position: absolute;
      top: calc(100% + 8px); left: 50%; transform: translateX(-50%);
      min-width: 200px;
      background: var(--c-surface);
      border: 1px solid var(--c-border);
      border-radius: 12px;
      padding: 8px;
      box-shadow: 0 16px 48px rgba(0,0,0,.45);
      opacity: 0; visibility: hidden; pointer-events: none;
      transition: opacity var(--transition), transform var(--transition), visibility var(--transition);
      transform: translateX(-50%) translateY(6px);
    }
    li.has-dropdown:hover .dropdown-menu,
    li.has-dropdown:focus-within .dropdown-menu {
      opacity: 1; visibility: visible; pointer-events: auto;
      transform: translateX(-50%) translateY(0);
    }
    .dropdown-menu li a {
      display: block; padding: 9px 14px; border-radius: 8px;
      font-size: .87rem; color: var(--c-muted);
      transition: background var(--transition), color var(--transition);
    }
    .dropdown-menu li a:hover { background: rgba(255,255,255,.06); color: var(--c-text); }

    /* ── Nav CTA buttons ──────────────────────────────────── */
    .nav-cta { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }

    .btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 9px 20px; border-radius: 8px;
      font-size: .875rem; font-weight: 600; font-family: var(--font-sans);
      cursor: pointer; border: none; transition: all var(--transition);
      white-space: nowrap;
    }
    .btn-outline {
      background: transparent;
      border: 1px solid var(--c-border);
      color: var(--c-muted);
    }
    .btn-outline:hover { border-color: rgba(255,255,255,.25); color: var(--c-text); background: rgba(255,255,255,.04); }
    .btn-primary {
      background: linear-gradient(135deg, var(--c-primary), #2563eb);
      color: #fff;
      box-shadow: 0 4px 16px rgba(59,130,246,.35);
    }
    .btn-primary:hover {
      box-shadow: 0 6px 24px rgba(59,130,246,.5);
      transform: translateY(-1px);
    }

    /* ── Hamburger ────────────────────────────────────────── */
    .hamburger {
      display: none; flex-direction: column; justify-content: center;
      gap: 5px; padding: 8px; background: none; border: none;
      cursor: pointer; margin-left: auto;
    }
    .hamburger span {
      display: block; width: 22px; height: 2px;
      background: var(--c-text); border-radius: 2px;
      transition: all var(--transition);
    }
    .hamburger[aria-expanded="true"] span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .hamburger[aria-expanded="true"] span:nth-child(2) { opacity: 0; }
    .hamburger[aria-expanded="true"] span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* ── Overlay ──────────────────────────────────────────── */
    .overlay {
      position: fixed; inset: 0; background: rgba(0,0,0,.6);
      backdrop-filter: blur(4px); z-index: 900;
      opacity: 0; visibility: hidden; transition: all var(--transition);
    }
    .overlay.active { opacity: 1; visibility: visible; }

    /* ── Mobile menu ──────────────────────────────────────── */
    .mobile-menu {
      position: fixed; top: 0; right: 0; bottom: 0;
      width: min(320px, 88vw);
      background: var(--c-surface);
      border-left: 1px solid var(--c-border);
      z-index: 1100;
      padding: 28px 24px;
      display: flex; flex-direction: column; gap: 8px;
      transform: translateX(100%);
      transition: transform 300ms cubic-bezier(.4,0,.2,1);
      overflow-y: auto;
    }
    .mobile-menu.open { transform: translateX(0); }
    .mobile-close {
      align-self: flex-end; background: none; border: none;
      font-size: 1.3rem; color: var(--c-muted); cursor: pointer; margin-bottom: 12px;
      transition: color var(--transition);
    }
    .mobile-close:hover { color: var(--c-text); }
    .mobile-menu ul { display: flex; flex-direction: column; gap: 4px; margin-bottom: 16px; }
    .mobile-menu ul li a {
      display: block; padding: 11px 14px; border-radius: 8px;
      font-size: .95rem; font-weight: 500; color: var(--c-muted);
      transition: background var(--transition), color var(--transition);
    }
    .mobile-menu ul li a:hover { background: rgba(255,255,255,.06); color: var(--c-text); }
    .mobile-menu .btn { width: 100%; justify-content: center; }

    /* ── Mobile Services Accordion ───────────────────────────── */
    .mobile-services-toggle {
      display: flex; align-items: center; justify-content: center;
      gap: 5px;
      width: 100%; padding: 11px 14px; border-radius: 8px;
      background: none; border: none; cursor: pointer;
      font-size: .95rem; font-weight: 500; color: var(--c-muted);
      font-family: var(--font-sans);
      transition: background var(--transition), color var(--transition);
    }
    .mobile-services-toggle:hover { background: rgba(255,255,255,.06); color: var(--c-text); }
    .mobile-services-toggle[aria-expanded="true"] { color: var(--c-text); background: rgba(255,255,255,.04); }
    .mobile-services-toggle .msv-arrow {
      font-size: .65rem; opacity: .6;
      transition: transform var(--transition);
    }
    .mobile-services-toggle[aria-expanded="true"] .msv-arrow { transform: rotate(180deg); }

    .mobile-services-dropdown {
      max-height: 0 !important;
      overflow: hidden !important;
      display: flex !important;
      flex-direction: column;
      gap: 2px;
      padding: 0 0 0 12px;
      transition: max-height 0.3s ease, padding 0.3s ease, margin-top 0.3s ease;
    }
    .mobile-services-dropdown.open {
      max-height: 600px !important;
      padding: 4px 0 4px 12px;
      margin-top: 2px;
    }

    /* "View All Services" top link */
    .msv-view-all a {
      display: flex; align-items: center; gap: 8px;
      padding: 10px 14px; border-radius: 8px;
      font-size: .875rem; font-weight: 600; color: var(--c-primary);
      border-bottom: 1px solid var(--c-border);
      margin-bottom: 4px;
      transition: background var(--transition);
    }
    .msv-view-all a:hover { background: rgba(59,130,246,.08); }

    /* Individual service items */
    .mobile-services-dropdown li a {
      display: flex; align-items: center; gap: 10px;
      padding: 9px 14px; border-radius: 8px;
      font-size: .875rem; font-weight: 500; color: var(--c-muted);
      transition: background var(--transition), color var(--transition);
    }
    .mobile-services-dropdown li a:hover { background: rgba(255,255,255,.06); color: var(--c-text); }

    /* ── Responsive ───────────────────────────────────────── */
    @media (max-width: 1024px) {
      .mega-menu { width: 640px; }
    }
    @media (max-width: 900px) {
      #primary-nav, .nav-cta .btn-outline { display: none; }
      .hamburger { display: flex; }
    }
    @media (max-width: 480px) {
      .nav-cta { display: none; }
    }
  </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="overlay" id="overlay"></div>

<!-- ── Mobile Drawer ───────────────────────────────────────────── -->
<nav class="mobile-menu" id="mobile-menu" aria-label="Mobile navigation">
  <button class="mobile-close" id="mobile-close" aria-label="Close menu">✕</button>
  <ul>

    <!-- Services — accordion -->
    <li>
      <button class="mobile-services-toggle" id="msv-toggle" aria-expanded="false" aria-controls="msv-dropdown">
        Services <span class="msv-arrow">▾</span>
      </button>
      <ul class="mobile-services-dropdown" id="msv-dropdown" role="list">

        <!-- View All at top -->
        <li class="msv-view-all">
          <a href="<?php echo esc_url(home_url('/index.php/our-services')); ?>">
            View All Services →
          </a>
        </li>

        <!-- Same order as desktop mega menu -->
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
    </li>

    <!-- Rest of nav — desktop order: Softwares, Industries, About Us, Contact -->
    <li><a href="<?php echo esc_url(home_url('/index.php/softwares')); ?>">Softwares</a></li>
    <li><a href="<?php echo esc_url(home_url('/index.php/industries')); ?>">Industries</a></li>
    <li><a href="<?php echo esc_url(home_url('/index.php/about')); ?>">About Us</a></li>
    <li><a href="<?php echo esc_url(home_url('/index.php/contact')); ?>">Contact</a></li>

  </ul>
  <a href="<?php echo esc_url(get_theme_mod('hero_cta_1_url','#contact')); ?>" class="btn btn-primary">
    <?php echo nexaflow_hero('hero_cta_1_text', 'Get Started'); ?> →
  </a>
</nav>

<!-- ── Site Header ─────────────────────────────────────────────── -->
<header id="site-header">
  <div class="container">
    <div class="nav-inner">

      <!-- Logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
        <?php if (has_custom_logo()) :
          the_custom_logo();
        else : ?>
          <div class="logo-mark"><?php echo esc_html(substr(get_bloginfo('name'), 0, 1)); ?></div>
          <span class="logo-text"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
      </a>

      <!-- Primary Nav -->
      <nav id="primary-nav" aria-label="Primary navigation">
        <?php if (has_nav_menu('primary')) :
          wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'items_wrap' => '<ul>%3$s</ul>']);
        else : ?>
        <ul>

          <!-- ── Services: MEGA MENU ── -->
          <li class="has-mega">
            <a href="<?php echo esc_url(home_url('/index.php/our-services')); ?>">
              Services <span class="dropdown-arrow">▾</span>
            </a>

            <div class="mega-menu" role="region" aria-label="Services menu">

              <!-- Featured left panel -->
              <div class="mega-featured">
                <div>
                  <p class="mega-featured-label">What we do</p>
                  <h3 class="mega-featured-title">End-to-end technology solutions</h3>
                  <p class="mega-featured-desc">From cloud infrastructure to AI-driven automation — we design, build, and scale the systems that power your business.</p>
                </div>
                <a href="<?php echo esc_url(home_url('/index.php/our-services')); ?>" class="mega-featured-link">
                  View all services →
                </a>
              </div>

              <!-- Service links grid -->
              <div class="mega-links">

                <div class="mega-link-item">
                  <a href="<?php echo esc_url(home_url('/index.php/our-services/artificial-intelligence-and-automation')); ?>">
                    <span class="mega-link-icon">🤖</span>
                    <span class="mega-link-text">
                      <span class="mega-link-name">AI &amp; Automation</span>
                      <span class="mega-link-desc">Intelligent workflows &amp; ML pipelines</span>
                    </span>
                  </a>
                </div>

                <div class="mega-link-item">
                  <a href="<?php echo esc_url(home_url('/index.php/our-services/business-analytics')); ?>">
                    <span class="mega-link-icon">📊</span>
                    <span class="mega-link-text">
                      <span class="mega-link-name">Business Analytics</span>
                      <span class="mega-link-desc">KPI dashboards &amp; strategic insight</span>
                    </span>
                  </a>
                </div>

                <div class="mega-link-item">
                  <a href="<?php echo esc_url(home_url('/index.php/cloud-infrastructure')); ?>">
                    <span class="mega-link-icon">☁️</span>
                    <span class="mega-link-text">
                      <span class="mega-link-name">Cloud Infrastructure</span>
                      <span class="mega-link-desc">Scalable, resilient cloud architecture</span>
                    </span>
                  </a>
                </div>

                <div class="mega-link-item">
                  <a href="<?php echo esc_url(home_url('/index.php/our-services/consulting-operations')); ?>">
                    <span class="mega-link-icon">🧭</span>
                    <span class="mega-link-text">
                      <span class="mega-link-name">Consulting &amp; Ops</span>
                      <span class="mega-link-desc">Strategy, transformation &amp; change</span>
                    </span>
                  </a>
                </div>

                <div class="mega-link-item">
                  <a href="<?php echo esc_url(home_url('/index.php/our-services/cybersecurity')); ?>">
                    <span class="mega-link-icon">🔐</span>
                    <span class="mega-link-text">
                      <span class="mega-link-name">Cybersecurity</span>
                      <span class="mega-link-desc">Threat detection &amp; compliance</span>
                    </span>
                  </a>
                </div>

                <div class="mega-link-item">
                  <a href="<?php echo esc_url(home_url('/index.php/our-services/data-analytics')); ?>">
                    <span class="mega-link-icon">📈</span>
                    <span class="mega-link-text">
                      <span class="mega-link-name">Data Analytics</span>
                      <span class="mega-link-desc">Big data, ETL &amp; visualisation</span>
                    </span>
                  </a>
                </div>

                <div class="mega-link-item">
                  <a href="<?php echo esc_url(home_url('/index.php/our-services/enterprise-solutions')); ?>">
                    <span class="mega-link-icon">🏢</span>
                    <span class="mega-link-text">
                      <span class="mega-link-name">Enterprise Solutions</span>
                      <span class="mega-link-desc">ERP, CRM &amp; integration platforms</span>
                    </span>
                  </a>
                </div>

                <div class="mega-link-item">
                  <a href="<?php echo esc_url(home_url('/index.php/our-services/industrial-autonomy-and-engineering')); ?>">
                    <span class="mega-link-icon">⚙️</span>
                    <span class="mega-link-text">
                      <span class="mega-link-name">Industrial Autonomy</span>
                      <span class="mega-link-desc">Robotics, IoT &amp; smart engineering</span>
                    </span>
                  </a>
                </div>

                <div class="mega-link-item" style="grid-column: 1 / -1;">
                  <a href="<?php echo esc_url(home_url('/index.php/our-services/network-solutions')); ?>">
                    <span class="mega-link-icon">🌐</span>
                    <span class="mega-link-text">
                      <span class="mega-link-name">Network Solutions &amp; Services</span>
                      <span class="mega-link-desc">SD-WAN, VPN, LAN/WAN design &amp; managed connectivity</span>
                    </span>
                  </a>
                </div>

              </div><!-- /.mega-links -->

              <!-- Footer bar -->
              <div class="mega-footer">
                <span class="mega-footer-text">Need help choosing? Talk to an expert.</span>
                <a href="<?php echo esc_url(home_url('/index.php/contact')); ?>" class="mega-footer-cta">
                  Book a free consultation →
                </a>
              </div>

            </div><!-- /.mega-menu -->
          </li>

          <!-- Standard links -->
          <li><a href="<?php echo esc_url(home_url('/index.php/softwares')); ?>">Softwares</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/industries')); ?>">Industries</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/about')); ?>">About Us</a></li>
          <li><a href="<?php echo esc_url(home_url('/index.php/contact')); ?>">Contact</a></li>

        </ul>
        <?php endif; ?>
      </nav>

      <!-- CTA buttons -->
      <div class="nav-cta">
        <a href="tel:<?php echo esc_attr(preg_replace('/[^+\d]/', '', get_theme_mod('contact_phone', '+18001234567'))); ?>"
           class="btn btn-outline">
          📞 <?php echo esc_html(get_theme_mod('contact_phone', '+1 800 123 4567')); ?>
        </a>
        <a href="<?php echo esc_url(get_theme_mod('hero_cta_1_url', '#contact')); ?>"
           class="btn btn-primary">
          <?php echo nexaflow_hero('hero_cta_1_text', 'Get Started'); ?> →
        </a>
      </div>

      <!-- Hamburger -->
      <button class="hamburger" id="hamburger" aria-label="Open menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>

    </div>
  </div>
</header>

<script>
(function () {
  // Scroll shadow
  const header = document.getElementById('site-header');
  window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 12);
  }, { passive: true });

  // Mobile menu toggle
  const hamburger = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileClose = document.getElementById('mobile-close');
  const overlay    = document.getElementById('overlay');

  // Services accordion in mobile menu
  const msvToggle = document.getElementById('msv-toggle');
  const msvDropdown = document.getElementById('msv-dropdown');
  if (msvToggle && msvDropdown) {
    msvToggle.addEventListener('click', () => {
      const isOpen = msvDropdown.classList.toggle('open');
      msvToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
  }

  // Close accordion when menu closes
  function openMenu() {
    mobileMenu.classList.add('open');
    overlay.classList.add('active');
    hamburger.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }
  function closeMenu() {
    mobileMenu.classList.remove('open');
    overlay.classList.remove('active');
    hamburger.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
    // Reset services accordion
    if (msvDropdown) msvDropdown.classList.remove('open');
    if (msvToggle) msvToggle.setAttribute('aria-expanded', 'false');
  }

  hamburger.addEventListener('click', openMenu);
  mobileClose.addEventListener('click', closeMenu);
  overlay.addEventListener('click', closeMenu);

  // Close on Esc
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
})();
</script>
