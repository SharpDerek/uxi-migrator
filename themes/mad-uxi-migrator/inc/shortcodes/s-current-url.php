<?php

$UXi_Shortocode_Current_URL = new UXi_Shortocode_Current_URL;

class UXi_Shortocode_Current_URL {

    public function __construct() {
        add_shortcode('uxi_current_url', array($this, 'shortcode'));
    }

    public function shortcode($atts) {
        $defaults = array(
            'query_string' => false,
        );
        $atts = shortcode_atts($defaults, $atts);

        return uxi_get_current_url($atts['query_string']);
    }
}
