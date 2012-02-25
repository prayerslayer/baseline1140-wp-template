<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	<div class="container post" id="id-<?php the_ID();?>">
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
					
					<?php if (!is_search())
							echo the_content();
						  else
						    echo the_excerpt();?>
				</div>
			</div>
		</div>
	</div>
