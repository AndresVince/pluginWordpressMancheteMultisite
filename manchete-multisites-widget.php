<?php
/*
 * Adiciona Widget
 */

 //  Usa o action hook 'admin_menu', roda a função 'mmp_Adiciona_Admin_Link()'

 function manchetemultisite_registra_widget() {
    register_widget( 'manchetemultisite_widget' );
    }
add_action( 'widgets_init', 'manchetemultisite_registra_widget' );

class manchetemultisite_widget extends WP_Widget {
   
    function __construct() {
        parent::__construct(
        // widget ID
        'manchetemultisite_widget',
        // widget name
        __('Manchete Multisite', 'manchetemultisite_widget_domain'),
        // widget description
        array( 'description' => __( 'Seleciona posts de uma categoria atráves dos subsites e retorna o(s) mais recente(s).', 'manchetemultisite_widget_domain' ), )
        );
        }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $manchecat1 = apply_filters( 'widget_title', $instance['categoria1'] );
        $manchecat2 = apply_filters( 'widget_title', $instance['categoria2'] );
        $manchecat3 = apply_filters( 'widget_title', $instance['categoria3'] );
        $manchecat4 = apply_filters( 'widget_title', $instance['categoria4'] );
        $manchecat5 = apply_filters( 'widget_title', $instance['categoria5'] );
        $manchelayout = apply_filters( 'widget_title', $instance['layout'] );
        $mancheposts = apply_filters( 'widget_title', $instance['nposts'] );
        $somaisnovo = apply_filters( 'widget_title', $instance['sonovo'] );
        $manchecats = array ($manchecat1, $manchecat2, $manchecat3, $manchecat4, $manchecat5);
        echo $args['before_widget'];
        //verifica se tem titulo
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        //saida
        chamamanchete( $manchecats, $manchelayout, $mancheposts, $somaisnovo);
        // echo __( 'aloouuu', 'manchetemultisite_widget_domain' );
        echo $args['after_widget'];
        }

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
        $title = $instance[ 'title' ];
        else
        $title = __( 'Manchete Multisite', 'manchetemultisite_widget_domain' );
        if ( isset( $instance[ 'categoria1' ] ) )
        $manchecat1 = $instance[ 'categoria1' ];
        else
        $manchecat1 = __( 'digite a categoria', 'manchetemultisite_widget_domain' );
        if ( isset( $instance[ 'categoria2' ] ) )
        $manchecat2 = $instance[ 'categoria2' ];
        else
        $manchecat2 = __( '888888', 'manchetemultisite_widget_domain' );
        if ( isset( $instance[ 'categoria3' ] ) )
        $manchecat3 = $instance[ 'categoria3' ];
        else
        $manchecat3 = __( '888888', 'manchetemultisite_widget_domain' );
        if ( isset( $instance[ 'categoria4' ] ) )
        $manchecat4 = $instance[ 'categoria4' ];
        else
        $manchecat4 = __( '888888', 'manchetemultisite_widget_domain' );
        if ( isset( $instance[ 'categoria5' ] ) )
        $manchecat5 = $instance[ 'categoria5' ];
        else
        $manchecat5 = __( '888888', 'manchetemultisite_widget_domain' );
        if ( isset( $instance[ 'layout' ] ) )
        $manchelayout = $instance[ 'layout' ];
        else
        $manchelayout = __( '1, 2 ou 3', 'manchetemultisite_widget_domain' );
        if ( isset( $instance[ 'nposts' ] ) )
        $mancheposts = $instance[ 'nposts' ];
        else
        $mancheposts = __( '1', 'manchetemultisite_widget_domain' );
        if ( isset( $instance[ 'sonovo' ] ) )
        $somaisnovo = $instance[ 'sonovo' ];
        else
        $somaisnovo = __( 'nao', 'manchetemultisite_widget_domain' );

        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titulo:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'categoria1' ); ?>"><?php _e( 'Categoria 1 (site principal):' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'categoria1' ); ?>" name="<?php echo $this->get_field_name( 'categoria1' ); ?>" type="text" value="<?php echo esc_attr( $manchecat1 ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'categoria2' ); ?>"><?php _e( 'Categoria 2:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'categoria2' ); ?>" name="<?php echo $this->get_field_name( 'categoria2' ); ?>" type="text" value="<?php echo esc_attr( $manchecat2 ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'categoria3' ); ?>"><?php _e( 'Categoria 3:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'categoria3' ); ?>" name="<?php echo $this->get_field_name( 'categoria3' ); ?>" type="text" value="<?php echo esc_attr( $manchecat3 ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'categoria4' ); ?>"><?php _e( 'Categoria 4:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'categoria4' ); ?>" name="<?php echo $this->get_field_name( 'categoria4' ); ?>" type="text" value="<?php echo esc_attr( $manchecat4 ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'categoria5' ); ?>"><?php _e( 'Categoria 5:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'categoria4' ); ?>" name="<?php echo $this->get_field_name( 'categoria5' ); ?>" type="text" value="<?php echo esc_attr( $manchecat5 ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e( 'Layout:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" type="text" value="<?php echo esc_attr( $manchelayout ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'nposts' ); ?>"><?php _e( 'Nº de posts por categoria:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'nposts' ); ?>" name="<?php echo $this->get_field_name( 'nposts' ); ?>" type="text" value="<?php echo esc_attr( $mancheposts ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'sonovo' ); ?>"><?php _e( 'Só o mais atual?' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'sonovo' ); ?>" name="<?php echo $this->get_field_name( 'sonovo' ); ?>" type="text" value="<?php echo esc_attr( $somaisnovo ); ?>" />
        </p>
        <?php
        }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['categoria1'] = ( ! empty( $new_instance['categoria1'] ) ) ? strip_tags( $new_instance['categoria1'] ) : '99999';
        $instance['categoria2'] = ( ! empty( $new_instance['categoria2'] ) ) ? strip_tags( $new_instance['categoria2'] ) : '99999';
        $instance['categoria3'] = ( ! empty( $new_instance['categoria3'] ) ) ? strip_tags( $new_instance['categoria3'] ) : '99999';
        $instance['categoria4'] = ( ! empty( $new_instance['categoria4'] ) ) ? strip_tags( $new_instance['categoria4'] ) : '99999';
        $instance['categoria5'] = ( ! empty( $new_instance['categoria5'] ) ) ? strip_tags( $new_instance['categoria5'] ) : '99999';
        $instance['layout'] = ( ! empty( $new_instance['layout'] ) ) ? strip_tags( $new_instance['layout'] ) : '';
        $instance['nposts'] = ( ! empty( $new_instance['nposts'] ) ) ? strip_tags( $new_instance['nposts'] ) : '';
        $instance['sonovo'] = ( ! empty( $new_instance['sonovo'] ) ) ? strip_tags( $new_instance['sonovo'] ) : '';

        return $instance;
        }
}
