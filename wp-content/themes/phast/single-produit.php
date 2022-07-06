<?php
/* Template Name: DetailPage */

get_header(); 
?>
	
<div class="hero-section">
<?php while ( have_posts() ) :	the_post();?>
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
<?php endwhile; ?>
</div>

<?php get_footer(); ?>
 



