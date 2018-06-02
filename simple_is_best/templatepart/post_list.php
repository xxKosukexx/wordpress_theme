<!-- 最新記事表示 start -->
<div class="post_list">
  <?php  $count = 0; //広告表示するためのカウント変数
  //メインループだと最新記事を表示できないので、wp_query()を使用する。

   if ( have_posts() ) :
    while ( have_posts() ) :
      the_post(); ?>

      <!-- 記事の内容 start-->
      <a href="<?php the_permalink(); ?>">
        <div class="post_list_block">
          <?php if(has_post_thumbnail()) : ?>
            <?php the_post_thumbnail(); ?>
          <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/image/NoImage.png" alt="No Image">
          <?php endif; ?>
          <div class="post_listTitle">
            <?php echo the_title(); ?>
          </div>
          <div class="post_listCategory">
            <?php $cat = get_the_category(); ?>
            <small><?php echo $cat[0]->name; ?></small>
          </div>
        </div>
      </a>
      <!-- 記事の内容 end-->

      <!-- ３記事ごとに広告を挿入する -->
      <?php
      $count++;
      if (($count % 3) == 0) : ?>
        <div class="ad_block">
          <?php echo get_option(POST_LIST_AD); ?>
          <div class="ad_title">
            スポンサーリンク
          </div>
        </div>
      <?php endif; ?>

    <?php endwhile;
  endif; ?>
</div>
<!-- 最新記事表示 end -->

<?php the_posts_pagination( array(
'mid_size' => 2,
'prev_text' => __( 'Back', 'textdomain' ),
'next_text' => __( 'Onward', 'textdomain' ),
'screen_reader_text' => ' '
) ); ?>
