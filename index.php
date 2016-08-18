<?php get_header(); ?>

    <?php if ( have_posts() ) : ?>
	<?php if ( !is_singular() ) { 
		the_archive_title();
	} ?>
    <?php while ( have_posts() ) : the_post(); ?>
		<?php
			$format = get_post_format();
			if ( false === $format ) {
				$format = null;
			}
			get_template_part( 'partials/format', $format );
		?>	
		<div class="comments">
			<?php wp_link_pages(); ?>
		</div>
		<?php
		/* Only render trackback_rdf when appropriate and allowed */
		if ( is_single() ) {
			echo '<!--';
			trackback_rdf();
			echo '-->' . "\n";
		}
		?>
    <?php endwhile; ?>
	<div class="prev_next">
		<?php the_post_navigation(); ?>
	</div>
	<?php comments_template(); ?>

    <?php else : 
	
			get_template_part( 'partials/no-posts' );
	
	endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>