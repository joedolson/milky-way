			</div>
		</main>
	</div> <?php // #content .content ?>
<div id="sidebar" role="complementary" class="sidebar milky-way-clear" aria-labelledby="sidebar-header">
	<h2 class="screen-reader-text" id="sidebar-header"><?php _e( 'Sidebar', 'milky-way' ); ?></h2>
	<?php echo apply_filters( 'milky_way_top_of_sidebar', '' ); ?>
	<?php if ( is_front_page() || is_page_template( 'page-full-width.php' ) ) {
		$count = milky_way_get_widget_count( 'ps2' );
		$class = " widgets-$count";
	} else {
		$class = " widgets";
	}	?>
	<div class='post-wrapper<?php echo $class; ?>'>
	<?php 
		/* Home sidebar displayed only on home page. Global sidebars on all other pages. */
		if ( is_front_page() ) {
			?><div class='home-sidebar'><?php 
			dynamic_sidebar('Home Sidebar'); 
			?></div><?php
		} else {
			dynamic_sidebar( 'Global Sidebar - Top' ); 
			if ( !is_page() ) { 
				dynamic_sidebar( 'Post Sidebar' );
			} else {
				dynamic_sidebar( 'Page Sidebar' );
			}
			dynamic_sidebar( 'Global Sidebar - Bottom' );	
			
		}
	?>
	</div>
	<?php echo apply_filters( 'milky_way_bottom_of_sidebar', '' ); ?>	
</div>