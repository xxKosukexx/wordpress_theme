<?php get_header(); ?>
<div id="page">
  <?php
  if(have_posts()): while(have_posts()): the_post();?>
  <div id="title">
    <h1><?php the_title(); ?></h1>
  </div>
  <div id="contents">
    <?php the_content(); ?>
  </div>

  <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
