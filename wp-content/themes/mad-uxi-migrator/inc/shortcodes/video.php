<?php

$UXi_Shortcode_Video = new UXi_Shortcode_Video;

class UXi_Shortcode_Video {
    public function __construct() {
        add_shortcode('uxi_video', array($this, 'video_shortcode'));
    }

    /**
     * Use the following YouTube and Vimeo shortcodes for videos for fluid videos
     * @link http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
     * @link graphicbeacon.com/web-design-development/embed-an-iframe-into-a-post-or-page-without-using-a-plugin/
     * [uxi_video id='100902001' type='vimeo' ratio='16by9' size='300' center='true']
     */
    function video_shortcode($atts) {
        $defaults = array(
            'id'              => '100902001',
            'type'            => 'vimeo', // vimeo or youtube
            'ratio'           => '16by9', // 16by9 or 4by3
            'size'            => '', // pixels
            'center'          => 'false',
            'related'         => 'false',
            'remove_branding' => 'false',
        );
        $atts = shortcode_atts($defaults, $atts);


        $params = '';
        if ( $atts['remove_branding'] == 'true' ) {
            if ( $atts['type'] == 'youtube' ) {
                $params .= '?controls=1&modestbranding=1';
            } elseif ( $atts['type'] == 'vimeo' ) {
                $params .= '?title=0&byline=0&portrait=0';
            }
        }

        $attributes = '';

        $url = '';
        if ( $atts['type'] == 'youtube' ) {
            $rel = ( $atts['related'] == 'false' ) ? 'rel=0' : 'rel=1';
            if ( $params ) {
                $params .= "&{$rel}";
            } else {
                $params .= "?{$rel}";
            }
            $url = 'https://www.youtube.com/embed/' . $atts['id'] . '' . $params;
            $attributes = 'allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen';
        } elseif ( $atts['type'] == 'vimeo' ) {
            $url = 'https://player.vimeo.com/video/' . $atts['id'] . '' . $params;
            $attributes = 'webkitallowfullscreen mozallowfullscreen allowfullscreen';
        }

        $size_style = (!empty($atts['size'])) ? ' style="max-width:'.absint($atts['size']).'px"' :  '';
        $center_class = ( $atts['center'] == 'true' ) ? ' is-centered' : '';

        return '<div class="video flex-embed-wrap'. esc_attr($center_class) .'"'. $size_style .'><div class="flex-embed '. esc_attr("{$atts['type']} _{$atts['ratio']}").'"><iframe src="'.esc_url($url).'" frameborder="0" width="560" height="315" '.$attributes.'></iframe></div></div>';
    }
}
