<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// portfolio
class amike_Widget_Portfolio extends Widget_Base {
 
   public function get_name() {
      return 'portfolio';
   }
 
   public function get_title() {
      return esc_html__( 'portfolio', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-gallery-masonry';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'portfolio_section',
         [
            'label' => esc_html__( 'portfolio', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'ppp',
         [
            'label' => __( 'number of portfolio', 'amike' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
               'no' => [
                  'min' => 0,
                  'max' => 100,
                  'step' => 1,
               ],
            ],
            'default' => [
               'size' => 9,
            ]
         ]
      );

      $this->add_control(
         'order',
         [
            'label' => __( 'order', 'amike' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'ASC',
            'options' => [
               'ASC'  => __( 'ascending', 'amike' ),
               'DESC' => __( 'descending', 'amike' )
            ],
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display();
      
      //Inline Editing
      $this->add_inline_editing_attributes( 'ppp', 'basic' );
      ?>

      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="portfolio-filter">
                  <ul class="list-inline">
                     <li class="select-cat list-inline-item active" data-filter="*"><?php echo esc_html__( 'All Works', 'amike' ) ?></li>
                     <?php  $portfolio_menu_terms = get_terms( array(
                         'taxonomy' => 'portfolio_category',
                         'hide_empty' => false,  
                     ) ); 
                     
                     foreach ( $portfolio_menu_terms as $portfolio_menu_term ) { ?>
                     <li class="list-inline-item" data-filter=".<?php echo esc_attr( $portfolio_menu_term->slug ) ?>"><?php echo esc_html( $portfolio_menu_term->name ) ?></li>

                     <?php } ?>
                  </ul>
               </div>
            </div>
            <div class="col-sm-12">
               <div class="isotope_items row">
               <?php

               $portfolio = new \WP_Query( array( 
                  'post_type' => 'portfolio',
                  'posts_per_page' => $settings['ppp']['size'],
                  'order' => $settings['order'],
               ));

               /* Start the Loop */
               while ( $portfolio->have_posts() ) : $portfolio->the_post(); 

                 $portfolio_terms = get_the_terms( get_the_ID() , 'portfolio_category' );

               ?>
                  <!-- Item -->
                  <a href="<?php echo get_the_post_thumbnail_url(); ?>" class="col-md-4 col-sm-4 col-xs-6 single_item <?php foreach ($portfolio_terms as $portfolio_term) { echo esc_attr( $portfolio_term->slug ); } ?>" data-source="<?php echo get_the_post_thumbnail_url(); ?>" title="<?php the_title_attribute() ?>">
                     <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title() ?>">
                     <div class="single_item_content">
                        <span><?php foreach ($portfolio_terms as $portfolio_term) { echo esc_attr( $portfolio_term->name ); } ?></span>
                        <?php the_title( '<h6>', '</h6>' ) ?>
                     </div>
                  </a>

               <?php 
               endwhile; 
               wp_reset_postdata();
            ?>
               </div>
            </div>
         </div>
      </div>

      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Portfolio );