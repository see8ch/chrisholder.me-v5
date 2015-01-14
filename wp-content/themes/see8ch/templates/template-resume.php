<?php
/**
 * Template Name: Resume Page
 *
 * @package see8ch
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main row" role="main">

		<?php while ( have_posts() ) : the_post(); ?>


				<article class="">
					<header class="entry-header">
						<h2><?php bloginfo( 'name' ); ?> <span>// <?php bloginfo( 'description' ); ?></span></h2>
					</header><!-- .entry-header -->
					<div class="entry-content">
						<p class="feature resume-feature"><?php the_field('resume_intro'); ?></p>

						<h3 class="section-header">Experience</h3>
						<?php if( have_rows('positions_row') ): ?>
							<div class="resume-section">
						<?php while ( have_rows('positions_row') ) : the_row(); ?>

							<div class="resume-position">
			        <h4><?php the_sub_field('resume_company'); ?><span> // <?php the_sub_field('resume_position'); ?></span></h4>
			        <p class="details"><?php the_sub_field('resume_location'); ?> // <span><?php the_sub_field('resume_dates'); ?></span></p>
			        <p><?php the_sub_field('resume_description'); ?></p>
			      </div>

						<?php endwhile; ?>
							</div>
						<?php endif; ?>


						<h3 class="section-header">Education</h3>
						<?php if( have_rows('resume_education') ): ?>
							<div class="resume-section">
						<?php while ( have_rows('resume_education') ) : the_row(); ?>

							<div class="resume-school">
								<p class="feature"><?php the_sub_field('resume_degree'); ?></p>
			        <h4><?php the_sub_field('resume_school'); ?><span> - <?php the_sub_field('graduation_date'); ?></span></h4>
			      </div>

						<?php endwhile; ?>
							</div>
						<?php endif; ?>


						<h3 class="section-header">Skills</h3>
						<?php if( have_rows('resume_skill_row') ): ?>
							<div class="resume-section">
								<ul class="resume-skills">
								<?php while ( have_rows('resume_skill_row') ) : the_row(); ?>

			        	<li><?php the_sub_field('resume_skill'); ?></li>

								<?php endwhile; ?>
								</ul>
							</div>
						<?php endif; ?>


						<h3 class="section-header">Press</h3>
						<?php if( have_rows('resume_press_row') ): ?>
							<div class="resume-section resume-press">
						<?php while ( have_rows('resume_press_row') ) : the_row(); ?>

							<li>
			        <a href="<?php the_sub_field('press_link'); ?>"><?php the_sub_field('press_article_title'); ?></a>
			        <p><?php the_sub_field('resume_source'); ?> - <?php the_sub_field('article_year'); ?></p>
			      </li>

						<?php endwhile; ?>
							</div>
						<?php endif; ?>


						<div class="resume-section links-area">
							<a class="button" href="">Download PDF</a>
							<a class="button" href="/projects">My Work</a>
							<a class="button" href="/contact">Hire Me</a>
						</div>
					</div><!-- .entry-content -->

				</article><!-- #post-## -->

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_footer(); ?>
