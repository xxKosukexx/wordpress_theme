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
  <ul>
    <?php while (have_posts()) : the_post(); ?>
      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>
<?php wp_reset_query(); ?>
