<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function amike_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'amike-elements',
		[
			'title' => esc_html__( 'amike Elements', 'amike' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'amike_add_elementor_widget_categories' );

// Elementor Templates List 
function amike_get_elementor_template() {
    $templates = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
    $types = array();
    if ( empty( $templates ) ) {
        $template_lists = [ '0' => __( 'Templates not found.', 'amike' ) ];
    } else {
        $template_lists = [ '0' => __( 'Select Template', 'amike' ) ];
        foreach ( $templates as $template ) {
            $template_lists[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
        }
    }
    return $template_lists;
}

//Elementor init
class amike_ElementorCustomElement {

   private static $instance = null;
 
   public static function get_instance() {
      if ( ! self::$instance )
         self::$instance = new self;
      return self::$instance;
   }
 
   public function init(){
      add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
   }


   public function widgets_registered() {
 
    // We check if the Elementor plugin has been installed / activated.
    if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){

         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-title.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-blog.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-banner.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-service.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-tab.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-counter.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-portfolio.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-pricing.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-testimonials.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-progress.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-address.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-timeline.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-button.php');
         include_once(plugin_dir_path( __FILE__ ).'/widgets/widget-partner.php');

      }
	}

}
 
amike_ElementorCustomElement::get_instance()->init();