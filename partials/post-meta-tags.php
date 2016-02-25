<?php
	if ( ( comments_open() || get_comments_number() ) && !is_single() ) {
?>
		<div class="comment-count">
			<span class='count'>
				<span class='dashicons-admin-comments dashicon' aria-hidden="true"></span> 
				<?php comments_popup_link( __( 'Comments (0)', 'milky-way' ), __( 'Comments (1)', 'milky-way' ), __( 'Comments (%)', 'milky-way' ) ); ?>
			</span>
		</div>
<?php
	}
?>
	<div class="meta foot">
			<?php
				/*
				 *	These dashicons are hidden to screen readers. They are decorative, and we want to prevent the character 
				 *	represented from being read aloud.
				 */
			echo apply_filters( 'milky_way_article_footer_meta_before','' );				 
			?>
			<span class="the-category dashicon" aria-hidden="true"></span> <?php _e('Categories:','milky-way'); ?> <?php the_category( ', ' ); ?>
			<?php
			if ( get_the_tags() ) { ?> <span aria-hidden="true">&bull;</span>
				<?php _e('Tags:','milky-way'); ?>
				<?php the_tags( '<span class="the-tags dashicon" aria-hidden="true"></span> ', ', ', '' ); 
			}		
			echo apply_filters( 'milky_way_article_footer_meta_after','' ); ?>
	</div>