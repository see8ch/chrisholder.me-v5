<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package see8ch
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main row" role="main">

		<?php if( $paged < 2 ) : ?>
			<h3 class="section-header">Featured Project</h3>

			<?php
				// Project Loop
       $args = array(
       	'post_type' => 'projects',
       	'category_name' => 'featured',
       	'posts_per_page' => 1
       );
       $loop = new WP_Query( $args );
       while ( $loop->have_posts() ) : $loop->the_post();
     ?>

				<article class="post-preview project-post column-full">
					<div class="entry-content">

						<?php if(!empty( get_field('feature_image')) ) : ?>
							<a href="<?php the_permalink(); ?>"><div class="feature-image" style="background:url(<?php the_field('feature_image'); ?>); "></div></a>
							<!-- <img class="feature-image" src="<?php the_field('feature_image'); ?>"> -->
						<?php endif; ?>


						<div class="feature-content">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
						<footer class="entry-footer"><a class="button read-more" href="<?php the_permalink(); ?>">Read More<span class="genericon genericon-next"></span></a></footer>
					</div>
					</div>
				</article><!-- #post-## -->

			<?php
				endwhile;
				wp_reset_postdata();
			?>
		<?php endif; ?>

		<?php if( $paged > 1 ) : ?>
			<h3 class="section-header">Recent Work <span class="page-number">Page <?php echo $paged; ?></span></h3>
		<?php else : ?>
			<h3 class="section-header">Recent Work</h3>
		<?php endif; ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article class="post-preview project-post column-half">
					<header class="entry-header">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="post-icons">
						<?php if( in_category('development') ) : ?>
							<span class="genericon genericon-code"></span>
							<!-- <span class="tag">development</span> -->
						<?php endif; ?>
						<?php if( in_category('design') ) : ?>
							<span class="genericon genericon-paintbrush"></span>
							<!-- <span class="tag">design</span> -->
						<?php endif; ?>
						<?php if( in_category('concept') ) : ?>
							<span class="genericon genericon-summary"></span>
							<!-- <span class="tag">featured</span> -->
						<?php endif; ?>
						<?php if( in_category('blog') ) : ?>
							<span class="genericon genericon-edit"></span>
							<!-- <span class="tag">blog</span> -->
						<?php endif; ?>
						<?php if( in_category('featured') ) : ?>
							<span class="genericon genericon-star"></span>
							<!-- <span class="tag">featured</span> -->
						<?php endif; ?>
					</div>
					</header><!-- .entry-header -->
					<div class="entry-content">

						<?php if(!empty( get_field('feature_image')) ) : ?>
							<a href="<?php the_permalink(); ?>"><div class="feature-image" style="background:url(<?php the_field('feature_image'); ?>); "></div></a>
							<!-- <img class="feature-image" src="<?php the_field('feature_image'); ?>"> -->
						<?php endif; ?>

						<?php if( !empty(get_field('project_blurb')) ) : ?>
							<p class="feature"><?php the_field('project_blurb'); ?></p>
						<?php endif; ?>

						<p>
						<?php
							$content = get_the_content();
							$trimmed_content = wp_trim_words( $content, 35, '...' );
							echo $trimmed_content;
						?>
						</p>
					</div><!-- .entry-content -->
					<!-- <footer class="entry-footer"><a class="button read-more" href="<?php the_permalink(); ?>">Read More<span class="genericon genericon-next"></span></a></footer> -->
				</article><!-- #post-## -->

			<?php endwhile; ?>

		</main><!-- #main -->

		<?php see8ch_project_nav(); ?>
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
