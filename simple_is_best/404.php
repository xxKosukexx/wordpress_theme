<?php get_header(); ?>

<article id="not404" class="main-area">
  <div id="title404">
    404
  </div>
  <div id="messeage404">
    <p>
        申し訳ありませんがお探しのページは存在しません。
        指定したURLが間違っているか、既に存在しないためと思われます。
    </p>
  </div>
  <?php
    //最新記事表示ファイル読み込み
    $args = array(
    'posts_per_page' => 9 // 表示件数の指定
    );
    $posts = get_posts( $args );
    foreach ( $posts as $post ): // ループの開始
    setup_postdata( $post ); // 記事データの取得
  ?>
    <!-- 記事の内容 start-->
    <a href="<?php the_permalink(); ?>">
      <div class="post_list_block">
        <?php if(has_post_thumbnail()) : ?>
          <?php the_post_thumbnail(); ?>
        <?php else : ?>
          <img src="<?php echo get_template_directory_uri(); ?>/image/NoImage.jpg" alt="No Image">
        <?php endif; ?>
        <div class="post_listTitle">
          <?php echo the_title(); ?>
        </div>
      </div>
    </a>
    <!-- 記事の内容 end-->
  <?php
    endforeach; // ループの終了
    wp_reset_postdata(); // 直前のクエリを復元する
  ?>
</article>

<?php get_footer(); ?>
