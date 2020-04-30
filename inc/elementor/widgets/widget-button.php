<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Button
class amike_Widget_Button extends Widget_Base {
 
   public function get_name() {
      return 'button';
   }
 
   public function get_title() {
      return esc_html__( 'Button', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-button';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'button_section',
         [
            'label' => esc_html__( 'Button', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      
      $this->add_control(
         'button_icon', [
            'label' => __( 'Button Icon', 'amike' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-facebook',
         ]
      );

      $this->add_control(
         'button_text', [
            'label' => __( 'Button Text', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
         ]
      );

      $this->add_control(
         'button_url', [
            'label' => __( 'Button URL', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'label_block' => true,
         ]
      );

      $this->add_control(
         'bordered',
         [
            'label' => __( 'Bordered', 'amike' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'your-plugin' ),
            'label_off' => __( 'Off', 'your-plugin' ),
            'return_value' => 'bordered',
            'default' => 'no',
         ]
      );


      $this->add_control(
         'align',
         [
            'label' => __( 'Align', 'amike' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'solid',
            'options' => [
               'center'  => __( 'Center', 'amike' ),
               'left' => __( 'Left', 'amike' ),
               'right' => __( 'Right', 'amike' )
            ],
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'button_icon', 'basic' );
      $this->add_inline_editing_attributes( 'button_text', 'basic' );
      $this->add_inline_editing_attributes( 'button_url', 'basic' );
      $this->add_inline_editing_attributes( 'align', 'basic' );

      ?>
      <div style="text-align: <?php echo esc_attr($settings['align']) ?>">
         <a class="amike-btn <?php echo esc_attr($settings['bordered']) ?>" href="<?php echo esc_url( $settings['button_url'] ); ?>">
         <?php if ($settings['button_icon']): ?>
            <i class="<?php echo esc_attr($settings['button_icon']) ?>"></i>
         <?php endif ?><?php echo esc_html( $settings['button_text'] ); ?></a>
      </div>
      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Button );