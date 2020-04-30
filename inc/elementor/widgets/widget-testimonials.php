<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Testimonials
class amike_Widget_Testimonials extends Widget_Base {
 
   public function get_name() {
      return 'testimonials';
   }
 
   public function get_title() {
      return esc_html__( 'Testimonials', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-testimonial';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'testimonials_section',
         [
            'label' => esc_html__( 'Testimonials', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $repeater = new \Elementor\Repeater();
      $repeater->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'amike' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src()
            ]
         ]
      );
      
      $repeater->add_control(
         'name',
         [
            'label' => __( 'Name', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Emaley Mcculloch', 'amike' ),
            
         ]
      );
      $repeater->add_control(
         'designation',
         [
            'label' => __( 'Designation', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Founder ceo', 'amike' ),
         ]
      );
      $repeater->add_control(
         'testimonial',
         [
            'label' => __( 'Testimonial', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'In promotion and of advertising testimonial show consiss of a person\'s written orsoken statement extollig the virtue', 'amike' ),
         ]
      );
      $repeater->add_control(
        'rating',
        [
          'label' => __( 'Rating', 'amike' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => 1,
          'options' => [
            1 => __( 'Star 1', 'amike' ),
            2 => __( 'Star 2', 'amike' ),
            3 => __( 'Star 3', 'amike' ),
            4 => __( 'Star 4', 'amike' ),
            5 => __( 'Star 5', 'amike' ),
            'none' => __( 'None', 'amike' ),
          ]
        ]
      );
      $this->add_control(
         'testimonial_list',
         [
            'label' => __( 'Testimonial List', 'amike' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{name}}',
         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'image', 'basic' );
      $this->add_inline_editing_attributes( 'name', 'basic' );
      $this->add_inline_editing_attributes( 'designation', 'basic' );
      $this->add_inline_editing_attributes( 'testimonial', 'basic' );
      ?>


      <div class="testimonial">
          <?php foreach (  $settings['testimonial_list'] as $testimonial_single ): ?>
          <div class="testimonial-item">
              <div class="testimonial-content">
                  <p>“<?php echo esc_html($testimonial_single['testimonial']); ?>”</p>
                  <?php if ('none'!==$testimonial_single['rating']): ?>
                    <div class="testimonial-rating">
                      <?php for ($i = 1; $i <= $testimonial_single['rating']; $i++) {
                        echo '<i class="fa fa-star"></i>';
                      } ?>
                    </div>
                  <?php endif ?>                  
              </div>
              <div class="testimonial-avatar">
                  <div class="testimonial-avatar-img">
                      <img src="<?php echo esc_url($testimonial_single['image']['url']) ?>" alt="img">
                  </div>
                  <div class="testimonial-avatar-info">
                      <h5><?php echo esc_html($testimonial_single['name']); ?></h5>
                      <span><?php echo esc_html($testimonial_single['designation']); ?></span>
                  </div>
              </div>
          </div>
        <?php endforeach; ?>
      </div>

      <?php
   }
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Testimonials );