
<?php
  //ページのアクセス数をカウントする
  if( !is_user_logged_in() && !is_bot() ) { set_post_views( get_the_ID() ); }
?>

<?php get_header(); ?>
<div class="main-area">
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <article id="article">
      <div id="title" class="width100">
        <h1><?php echo the_title(); ?></h1>
      </div>
      <div id="thumbnail" class="width100">
        <?php the_post_thumbnail(); ?>
      </div>
      <div id="breadcrumbs" class="width100">
        <p><?php breadcrumbs(); ?></p>
      </div>
      <div id="read_time" class="width100">
        <?php read_time(); ?>
      </div>
      <div id="contents" class="width100 break-all">
        <?php the_content(); ?>
      </div>
      <div id="related_post" class="width100">
        <h1>related post</h1>
        <?php get_template_part( 'templatepart/relsted_post' ); ?>
      </div><!-- related post end -->
      <div id="writer_info" class="width100">
        <h1>この記事を書いた人</h1>
        <p><?php echo nl2br(get_the_author_meta('description')); ?></p>
      </div>
      <div id="comment_form" class="width100">
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
