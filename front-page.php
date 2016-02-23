<?php get_header(); ?>

    <?php if ( have_posts() ) : ?>
	<?php if ( !is_page() ) { 
		/*
		 *	Add text to indicate page structure. Page structure helps non-sighted users navigate the page, 
		 *	but also informs screen readers about how your information relates.
		 */
		milky_way_archive_title(); 
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
				$post_link = wpautop( sprintf( __( '<a href="%s" rel="bookmark">View untitled post</a>', 'milky-way' ), get_the_permalink() ) );
			} else {
		?>
		<?php 
			}
			if ( is_page() ) { ?>
				<?php if ( get_the_title() != '' ) { ?>
					<h1 class="post-title" id="title-<?php the_ID(); ?>"><?php the_title(); ?></h1>
				<?php } ?>
					<?php the_content( sprintf( __( 'Finish reading <em>%s</em>', 'milky-way' ), get_the_title() ) ); ?>
					<div class='home-widget-container'>
						<div class='home-widgets'>
							<?php 
							$customizer = add_query_arg( 'url', urlencode( home_url() ), admin_url( 'customize.php' ) );
							if ( !is_active_sidebar('Front Page Content - Left') ) { 
								echo ( current_user_can( 'edit_theme_options' ) ) ? "<div class='widget home-left'><p class='get-started'><a href='$customizer'>Add Widget Here</a></p></div>" : '';
							} else {
								dynamic_sidebar('Front Page Content - Left');
							}
							if ( !is_active_sidebar('Front Page Content - Right') ) {
								echo ( current_user_can( 'edit_theme_options' ) ) ? "<div class='widget home-right'><p class='get-started'><a href='$customizer'>Add Widget Here</a></p></div>" : '';
							} else {
								dynamic_sidebar('Front Page Content - Right');
							}
							?>
						</div>
					</div>
					<?php echo $post_link; ?>
					<?php edit_post_link( sprintf( __( 'Edit %s', 'milky-way' ), "<span class='screen-reader-text'>" . get_the_title() . "</span>" ), '<p class="edit">', '</p>' ); ?>			
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
						the_content( sprintf( __( 'Finish reading <em>%s</em>', 'milky-way' ), get_the_title() ) ); 
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
				<?php posts_nav_link( ' <span aria-hidden="true">&bull;</span> ', sprintf( __( '%s Previous Posts','milky-way' ), '<span aria-hidden="true">&larr;</span>' ), sprintf( __( 'Next Posts %s','milky-way' ), '<span aria-hidden="true">&rarr;</span>' ) ); ?>
			</div>
    <?php else : 
		
		get_template_part( 'partials/no-posts' );
	
	endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
