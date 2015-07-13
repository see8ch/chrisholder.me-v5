<?php
/**
 * @package see8ch
 */

get_header(); ?>


			<h3 class="section-header">Blog Posts
				<?php
					if ( is_category() && !is_category('blog') ) :
						echo '// ';
						single_cat_title();
					elseif ( is_tag() ) :
						echo '// ';
						single_tag_title();
					elseif ( is_author() ) :
						echo '// ';
						printf( __( '%s', 'see8ch' ), '<span class="vcard">' . get_the_author() . '</span>' );
					elseif ( is_day() ) :
						echo '// ';
						printf( __( '%s', 'see8ch' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						echo '// ';
						printf( __( '%s', 'see8ch' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'see8ch' ) ) . '</span>' );
					elseif ( is_year() ) :
						echo '// ';
						printf( __( '%s', 'see8ch' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'see8ch' ) ) . '</span>' );
					else :
					endif;
				?>
				<?php if( $paged > 1 ) : ?>
					<span class="page-number">Page <?php echo $paged; ?></span>
				<?php endif;?>
			</h3>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php /* Start the Loop */ ?>
			<?php if ( have_posts() ) : the_post(); ?>
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
			<?php else : ?>
				<div class="no-post-wrapper">
					<h3 class="no-posts">No posts
						<?php
							if ( is_category() ) :
								echo 'in this category';
							elseif ( is_tag() ) :
								echo 'in this tag';
							elseif ( is_author() ) :
								echo 'for this author';
							elseif ( is_day() ) :
								echo 'on this day';
							elseif ( is_month() ) :
								echo 'in this month';
							elseif ( is_year() ) :
								echo 'in this year';
							else :
							endif;
						?>
					</h3>
					<a href="/category/blog">Try looking here...</a>
				</div>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php see8ch_paging_nav(); ?>

<?php get_footer(); ?>
