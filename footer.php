<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->
	<div class="container">
		<div class="row">
			<div class="fourcol"></div>
			<footer id="colophon" class="fourcol" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				if ( ! is_404() )
					get_sidebar( 'footer' );
			?>

	</footer><!-- #colophon -->
		</div>
	</div>
	
</div><!-- #page -->

<?php wp_footer(); ?>



</body>
</html>