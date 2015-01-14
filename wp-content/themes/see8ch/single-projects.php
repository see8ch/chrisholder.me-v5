<?php
/**
 * The template for displaying all single posts.
 *
 * @package see8ch
 */

get_header(); ?>

	<div id="primary" class="content-area">
	<?php if(!empty(get_field('project_hero'))) : ?>
		<div class="feature-image" style="background:url(<?php the_field('project_hero'); ?>); "></div>
	<?php else : ?>
		<div class="feature-image" style="background:url(<?php the_field('feature_image'); ?>); "></div>
	<?php endif; ?>

		<main id="main" class="site-main row" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" class="project-single">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<p class="feature"><?php the_field('project_blurb'); ?></p>

					<!-- <p class="entry-meta"><?php see8ch_posted_on(); ?></p> -->
				</header>

				<div class="project-details">
					<ul>
						<h4>Project Details</h4>
						<?php if(!empty(get_field('project_agency'))) : ?>
							<li class="agency"><span>Agency:</span><a href="<?php the_field('agency_website'); ?>" target="_blank"><?php the_field('project_agency'); ?></a></li>
						<?php endif; ?>

						<!-- Tools -->
						<?php if( have_rows('project_tools') ): ?>
						<?php while ( have_rows('project_tools') ) : the_row(); ?>

			        <li><span class="genericon genericon-<?php the_sub_field('tool_icon'); ?>"></span><?php the_sub_field('tool_name'); ?></li>

							<?php endwhile; ?>
							<?php endif; ?>

						<?php if(!empty(get_field('live_url'))) : ?>
							<li class="website"><a class="button" href="<?php the_field('live_url'); ?>" target="_blank">Live Website<span class="genericon genericon-next"></span></a></li>
						<?php endif; ?>
					</ul>
				</div>

				<div class="entry-content">

					<!-- Website Preview -->
					<?php if(!empty(get_field('website_preview'))) : ?>
						<div class="website-preview"><iframe src="<?php the_field('website_preview'); ?>"></iframe></div>
					<?php endif; ?>

					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'see8ch' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php see8ch_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->

		<?php see8ch_post_nav(); ?>

	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
