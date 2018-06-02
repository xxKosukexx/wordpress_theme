
<?php
  //ページのアクセス数をカウントする
  if( !is_user_logged_in() && !is_bot() ) { set_post_views( get_the_ID() ); }
?>

<?php get_header(); ?>
<div id="post">
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article id="article">
      <div id="title">
        <h1><?php echo the_title(); ?></h1>
      </div>
      <div id="read_time">
        <?php read_time(); ?>
      </div>
      <?php if( has_post_thumbnail() ): ?>
        <div id="thumbnail">
          <?php the_post_thumbnail(); ?>
        </div>
      <?php endif; ?>
      <div id="breadcrumbs">
        <p><?php breadcrumbs(); ?></p>
      </div>
      <div id="contents">
        <?php the_content(); ?>
      </div>
      <div id="related_post">
        <h1>関連記事</h1>
        <?php get_template_part( 'templatepart/related_post' ); ?>
      </div><!-- related post end -->
      <div id="writer">
        <div id="writer_avater">
          <?php echo get_avatar( get_the_author_meta('ID'), 120 ); ?>
        </div>
        <div id="writer_info">
          <h1>この記事を書いた人</h1>
          <?php echo nl2br(get_the_author_meta('description')); ?>
        </div>
      </div>
      <p class='clear_both'></p>
      <div id="comment_form">
        <?php comments_template(); ?>
      </div>


    </article>
  <?php endwhile; ?>

  <?php
  //サイドバーを読み込む
  get_sidebar();
   ?>
  <div class="float-clear"></div>

</div>


<?php get_footer(); ?>
