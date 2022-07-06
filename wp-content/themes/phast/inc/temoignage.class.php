<?php 
class CTemoignage {

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
	
    if($p->post_type == "temoignage"){
   	    $element = new stdClass();
            
   	   //traitement des donn�es
            $element->id = $pid;
            $element->title = $p->post_title;
            $element->content = $p->post_content;
            $element->author = get_field('author', intval($pid));
           
          
   	    //stocker dans le tableau statique
	    self::$_elements[$pid] = $element;
    }
  }
  
  /**
   * fonction qui retourne une liste filtrée
   * 
   */
  public static function getBy($numberposts = -1, $orderby = 'date', $order = 'DESC', $meta_key = null) {
        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
       
       
        $args = array(
            'post_type' => 'temoignage',
            'post_status' => 'publish',
            'paged'=> $paged,
            'posts_per_page' => $numberposts,
            'order' => $order,
            'orderby' => $orderby,
            'fields' => 'ids'
            
        );
        
        if (!is_null($meta_key)) {
            $args['meta_key'] = $meta_key;
        }        

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

     
}  
?>