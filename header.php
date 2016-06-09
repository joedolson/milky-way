<!DOCTYPE html>
<?php
/*
 *	Define the language and text direction in your HTML element.
 *	The WP function language_attributes() handles this, and makes sure that text is pronounced correctly in screen reading software.
 */
?>
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js ie8"><![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php 
		/*
		 *	The important thing in the viewport is what's not here: zoom control. Limiting or disallowing zoom on mobile prevents
		 * 	visitors from being able to enlarge your content (text or images) for a better reading or viewing experience.
		 */
	?>
	<meta name="viewport" content="width=device-width" />		
	<?php wp_head(); ?>
</head>
<?php
	$class = ( !is_front_page() ) ? 'not-home' : '';
?>
<body <?php body_class( $class ); ?>>
	<?php get_template_part( 'partials/skiplinks' ); ?>
	<div id="wrapper" class='wrapper'>
		<?php 
		/*
		 *	Filters that allow adding content outside of a defined landmark role include the _role suffix.
		 *	When adding readable content to one of these filters, you must provide a role for that content. 
		 * 	Most of the time, role=complementary will be most appropriate, but each case should be treated differently.
		 */
		?>
		<?php echo apply_filters( 'milky_way_before_header_role', '' ); ?>
		<?php $class = ( get_header_image() ) ? ' has-image' : ' no-image'; ?>
		<div id="header" class='header<?php echo $class; ?>'>
			<header role="banner">
				<?php echo apply_filters( 'milky_way_top_of_header', '' ); ?>
				<?php 
					$logo_img = '';
					$has_logo = '';
					$logo = has_custom_logo(); 
					if ( $logo ) {
						// if alt is bank, use theme alt.
						$logo_img = "<div class='logo'>" . get_custom_logo() . "</div>";
						$has_logo = 'has-logo';
						$class .= ' ' . $has_logo;
					}
				?>
				<div class="text-header<?php echo $class; ?>">
					<div class='contents'>
						<div class="outer">
							<div class='inner-contents'>
							<?php echo $logo_img; ?>
							<?php 
							/**
							 * If somebody sets their blog name to an empty string, their intent is probably to hide the site title on the home page.
							 * This results in an empty link with no text, so this pattern inserts text and hides the link.
							 */
							if ( get_bloginfo( 'name' ) == '' ) {
								$class = 'site-title screen-reader-text';
								$name = __( 'Home', 'milky-way' );
							} else {
								$class = 'site-title';
								$name = get_bloginfo( 'name' );
							}
							?>
							<div class='heading-contents'>
								<div class='<?php echo $class; ?>'><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $name; ?></a></div>
								<?php if ( get_bloginfo( 'description' ) != '' ) { ?>
									<div class='site-description'><?php bloginfo('description'); ?></div>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo apply_filters( 'milky_way_end_of_header', '' ); ?>	
			</header>
		</div>
		<?php echo apply_filters( 'milky_way_before_primary_menu_role', '' ); ?>		
		<div class='primary-menu'>
			<?php
				/*
				 * Aria Label: Provides a label to differentiate multiple navigation landmarks
				 * hidden heading: provides navigational structure to site for scanning with screen reader
				 */
			?>
			<nav role="navigation" aria-label='<?php _e( 'Primary Menu ', 'milky-way' ); ?>'>
				<button class='menu-toggle' aria-controls='menu-primary-id' aria-expanded='false'><span><?php _e( 'Toggle Menu','milky-way' ); ?></span></button>			
				<?php wp_nav_menu( array( 'theme_location'=>'primary', 'menu_id'=>'menu-primary-id' ) ); ?>
			</nav>
		</div>
		<?php echo apply_filters( 'milky_way_after_primary_menu_role', '' ); ?>
		<div id="page" class="page-wrapper milky-way-clear">
			<?php echo apply_filters( 'milky_way_before_main_role', '' ); ?>
			<div id="content" class="content milky-way-clear" tabindex="-1">
				<main role="main">
					<div class='post-wrapper'>
					<?php echo apply_filters( 'milky_way_before_posts', '' ); ?>