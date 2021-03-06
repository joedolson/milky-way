<div class="searchform" role="search">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>/">
		<?php $form_id = rand( 100, 999 ); ?>
		<p>
			<label for="s<?php echo $form_id; ?>" class='screen-reader-text'><?php esc_html_e( 'Search', 'milky-way' ); ?></label> 
			<input type="text" name="s" id="s<?php echo $form_id; ?>" placeholder="<?php esc_attr_e( 'Search', 'milky-way' ); ?>" value="<?php echo trim( get_search_query() ); ?>" /> 
			<input type="submit" name="submit" value="<?php esc_attr_e( 'Search', 'milky-way' ); ?>" class="button screen-reader-text" />
		</p>
	</form>
</div>
