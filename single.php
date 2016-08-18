<?php get_header(); ?>

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
	<?php /* post-content class is in the post format template. */ ?>
	<div <?php post_class(); ?>>
		<?php
			$format = get_post_format();
			if ( false === $format ) {
				$format = null;
			}
			get_template_part( 'partials/format', $format );
		?>
		<div class="link-pages">
			<?php
				$args = array( 
							'before'=>'<p class="paginated">',
							'next_or_number' => 'next',
							'nextpagelink' => __( 'Next Page', 'milky-way' ) . '<span class="dashicon nextpage" aria-hidden="true"></span>',
							'previouspagelink' => '<span class="dashicon prevpage" aria-hidden="true"></span>' . __( 'Previous Page', 'milky-way' )
						);
				wp_link_pages( $args );
			?>
		</div>

		<div class="prev_next">
			<?php the_posts_navigation(); ?>
		</div>
	</div>
    <?php endwhile; ?>

	<?php comments_template(); ?>

    <?php else :

			get_template_part( 'partials/no-posts' );

	endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
