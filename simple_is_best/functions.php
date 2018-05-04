<?php

//定数定義ファイル読み込み
include_once('include.php');

//カスタマイズにオリジナルの項目を追加する
add_action( 'customize_register', 'origin_customize' );

function origin_customize($wp_customize){

  //記事内カスタマイズセクションの設定
  $wp_customize->add_section( ARTICLE_CUSTOMIZE_SECTION,
                              array(
                                'title' => '記事内カスタマイズ',
                                'priority' => 1,
                              ));

  //所要時間のセッティングの設定
  $wp_customize->add_setting(READ_TIME, array(
        'default' => 'checked',
        'type'  => 'option',
    ));
  $wp_customize->add_control( READ_TIME, array(
        'section' => ARTICLE_CUSTOMIZE_SECTION,
        'settings' => READ_TIME,
        'label' => '所要時間を表示する。',
        'type' => 'checkbox'
      ));

  //関連記事のセッティングの設定
  $wp_customize->add_setting(RELATED_POST, array(
        'default' => 'checked',
        'type'  => 'option',
    ));
  $wp_customize->add_control( RELATED_POST, array(
        'section' => ARTICLE_CUSTOMIZE_SECTION,
        'settings' => RELATED_POST,
        'label' => '記事下に関連記事を表示する。',
        'type' => 'checkbox'
      ));

  //ヘッダー画像のセクションの設定
  $wp_customize->add_section( HEADER_IMAGE_SECTION,
                              array(
                                'title' => 'ヘッダー画像',
                                'priority' => 2,
                              ));
  //ヘッダー画像セッティングの設定
  $wp_customize->add_setting( HEADER_IMAGE_URL );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, HEADER_IMAGE_URL, array(
   'label' => 'ヘッダー画像', //設定ラベル
   'section' => HEADER_IMAGE_SECTION, //セクションID
   'settings' => HEADER_IMAGE_URL, //セッティングID
   'description' => 'ヘッダー画像を設定してください。',
  ) ) );

  //背景画像セクションの設定
  $wp_customize->add_section( BACKGROUND_IMAGE_SECTION,
                              array(
                                'title' => '背景画像',
                                'priority' => 3,
                              ));
  //背景画像セッティングの設定
  $wp_customize->add_setting( BACKGROUND_IMAGE_URL );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, BACKGROUND_IMAGE_URL, array(
   'label' => '背景画像', //設定ラベル
   'section' => BACKGROUND_IMAGE_SECTION, //セクションID
   'settings' => BACKGROUND_IMAGE_URL, //セッティングID
   'description' => '背景画像を設定してください。',
  ) ) );


  /*snsアイコンにurlを設定するためのカスタマイズ*/

  //snsアイコンカスタマイズのセクション
   /*$wp_customize->add_section( SNS_SECTION,
                              array(
                                'title' => 'SNSリンク',
                                'priority' => 4,
                              ));

  //facebookセッティング
  $wp_customize->add_setting(FACEBOOK_URL, array(
        'type'  => 'option',
    ));
  $wp_customize->add_control( FACEBOOK_URL, array(
        'section' => SNS_SECTION,
        'settings' => FACEBOOK_URL,
        'label' => 'FacebookページのURLを入力してください。',
        'type' => 'text'
      ));

  //twitterセッティング
  $wp_customize->add_setting(TWITTER_URL, array(
        'type'  => 'option',
    ));
  $wp_customize->add_control( TWITTER_URL, array(
        'section' => SNS_SECTION,
        'settings' => TWITTER_URL,
        'label' => 'TwitterページのURLを入力してください。',
        'type' => 'text'
      ));

  //google+セッティング
  $wp_customize->add_setting(GOOGLE_URL, array(
        'type'  => 'option',
    ));
  $wp_customize->add_control( GOOGLE_URL, array(
        'section' => SNS_SECTION,
        'settings' => GOOGLE_URL,
        'label' => 'Google+ページのURLを入力してください。',
        'type' => 'text'
      )); */

  //広告情報セクション設定
  $wp_customize->add_section( AD_CUSTOMIZE_SECTION,
                              array(
                                'title' => '広告カスタマイズ',
                                'priority' => 5,
                              ));

  $wp_customize->add_setting(POST_LIST_AD, array(
        'type'  => 'option',
    ));
  $wp_customize->add_control( POST_LIST_AD, array(
        'section' => AD_CUSTOMIZE_SECTION,
        'settings' => POST_LIST_AD,
        'label' => '下記テキストエリアに広告コードを入力すると、記事一覧表示箇所にて、３記事ごとに広告を表示します。',
        'type' => 'textarea'
      ));
}


//ヘッダー画像のurlを取得するための関数
function get_the_header_image_url(){
  return esc_url( get_theme_mod( HEADER_IMAGE_URL ) );
}

//背景画像を設定できるようにするための関数
function get_the_background_image_url(){
  return esc_url( get_theme_mod( BACKGROUND_IMAGE_URL ) );
}

/*サイドバーとフッターのウィジェット機能を有効にする*/
function bj_register_sidebars(){
//ウィジェット機能を有効にする
  if ( function_exists('register_sidebar') ){
    register_sidebar( array(
      'id'            => 'sidebar', //ウィジェットのID
      'name'          => 'サイドバー', //ウィジェットの名前
      'description'   => 'ウィジェットをドラッグして編集してください。', //ウィジェットの説明文
      'before_widget' => '<div class=sidebar-block>', //ウィジェットを囲う開始タグ
      'after_widget'  => '</div>', //ウィジェットを囲う終了タグ
      'before_title'  => '<h4>', //タイトルを囲う開始タグ
      'after_title'   => '</h4>', //タイトルを囲う終了タグ
    ) );


  }

  if ( function_exists('register_sidebar') ){
    register_sidebar( array(
      'id'            => 'footer', //ウィジェットのID
      'name'          => 'フッター', //ウィジェットの名前
      'description'   => 'ウィジェットをドラッグして編集してください。', //ウィジェットの説明文
      'before_widget' => '<div>', //ウィジェットを囲う開始タグ
      'after_widget'  => '</div>', //ウィジェットを囲う終了タグ
      'before_title'  => '<h4>', //タイトルを囲う開始タグ
      'after_title'   => '</h4>', //タイトルを囲う終了タグ
    ) );
  }
}
/*ウィジェット機能を有効にするためのアクションフック*/
add_action( 'widgets_init', 'bj_register_sidebars' );

//カスタムメニューを設定できるようにする
add_theme_support('menus');

//アイキャッチ画像を設定できるようにする
add_theme_support('post-thumbnails');

//人気記事出力用
function get_post_views($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 View";
	}
	return $count.' Views';
}

function set_post_views($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
	}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
	}
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//クローラーのアクセス判別
function is_bot() {
  global $SERVER;
  $ua = $SERVER['HTTP_USER_AGENT'];
  $bot = array(
  "googlebot",
  "msnbot",
  "yahoo"
  );
  foreach( $bot as $bot ) {
    if (stripos( $ua, $bot ) !== false){
      return true;
    }
  }
  return false;
}

//投稿一覧画面にサムネイルとview数を表示する。
function manage_posts_columns($columns) {
  $columns['post_views_count'] = 'view数';
  $columns['thumbnail'] = 'サムネイル';
  return $columns;
}

function add_column($column_name, $post_id) {
  /*View数呼び出し*/
  if ( $column_name == 'post_views_count' ) {
    $stitle = get_post_meta($post_id, 'post_views_count', true);
  }
  /*サムネイル呼び出し*/
  if ( $column_name == 'thumbnail') {
    $thumb = get_the_post_thumbnail($post_id, array(100,100), 'thumbnail');
  }
  /*ない場合は「なし」を表示する*/
  if ( isset($stitle) && $stitle ) {
    echo esc_attr($stitle);
  }
  else if ( isset($thumb) && $thumb ) {
    echo $thumb;
  }
  else {
    echo __('None');
  }
}
add_filter( 'manage_posts_columns', 'manage_posts_columns' );
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 );

//所要時間を表示する関数
function read_time(){
  global $post;
  $mycontent = $post->post_content;
              $word = mb_strlen(strip_tags($mycontent));
              $m = floor($word / 600)+1;
              $s = floor($word % 600 / (600 / 60));
              $time = ($m == 0 ? '' : $m) ;
              $times = ($s == 0 ? '' : $s) ;

				$str  = "<p class='article-read-time'>
            		<b><font color=#808080>この記事は約</font></b><b><font color=#cc0000> $time </font></b><b><font color=#808080>分</font></b><b><font color=#cc0000> $times </font></b><b><font color=#808080>秒で読めます。</font></b>
				</p>";
        echo $str;
}

//パンくずリストを表示する関数
function breadcrumbs(){
  global $post;
	$str ='';
	if ( !is_home() && !is_admin() ) { // !is_admin は管理ページ以外という条件分岐です
		$str .= '<div id="breadcrumb" class="clearfix">';
		$str .= '<ul>';
		$str .= '<li><a href="' . home_url('/') . '">HOME</a></li>';
		$str .= '<li>&gt;</li>';

		if ( is_search() ) { // 検索結果ページ
			$str .= '<li>「' . get_search_query() . '」で検索した結果</li>';
		} elseif ( is_tag() ) {
			$str .= '<li>タグ : ' . single_tag_title( '' , false ) . '</li>';
		} elseif ( is_404() ) { // 404ページ
			$str .= '<li>404 Not found</li>';
		} elseif ( is_date() ) { // 日付アーカーブ
			if ( is_day() ) { // 日別アーカイブ
				$str .= '<li><a href="' . get_year_link( get_query_var( 'year' ) ) . '">' . get_query_var( 'year' ) . '年</a></li>';
				$str .= '<li>&gt;</li>';
				$str .= '<li><a href="' . get_month_link( get_query_var( 'year' ), get_query_var( 'monthnum' ) ) . '">' . get_query_var( 'monthnum' ) . '月</a></li>';
				$str .= '<li>&gt;</li>';
				$str .= '<li>' . get_query_var( 'day' ) . '日</li>';
			} elseif ( is_month() ) { // 月別アーカイブ
				$str .= '<li><a href="' . get_year_link( get_query_var( 'year' ) ) . '">' . get_query_var( 'year' ) . '年</a></li>';
				$str .= '<li>&gt;</li>';
				$str .= '<li>' . get_query_var( 'monthnum' ) . '月</li>';
			} elseif ( is_year() ) { // 年別アーカイブ
				$str .= '<li>' . get_query_var( 'year' ) . '年</li>';
			}
		} elseif ( is_category() ) { // カテゴリーアーカイブ
			$cat = get_queried_object();
			if ( $cat->parent != 0 ) {
				$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
				foreach( $ancestors as $ancestor ) {
					$str .= '<li><a href="' . get_category_link($ancestor) . '">' . get_cat_name( $ancestor ) . '</a></li>';
					$str .= '<li>&gt;</li>';
				}
			}
			$str .= '<li>' . $cat->name . '</li>';
		} elseif ( is_author() ) { // 投稿者アーカイブ
			$str .= '<li>投稿者 : ' . get_the_author_meta( 'display_name', get_query_var('author') ). '</li>';
		} elseif ( is_page() ) { // 固定ページ
			if ( $post->post_parent != 0 ) {
				$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
				foreach( $ancestors as $ancestor ) {
					$str .= '<li><a href="' . get_permalink( $ancestor ). '">' . get_the_title( $ancestor ) . '</a></li>';
					$str .= '<li>&gt;</li>';
				}
			}
			$str .= '<li>' . $post->post_title . '</li>';

		} elseif ( is_attachment() ) { // 添付ファイルページ
			if ( $post->post_parent != 0 ) {
				$str .= '<li><a href="' . get_permalink( $post->post_parent ). '">' . get_the_title( $post->post_parent ) . '</a></li>';
				$str .= '<li>&gt;</li>';
			}
			$str .= '<li>' . $post->post_title . '</li>';
		} elseif ( is_single() ) { // ブログ記事ページ
			$categories = get_the_category( $post->ID );
			$cat = $categories[0];
			if ( $cat->parent != 0 ) {
				$ancestors = array_reverse( get_ancestors( $cat->cat_ID, 'category' ) );
				foreach( $ancestors as $ancestor ) {
					$str .= '<li><a href="' . get_category_link( $ancestor ) . '">' . get_cat_name( $ancestor ) . '</a></li>';
					$str .= '<li>&gt;</li>';
				}
			}
			$str .= '<li><a href="' . get_category_link( $cat->term_id ) . '">' . $cat->cat_name . '</a></li>';
			$str .= '<li>&gt;</li>';
			$str .= '<li>' . $post->post_title . '</li>';
		} else { // その他のページ
			$str .= '<li>' . wp_title( '', true ) . '</li>';
		}
		$str .= '</ul>';
		$str .= '</div>';
	}
	echo $str;
}
?>
