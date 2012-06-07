<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

<div class="wrapcontent">

	<?php if (have_posts()) :?>
	
		<?php while (have_posts()) : the_post(); ?>
		
			<section class="container post">
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
					<article class="sixcol postcontent last">
						<h2><?php the_title();?></h2>
						<div class="content">
							<?php the_content();?>
						</div>
					</article>
				</div>
			</section>
		<?php endwhile; ?>
		
		<nav class="container pagination">
			<div class="row">
				<div class="fourcol older"><?php next_posts_link("older");?></div>
				<div class="threecol newer"><?php previous_posts_link("newer");?></div>
			</div>
		</nav>
	<?php else: ?>
		<h2>No posts</h2>
		<p>Please come back again later!</p>
	<?php endif; ?>

</div>

<?php get_footer(); ?>