<?php
    /*人気記事を表示するためにELASTIC IMAGE SLIDESHOWというjQueryプラグインを使用している*/
 ?>

<div id="popularArticle_block">
  <div class="wrapper">
          <div id="ei-slider" class="ei-slider">
              <ul class="ei-slider-large">
                <?php //人気記事を取得する
                      query_posts('meta_key=post_views_count&orderby=meta_value_num&posts_per_page=7&order=DESC');
                      // ループ開始
                      while(have_posts()) : the_post(); ?>
                          <li>
                            <a href="<?php the_permalink(); ?>">
                              <?php if(has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                              <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/image/NoImage.png" alt="No Image">
                              <?php endif; ?>
                              <div class="ei-title">
                                  <h2><?php echo get_the_date() ?></h2>
                                  <h3><?php echo the_title(); ?></h3>
                              </div>
                            </a>
                          </li>
                    <?php endwhile; ?>
              </ul><!-- ei-slider-large -->

              <ul class="ei-slider-thumbs">
                  <li class="ei-slider-element">Current</li>
                  <?php $popular_count = 1;
                  // 人気記事取得
                  query_posts('meta_key=post_views_count&orderby=meta_value_num&posts_per_page=7&order=DESC');
                  // ループ開始
                  while(have_posts()) : the_post(); ?>
                    <li>
                      <?php  ?>
                      <a href="#"><?php echo "Slide $popular_count" ?></a>
                      <?php if(has_post_thumbnail()) : ?>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo the_title(); ?>">
                      <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/image/NoImage.png" alt="No Image">
                      <?php endif; ?>
                      <?php $popular_count++; ?>
                    </li>
                  <?php endwhile; ?>
              </ul><!-- ei-slider-thumbs -->
            </div><!-- ei-slider -->
      </div><!-- wrapper -->
      <?php wp_reset_query(); ?>
  </div>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>-->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/ElasticSlideshow/js/jquery.eislideshow.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/ElasticSlideshow/js/jquery.easing.1.3.js"></script>
<script type="text/javascript">
    $(function() {
        $('#ei-slider').eislideshow({
  easing		: 'easeOutExpo',
  titleeasing	: 'easeOutExpo',
  titlespeed	: 1200
        });
    });
</script>
