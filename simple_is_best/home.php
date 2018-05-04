<?php get_header(); ?>
<div class="main-area">
  <div id="title_welcome">
    <h1 class="charColorMove">WELCOME</h1>
  </div>
  <div id="title_popularPost">
    <h1>人気記事</h1>
  </div>
  <?php
    //人気記事表示ファイル読み込み
    get_template_part( 'templatepart/popularPost', 'home' );
  ?>
  <div id="title_newPost">
    <h1>最新記事</h1>
  </div>
  <?php
    //最新記事表示ファイル読み込み
    get_template_part( 'templatepart/post_list');
  ?>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/char-color-move.js"></script>
<script type="text/javascript">
  $(function() {
    $('.charColorMove').charColorMove();
  });
</script>
