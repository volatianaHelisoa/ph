<?php
/* Template Name: Detail Referentiel */
get_header(); 
?>

<div class="hero-section">
<?php while ( have_posts() ) :
	the_post();
endwhile; ?>
</div>

<?php get_footer(); ?>