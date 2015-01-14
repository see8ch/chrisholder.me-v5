<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package see8ch
 */

get_header(); ?>

		<?php if( $paged > 1 ) : ?>
			<h3 class="section-header">Blog Posts <span class="page-number">Page <?php echo $paged; ?></span></h3>
		<?php else : ?>
			<h3 class="section-header">Blog Posts</h3>
		<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article class="post-preview blog-post">
					<header class="entry-header">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</header><!-- .entry-header -->
					<div class="entry-content">

						<?php if(!empty( get_field('feature_image')) ) : ?>
							<a href="<?php the_permalink(); ?>"><div class="feature-image" style="background:url(<?php the_field('feature_image'); ?>); "></div></a>
						<?php endif; ?>

						<?php if( !empty(get_field('project_blurb')) ) : ?>
							<p class="feature"><?php the_field('project_blurb'); ?></p>
						<?php endif; ?>

						<p>
						<?php
							$content = get_the_content();
							$trimmed_content = wp_trim_words( $content, 60, '...' );
							echo $trimmed_content;
						?>
						</p>
					</div><!-- .entry-content -->
					<footer class="entry-footer"><a class="button read-more" href="<?php the_permalink(); ?>">Read More<span class="genericon genericon-next"></span></a></footer>
				</article><!-- #post-## -->

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php see8ch_paging_nav(); ?>

<?php get_footer(); ?>
