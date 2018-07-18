  <footer>
    <?php if ( is_active_sidebar( 'footer' ) ) : ?>
     <div id="footer_widget" style="list-style-image: url(<?php echo get_template_directory_uri(); ?>/image/list-mark.gif);">
    	<?php dynamic_sidebar( 'footer' ); ?>
    </div>
    <?php endif; ?>
    <div class="site-info">
       <p>© <?php bloginfo('name'); ?> All rights reserved.</p>
   </div>

  </footer>
  <?php wp_footer(); ?>
</body>
