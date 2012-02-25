<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php bloginfo("template_url")?>/css/1140.css" />
<link rel="stylesheet" href="<?php bloginfo("template_url")?>/css/ie.css" />
<link rel="stylesheet" href="<?php bloginfo("template_url")?>/css/baseline.compress.css" />
<link rel="stylesheet" href="<?php bloginfo("template_url")?>/css/style.css" />
<link rel="icon" type="image/png" href="<?php bloginfo("template_url")?>/images/favicon.png" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script type="text/javascript" src="<?php bloginfo("template_url")?>/js/css3-mediaqueries.js"></script>
<script type="text/javascript" src="<?php bloginfo("template_url")?>/js/jquery.min.js"></script>
<script type="text/javascript" >

$(document).ready(function() {
	//redirect to base directory
	$(".headline h1").click(function() {
		window.location = "<?php bloginfo("siteurl");?>";
	});
});

</script>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

	<div class="gray wraphead">
			
			<!-- headline -->
			<div class="container headline">
				<div class="row">
					<div class="fourcol"></div>
					<div class="fourcol last"><h1><?php bloginfo("name"); ?></h1></div>
				</div>
			</div>
			
			<!-- menu -->
			<div class="container">
				<div class="row">
					<div class="fourcol menu" id="leftmenu">
						
						<?php
							
							//wenn keine seite, blog highlighten
							if (!is_page()) {
								$pages = get_pages(array("parent"=>0));
								echo "<p><a class='highlight' href='". get_bloginfo("siteurl") ."'>blog</a></p>";
								foreach($pages as $page) {
									echo "<p><a href='".get_page_link($page->ID)."'>".$page->post_title."</a><p>";
								}
							}
							else {
								//alle pages durchgehen
								$pages = get_pages();
								echo "<p><a href='". get_bloginfo("siteurl") ."'>blog</a></p>"; 
								foreach($pages as $page) {
									$ancestors = get_ancestors($page->ID, "page");	//eltern von seite
									$parents = get_ancestors($post->ID, "page");	//eltern von aktuellem post
									//nur kinder von root anzeigen
									if (count($ancestors)<1) { 
										//seite ist aktuelle seite -> highlight
										if ($page->post_title==$post->post_title) {
											echo "<p><a class='highlight' href='".get_page_link($page->ID)."'>".$page->post_title."</a><p>";
										}
										//seite ist parent von aktueller seite -> highlight
										else if ($parents[0]==$page->ID) {
											echo "<p><a class='highlight' href='".get_page_link($page->ID)."'>".$page->post_title."</a><p>";
										}
										//seite ist weder noch -> kein highlight
										else {
											echo "<p><a href='".get_page_link($page->ID)."'>".$page->post_title."</a><p>";
										}
									}
								}
							}
						?>
					</div>
					<div class="fourcol menu last" id="rightmenu">
						<?php
							if (is_page()) {
								//ist kein blog
								//seite fetchen
								$fullcurpage = get_page_by_title($post->post_title);
								//parent bestimmen
								$parent = $fullcurpage->ancestors[0];
								//parent ungleich root: siblings laden
								if ($parent!=null) {
									//kinder von parent holen
									$children = get_pages(array("child_of"=>$parent));
									//children anzeigen, highlight wenn selbe seite
									foreach ($children as $child) {
										if ($post->ID==$child->ID)
											echo "<p><a class='highlight' href='".get_page_link($fullcurpage->ID)."'>".$child->post_title."</a></p>";
										else
											echo "<p><a href='".get_page_link($child->ID)."'>".$child->post_title."</a></p>";
									}
								}
								//parent gleich root: kinder laden
								else {
									$children = get_pages(array("child_of"=>$fullcurpage->ID));
									//children anzeigen
									foreach ($children as $child) {
										echo "<p><a href='".get_page_link($child->ID)."'>".$child->post_title."</a></p>";
									}
								}
							}	
							else {
								//ist blog
								$cats = get_categories();
								$cur_cat = -1;
								if (is_category())
									$cur_cat = get_query_var("cat");
								foreach ($cats as $cat) {
									if ($cat->term_id == $cur_cat)
										echo "<p><a class='highlight' href='".get_category_link($cat->term_id). "'>".$cat->name."</a></p>";
									else
										echo "<p><a href='".get_category_link($cat->term_id). "'>".$cat->name."</a></p>";
								}
							}
						?>
					</div>
				</div>
			</div>
			
			<!-- potential headline -->
			<div class="container subheading">
				<div class="row">
					<div class="fourcol" id="specialbox">
						<!-- put special lists here -->
					</div>
					<div class="sixcol last"><h2>
						<?php
							if (is_category()) {
								single_cat_title("topic ", true);
							}
							elseif (is_month()) {
								the_time("F Y");
							}
						?>
					</h2></div>
				</div>
			</div>
		</div>