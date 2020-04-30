<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// address
class amike_Widget_Address extends Widget_Base {
 
   public function get_name() {
      return 'address';
   }
 
   public function get_title() {
      return esc_html__( 'Address', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-fb-feed';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'address_section',
         [
            'label' => esc_html__( 'Address', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      
      $this->add_control(
         'address_icon', [
            'label' => __( 'Address Icon', 'amike' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-envelope-o',
         ]
      );

      $this->add_control(
         'address_title', [
            'label' => __( 'Address Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
         ]
      );

      $this->add_control(
         'address_desc', [
            'label' => __( 'Address Desc', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'label_block' => true,
         ]
      );

      $this->add_control(
         'address_url', [
            'label' => __( 'Address URL', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
         ]
      );


      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editingaddress_icon
      $this->add_inline_editing_attributes( 'address_icon', 'basic' );
      $this->add_inline_editing_attributes( 'address_title', 'basic' );
      $this->add_inline_editing_attributes( 'address_desc', 'basic' );
      $this->add_inline_editing_attributes( 'address_url', 'basic' );

      ?>
      <div class="address">
         <a href="<?php echo esc_url( $settings['address_url'] ); ?>">
         <?php if ($settings['address_icon']): ?>
            <i class="fa-fw <?php echo esc_attr($settings['address_icon']) ?>"></i>
         <?php endif ?>
         <span><?php echo esc_html($settings['address_title']) ?></span>
         <p><?php echo esc_html($settings['address_desc']) ?></p>
         </a>
      </div>
      <?php
   }
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Address );