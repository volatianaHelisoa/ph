<?php /* Template Name: Homepage */

get_header(); 
$id_top = [];
//$evenements = CBlog::getBy(8,2);



?>

<div class="hero-section">
		<div class="wrapper">
			<div class="hero-content">
				<h1>Opérateur d'interopérabilité sémantique</h1>
				<p>La mission de PHAST est de concevoir des solutions de standardisation et structurationdes données de santé pour accompagner les acteurs du secteur hospitalier dans leur démarche d'interopérabilité.</p>
			</div>
			<div class="hero-content--blog-slider">
			<?php                        
                    $argums=array('post_type' => 'post', 'posts_per_page'=>4,'category__in' => [6],'post__not_in'=> $id_top,'orderby' => 'date', 'order'=>'ASC');      
                    $loop = new WP_Query( $argums ); 
                    while ($loop->have_posts()):  $loop->the_post(); $id_top[] = get_the_ID();?>					
					<div class="item">
						<a class="blog-slider--item" href="<?php the_permalink(); ?>">
							<div class="date-of-post"><?= get_the_date('d F Y') ?></div>
							<strong><?php the_title(); ?></strong>	
						</a>
					</div>                        
            <?php endwhile; wp_reset_query(); ?>				
		</div>
	</div>
</div>
<main id="site-content">
		<section id="services-cards" class="box--shadow">
			<div class="wrapper">
				<div class="d-grid grid-4">				
					<?php 
						$args = array( 'post_type' => 'produit', 'posts_per_page' => 4 ,'orderby' => 'date', 'order'=>'ASC' );
						$the_query = new WP_Query( $args );  ?>
						<?php if ( $the_query->have_posts() ) : ?>
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>					
							<div class="service-item--inner">
								<div class="front">
									<span class="service-item--logo"><?php the_post_thumbnail(); ?></span>
									<?php the_title(); ?>
								</div>
								<div class="back">
									<?= substr (get_the_excerpt(), 0, 300); ?>
									<div class="back-actions">
										<a href="<?php the_permalink(); ?>" class="btn">En savoir +</a>
										<a href="<?php the_field('link-visionneuse'); ?>" class="btn">Consulter la visionneuse</a>
									</div>
								</div>
							</div>
							<?php endwhile;wp_reset_postdata(); ?>						
						<?php endif; ?>					
				</div>
			</div>
		</section>

		<section id="webinaires" class="relative">
			<div class="wrapper">
				<div class="live-area">
					<div class="live-area--slider make-slide">
					<?php 				
						$args=array('post_type' => 'post', 'posts_per_page'=>2,'order'=>'ASC','category__in' => [8],'post__not_in'=> $id_top, );  
						$the_query = new WP_Query( $args );  ?>
						<?php if ( $the_query->have_posts() ) : ?>
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>	
								<div class="item">
									<div class="animated-illustration">		
										<?php the_post_thumbnail('slide-event'); ?>	
									</div>
									<div class="contents">
										<div class="title"><?php the_title(); ?></div>
										<p><?php echo get_the_excerpt() ?></p>
										<a href="<?php the_permalink(); ?>" class="btn primary">S'inscrire</a>
									</div>
								</div>	
							<?php endwhile;wp_reset_postdata(); ?>						
						<?php endif; ?>	
					</div>
				</div>

				<div class="d-grid grid-2 web-cards">
						<?php 				
							$args=array('post_type' => 'post', 'posts_per_page'=>2,'order'=>'ASC','category__in' => [7],'post__not_in'=> $id_top, );  
							$the_query = new WP_Query( $args );  ?>
							<?php if ( $the_query->have_posts() ) : ?>
								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>									
								<div class="web-card web-card--webinaire">
								<div class="texts">
										<h3><?php the_title(); ?></h3>
										<p><?php echo get_the_excerpt() ?></p>
									</div>
									<a href="<?php the_permalink(); ?>" class="btn white">Découvrir les prochains webinaires</a>
									<img src="<?php the_post_thumbnail_url(); ?>" class="illustration-webcard" alt="webinaires">										
								</div>
								
								<?php endwhile;wp_reset_postdata(); ?>						
						<?php endif; ?>					
				</div>
			</div>
		</section>
	

		<section id="agenda" class="box--shadow">
			<div class="agenda-calendar--entry-animation">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/illustration-calendrier.png" alt="">
			</div>
			<div class="wrapper">
				<h2 class="text-primary">Agendas</h2>
				<div class="agenda-tiles">
					<div class="l-space"></div>
					<?php 
						$rows = get_field('agenda');
						if( $rows ) 
						{
							$first_parts = array_slice($rows, 0, 4);  
							$second_parts = array_slice($rows, 4, 4);
							?>					
							<div class="tiles-list">
								<?php foreach( $first_parts as $row ) { 
										$sub_date = $row['date'];
										$sub_titre =  $row['titre'];
										$sub_lieu =  $row['lieu']; ?>

									<div class="item-tile" data-aos="fade-up">
										<div class="tile">
											<span class="agenda-date text-primary"><?php echo $sub_date; ?></span>
											<strong><?php echo $sub_titre; ?></strong>
											<div class="agenda-desc"><?php echo $sub_lieu; ?></div>
										</div>
									</div>
								<?php } ?>
							</div>
							<div class="tiles-list">
								<?php foreach( $second_parts as $row ) { 
										$sub_date = $row['date'];
										$sub_titre =  $row['titre'];
										$sub_lieu =  $row['lieu']; ?>

									<div class="item-tile" data-aos="fade-up">
										<div class="tile">
											<span class="agenda-date text-primary"><?php echo $sub_date; ?></span>
											<strong><?php echo $sub_titre; ?></strong>
											<div class="agenda-desc"><?php echo $sub_lieu; ?></div>
										</div>
									</div>
								<?php } ?>
							</div>
					<?php } ?>			
				
				</div>
			</div>
		</section>

		<section id="discutons" class="bg-grey">
			<div class="text-center">
				<h2 class="text-primary w-separator">Discutons de votre projet</h2>
				<p><b>Planifiez un rendez-vous avec notre équipe</b></p>
			</div>
			<div class="sm-wrapper">
				<div class="card">
					<div class="card-inner">
						<div class="card-title">Votre demande concerne ?</div>
						<div class="d-grid grid-2" id="contact-type">
							<a href="#">Médicament</a>
							<a href="#">Alignement sémantique en SNOMED CT</a>
							<a href="#">Dispositif médical</a>
							<a href="#">Biologie</a>
							<a href="#">Autre</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	
        </main>
<?php get_footer(); ?>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/slick.js"></script>
	<script>
		jQuery(function($) {
			
			$('.hero-content--blog-slider').slick({
					dots: true,
					arrows: false,
					autoplay: true,
					autoplaySpeed : 2000,
					fade: true,
					autoheight: true,
					adaptiveHeight:true					
				});
				$('.make-slide').slick({
					dots: true,
					arrows: false
				});
		});
		
	</script> 
