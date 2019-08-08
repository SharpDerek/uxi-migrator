<?php

/**
 * Columns Shortcode
 * This is for CSS columns.
 */

$UXi_Shortcode_Columns = new UXi_Shortcode_Columns;

class UXi_Shortcode_Columns {

    function __construct() {
        add_shortcode('columns_open', array($this, 'columnsOpen'));
        add_shortcode('columns_close', array($this, 'columnsClose'));
    }

    // Begin column wrapper.
    public function columnsOpen($atts) {

        $defaults = array(
            'class'   => '',
            'palm'    => '',
            'tablet'  => '',
            'desktop' => '',
        );
        $atts = shortcode_atts($defaults, $atts);

        $colPalm    = ($this->columnsCount($atts['palm'])) ? "columns-palm-{$this->columnsCount($atts['palm'])} " : "";
        $colTablet  = ($this->columnsCount($atts['tablet'])) ? "columns-tab-{$this->columnsCount($atts['tablet'])} " : "";
        $colDesktop = ($this->columnsCount($atts['desktop'])) ? "columns-desk-{$this->columnsCount($atts['desktop'])} " : "";

        return "<div class=\"" . esc_attr(trim("{$colPalm}{$colTablet}{$colDesktop}{$atts['class']}")) . "\">";
    }

    // Close column wrapper.
    public function columnsClose() {
        return "</div>";
    }

    // Check if column number is valid. Return number if true else return false.
    public function columnsCount($num) {
        $numbers = array('2', '3', '4');
        if (in_array($num, $numbers)) {
            return $num;
        } else {
            return false;
        }
    }
}
