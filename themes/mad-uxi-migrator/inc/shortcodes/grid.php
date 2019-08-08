<?php

/**
 * Grid Shortcodes
 */

$UXi_Shortcode_Grid = new UXi_Shortcode_Grid;

class UXi_Shortcode_Grid {

    function __construct() {
        add_shortcode('grid_row_open', array($this, 'rowOpen'));
        add_shortcode('grid_row_close', array($this, 'rowClose'));
        add_shortcode('grid_col_open', array($this, 'columnOpen'));
        add_shortcode('grid_col_close', array($this, 'columnClose'));
    }

    // Begin row.
    public function rowOpen($atts) {
        $defaults = array(
            'class' => ''
        );
        $atts = shortcode_atts($defaults, $atts);
        return "<div class=\"".esc_attr(trim("row {$atts['class']}"))."\">";
    }

    // Close row.
    public function rowClose() {
        return '</div>';
    }

    // Begin column.
    public function columnOpen($atts) {

        $defaults = array(
            'class'   => '',
            'palm'    => '',
            'tablet'  => '',
            'desktop' => '',
            'center'  => '', // desktop tablet palm
        );
        $atts = shortcode_atts($defaults, $atts);

        $phone    = ($this->columnWidth($atts['palm'])) ? "grid-palm-{$this->columnWidth($atts['palm'])} " : "";
        $tab      = ($this->columnWidth($atts['tablet'])) ? "grid-tab-{$this->columnWidth($atts['tablet'])} " : "";
        $desk     = ($this->columnWidth($atts['desktop'])) ? "grid-desk-{$this->columnWidth($atts['desktop'])} " : "";
        $centerOn = $this->columnCenter($atts['center']);

        return "<div class=\"".esc_attr(trim("{$phone}{$tab}{$desk}{$centerOn}{$atts['class']}"))."\">";
    }

    // Close column.
    public function columnClose() {
        return '</div>';
    }

    // Check if column width is valid. Return width if true else return false.
    public function columnWidth($percent) {
        $widths = array(
            '100%' => '12',
            '75%'  => '9',
            '66%'  => '8',
            '50%'  => '6',
            '33%'  => '4',
            '25%'  => '3',
        );
        if (array_key_exists($percent, $widths)) {
            return $widths[$percent];
        } else {
            return false;
        }
    }

    // Check if center device is valid. If true return class else return empty string.
    public function columnCenter($devices) {
        $devices = trim($devices);
        $devices = explode(' ', $devices);
        $classes = array(
            'palm'    => 'grid-palm-center',
            'tablet'  => 'grid-tab-center',
            'desktop' => 'grid-desk-center',
        );
        $centerOn = "";
        foreach ($devices as $device) {
            if (array_key_exists($device, $classes)) {
                $centerOn .= "{$classes[$device]} ";
            }
        }
        return $centerOn;
    }

}
