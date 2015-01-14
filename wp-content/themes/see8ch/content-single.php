<?php
/**
 * @package see8ch
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<p class="entry-meta">
			<?php see8ch_posted_on(); ?>
		</p><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'see8ch' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<p><?php see8ch_entry_footer(); ?></p>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
