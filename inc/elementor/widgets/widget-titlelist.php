<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title list
class amike_Widget_Titlelist extends Widget_Base {
 
   public function get_name() {
      return 'titlelist';
   }
 
   public function get_title() {
      return esc_html__( 'Title list', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-editor-list-ol';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'titlelist_section',
         [
            'label' => esc_html__( 'Title list', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'title', [
            'label' => __( 'Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'Title', 'amike' ),
         ]
      );

      $repeater->add_control(
         'description', [
            'label' => __( 'Description', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'Description', 'amike' ),
         ]
      );

      $this->add_control(
         'titlelist',
         [
            'label' => __( 'Title list', 'amike' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{title}}',

         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'logo', 'basic' );
      $this->add_inline_editing_attributes( 'logo_url', 'basic' );
      ?>

      <ul class="title-list">
         <?php 
            foreach (  $settings['titlelist'] as $value ) { ?>
               <li>
                  <span><?php echo esc_html($value['title']) ?> : </span><?php echo esc_html($value['description']) ?>
               </li>
         <?php 
         } ?>
     </ul>
     <?php
   }

}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Titlelist );