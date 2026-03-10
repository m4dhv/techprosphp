<?php
/**
 * Default page template
 */
get_header();
?>
<main style="padding-top: 0px; min-height: 60vh;">
  <!-- Page Hero -->
  <div style="background: var(--color-primary); padding: 80px 0 60px; position: relative; overflow: hidden;">
    <div style="position:absolute;inset:0;background-image:linear-gradient(rgba(0,194,255,0.04) 1px,transparent 1px),linear-gradient(90deg,rgba(0,194,255,0.04) 1px,transparent 1px);background-size:60px 60px;"></div>
    <div class="container" style="position:relative;z-index:1;">
      <h1 style="color: white;"><?php the_title(); ?></h1>
    </div>
  </div>

  <div class="container section-pad">
    <?php while (have_posts()) : the_post(); ?>
    <div class="entry-content" style="max-width: 860px;">
      <?php the_content(); ?>
    </div>
    <?php endwhile; ?>
  </div>
</main>
<?php get_footer(); ?>
