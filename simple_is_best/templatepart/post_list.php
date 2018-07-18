<!-- 記事一覧表示 start -->
<div class="post_list">
  <?php  $count = 0; //広告表示するためのカウント変数
  //メインループだと最新記事を表示できないので、wp_query()を使用する。

   if ( have_posts() ) :
    while ( have_posts() ) :
      the_post(); ?>

      <!-- 記事の内容 start-->

        <div class="post_list_block">
          <a href="<?php echo get_the_permalink(); ?>">
            <?php if(has_post_thumbnail()) : ?>
              <?php the_post_thumbnail(); ?>
            <?php else : ?>
              <img src="<?php echo get_template_directory_uri(); ?>/image/NoImage.jpg" alt="No Image">
            <?php endif; ?>
            <div class="post_listTitle">
              <?php echo the_title(); ?>
            </div>
          </a>
        </div>

      <!-- 記事の内容 end-->

      <!-- ３記事ごとに広告を挿入する -->
      <?php
      $count++;
      if(get_option(POST_LIST_AD)):
        if (($count % 3) == 0) : ?>
          <div class="post_list_block">
            <?php echo get_option(POST_LIST_AD); ?>
            <div class="post_listTitle">
              スポンサーリンク広告
            </div>
          </div>
        <?php endif;
      endif; ?>

    <?php endwhile;
  endif; ?>

  <?php
    //ページネーション
    the_posts_pagination( array(
    'mid_size' => 2,
    'prev_text' => __( '<<', 'textdomain' ),
    'next_text' => __( '>>', 'textdomain' ),
    'screen_reader_text' => ' '
    ) );
  ?>
</div>
<!-- 記事一覧表示 end -->
