<?php
/**
 * The template for displaying Service Archive pages
 * Path: wp-content/themes/techpros-theme/archive-service.php
 */

get_header(); ?>

<main id="primary" class="site-main" style="padding-top: 100px; background: var(--color-light);">

    <!-- HERO SECTION -->
    <header class="services-archive-hero" style="background: var(--color-primary); padding: 120px 0 80px; position: relative; overflow: hidden;">
        <div class="hero-bg-grid" style="opacity: 0.1;"></div>
        <div class="hero-bg-orb-1" style="top: -20%; left: -10%; opacity: 0.3;"></div>
        
        <div class="container" style="position: relative; z-index: 2;">
            <div class="hero-badge" style="margin-bottom: 24px;">
                <span class="dot"></span>
                <span>Our Expertise</span>
            </div>
            <h1 style="color: white; font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 20px; line-height: 1.1;">
                Future-Proof <span class="highlight">Solutions</span><br>For Global Enterprises
            </h1>
            <p style="color: rgba(255,255,255,0.7); max-width: 600px; font-size: 1.125rem; line-height: 1.6;">
                We combine deep domain knowledge with cutting-edge technology to streamline operations and drive exponential growth.
            </p>
        </div>
    </header>

    <!-- MAIN SERVICES GRID -->
    <section class="section-pad">
        <div class="container">
            <div class="services-grid">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post(); 
                        // Fetching the icon from custom fields or using a default
                        $icon = get_post_meta(get_the_ID(), '_service_icon', true) ?: '⚡';
                    ?>
                    <article class="service-card reveal">
                        <div class="service-icon" style="font-size: 2.5rem; margin-bottom: 24px;"><?php echo esc_html($icon); ?></div>
                        <h3 style="margin-bottom: 16px;"><?php the_title(); ?></h3>
                        <div style="color: var(--color-gray); margin-bottom: 24px; line-height: 1.6;">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="btn-text" style="color: var(--color-accent); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                            Explore Service <span>→</span>
                        </a>
                    </article>
                    <?php 
                    endwhile;
                else : 
                    // Fallback to defaults from functions.php if no posts are created yet
                    $defaults = tp_default_services();
                    foreach ($defaults as $svc) : ?>
                        <article class="service-card reveal">
                            <div class="service-icon" style="font-size: 2.5rem; margin-bottom: 24px;"><?php echo esc_html($svc['icon']); ?></div>
                            <h3><?php echo esc_html($svc['title']); ?></h3>
                            <p style="color: var(--color-gray); margin-bottom: 24px; line-height: 1.6;"><?php echo esc_html($svc['description']); ?></p>
                            <a href="#contact" class="btn-text" style="color: var(--color-accent); font-weight: 600; text-decoration: none;">Learn More →</a>
                        </article>
                <?php endforeach; 
                endif; ?>
            </div>
        </div>
    </section>

    <!-- CTAS / CAPABILITIES SECTION -->
    <section style="background: var(--color-white); border-top: 1px solid var(--color-gray-light);">
        <div class="container section-pad">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; align-items: center;">
                <div>
                    <h2 style="margin-bottom: 24px;">Specialized Consulting & <br><span class="highlight">Delivery Models</span></h2>
                    <p style="color: var(--color-gray); margin-bottom: 32px;">Our engagement models are designed to be flexible, scalable, and results-oriented, ensuring maximum ROI for your digital investments.</p>
                    
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 16px; display: flex; gap: 12px; align-items: center;">
                            <span style="color: var(--color-accent);">✓</span> Outcome-Based Managed Services
                        </li>
                        <li style="margin-bottom: 16px; display: flex; gap: 12px; align-items: center;">
                            <span style="color: var(--color-accent);">✓</span> Global Delivery Centers
                        </li>
                        <li style="margin-bottom: 16px; display: flex; gap: 12px; align-items: center;">
                            <span style="color: var(--color-accent);">✓</span> Strategic Staff Augmentation
                        </li>
                    </ul>
                </div>
                <div style="background: var(--color-primary); padding: 48px; border-radius: 24px; color: white;">
                    <h3 style="color: white; margin-bottom: 16px;">Ready to Transform?</h3>
                    <p style="color: rgba(255,255,255,0.7); margin-bottom: 32px;">Speak with our solution architects to design a custom roadmap for your business.</p>
                    <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="btn btn-primary" style="width: 100%; justify-content: center;">Book a Consultation</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>