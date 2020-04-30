<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Pricing
class amike_Widget_Pricing extends Widget_Base {
 
   public function get_name() {
      return 'pricing';
   }
 
   public function get_title() {
      return esc_html__( 'Pricing', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-price-table';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'pricing_section',
         [
            'label' => esc_html__( 'Pricing', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Standard'
         ]
      );

      $this->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'amike' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'label_block' => true,
            'default' => 'fa fa-shield'
         ]
      );

      $this->add_control(
         'price',
         [
            'label' => __( 'Price', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '70'
         ]
      );
      
      $this->add_control(
         'currency',
         [
            'label' => __( 'Currency', 'amike' ),
            'type' => \Elementor\Controls_Manager::ICON,
            'default' => 'fa fa-dollar',
            'include' => [
               'fa fa-bitcoin',
               'fa fa-btc',
               'fa fa-cny',
               'fa fa-dollar',
               'fa fa-eur',
               'fa fa-euro',
               'fa fa-gbp',
               'fa fa-ils',
               'fa fa-inr',
               'fa fa-jpy',
               'fa fa-krw',
               'fa fa-money',
               'fa fa-rmb',
               'fa fa-rouble',
               'fa fa-rub',
               'fa fa-ruble',
               'fa fa-rupee',
               'fa fa-shekel',
               'fa fa-sheqel',
               'fa fa-try',
               'fa fa-turkish-lira',
               'fa fa-usd',
               'fa fa-won',
               'fa fa-yen',
            ],
         ]
      );

      $feature = new \Elementor\Repeater();

      $feature->add_control(
         'feature',
         [
            'label' => __( 'Feature', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( '10 Free Domain Names', 'amike' )
         ]
      );

      $this->add_control(
         'feature_list',
         [
            'label' => __( 'Feature List', 'amike' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $feature->get_controls(),
            'default' => [
               [
                  'feature' => __( '5GB Storage Space', 'amike' )
               ],
               [
                  'feature' => __( '20GB Monthly Bandwidth', 'amike' )
               ],
               [
                  'feature' => __( 'My SQL Databases', 'amike' )
               ],
               [
                  'feature' => __( '100 Email Account', 'amike' )
               ],
               [
                  'feature' => __( '10 Free Domain Names', 'amike' )
               ]
            ],
            'title_field' => '{{{ feature }}}'
         ]
      );

      $this->add_control(
         'btn_text',
         [
            'label' => __( 'Button Text', 'amike' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Purchase'
         ]
      );

      $this->add_control(
         'btn_url',
         [
            'label' => __( 'Button TRL', 'amike' ),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => __( 'https://example.com', 'amike' ),
            'show_external' => true,
            'default' => [
               'url' => '#',
               'is_external' => true,
               'nofollow' => true,
            ]
         ]
      );

      $this->add_control(
         'recommended',
         [
            'label' => __( 'Recommended', 'amike' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'On', 'amike' ),
            'label_off' => __( 'Off', 'amike' ),
            'return_value' => 'on',
            'default' => 'off',
         ]
      );

      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'title', 'basic' );
      $this->add_inline_editing_attributes( 'price', 'basic' );
      $this->add_inline_editing_attributes( 'btn_text', 'basic' );
      $this->add_inline_editing_attributes( 'btn_url', 'basic' );

      $target = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
      $nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';

      ?>

      <div class="amike-pricing-table <?php if ( 'on' == $settings['recommended'] ){ echo"recommended"; }?>">
         <h4 class="type elementor-inline-editing" <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html( $settings['title'] ); ?></h4>
         <div class="position-relative">
            <h1 class="amike-price elementor-inline-editing" <?php echo $this->get_render_attribute_string( 'price' ); ?>><?php echo esc_html( $settings['price'] ); ?>
            </h1>
            <span class="amike-currency <?php echo esc_attr($settings['currency']) ?>"></span>
         </div>
         <ul>
            <?php 
               foreach (  $settings['feature_list'] as $index => $feature ) { 
               $feature_inline = $this->get_repeater_setting_key( 'feature','feature_list',$index);
               $this->add_inline_editing_attributes( $feature_inline, 'basic' );
            ?>
               <li <?php echo $this->get_render_attribute_string( $feature_inline ); ?>><?php echo $feature['feature'] ?></li>
            <?php 
            } ?>
         </ul>
         <a class="elementor-inline-editing amike-btn bordered" href="<?php echo esc_attr( $settings['btn_url']['url'] ) ?>" <?php echo $this->get_render_attribute_string( 'btn_text' ); ?><?php echo esc_attr( $target ) . esc_attr( $nofollow ) ?>><?php echo esc_html( $settings['btn_text'] ) ?></a>
      </div>

      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Pricing );