<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class amike_Widget_Title extends Widget_Base {
 
   public function get_name() {
      return 'title';
   }
 
   public function get_title() {
      return esc_html__( 'Title', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-site-title';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'title_section',
         [
            'label' => esc_html__( 'Title', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'align',
         [
            'label' => __( 'Align', 'amike' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'left',
            'options' => [
               'center'  => __( 'Center', 'amike' ),
               'left' => __( 'Left', 'amike' ),
               'right' => __( 'Right', 'amike' )
            ],
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
         'subtitle',
         [
            'label' => __( 'Sub Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );
      
      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $this->add_control(
         'colored-title',
         [
            'label' => __( 'Colored Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
         ]
      );

      $this->add_control(
         'text',
         [
            'label' => __( 'Text', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA
         ]
      );

      $this->add_control(
         'switch',
         [
            'label' => __( 'Show Title Underline', 'amike' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'amike' ),
            'label_off' => __( 'Hide', 'amike' ),
            'return_value' => 'underline',
            'default' => 'underline',
         ]
      );

      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'align', 'basic' );
      $this->add_inline_editing_attributes( 'icon', 'basic' );
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'subtitle', 'basic' );
      $this->add_inline_editing_attributes( 'colored-title', 'basic' );
      $this->add_inline_editing_attributes( 'text', 'basic' );
      ?>
      <div class="section-title <?php echo esc_attr( $settings['switch'] ) ?>" style="text-align: <?php echo esc_attr($settings['align']); ?>">
         <?php if ( $settings['icon'] ) { ?>
            <i class="<?php echo $settings['icon'] ?> fa-2x" aria-hidden="true"></i>
         <?php } ?>

         <?php if ($settings['subtitle']): ?>
            <span <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>><?php echo esc_html($settings['subtitle']); ?></span>
         <?php endif ?>
         
         <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html($settings['title']); ?><span <?php if ( $settings['align'] == 'center' ) { echo 'class="span-inline"';} ?>><?php echo esc_html($settings['colored-title']); ?></span></h2>
         <p <?php if ( $settings['align'] == 'center' ) { echo 'class="title-desc"';} ?><?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo esc_html($settings['text']); ?></p>
      </div>
      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Title );