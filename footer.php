<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package metric_av_main
 */
?>

  </div><!-- #main .site-main -->
</div><!-- #page .hfeed .site -->

  <div id="colophon-wrap">
    <footer id="colophon" class="site-footer" role="contentinfo">
      <div class="site-info">
        <nav role="navigation" class="site-navigation footer-navigation">
          <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav>
      </div><!-- .site-info -->
    </footer><!-- #colophon -->
  </div><!-- #colophon-wrap -->

<?php wp_footer(); ?>
</body>
</html>
