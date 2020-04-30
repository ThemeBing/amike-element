<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// banner
class amike_Widget_Banner extends Widget_Base {
 
   public function get_name() {
      return 'banner';
   }
 
   public function get_title() {
      return esc_html__( 'Banner', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-banner';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'banner_section',
         [
            'label' => esc_html__( 'Banner Image', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'amike' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
         ]
      );

      $this->add_control(
         'play_button',
         [
            'label' => __( 'Play Button URL', 'amike' ),
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
         'text',
         [
            'label' => __( 'Text', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,

         ]
      );

      $this->add_control(
         'button',
         [
            'label' => __( 'Button Text', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Explore Portfolio'
         ]
      );

      $this->add_control(
         'button_url',
         [
            'label' => __( 'Button URL', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
         ]
      );

      $this->add_control(
         'video_url',
         [
            'label' => __( 'Video URL', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
         ]
      );

      $social = new \Elementor\Repeater();

      $social->add_control(
         'social_icon', [
            'label' => __( 'Icon', 'amike' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'default' => 'fa fa-facebook'
         ]
      );

      $social->add_control(
         'social_url', [
            'label' => __( 'URL', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#'
         ]
      );

      $this->add_control(
         'social',
         [
            'label' => __( 'Repeater List', 'amike' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $social->get_controls(),
            'default' => [
               [
                  'social_icon' => 'fa fa-facebook',
                  'social_url' => '#'
               ],
               [
                  'social_icon' => 'fa fa-twitter',
                  'social_url' => '#'
               ],
               [
                  'social_icon' => 'fa fa-linkedin',
                  'social_url' => '#'
               ]
            ]
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'image', 'basic' );
      $this->add_inline_editing_attributes( 'play_button', 'basic' );
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'text', 'basic' );
      $this->add_inline_editing_attributes( 'button', 'basic' );
      $this->add_inline_editing_attributes( 'button_url', 'basic' );
      ?>
      <div class="banner">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-lg-7">
                  <ul class="list-inline social">
                     <?php 
                        foreach (  $settings['social'] as $index => $social_profile ) { ?>
                        <li class="list-inline-item"><a href="<?php echo esc_url( $social_profile['social_url'] ) ?>"><i class="<?php echo esc_attr($social_profile['social_icon']) ?>"></i></a></li>
                     <?php 
                     } ?>
                  </ul>
                  <div class="align-middle">
                     <h1 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html($settings['title']); ?></h1>
                     
                     <p <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo esc_html($settings['text']); ?></p>
                     
                     <ul class="list-inline">
                        <?php if ($settings['button']): ?>
                           <li class="list-inline-item"><a <?php echo $this->get_render_attribute_string( 'button' ); ?> href="<?php echo esc_url($settings['button_url']); ?>"><?php echo esc_html($settings['button']); ?>
                           </a></li>
                        <?php endif ?>
                        <?php if ($settings['video_url']): ?>
                        <li class="list-inline-item"><a class="play-btn popup-video" <?php echo $this->get_render_attribute_string( 'button' ); ?> href="<?php echo esc_url($settings['video_url']); ?>"><i class="fa fa-play"></i>
                        </a></li>
                        <?php endif ?>                        
                     </ul>
                  </div>
               </div>
               <div class="col-lg-5">
                  <?php if ($settings['image']['id']): ?>
                  <div class="about_me_image">
                     <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
                  </div>
                  <?php endif ?>
               </div>
            </div>
         </div>
      </div>


      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Banner );