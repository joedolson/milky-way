<?php get_header(); ?>

    <?php if ( have_posts() ) : ?>
	<?php if ( !is_page() ) { 
		/*
		 *	Add text to indicate page structure. Page structure helps non-sighted users navigate the page, 
		 *	but also informs screen readers about how your information relates.
		 */
		the_archive_title(); 
	?>
	<?php } ?>
    <?php while ( have_posts() ) : the_post(); ?>
	<?php $class = ( get_the_title() != '' ) ? '' : ' no-title'; ?>
	<div class='front-page-wrapper<?php echo $class; ?>'>
		<section>
		<?php if ( has_post_thumbnail() ) { ?>
			<div class='featured-image'><?php the_post_thumbnail(); ?></div>
		<?php } ?>
			<div <?php post_class( 'post-content' ); ?> id="post-<?php the_ID(); ?>">
		<?php
			$post_link = ''; 
			if ( get_the_title() == '' ) {
				$post_link = '<p class="milky-way-untitled"><a href="' .  get_the_permalink() . '" rel="bookmark">' . __( 'View untitled post', 'milky-way' ) . '</a></p>';
			} else {
		?>
		<?php 
			}
			if ( is_page() ) { ?>
				<?php if ( get_the_title() != '' ) { ?>
					<h1 class="post-title" id="title-<?php the_ID(); ?>"><?php the_title(); ?></h1>
				<?php }
				the_content( sprintf( __( 'Finish reading %s', 'milky-way' ), '&ldquo;<em>' . get_the_title() . '</em>&rdquo;' ) ); ?>
				<div class='home-widget-container'>
					<div class='home-widgets'>
						<?php 
						$customizer = add_query_arg( 'url', urlencode( home_url() ), admin_url( 'widgets.php' ) );
						if ( !is_active_sidebar( 'mw6' ) ) { 
							echo ( current_user_can( 'edit_theme_options' ) ) ? "<div class='widget home-left'><p class='get-started'><a href='" . esc_url( $customizer ) . "'>" . __( 'Add Widget Here', 'milky-way' ) . "</a></p></div>" : '';
						} else {
							dynamic_sidebar( 'mw6' );
						}
						if ( !is_active_sidebar('mw7') ) {
							echo ( current_user_can( 'edit_theme_options' ) ) ? "<div class='widget home-right'><p class='get-started'><a href='" . esc_url( $customizer ) . "'>" . __( 'Add Widget Here', 'milky-way' ) . "</a></p></div>" : '';
						} else {
							dynamic_sidebar( 'mw7' );
						}
						?>
					</div>
				</div>
				<?php 
				echo $post_link; 
				edit_post_link( sprintf( __( 'Edit %s', 'milky-way' ), "<span class='screen-reader-text'>" . get_the_title() . "</span>" ), '<p class="edit">', '</p>' ); 
				?>		
				<!--
				<?php trackback_rdf(); ?>
				-->

			<?php } else { ?>
				<h2 class="post-title" id="title-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php
				get_template_part( 'partials/post-meta' ); ?>

					<?php 
					if ( milky_way_show_excerpt() ) { 
						the_excerpt();
					} else {
						the_content( sprintf( __( 'Finish reading %s', 'milky-way' ), '&ldquo;<em>' . get_the_title() . '</em>&rdquo;' ) ); 
					}	
					?>
					<?php echo $post_link; ?>
					<?php edit_post_link( sprintf( __( 'Edit %s', 'milky-way' ), "<span class='screen-reader-text'>" . get_the_title() . "</span>" ), '<p class="edit">', '</p>' ); ?>			

			<?php } ?>
			</div>
		</section>
	</div>
    <?php endwhile; ?>
			<div class="prev_next">
				<?php the_posts_navigation(); ?>
			</div>
    <?php else : 
		
		get_template_part( 'partials/no-posts' );
	
	endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
