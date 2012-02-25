<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div class="wrapcontent">

	<?php if (have_posts()) :?>
	
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
		
		<div class="container pagination">
			<div class="row">
				<div class="fourcol older"><?php next_posts_link("older");?></div>
				<div class="threecol newer"><?php previous_posts_link("newer");?></div>
			</div>
		</div>
	<?php else: ?>
		<h2>No posts</h2>
		<p>Please come back again later!</p>
	<?php endif; ?>

</div>

<?php get_footer(); ?>