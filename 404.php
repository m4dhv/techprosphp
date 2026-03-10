<?php get_header(); ?>
<main style="padding-top:120px;min-height:80vh;display:flex;align-items:center;justify-content:center;text-align:center;background:var(--color-light);">
  <div class="container">
    <div style="font-size:6rem;margin-bottom:24px;">🔍</div>
    <h1 style="color:var(--color-primary);font-size:5rem;margin-bottom:16px;">404</h1>
    <h2 style="color:var(--color-secondary);margin-bottom:20px;">Page Not Found</h2>
    <p style="max-width:400px;margin:0 auto 40px;">The page you're looking for doesn't exist or has been moved.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-dark">← Back to Home</a>
  </div>
</main>
<?php get_footer(); ?>
