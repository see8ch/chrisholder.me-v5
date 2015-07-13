<?php
/**
 * Template Name: Home Page
 *
 * @package see8ch
 */

get_header(); ?>
	<?php if(!empty(get_field('feature_background'))) : ?>
		<div class="feature-blurb" style="background:url(<?php the_field('feature_background'); ?>);">
	<?php else : ?>
		<div class="feature-blurb">
	<?php endif; ?>
		<div class="row">
			<p><?php the_field('feature_content'); ?></p>
		</div>
	</div>

	<div class="process-blurb">
		<div class="row">
			<h3 class="section-header"><?php the_field('process_headline'); ?></h3>

			<div class="tools-column">
			<?php get_template_part('assets/img/icons/icon', 'laptop.svg'); ?>
			</div>

			<div class="content-column">
				<p class="feature"><?php the_field('process_feature'); ?></p>
				<p><?php the_field('process_content'); ?></p>
			</div>
		</div>
	</div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main row" role="main">

		<?php while ( have_posts() ) : the_post(); // Main Loop ?>


		<div class="recent-project-column">
			<h3 class="section-header">Featured Projects<a class="view-all-link" href="/projects">View All<span class="genericon genericon-next"></span></a></h3>

			<?php
				// Project Loop
       $args = array(
       	'post_type' => 'projects',
       	'category_name' => 'featured',
       	'posts_per_page' => 2
       );
       $loop = new WP_Query( $args );
       while ( $loop->have_posts() ) : $loop->the_post();
     ?>

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
							$trimmed_content = wp_trim_words( $content, 40, '...' );
							echo $trimmed_content;
						?>
						</p>
					</div><!-- .entry-content -->
					<!-- <footer class="entry-footer"><a class="button read-more" href="<?php the_permalink(); ?>">Read More<span class="genericon genericon-next"></span></a></footer> -->
				</article><!-- #post-## -->


			<?php
				// End Project Loop
				endwhile;
				wp_reset_postdata();
			?>
		</div>


		<div class="recent-posts-column">
			<h3 class="section-header">Recent Posts<a class="view-all-link" href="/category/blog">View All<span class="genericon genericon-next"></span></a></h3>
			<?php
				// Project Loop
       $args = array(
       	'category_name' => 'blog',
       	'posts_per_page' => 3
       );
       $loop = new WP_Query( $args );
       while ( $loop->have_posts() ) : $loop->the_post();
     ?>

				<article class="post-preview blog-post column-third">
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
							<div class="feature-image" style="background:url(<?php the_field('feature_image'); ?>); "></div>
						<?php endif; ?>

						<p>
						<?php
							$content = get_the_content();
							$trimmed_content = wp_trim_words( $content, 40, '...' );
							echo $trimmed_content;
						?>
						</p>
					</div><!-- .entry-content -->
					<footer class="entry-footer"><a class="button read-more" href="<?php the_permalink(); ?>">Read More<span class="genericon genericon-next"></span></a></footer><!-- .entry-footer -->
				</article><!-- #post-## -->

			<?php
				// End Project Loop
				endwhile;
				wp_reset_postdata();
			?>
		</div>



		<?php endwhile; // End Main Loop ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
