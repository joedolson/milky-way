<?php get_header(); ?>

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
	<?php /* post-content class is in the post format template. */ ?>
	<div <?php post_class(); ?>>
		<?php
			$format = get_post_format();
			if ( false === $format) {
				$format = null;
			}
			get_template_part( 'partials/format', $format );
		?>
		<?php if ( comments_open() ) { ?>
			<div class="comments">
				<?php
					$args = array(
								'before'=>'<p class="paginated">',
								'next_or_number' => 'next',
								'nextpagelink' => 'Next Page<span class="dashicon nextpage" aria-hidden="true"></span>',
								'previouspagelink' => '<span class="dashicon prevpage" aria-hidden="true"></span>Previous Page'
							);
					wp_link_pages( $args );
				?>
			</div>
		<?php } ?>

		<div class="prev_next">
			<?php posts_nav_link( ' <span aria-hidden="true">&bull;</span> ', sprintf( __( '%s Previous Post','milky-way' ), '<span aria-hidden="true">&larr;</span>' ), sprintf( __( 'Next Post %s','milky-way' ), '<span aria-hidden="true">&rarr;</span>' ) ); ?>
		</div>
	</div>
    <?php endwhile; ?>

	<?php comments_template(); ?>

    <?php else :

			get_template_part( 'partials/no-posts' );

	endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
