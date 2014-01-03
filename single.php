<?php
/**
 * The Template for displaying all single posts.
 *
 * @package metric_av_main
 * @since metric_av_main 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php book_lite_content_nav( 'nav-above' ); ?>

				<?php
					  if ( false == get_post_format() )
						  get_template_part( 'content', 'single' );
					  else
						  get_template_part( 'content', 'formats' );
				?>

				<?php book_lite_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
