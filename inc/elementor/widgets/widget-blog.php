<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// blog
class amike_Widget_Blog extends Widget_Base {
 
   public function get_name() {
      return 'blog';
   }
 
   public function get_title() {
      return esc_html__( 'Latest Blog', 'amike' );
   }
 
   public function get_icon() { 
        return 'eicon-posts-carousel';
   }
 
   public function get_categories() {
      return [ 'amike-elements' ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'blog_section',
         [
            'label' => esc_html__( 'Blog', 'amike' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'order',
         [
            'label' => __( 'Order', 'amike' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'ASC',
            'options' => [
               'ASC'  => __( 'Ascending', 'amike' ),
               'DESC' => __( 'Descending', 'amike' )
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
      
      <div class="container">
         <div class="row justify-content-center">
               <?php
               $blog = new \WP_Query( array( 
                  'post_type' => 'post',
                  'posts_per_page' => 3,
                  'ignore_sticky_posts' => true,
                  'order' => $settings['order'],
               ));
               /* Start the Loop */
               while ( $blog->have_posts() ) : $blog->the_post(); ?>
              <div class="col-lg-4 col-md-6">
                <div class="blog-item mb-50">
                  <?php if (has_post_thumbnail()): ?>
                    <div class="blog-thumb">
                        <a href="<?php the_permalink() ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(),'amike-404x279'); ?>" alt="<?php the_title() ?>"></a>
                    </div>
                  <?php endif ?>
                    
                  <div class="blog-content s-blog-content">
                      <div class="blog-meta mb-15">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                              <i class="fa fa-user"></i><?php echo esc_html__( 'By','amike' ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php the_author(); ?></a>
                            </li>
                            <li class="list-inline-item"><i class="fa fa-calendar-o"></i><?php echo get_the_date('l') ?></li>
                            <li class="list-inline-item"><i class="fa fa-comments"></i><?php echo get_comments_number() ?></li>                            
                        </ul>
                      </div>
                      <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                      <a href="<?php the_permalink(); ?>"><?php echo esc_html__( 'Read More', 'amike' ); ?><i class="fa fa-fw fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>

              <?php endwhile; wp_reset_postdata(); ?>
         </div>
      </div>

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new amike_Widget_Blog );