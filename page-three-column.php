<?php
/*
Template Name: Three Column
*/ 
get_header(); 
?>

    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
		<section>
		<?php if ( has_post_thumbnail() ) { ?>
			<div class='featured-image'><?php the_post_thumbnail(); ?></div>
		<?php } ?>		
		<div <?php post_class( 'post-content' ); ?> id="post-<?php the_ID(); ?>">
			<h1 class="page-title" id="title-<?php the_ID(); ?>"><?php the_title(); ?></h1>

			<?php the_content( sprintf( __( 'Finish reading <em>%s</em>', 'milky-way' ), get_the_title() ) ); ?>
		</div> 
		<?php edit_post_link( sprintf( __( 'Edit %s', 'milky-way' ), "<span class='screen-reader-text'>" . get_the_title() . "</span>" ), '<p class="edit">', '</p>' ); ?>			
		</section>

    <?php endwhile; ?>

	<?php 
		if ( comments_open() ) {
			comments_template(); 
		}
	?>


	<?php else :
	
		get_template_part( 'partials/no-posts' );	
	
	endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>