<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// progress
class amike_Widget_ProgressBar extends Widget_Base {
 
   public function get_name() {
      return 'progress_bar';
   }
 
   public function get_title() {
      return esc_html__( 'Progress Bar', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-skill-bar';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'service_section',
         [
            'label' => esc_html__( 'progress', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      
      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'WordPress',
         ]
      );

      $this->add_control(
         'percentage',
         [
            'label' => __( 'Percentage', 'amike' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
               'no' => [
                  'min' => 0,
                  'max' => 100,
                  'step' => 1,
               ],
            ],
            'default' => [
               'size' => 70,
            ]
         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'percentage', 'basic' );
      ?>

      <div class="skill">
         <p><?php echo esc_html($settings['title']); ?></p>
         <div class="skill-bar wow slideInLeft animated" style="width: <?php echo esc_attr($settings['percentage']['size']); ?>%">
             <span class="skill-count"><?php echo esc_html($settings['percentage']['size']); ?>%</span>
         </div>
      </div>
      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_ProgressBar );