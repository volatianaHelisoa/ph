<?php

get_header(); 

$category = get_the_category();
$category_id = $category[0]->cat_ID;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


// $blogs = CBlog::getBy($category_id ,9,$paged);

?>
<div class="hero-section">

<div class="wrapper">
            <h1><?= $category->name ?> blog</h1>
            <?php if ($paged == 0 ) : 
            $argums = ['tax_query' => [ [ 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $cat_id ] ], 
            'order' => 'DESC', 'posts_per_page' => 2, 'post_status' => 'publish'];  
            $loop = new WP_Query ( $argums ); ?>
            <div class="sticky-post">
            <?php $count==0; while ($loop->have_posts()) : $loop->the_post(); $id_top[] = get_the_ID(); $count++; ?>
                <div class="item">
                    <div class="image"><?php the_post_thumbnail(); ?></div>
                    <div class="content">
                        <div>
                            <div class="date"><?= get_the_date('d F Y') ?></div>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php if ($count==1): ?><p><?= substr (get_the_excerpt(), 0, 200); ?>...</p><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_query(); ?>  
            </div>
            <?php endif; ?>
            <div class="listing-blog">
            <?php 
            $argums = ['tax_query' => [ [ 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $cat_id ] ], 
            'order' => 'DESC', 'posts_per_page' => 15, 'post_status' => 'publish','post__not_in'=> $id_top];                                                                     
            $argums ['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;    
            if ($paged == 2) { $argums['offset'] = 17;}                                  
            $loop = new WP_Query ( $argums );
            // Pagination fix
            $temp_query = $wp_query;
            $wp_query   = NULL;
            $wp_query   = $loop;
            if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); ?>
                <div class="item">
                    <div class="image"><?php the_post_thumbnail('category'); ?></div>
                    <div class="texte">
                        <div class="date"><?= get_the_date('d F Y') ?></div>
                        <div class="s-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                        <p><?= substr (get_the_excerpt(), 0, 200); ?>...</p>
                        <a href="<?php the_permalink(); ?>" class="voir">En savoir plus</a>
                    </div>
                </div>
            <?php endwhile; endif; wp_reset_query(); ?>  
            </div>
            <?php wp_pagenavi( [ 'query' => $loop ] ); ?>
        </div>



</div>
			
<?php

get_footer();
