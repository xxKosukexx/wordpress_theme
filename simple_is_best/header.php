<?php
//定数定義ファイル読み込み
include_once('include.php');
 ?>
 <!DOCTYPE html>
 <html lang='ja'>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
  <?php if ( !is_front_page() ) {
      wp_title( '::', true, 'right' );
  }
bloginfo( 'name' ); ?>
</title>
<meta name="description" content="<?php bloginfo( 'description' ); ?>">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" media="screen" />
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/page-top.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/menu-icon.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/width_height_equal.js"></script>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<!-- Elastic Slideshow start -->
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/ElasticSlideshow/css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />
<noscript>
<link rel="stylesheet" type="text/css" href="css/noscript.css" />
</noscript>
<!-- Elastic Slideshow end -->

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular()) {
  wp_enqueue_script( 'comment-reply' );
} ?>
<?php wp_head(); ?>
</head>
<script type="text/javascript">
  //page_top_fixed_width(); 使わなくなったけど一応残しておく。
  /*画面縮小時のメニューアイコン用*/
  menu_icon();
  /*画面縮小時に記事一覧のブロックの大きさを調整する*/
  width_height_equal();
</script>
<body style="background-image: url(<?php echo get_the_background_image_url(); ?>);" >

  <header>
    <!-- <div class="page_top_fixed"> -->

      <div id="header_top">
        <div id="header_title">
          <a href="<?php echo home_url(); ?>"><h1><?php bloginfo('name'); ?></h1></a>
        </div>
      </div>
        <!-- <div id="header_sns">
          <div class="sns_block">
            <p><a href=<?php //echo get_option(FACEBOOK_URL); ?> >f</a></p>
          </div>

          <div class="sns_block">
            <p><a href=<?php //echo get_option(TWITTER_URL); ?> >t</a></p>
          </div>

          <div class="sns_block">
            <p><a href=<?php //echo get_option(GOOGLE_URL); ?> >g+</a></p>
          </div>
        </div>

        <div class="float-clear"></div> -->

    <!-- </div> -->


    <?php if(is_home()): ?>
      <div id="header_image">
        <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
        <p><?php echo bloginfo('description'); ?></p>
      </div>

    <?php endif; ?>



    <?php
    //pc表示でのメニューリスト
    $nav_info = array(
      'container_id' => 'menu_list'
    );
    wp_nav_menu($nav_info); ?>
    <!-- ナビゲーションメニュー -->
    <!-- 画面縮小時のメニューリスト
     メニューが改行されそうならメニューアイコンに切り替える -->
     <div id="menu_icon">
      <div id="menu_icon_image">
        <img src="<?php echo get_template_directory_uri(); ?>/image/menu-icon.png" alt="メニューアイコンです。" />
      </div>
      <?php
        $nav_info = array(
          'container_id' => 'menu_list_sumaho'
        );
        wp_nav_menu($nav_info);
      ?>
      <div id="show_icon_menu">

      </div>
    </div>

  </header>
