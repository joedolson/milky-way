<?php get_header(); ?>

		<div class="post-content">
			<section>
			<h1><?php _e( 'Error: Page not found!', 'milky-way' ); ?></h1>
			<p>
			<?php _e( 'Sorry, the page you requested could not be located.', 'milky-way' ); ?>
			</p>
			<p>
			<?php _e( 'Thanks for your patience!', 'milky-way' ); ?>
			</p>
			<p>
			<?php bloginfo( 'name' ); ?>
			</p>			
			<h2><?php _e( 'Browse the site map', 'milky-way' ); ?></h2>
			<?php wp_nav_menu( array( 'theme_location'=>'site-map' ) ); ?>
			</section>
		</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>