<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class amike_Widget_Counter extends Widget_Base {
 
   public function get_name() {
      return 'counter';
   }
 
   public function get_title() {
      return esc_html__( 'Counter', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-counter';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'counter_section',
         [
            'label' => esc_html__( 'Counter', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $counter = new \Elementor\Repeater();

      $counter->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'amike' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'default' => 'fa fa-user',
         ]
      );

      $counter->add_control(
         'count',
         [
            'label' => __( 'Count', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $counter->add_control(
         'title',
         [
            'label' => __( 'Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT
         ]
      );

      $this->add_control(
         'counter',
         [
            'label' => __( 'Counter', 'amike' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $counter->get_controls(),
            'title_field' => '{{title}}',

         ]
      );

      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="container">
       <div class="row">
        <?php foreach (  $settings['counter'] as $counter_single ): ?>
           <div class="col-lg-3 col-sm-6">
              <div class="counter text-center">
                <i class="<?php echo esc_attr($counter_single['icon']) ?> fa-fw" aria-hidden="true"></i>
                <h2 class="count"><?php echo $counter_single['count'] ?></h2>
                <span><?php echo $counter_single['title'] ?></span>
              </div>
           </div>
        <?php endforeach; ?>
       </div>
      </div>

      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Counter );