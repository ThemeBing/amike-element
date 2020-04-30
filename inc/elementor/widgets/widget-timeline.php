<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Timeline item
class amike_Widget_Timeline extends Widget_Base {
 
   public function get_name() {
      return 'Timeline';
   }
 
   public function get_title() {
      return esc_html__( 'Timeline', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-facebook-comments';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'Timeline_section',
         [
            'label' => esc_html__( 'Timeline item', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'achievement',
         [
            'label' => __( 'Achievement', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Senior UI/UX Designer',
         ]
      );

      $this->add_control(
         'year',
         [
            'label' => __( 'Year', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '2008 - 2009',
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'ThemeForest', 'amike' ),
         ]
      );

      $this->add_control(
         'text',
         [
            'label' => __( 'Text', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum standard dummy text.', 'amike' ),
         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'achievement', 'basic' );
      $this->add_inline_editing_attributes( 'year', 'basic' );
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'text', 'basic' );
      ?>
      <div class="timeline-item">
         <div class="row">
            <div class="col-md-4">
               <h5 <?php echo $this->get_render_attribute_string( 'achievement' ); ?>><?php echo esc_html($settings['achievement']); ?></h5>
               <span <?php echo $this->get_render_attribute_string( 'year' ); ?>><?php echo esc_html($settings['year']); ?></span>
            </div>
            <div class="col-md-7 offset-md-1">
               <h4 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html($settings['title']); ?></h4>
               <p <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo esc_html($settings['text']); ?></p> 
            </div>      
         </div>
      </div>
      <?php
   }
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Timeline );