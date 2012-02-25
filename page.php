<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while (have_posts()) : the_post(); ?>
		
			<div class="container post">
				<div class="row">
					<div class="fourcol metadata">
						<div class="date">
							<div class="day"><h2><?php the_time("d"); ?></h2></div>
							<div class="monthyear"><p><?php the_time("m/Y");?></p></div>
						</div>
						<div class="meta">
							<div class="time"><p>on <?php the_time("G:i");?></p></div>
							<div class="permalink"><p><a href="<?php the_permalink();?>">permalink</a></p></div>
						</div>
					</div>
					<div class="sixcol postcontent last">
						<h2><?php the_title();?></h2>
						<div class="content">
							<?php the_content();?>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>