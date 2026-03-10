/**
 * NexaFlow BPO - Main JavaScript
 */

(function () {
  'use strict';

  // =============================================
  // STICKY HEADER
  // =============================================
  const header = document.getElementById('site-header');
  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('scrolled', window.scrollY > 60);
    }, { passive: true });
  }

  // =============================================
  // MOBILE MENU
  // =============================================
  const hamburger   = document.getElementById('hamburger');
  const mobileMenu  = document.getElementById('mobile-menu');
  const mobileClose = document.getElementById('mobile-close');
  const overlay     = document.getElementById('overlay');

  function openMenu() {
    mobileMenu.classList.add('open');
    overlay.classList.add('show');
    document.body.style.overflow = 'hidden';
    if (hamburger) hamburger.setAttribute('aria-expanded', 'true');
  }

  function closeMenu() {
    mobileMenu.classList.remove('open');
    overlay.classList.remove('show');
    document.body.style.overflow = '';
    if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
  }

  if (hamburger)   hamburger.addEventListener('click', openMenu);
  if (mobileClose) mobileClose.addEventListener('click', closeMenu);
  if (overlay)     overlay.addEventListener('click', closeMenu);

  // Close on nav link click
  if (mobileMenu) {
    mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenu));
  }

  // =============================================
  // SMOOTH SCROLL
  // =============================================
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const id = this.getAttribute('href');
      if (id === '#') return;
      const target = document.querySelector(id);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // =============================================
  // SCROLL REVEAL
  // =============================================
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

  document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

  // =============================================
  // ANIMATED COUNTERS
  // =============================================
  function animateCounter(el, target, suffix) {
    const duration = 1800;
    const start    = performance.now();
    const isFloat  = target % 1 !== 0;

    function step(timestamp) {
      const progress = Math.min((timestamp - start) / duration, 1);
      const eased    = 1 - Math.pow(1 - progress, 3);
      const value    = isFloat
        ? (eased * target).toFixed(1)
        : Math.round(eased * target);
      el.textContent = value + suffix;
      if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
  }

  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el   = entry.target;
      const raw  = el.dataset.count || '0';
      const suffix = raw.replace(/[\d.]/g, '');
      const num    = parseFloat(raw);
      animateCounter(el, num, suffix);
      counterObserver.unobserve(el);
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('[data-count]').forEach(el => counterObserver.observe(el));

  // =============================================
  // CONTACT FORM (basic frontend handling)
  // =============================================
  const form = document.getElementById('nexaflow-contact');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const btn  = form.querySelector('button[type="submit"]');
      const orig = btn.textContent;
      btn.textContent = 'Sending…';
      btn.disabled = true;

      // Simulate submission (replace with wp_ajax or REST API call)
      setTimeout(() => {
        btn.textContent = '✓ Message Sent!';
        btn.style.background = '#00C88C';
        form.reset();
        setTimeout(() => {
          btn.textContent = orig;
          btn.style.background = '';
          btn.disabled = false;
        }, 3000);
      }, 1200);
    });
  }

  // =============================================
  // ACTIVE NAV HIGHLIGHT
  // =============================================
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('nav a[href^="#"]');

  const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      navLinks.forEach(link => {
        link.style.color = link.getAttribute('href') === '#' + entry.target.id
          ? 'var(--color-accent)'
          : '';
      });
    });
  }, { threshold: 0.4 });

  sections.forEach(s => sectionObserver.observe(s));

})();
