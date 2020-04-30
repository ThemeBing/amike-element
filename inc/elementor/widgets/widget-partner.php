<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// partner
class amike_Widget_Partner extends Widget_Base {
 
   public function get_name() {
      return 'partner';
   }
 
   public function get_title() {
      return esc_html__( 'partner', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-logo';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'partner_section',
         [
            'label' => esc_html__( 'partner', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'logo', [
            'label' => __( 'logo', 'amike' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );


      $repeater->add_control(
         'logo_url',
         [
            'label' => __( 'URL', 'amike' ),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __( 'https://example.com', 'amike' ),
            'show_external' => true,
            'default' => [
               'url' => '#',
               'is_external' => true
            ],
         ]
      );

      $this->add_control(
         'partner',
         [
            'label' => __( 'partner list', 'amike' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => 'Partner',

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

      <ul class="list-inline partner justify-content-center">
         <?php 
            foreach (  $settings['partner'] as $single_feature ) { 
               $target = $single_feature['logo_url']['is_external'] ? ' target="_blank"' : ''; ?>
               <li class="list-inline-item">
                  <a <?php echo esc_attr($target) ?> href="<?php echo esc_url( $single_feature['logo_url']['url'] ); ?>">
                     <img src="<?php echo esc_attr($single_feature['logo']['url']); ?>" alt="client logo"></a>
               </li>
         <?php 
         } ?>
     </ul>
     <?php
   }

}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Partner );