<?php

// require_once get_stylesheet_directory_uri() . '/inc/blog.class.php';


function require_scripts(){   
    wp_enqueue_style( 'style-main', get_stylesheet_uri() );      
    wp_enqueue_script('jquery' , get_template_directory_uri() . '/assets/js/jquery.js', array('jquery'), '1.1', true );
    wp_enqueue_script('slick' , get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.1', true );
    wp_enqueue_style('responsive' , get_stylesheet_directory_uri() . '/assets/css/responsive.css');
}

add_action('wp_enqueue_scripts', 'require_scripts');

function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) { $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) ); }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

add_filter('login_errors',create_function('$a', "return null;"));
define('DISALLOW_FILE_EDIT',true);

function require_back_office(){
    add_image_size('slide-event', 500, 450, true);
    add_theme_support('custom-logo', array());   
    add_theme_support( 'post-thumbnails' );
    remove_action('wp_head', 'wp_generator');
    remove_filter('the_content', 'wptexturize');
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'wlwmanifest_link' ) ; 
    remove_action( 'wp_head', 'rsd_link' ) ;
    add_theme_support('title-tag');
    register_nav_menus( array('primary' => "Principal", 'secondary' => "Secondaire" ) );
    add_post_type_support( 'page', 'excerpt' );

  }
  add_action('after_setup_theme', 'require_back_office');

   function change_logo( $html ) {
	$html = str_replace('custom-logo-link', 'site-branding', $html );
	return $html;
    }
    add_filter('get_custom_logo', 'change_logo', 10);


    /*
    * Custom post type 'Référentiels'
    */
    
    function load_custom_post_type() {

        $labels = array(
            'name'                => _x( 'Produit', 'Post Type General Name', 'text_domain' ),
            'singular_name'       => _x( 'Produit', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'           => __( 'Produit', 'text_domain' ),
            'all_items'           => __( 'Tous les produits', 'text_domain' ),
            'view_item'           => __( 'Voir', 'text_domain' ),
            'add_new_item'        => __( 'Ajouter nouveau', 'text_domain' ),
            'add_new'             => __( 'Ajouter nouveau', 'text_domain' ),
            'edit_item'           => __( 'Modifier', 'text_domain' ),
            'update_item'         => __( 'Mettre a jour', 'text_domain' ),
            'search_items'        => __( 'Rechercher', 'text_domain' ),
            'not_found'           => __( 'Aucun produit', 'text_domain' ),
            'not_found_in_trash'  => __( 'Aucun produit', 'text_domain' ),
        );
        
        $args = array(
            'label'               => __( 'Produit', 'text_domain' ),
            'description'         => __( 'Produit', 'text_domain' ),
            'labels'              => $labels,
            'supports'            =>   array( 'title', 'editor', 'custom-fields','thumbnail','excerpt' ),
            'taxonomies'          => array(''),
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 4,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
        register_post_type( 'produit', $args );
        
    
    }
    add_action( 'init', 'load_custom_post_type' );


    function phast_script_enqueuer() {
        // Charger notre script
        wp_enqueue_script( 
            'phast', 
            get_stylesheet_directory_uri() . '/assets/js/phast.js', array( 'jquery' ), 
            '1.0', 
            true 
        );
      
        // Envoyer une variable de PHP à JS proprement
        wp_localize_script(
            'phast', 
            'phast', 
            [ "ajaxurl" => admin_url( 'admin-ajax.php' ) ] 
        );      
      }

    add_action('wp_enqueue_scripts', 'phast_script_enqueuer');
 
    function search_actuality() {  
        $post_id = $_POST['post_id'];  
        $result = load_actuality($post_id);    
        
        echo $result;
        wp_die();
    }
    add_action( 'wp_ajax_search_actuality', 'search_actuality' );
    add_action( 'wp_ajax_nopriv_search_actuality', 'search_actuality' );


    function load_actuality($post_id ){
        $args = array('post_type' => 'post', 'order'=>'ASC','category__in' => $post_id  );   
        $result ="<div class='d-grid grid-3'>";		
        //$the_query = new WP_Query( $args );  
        $myposts = get_posts( $args );
         //if ( $the_query->have_posts() ) {
          //  while ( $the_query->have_posts() )
          foreach( $myposts as $the_query )              
            { 
                setup_postdata($post);      
               
                //$the_query->the_post(); 
                $result .="<div class='card-item'>								
                <div class='date-of-post'>Publié le ".get_the_date('d/m/Y') ."</div>
                <div class='item'>
                    <span class='service-item--logo'>". get_the_post_thumbnail($the_query->ID)."</span>		                                            
                    <div class='contents'>
                        <div class='title'>". $the_query->post_title."</div>         
                        <div class='tags'>";                                                                              
                                $post_categories = get_the_category( $the_query->ID);                                                                                                   
                                if( $post_categories ) {
                                    foreach ($post_categories as $key => $category) {
                                        // if($category->term_id == $actu_category->term_id) {
                                        //     continue;
                                        // }  
                                        if($key ) {
                                                $result .="<span class='sep'>|</span>";
                                                $result .="<a href='javascript:void(0)' onclick='return false;' title='". $category->name."'>". $category->cat_name."</a>";                                                        
                                        }                                       
                                    }   
                                }    

                $result .="</div>                                    
                        <a href='".the_permalink() ."' class='btn'>En savoir +</a>		
                    </div>	                                        
                </div>                               							
            </div>";
            }
            wp_reset_postdata();						
        //  }
          $result .="</div>";
        return $result;
    }