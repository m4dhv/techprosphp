<?php
/**
 * Single post template
 */
get_header();
?>
<main style="padding-top: 120px; min-height: 60vh;">
  <div class="container section-pad">
    <?php while (have_posts()) : the_post(); ?>
    <article>
      <h1 style="color: var(--color-primary); margin-bottom: 24px;"><?php the_title(); ?></h1>
      <div style="color: var(--color-gray); margin-bottom: 32px; font-size: 0.9375rem;">
        Published on <?php echo get_the_date(); ?> by <?php the_author(); ?>
      </div>
      <div class="entry-content" style="max-width: 760px;">
        <?php the_content(); ?>
      </div>
    </article>
    <?php endwhile; ?>
  </div>
</main>
<?php get_footer(); ?>
