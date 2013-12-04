<?php
/**
 * @package Book Lite
 * @since Book Lite 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title"><a href="' . get_permalink() . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'book-lite' ), the_title_attribute( 'echo=0' ) ) ) . '" rel="bookmark">', '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php book_lite_posted_on(); ?>
			<?php edit_post_link( __( 'Edit', 'book-lite' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'book-lite' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'book-lite' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'book-lite' ), __( '1 Comment', 'book-lite' ), __( '% Comments', 'book-lite' ) ); ?></span>
		<?php endif; ?>

	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
