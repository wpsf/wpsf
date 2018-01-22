</div>
<div class="wpsf-sections">
    <div class="wpsf-simple-footer">
        <?php
        if( $is_ajax === TRUE ) {
            echo '<span id="wpsf-save-ajax">' . esc_html__("Settings Saved", 'flexile-wp-wp') . '</span>';
        }
        echo $class->get_settings_buttons(); ?>
    </div>
</div>
</div>
</div>
</div>
</div>