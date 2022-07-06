<?php 
class CBlog {

  private static $_elements;
	
  public function __construct() {
    
  }
  
  /**
   * fonction qui prend les informations son Id. 
   * 
   * @param type $pid
   */
  public static function getById($pid) {
    $pid = intval($pid);
    
    //On essaye de charger l'element
    if(!isset(self::$_elements[$pid])) {
      self::_load($pid);
    }
    //Si on a pas réussi à chargé l'article (pas publiée?)
    if(!isset(self::$_elements[$pid])) {
      return FALSE;
    }

    return self::$_elements[$pid];
  }
  
  /**
   * fonction qui charge toutes les informations dans le variable statique $_elements.
   * 
   * @param type $pid 
   */
  private static function _load($pid) {
	$pid = intval($pid);
    $p = get_post($pid);
	
    if($p->post_type == "post"){
   	    $element = new stdClass();

            //traitement des données
            $element->id = $pid;
            $element->title = $p->post_title;
            $element->content = $p->post_content;           
            $element->thumbnail = get_post_thumbnail_id($pid);
            $element->extrait = wp_trim_words( $p->post_content );
            $element->thumbnail_url = get_the_post_thumbnail_url($pid);
            $element->link = get_permalink($p);

            //stocker dans le tableau statique
            self::$_elements[$pid] = $element;
    }
  }
  
  /**
   * fonction qui retourne une liste filtrée
   * 
   */
  public static function getBy($category_id='1',$numberposts =-1,$paged=1, $current_page_ids=""){


    //    $args = array(
    //     'cat'=>$categoryId,
    //     'post_type' => 'post',
    //     'post_status' => 'publish',
    //     'paged'=> $paged,
    //     'posts_per_page' => $numberposts,
    //     'order' => $order,
    //     'orderby' => $orderby
      
       
    // );

    $args = array(
      'posts_per_page' => $numberposts,
      'cat'              => $category_id,
      'orderby'          => 'post_date',
      'order'            => 'DESC',
      'post_status'      => 'publish',
      'paged'=> $paged,
      'fields' => 'ids'
    );

    if (!is_null($meta_key)) {
        $args['meta_key'] = $meta_key;
    }

    if(!is_null($current_page_ids))
	 $args['post__not_in'][] = $current_page_ids ;
    	
   $elements = new WP_Query ( $args );
        
   $GLOBALS['wp_query'] = $elements;

   $elts = array ();
   if ( $elements->have_posts () ) {
       
       $elements = $elements->posts;

       foreach ( $elements as $id ) {
               $elt = self::getById ( intval ( $id ) );
               $elts [] = $elt;
       }
   }
   
   wp_reset_postdata ();
 
   return $elts;
    
  }

    public static function getArticleImage($id, $size = null) {
        return wp_get_attachment_image_url($id, $size);
    }
}  
?>