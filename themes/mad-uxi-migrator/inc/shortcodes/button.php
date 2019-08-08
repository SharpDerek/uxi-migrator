<?php

$UXi_Button_Shortcode = new UXi_Button_Shortcode;

class UXi_Button_Shortcode {

    public function __construct() {
        add_shortcode( "uxi_button", array($this, 'shortcode') );
    }

    // [uxi_button link="http://www.google.com" new_window="1" link_type="" class="button-27" padding_y="15" padding_x="25" icon="questions" icon_size="32" icon_size_mobile="24" icon_align="left" text="Primary Button Text" text_size="20" text_size_mobile="16" text_font="header-font" sub_text="Secondary Button Text " sub_text_size="16" sub_text_size_mobile="14" sub_text_font="body-font"]
    public function shortcode( $atts  ) {

        $defaults = array(
            'link'                 => '',
            'new_window'           => '', // 0/1
            'tel'                  => '', // 0/1 tel is now for backwards compatibility only, link_type should be used whenever possible.
            'link_type'            => '', // tel/sms empty string is a normal link
            'class'                => '',
            'padding_y'            => '', // vertical
            'padding_x'            => '', // horizontal
            'text'                 => '',
            'text_size'            => '',
            'text_size_mobile'     => '',
            'text_font'            => '', // header-font, sub-header-font, body-font
            'sub_text'             => '',
            'sub_text_size'        => '',
            'sub_text_size_mobile' => '',
            'sub_text_font'        => '', // header-font, sub-header-font, body-font
            'icon'                 => '', // see icon options list below
            'icon_size'            => '',
            'icon_size_mobile'     => '',
            'icon_align'           => '', // left, right, top
        );
        $atts = shortcode_atts($defaults, $atts);

        $link = trim($atts['link']);

        $styles = "";

        // See uxi/less/site/components/glyphicons.less for a full list of available icons.

        /**
         * Generate unique id for each shortcode use
         */

        STATIC $i = 0;
        $i++;
        $id = "button-id-$i";

        /**
         * CLASS
         */
        $buttonClass = (!empty($atts['class'])) ? " {$atts['class']}" : "";

        /**
         * Padding
         */
        $styles .= (intval($atts['padding_y']) >= 0 && intval($atts['padding_x']) >= 0) ? ".is-tablet-up #$id { padding: ".esc_html($atts['padding_y'])."px ".esc_html($atts['padding_x'])."px; }" : "";

        /**
         * LINK TARGET
         */

        $target = ($atts['new_window'] == '1' ) ? " target=\"_blank\"" : "";

        /**
         * TELEPHONE
         *
         * link_type was added in version 2.6.6
         * tel is now for backwards compatibility only
         */

        $linkHref = $link;
        if ( $atts['link_type'] === 'sms' ) {
            $linkHref = "sms:" . uxi_numchar_only( $link );
        } elseif ( $atts['link_type'] === 'tel' || $atts['tel'] == '1' ) {
            $linkHref = "tel:" . uxi_numchar_only( $link );
        } elseif ( $atts['link_type'] === 'email' ) {
            $linkHref = "mailto:" . $link;
        }

        /**
         * Permalink
         * If $link only contains post_id-123 then get the permalink of that post id number.
         * Note 'post_id-' has to be at the beginning of the string and only the id number after it as
         * well as at the end of the string otherwise it will not return the permalink.
         */

        if ($link && preg_match('/^(post_id-)(\d*)$/', $link)) {
            $pageLink = get_permalink(preg_replace('/^(post_id-)(\d*)$/', '$2', $link));
            $linkHref = $pageLink;
        }

        /**
         * TEXT
         */

        // set text size
        $styles .= (!empty($atts['text_size'])) ? "#$id { font-size: ".esc_html($atts['text_size'])."px; }" : "";
        // set mobile text size
        $styles .= (!empty($atts['text_size_mobile'])) ? ".is-phone #$id { font-size: ".esc_html($atts['text_size_mobile'])."px; }" : "";
        // set font class
        $textFont = (!empty($atts['text_font'])) ? " {$atts['text_font']}" : "";

        /**
         * SUB-TEXT
         */

        // set sub text font size
        $styles .= (!empty($atts['sub_text_size']) && !empty($atts['sub_text'])) ? "#$id .button-sub-text { font-size: ".esc_html($atts['sub_text_size'])."px; }" : "";
        // set mobile text font size
        $styles .= (!empty($atts['sub_text_size_mobile']) && !empty($atts['sub_text'])) ? ".is-phone #$id .button-sub-text { font-size: ".esc_html($atts['sub_text_size_mobile'])."px; }" : "";
        // set sub text font
        $subTextFont = (!empty($atts['sub_text_font'])) ? " {$atts['sub_text_font']}" : "";
        // set sub text
        $subTextItem = (!empty($atts['sub_text'])) ? '<span class="button-sub-text'.esc_attr($subTextFont).'">'.uxi_dynamic_content(esc_html($atts['sub_text'])).'</span>' : '';

        /**
         * ICON
         */

        // set icon alignment
        $iconAlign = "";
        if ( empty($atts['icon_align']) || $atts['icon_align'] == "left") {
            $iconAlign = " button-icon-is-left";
        } elseif ($atts['icon_align'] == "right") {
            $iconAlign = " button-icon-is-right";
        } elseif ($atts['icon_align'] == "top") {
            $iconAlign = " button-icon-is-top";
        }
        // set class if an icon is being used
        $buttonClass .= (!empty($atts['icon'])) ? " button-has-icon" : "";
        // set icon
        $iconItem = (!empty($atts['icon'])) ? '<span class="button-icon'.$iconAlign.'"><span class="icon-uxis-'.esc_attr($atts['icon']).'" aria-hidden="true"></span></span>' : '';
        // set icon size
        $styles .= (!empty($atts['icon_size'])) ? "#$id .button-icon [class*=\"icon-uxis-\"] { font-size: ".esc_html($atts['icon_size'])."px; }" : "";
        // set mobile icon size
        $styles .= (!empty($atts['icon_size_mobile'])) ? ".is-phone #$id .button-icon [class*=\"icon-uxis-\"] { font-size: ".esc_html($atts['icon_size_mobile'])."px; }" : "";

        /**
         * OUTPUT HTML
         */

        $output = "";

        $output .= (!empty($styles)) ? "<style>{$styles}</style>" : "";

        if (!empty($atts['icon']) && $atts['icon_align'] == 'right') {
            $output .= '<a id="'.$id.'" class="button'.esc_attr($buttonClass).'" href="'.esc_url($linkHref).'" '.$target.'><span class="button-inner"><span class="button-text-wrap'.esc_attr($iconAlign).'"><span class="button-text'.esc_attr($textFont).'">'.uxi_dynamic_content(esc_html($atts['text'])).'</span>'.$subTextItem.'</span>'.$iconItem.'</span></a>';
        } else {
            $output .= '<a id="'.$id.'" class="button'.esc_attr($buttonClass).'" href="'.esc_url($linkHref).'" '.$target.'><span class="button-inner">'.$iconItem.'<span class="button-text-wrap'.esc_attr($iconAlign).'"><span class="button-text'.esc_attr($textFont).'">'.uxi_dynamic_content(esc_html($atts['text'])).'</span>'.$subTextItem.'</span></span></a>';
        }

        return $output;
    }
}


