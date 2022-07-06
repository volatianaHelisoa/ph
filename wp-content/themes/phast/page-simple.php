<?php /* Template Name: Page simple */
get_header(); 


$actu_category = get_category_by_slug("actualites");  
$id_parents = [1,6,7,8];

$themes = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC',
    "hide_empty" => true,    
    'exclude' => $id_parents,
) );
?>
<main class="page-simple">
    <section class="hero-section bg-gradient">
        <!-- <img style="position:absolute" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/bg-lines-hero--home.png" alt="actu"> -->
        <h1><?php the_title(); ?></h1>
    </section>

 
    <div class="wrapper" >
        <div class="bloc">
            <div class="d-grid grid-4 filter" >                              
                <select class="input-filter">
                        <?php                           
                            $args = array( 'post_type' => 'produit', 'posts_per_page' => -1 ,'orderby' => 'title', 'order'=>'ASC' );
                            $the_query = new WP_Query( $args );                                  
                            if ( $the_query->have_posts() ) : ?>
                                <option value="0"  >PRODUIT</option>
                                <?php  while ( $the_query->have_posts() ) : $the_query->the_post();    
                                 ?>
                                  <option value="<?php the_id() ?>" <?php  echo selected($_GET['orderby'],'title')?> ><?php the_title(); ?></option>                              
                                <?php  endwhile; wp_reset_postdata();
                            endif; ?>
                </select>  


                <select class="input-filter" id="select-theme">
                        <option value="0" >THEME</option>                       
                             <?php foreach ($themes as $key => $category): ?>
                                <option value="<?php echo  $category->term_id ?>" ><?php echo $category->cat_name; ?></option>          
                            <?php endforeach; ?>
                </select>	
              
                <input type="date" name="bday" class="input-filter">	
                   
                
                <input type="button" class="btn btn-search" value="Rechercher">
            </div>          
        </div> 
  
            <div class="bloc" id="content">   
                <div class="d-grid grid-3">				
                            <?php 
                                $args = array('post_type' => 'post', 'category__in' => $actu_category->term_id,'post__not_in'=> $id_top,'orderby' => 'date', 'order'=>'ASC');    
                                $the_query = new WP_Query( $args );  ?>
                                <?php if ( $the_query->have_posts() ) : ?>
                                    <?php while ( $the_query->have_posts() ) : 
                                    $the_query->the_post();  
                                    ?>					
                                    <div class="card-item">								
                                        <div class="date-of-post">Publié le <?= get_the_date('d/m/Y') ?></div>
                                        <div class="item">
                                            <span class="service-item--logo"><?php the_post_thumbnail(); ?></span>		                                            
                                            <div class="contents">
                                                <div class="title"><?= the_title() ?></div>         
                                                <div class="tags">
                                                    <?php                                                        
                                                        $post_categories = get_the_category( $the_query->ID);                                                                                                   
                                                        if( $post_categories ) :   
                                                                foreach ($post_categories as $key => $category) :                                                                
                                                                   
                                                                    //if($category->term_id == $actu_category->term_id) : continue;  else :                                                                                                                        
                                                                    if($key) : ?><span class="sep">|</span><?php endif; ?>
                                                                    <a href="<?php echo get_category_link( $category->term_id ); ?>"onclick="return false;" title="<?php echo esc_attr($category->name); ?>"><?php echo $category->cat_name; ?></a>                                                               
                                                                    
                                                                <?php endforeach; ?>
                                                        <?php endif; ?>
                                                </div>                                     
                                                <a href="<?php the_permalink(); ?>" class="btn">En savoir +</a>			
                                            </div>	                                        
                                        </div>                               							
                                    </div>
                                    <?php endwhile;wp_reset_postdata(); 
                                endif; 
                            ?>	
                </div>            
            </div>
</div>


</main>

<?php get_footer(); ?>