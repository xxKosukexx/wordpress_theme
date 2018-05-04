  <footer>
    <?php if ( is_active_sidebar( 'footer' ) ) : ?>
     <ul id="footer_widget">
    	<?php dynamic_sidebar( 'footer' ); ?>
     </ul>
    <?php endif; ?>
    <div class="site-info">
       <p>© 2018 - <?php bloginfo('name'); ?> All rights reserved.</p>
   </div>

  </footer>
  <?php wp_footer(); ?>
</body>
