<?php get_header(); ?>

    <?php if ( have_posts() ) : ?>
	<?php if ( !is_singular() ) { 
		milky_way_archive_title();
	} ?>
    <?php while ( have_posts() ) : the_post(); ?>
	<div <?php post_class( 'post-content' ); ?>>
		<?php
			$format = get_post_format();
			if ( $format === false ) {
				$format = 'format';
			}
			get_template_part( 'partials/format', $format );
		?>	
		<div class="comments">
			<?php wp_link_pages(); ?>
			<?php 
			if ( comments_open() || get_comments_number() ) {
				comments_popup_link( __( 'Comments (0)', 'milky-way' ), __( 'Comments (1)', 'milky-way' ), __( 'Comments (%)', 'milky-way' ) ); 
			}
			?>
		</div>
		<?php
		/* Only render trackback_rdf when appropriate and allowed */
		if ( is_single() ) {
			echo '<!--';
			trackback_rdf();
			echo '-->' . "\n";
		}
		?>
	</div>
    <?php endwhile; ?>
	<div class="prev_next">
		<?php posts_nav_link( ' <span aria-hidden="true">&bull;</span> ', sprintf( __( '%s Previous Posts','milky-way' ), '<span aria-hidden="true">&larr;</span>' ), sprintf( __( 'Next Posts %s','milky-way' ), '<span aria-hidden="true">&rarr;</span>' ) ); ?>
	</div>
	<?php comments_template(); ?>

    <?php else : 
	
			get_template_part( 'partials/no-posts' );
	
	endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>