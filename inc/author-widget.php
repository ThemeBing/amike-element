<?php
/**
 * Add Recent Post Widget.
 * @package amike
 */
if( !class_exists('amike_Author') ){
	class amike_Author extends WP_Widget{
		/**
		 * Register widget with WordPress.
		 */
		function __construct(){

			$widget_options = array(
				'description'					=> esc_html__('Amike author here', 'amike'), 
				'customize_selective_refresh' 	=> true,
			);

			parent:: __construct('amike_Author', esc_html__( 'Author : amike', 'amike'), $widget_options );

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
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'About Author','amike' );
		$profile_image = ( ! empty( $instance['profile_image'] ) ) ? $instance['profile_image'] : '';
		$short_description = ( ! empty( $instance['short_description'] ) ) ? $instance['short_description'] : esc_html__( 'There are many variations of passages of Lorem Ipsum available, but the majority suffered','amike' );
		$facebook = ( ! empty( $instance['facebook'] ) ) ? $instance['facebook'] : '#';
		$twitter = ( ! empty( $instance['twitter'] ) ) ? $instance['twitter'] : '#';
		$pinterest = ( ! empty( $instance['pinterest'] ) ) ? $instance['pinterest'] : '#';
		$linkedin = ( ! empty( $instance['linkedin'] ) ) ? $instance['linkedin'] : '#';
		
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );


			echo $args['before_widget']; ?>

            <div class="author-widget text-center">
            	<?php if ( $title ): ?>
			    <h5>
			    	<?php echo esc_attr( $title );   ?>
			 	</h5>
				<?php endif; ?>
				
            	<?php if ($profile_image): ?>
		    	<div class="author-widget-thumb mb-30 text-center">
		            <img src="<?php echo esc_url( $profile_image ) ?>" alt="<?php echo esc_attr( $title ); ?>">
		        </div>
		    	<?php endif ?>
            	
                <p><?php echo esc_html( $short_description ) ?></p>
                <div class="author-widget-social">
                    <ul class="list-inline mb-0">
			            <li class="list-inline-item"><a href="<?php echo esc_url( $facebook ) ?>"><i class="fa fa-facebook-f"></i></a></li>
			            <li class="list-inline-item"><a href="<?php echo esc_url( $twitter ) ?>"><i class="fa fa-twitter"></i></a></li>
			            <li class="list-inline-item"><a href="<?php echo esc_url( $pinterest ) ?>"><i class="fa fa-pinterest-p"></i></a></li>
			            <li class="list-inline-item"><a href="<?php echo esc_url( $linkedin ) ?>"><i class="fa fa-linkedin"></i></a></li>
			        </ul>
                </div>
            </div>
            
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
			$instance['profile_image'] = sanitize_text_field( $new_instance['profile_image'] );
			$instance['short_description'] = sanitize_text_field( $new_instance['short_description'] );
			$instance['facebook'] = sanitize_text_field( $new_instance['facebook'] );
			$instance['twitter'] = sanitize_text_field( $new_instance['twitter'] );
			$instance['pinterest'] = sanitize_text_field( $new_instance['pinterest'] );
			$instance['linkedin'] = sanitize_text_field( $new_instance['linkedin'] );
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
		$profile_image     = isset( $instance['profile_image'] ) ? esc_attr( $instance['profile_image'] ) : '';
		$short_description     = isset( $instance['short_description'] ) ? esc_attr( $instance['short_description'] ) : '';
		$facebook     = isset( $instance['facebook'] ) ? esc_attr( $instance['facebook'] ) : '';
		$twitter     = isset( $instance['twitter'] ) ? esc_attr( $instance['twitter'] ) : '';
		$pinterest     = isset( $instance['pinterest'] ) ? esc_attr( $instance['pinterest'] ) : '';
		$linkedin     = isset( $instance['linkedin'] ) ? esc_attr( $instance['linkedin'] ) : ''; 
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:','amike' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
	        <label for="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>"><?php echo esc_html__( 'Profile image:','amike' ); ?></label>
	        <img class="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>_img" src="<?php echo esc_url($profile_image); ?>" style="margin:0;padding:0;max-width:100%;display:block"/>
	        <input type="text" class="widefat <?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>_url" name="<?php echo esc_attr($this->get_field_name( 'profile_image' )); ?>" value="<?php echo esc_attr($profile_image); ?>" style="margin-top:5px;" />
	        <input type="button" id="<?php echo esc_attr($this->get_field_id( 'profile_image' )); ?>" class="button button-primary js_custom_upload_media" value="Upload Image" style="margin-top:5px;" />
	    </p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'short_description' )); ?>"><?php echo esc_html__( 'Short description:','amike' ); ?></label>
			<textarea class="widefat" rows="5" cols="30" id="<?php echo esc_attr($this->get_field_id( 'short_description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'short_description' )); ?>"><?php echo stripslashes( $short_description ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php echo esc_html__( 'Facebook:','amike' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php echo esc_html__( 'Twitter:','amike' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>"><?php echo esc_html__( 'Pinterest:','amike' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>"><?php echo esc_html__( 'Linkedin:','amike' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" />
		</p>

	<?php
		}
	}
}



// register Contact  Widget widget
function amike_Author(){
	register_widget('amike_Author');
}
add_action('widgets_init','amike_Author');