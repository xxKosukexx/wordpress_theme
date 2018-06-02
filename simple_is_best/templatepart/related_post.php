<?php
//表示中の記事のカテゴリーと同じカテゴリの記事を取得して、表示する。
$post_id = get_the_ID();
foreach((get_the_category()) as $cat) {
  $cat_id = $cat->cat_ID ;
  break ;
}
query_posts(
  array(
    'cat' => $cat_id,
    'showposts' => 5,
    'post__not_in' => array($post_id)
  )
);
if(have_posts()) :
  ?>
    <?php while (have_posts()) : the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="related_post">
        <?php if(has_post_thumbnail()) : ?>
          <?php the_post_thumbnail(); ?>
        <?php else : ?>
          <img src="<?php echo get_template_directory_uri(); ?>/image/NoImage.png" alt="No Image">
        <?php endif; ?>
        <h1><?php echo get_the_title(); ?></h1>
        <?php the_excerpt(); ?>
      </a>
      <p class="clear_both"></p>
      <p></p>
    <?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
