<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// tab
class Amike_Widget_Tab extends Widget_Base {
 
   public function get_name() {
      return 'tab';
   }
 
   public function get_title() {
      return esc_html__( 'Tab', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-tabs';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'tab_section',
         [
            'label' => esc_html__( 'Tab', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $tab = new \Elementor\Repeater();
        
        $tab->start_controls_tabs( 'content_tabs' );

          $tab->start_controls_tab(
              'tab_content',
              [
                  'label' => __( 'Content', 'amike' ),
              ]
          );

            $tab->add_control(
               'title',
               [
                  'label' => __( 'Title', 'amike' ),
                  'type' => \Elementor\Controls_Manager::TEXT,
                  'default' => __( 'About me', 'amike' ),
                  
               ]
            );

            $tab->add_control(
              'content_source',
              [
                  'label'   => esc_html__( 'Select Content Source', 'amike' ),
                  'type'    => Controls_Manager::SELECT,
                  'default' => 'content',
                  'options' => [
                      'content'    => esc_html__( 'Content', 'amike' ),
                      "template" => esc_html__( 'Template', 'amike' ),
                  ],
              ]
            );

            $tab->add_control(
              'content',
              [
                  'label' => __( 'Content', 'amike' ),
                  'type' => Controls_Manager::WYSIWYG,
                  'title' => __( 'Content', 'amike' ),
                  'condition' => [
                      'content_source' =>'content',
                  ],
              ]
            );

            $tab->add_control(
              'template',
              [
                  'label'       => __( 'Template', 'amike' ),
                  'type'        => Controls_Manager::SELECT,
                  'default'     => '0',
                  'options'     => amike_get_elementor_template(),
                  'condition'   => [
                      'content_source' => "template"
                  ],
              ]
            );

          $tab->end_controls_tab();

          $tab->start_controls_tab(
              'tab_style',
              [
                  'label' => __( 'Style', 'amike' ),
              ]
          );

            $tab->add_control(
              'bg_color',
              [
                'label' => __( 'BG Color', 'amike' ),
                'type' => \Elementor\Controls_Manager::COLOR
              ]
            );

          $tab->end_controls_tab();

        $tab->end_controls_tabs();

      $this->add_control(
         'tab_list',
         [
            'label' => __( 'Tab List', 'amike' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $tab->get_controls(),
            'title_field' => '{{title}}',
         ]
      );

      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>
      
      <div class="amike-tab">
        
        <div class="nav" role="tablist">

          <?php foreach (  $settings['tab_list'] as $key => $tab_single ){ ?>
            <a class="nav-item nav-link <?php if($key == 0){echo'active';} ?>" id="<?php echo esc_attr( $key ) ?>-tab" data-toggle="tab" href="#tab-<?php echo esc_attr( $key ) ?>" role="tab" aria-controls="<?php echo esc_attr( $key ) ?>" aria-selected="<?php if($key == 0){echo'true';} ?>"><?php echo esc_html( $tab_single['title'] ) ?></a>
          <?php } ?>

        </div>

        <div class="tab-content">

          <?php foreach (  $settings['tab_list'] as $key => $tab_single ){ ?>

            <div class="tab-pane fade show <?php if($key == 0){echo'active';} ?>" id="tab-<?php echo esc_attr( $key ) ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $key ) ?>-tab" style="background-color: <?php echo esc_attr( $tab_single['bg_color'] ); ?>">

              <?php if ( $tab_single['content_source'] == 'content' ) {
              
                echo wp_kses_post( $tab_single['content'] );
                
              } elseif ( $tab_single['content_source'] == 'template' ){

                echo Plugin::instance()->frontend->get_builder_content_for_display( $tab_single['template'] );

              } ?>
            </div>

          <?php } ?>
          
        </div>

      </div>

      <?php
   }
}

Plugin::instance()->widgets_manager->register_widget_type( new Amike_Widget_Tab );