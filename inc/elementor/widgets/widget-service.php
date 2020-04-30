<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// service item
class amike_Widget_Service extends Widget_Base {
 
   public function get_name() {
      return 'service item';
   }
 
   public function get_title() {
      return esc_html__( 'service item', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-facebook-comments';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'service_section',
         [
            'label' => esc_html__( 'service item', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'icon',
         [
            'label' => __( 'icon', 'amike' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-user',
         ]
      );
      
      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Web Development',
         ]
      );

      $this->add_control(
         'text',
         [
            'label' => __( 'Text', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum standard dummy text.',
         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'icon', 'basic' );
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'text', 'basic' );
      ?>
      <div class="item-service">
         <div class="item-service-icon">
            <i class="<?php echo esc_attr($settings['icon']) ?>" aria-hidden="true"></i>
         </div>
         <div class="item-service-content">
            <h5 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html($settings['title']); ?></h5>
            <p <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo esc_html($settings['text']); ?></p>            
         </div>
      </div>
      <?php
   } 
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Service );