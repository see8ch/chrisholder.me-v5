<?php
/**
 * The template for displaying all single posts.
 *
 * @package see8ch
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>


				<article class="post-preview blog-post">
					<header class="entry-header">
						<h3><?php the_title(); ?></h3>
						<p class="entry-meta">
							<?php see8ch_posted_on(); ?>
						</p>
					</header><!-- .entry-header -->
					<div class="entry-content">

						<?php if(!empty( get_field('feature_image')) ) : ?>
							<a href="<?php the_permalink(); ?>"><div class="feature-image" style="background:url(<?php the_field('feature_image'); ?>); "></div></a>
						<?php endif; ?>

						<?php if( !empty(get_field('project_blurb')) ) : ?>
							<p class="feature"><?php the_field('project_blurb'); ?></p>
						<?php endif; ?>


						<?php the_content(); ?>

					</div><!-- .entry-content -->
					<footer class="entry-footer">
						<p><?php see8ch_entry_footer(); ?></p>
					</footer>
				</article><!-- #post-## -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php see8ch_post_nav(); ?>

<?php get_footer(); ?>
