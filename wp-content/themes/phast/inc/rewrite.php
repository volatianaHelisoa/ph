<?php

/**
 * class rewrite url
 */
class rewrite {

  /**
   * Constructor function.
   **/
  function __construct() {
    add_action('init', array($this, 'flush_rewrite_rules'));
    add_filter('post_type_link', array($this, 'post_type_link'), 10, 3);
    add_filter('post_link', array($this, 'post_type_link'), 10, 3);
    add_filter('term_link', array($this, 'term_link'), 1, 3);
    add_action('generate_rewrite_rules', array(
      $this,
      'create_custom_rewrite_rules'
    ));
    add_filter('query_vars', array($this, 'add_custom_page_variables'));
  } // End constructor

  /**
   * rewrite post type url
   */
  function post_type_link($permalink, $post, $leavename) {

    switch ($post->post_type) {
      case 'agenda' :
        $permalink = $this->rewrite_permalink($post, $permalink);
        break;
    }

    return $permalink;
  }

  /**
   * Fonction qui permet de change l'url des divers post_type le pays rattaché.
   */
  function rewrite_permalink($post, $permalink) {
    return $permalink;
  }

  /**
   * Fonction qui permet de change l'url des pays et metiers.
   */
  function term_link($termlink, $term, $taxonomy) {
    global $statut;

    switch ($taxonomy) {
      case 'category' :
        $termlink = str_replace('category/', '',$termlink);
        break;
    }

    return $termlink;
  }

  /**
   * create_custom_rewrite_rules()
   * Creates the custom rewrite rules.
   * return array $rules.
   **/
  public function create_custom_rewrite_rules() {
    global $wp_rewrite;

    remove_action('template_redirect', 'redirect_canonical');
    $_SERVER['REQUEST_URI'] = str_replace(PATH_URL,'',$_SERVER['REQUEST_URI']);
    
    $tmp = explode("/", $_SERVER['REQUEST_URI']);
 
    array_pop($tmp);
  
    $category = get_term_by('slug', $tmp[0], 'category');
    
    if (isset($category->term_id) && $category->term_id > 0 && (isset($tmp[1]) && $tmp[1] == 'page')) {
    
        $taxonomy     = '%category_name%';
        $paged    = '%paged%';
        
        // Add the rewrite tokens
        $wp_rewrite->add_rewrite_tag($taxonomy, '([^/]*)', 'category_name=');
        $wp_rewrite->add_rewrite_tag($paged, '?([0-9]{1,})', 'paged=');

        // Define the custom permalink structure
        $rewrite_keywords_structure = $wp_rewrite->root . "/" . $taxonomy . "/page/" . $paged ."/";

        // Generate the rewrite rules
        $new_rule = $wp_rewrite->generate_rewrite_rules( $rewrite_keywords_structure, EP_NONE, false,false,false,false,false	 );

        $wp_rewrite->rules = $new_rule + $wp_rewrite->rules;
    } elseif(isset($category->term_id) && $category->term_id > 0) {
	$taxonomy     = '%category_name%';
        
        // Add the rewrite tokens
        $wp_rewrite->add_rewrite_tag($taxonomy, '([^/]*)', 'category_name=');

        // Define the custom permalink structure
        $rewrite_keywords_structure = $wp_rewrite->root . "/" . $taxonomy . "/";

        // Generate the rewrite rules
        $new_rule = $wp_rewrite->generate_rewrite_rules( $rewrite_keywords_structure, EP_NONE, false,false,false,false,false	 );

        $wp_rewrite->rules = $new_rule + $wp_rewrite->rules;
    }
    
    return $wp_rewrite->rules;
  } // End create_custom_rewrite_rules()

  /**
   * add_custom_page_variables()
   * Add the custom token as an allowed query variable.
   * return array $public_query_vars.
   **/
  public function add_custom_page_variables($public_query_vars) {

    return $public_query_vars;
  } // End add_custom_page_variables()

  /**
   * flush_rewrite_rules()
   * Flush the rewrite rules, which forces the regeneration with new rules.
   * return void.
   **/
  public function flush_rewrite_rules() {
    global $wp_rewrite;

    $wp_rewrite->flush_rules();
  } // End flush_rewrite_rules()
}

new rewrite();
?>
