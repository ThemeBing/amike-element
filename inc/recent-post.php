<?php
/**
 * Add Recent Post Widget.
 * @package amike
 */
if( !class_exists('amike_Recent_Post') ){
	class amike_Recent_Post extends WP_Widget{
		/**
		 * Register widget with WordPress.
		 */
		function __construct(){

			$widget_options = array(
				'description'					=> esc_html__('Amike recent post here', 'amike'), 
				'customize_selective_refresh' 	=> true,
			);

			parent:: __construct('amike_Recent_Post', esc_html__( 'Recent Post : amike', 'amike'), $widget_options );

		}
		
		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget($args, $instance){

			if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts','amike' );
		
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$show_item = ( ! empty( $instance['show_item'] ) ) ? absint( $instance['show_item'] ) : 3;


			echo $args['before_widget']; 
			if ( $title ): 
		    echo $args['before_title'];  
			echo esc_attr( $title );  
		 	echo $args['after_title']; 
			endif;

				$posts = new WP_Query(array(
					'post_type'      => 'post',
					'posts_per_page' => $show_item,
					'ignore_sticky_posts' => true,
				));

				?>

                <ul class="sidebar-recent-post">
					<?php while($posts->have_posts()) : $posts->the_post();  ?>
                    <li>
                    	<?php if (has_post_thumbnail( )): ?>
                    	<div class="recent-post-thumb">
                            <a href="<?php the_permalink() ?>">
                            	<?php the_post_thumbnail( 'amike-80x80' ); ?>
                            </a>
                        </div>
                    	<?php endif ?>
                        <div class="recent-post-content">
                            <p>
                            	<a href="<?php the_permalink() ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
                            </p>
                            <span><?php the_date() ?></span>
                        </div>
                    </li>
					<?php endwhile; ?>
                </ul>

			<?php echo $args['after_widget']; ?>
			
			<?php wp_reset_postdata();
		}
		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
			$instance['show_item'] = (int) $new_instance['show_item'];
			return $instance;
		}

	 	/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */

		public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$show_item    = isset( $instance['show_item'] ) ? absint( $instance['show_item'] ) : 4;
	?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:','amike' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_item' )); ?>"><?php echo esc_html__( 'No. of Item of posts to show:','amike' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr(esc_attr($this->get_field_id( 'show_item' ))); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_item' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($show_item); ?>" size="3" />
		</p>

	<?php
		}
	}
}



// register Contact  Widget widget
function amike_Recent_Post(){
	register_widget('amike_Recent_Post');
}
add_action('widgets_init','amike_Recent_Post');