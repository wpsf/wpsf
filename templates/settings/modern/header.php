<header class="wpsf-header <?php echo $class->is_sticky_header(); ?>">

    <h1><?php echo $title; ?></h1>

    <fieldset>
        <?php
        if( $is_ajax === TRUE ) {
            echo '<span id="wpsf-save-ajax">' . esc_html__("Settings Saved", 'flexile-wp-wp') . '</span>';
        }

        echo $class->get_settings_buttons();
        ?>
    </fieldset>
    <?php
    echo ( empty ($class->has_nav()) ) ? '<a href="#" class="wpsf-expand-all"><i class="fa fa-eye-slash"></i> ' . esc_html__('show all options', 'flexile-wp-wp') . '</a>' : '';
    echo '<div class="clear"></div>';
    ?>
</header>