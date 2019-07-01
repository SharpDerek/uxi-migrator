<?php

$UXi_Shortcode_Gallery = new UXi_Shortcode_Gallery;

class UXi_Shortcode_Gallery {

    public function __construct() {

        // remove wordpress's gallery shortcode
        remove_shortcode('gallery');
        //add our gallery shortcode
        add_shortcode('gallery', array($this, 'gallery_shortcode'));

        add_action('print_media_templates', array($this, 'modal_media_template') );
    }

    /**
     * The Gallery shortcode.
     *
     * @author Kyle Geminden <kyle@madwire.com>
     * @param array $atts Attributes of the shortcode.
     * @return string HTML content to display gallery.
     */
    function gallery_shortcode($atts) {

        $defaults = array(
            'ids'             => '',
            'thumbnail_style' => 'none',
            'caption'         => 'none',
            'desktop_columns' => 3,
            'tablet_columns'  => 3,
            'palm_columns'    => 3
        );
        $atts = shortcode_atts( $defaults, $atts );

        /**
         * @var string $ids
         * @var string $thumbnail_style
         * @var string $caption
         * @var string $desktop_columns
         * @var string $tablet_columns
         * @var string $palm_columns
         */
        extract($atts);

        static $instance = 0;
        $instance++;

        if (!empty($ids)) {


            $feed = '';

            $selector = "gallery-{$instance}";
            $output = "";
            $output .= '<div id="'.esc_attr($selector).'" class="gallery galleryid-'.esc_attr($selector).' gallery-desk-'.esc_attr($desktop_columns).' gallery-tab-'.esc_attr($tablet_columns).' gallery-palm-'.esc_attr($palm_columns).'">';

            $post_ids = preg_replace('/\s+/', '', $ids);
            $post_ids = explode(',', $post_ids);

            $newQuery = new WP_Query( array(
                    'post_type'      => 'attachment',
                    'post_status'    => 'any',
                    'orderby'        => 'post__in',
                    'post__in'       => $post_ids,
                    'post_mime_type' => 'image',
                    'nopaging'       => true,
                )
            );

            // image style class
            if ($thumbnail_style === 'rounded') {
                $img_style = ' img-rounded';
            } elseif ($thumbnail_style === 'circle') {
                $img_style = ' img-circle';
            } elseif ($thumbnail_style === 'thumbnail' ) {
                $img_style = ' img-thumbnail';
            } else {
                $img_style = '';
            }

            // caption alignment
            if ($caption === 'left') {
                $caption_align = 'text-left';
            } elseif ($caption === 'center') {
                $caption_align = 'text-center';
            } else {
                $caption_align = '';
            }

            if ($newQuery->have_posts()) {

                $i = 0;

                $schema = [];

                while ($newQuery->have_posts()) {


                    $i++;

                    $newQuery->the_post();

                    global $post;

                    $id = $post->ID;

                    $caption_text = get_the_excerpt($id);
                    $has_caption = (!empty($caption_text) && $caption !== 'none') ? true : false;
                    $caption_classes = ($has_caption) ? "gallery-caption {$caption_align}" : "sr-only";

                    $thumb_style = ($has_caption && $thumbnail_style === 'thumbnail') ? '' : $img_style;
                    $image_large = wp_get_attachment_image_src($id, 'large');
                    $image_thumb = uxi_get_image($id, 'gallery_thumb', array('class' => "lazyload img-lazyload gallery-thumb $thumb_style"));

                    // column clear classes
                    if (($i % absint($desktop_columns) === 1) && ($i !== 1)) { $clear_desk = ' clear-desk'; } else { $clear_desk = ''; }
                    if (($i % absint($tablet_columns) === 1) && ($i !== 1)) { $clear_tab = ' clear-tab'; } else { $clear_tab = ''; }
                    if (($i % absint($palm_columns) === 1) && ($i !== 1)) { $clear_palm = ' clear-palm'; } else { $clear_palm = ''; }
                    $item_classes = preg_replace('/\s+/', ' ', "gallery-item $clear_desk $clear_tab $clear_palm");

                    // output gallery
                    $output .= '<figure class="'.trim($item_classes).'">';
                    $output .= ($has_caption && $thumbnail_style === 'thumbnail') ? '<div class="thumbnail">' : '';
                    $output .= '<a class="gallery-link" href="'.esc_url($image_large[0]).'" data-fancybox="'.esc_attr($selector).'" data-srcset="'.uxi_calculate_image_srcset($id, 'large').'" data-caption="'.esc_attr(uxi_kses_text($caption_text)).'" data-width="'.$image_large[1].'" data-height="'.$image_large[2].'">';
                    $output .= $image_thumb;
                    $output .= '</a>';
                    $output .= '<figcaption class="'.$caption_classes.'">' . uxi_kses_text($caption_text) .'</figcaption>';
                    $output .= ($has_caption && $thumbnail_style === 'thumbnail') ? '</div>' : '';
                    $output .= '</figure>';

                    // output feed
                    $feed .= wp_get_attachment_link($id, 'large', true) . "\n";

                    $thumb_data = wp_get_attachment_image_src($id, 'gallery_thumb');

                    $image_object = [
                        '@type'      => 'ImageObject',
                        'contentUrl' => $image_large[0],
                        'thumbnail'  => $thumb_data[0],
                    ];
                    if ($has_caption)
                        $image_object['caption'] = $caption_text;

                    $schema[] = $image_object;
                }
                wp_reset_postdata();

                UXI_SEO_Schema::add_webpage_item('associatedMedia', $schema);
            }

            $output .= '</div>';

            return (is_feed()) ? $feed : $output;
        }

        return null;
    }


    /**
     * Add custom settings to media manager modal
     * http://wordpress.stackexchange.com/questions/90114/enhance-media-manager-for-gallery
     */

    public function modal_media_template() {

        // define your backbone template;
        // the "tmpl-" prefix is required,
        // and your input field should have a data-setting attribute
        // matching the shortcode name
        ?>
        <script type="text/html" id="tmpl-uxi-custom-gallery-setting">
            <label class="setting">
                <span><?php _e('Thumbnail Style'); ?></span>
                <select data-setting="thumbnail_style">
                    <option value="none" selected>None</option>
                    <option value="rounded">Rounded</option>
                    <option value="circle">Circle</option>
                    <option value="thumbnail">Thumbnail</option>
                </select>
            </label>
            <label class="setting">
                <span><?php _e('Caption Display'); ?></span>
                <select data-setting="caption">
                    <option value="none" selected>None</option>
                    <option value="left">Text Align Left</option>
                    <option value="center">Text Align Center</option>
                </select>
            </label>
            <label class="setting">
                <span><?php _e('Desktop Columns'); ?></span>
                <select data-setting="desktop_columns">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3" selected>3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </label>
            <label class="setting">
                <span><?php _e('Tablet Columns'); ?></span>
                <select data-setting="tablet_columns">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3" selected>3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </label>
            <label class="setting">
                <span><?php _e('Palm Columns'); ?></span>
                <select data-setting="palm_columns">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3" selected>3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </label>
        </script>

        <script>

            jQuery(document).ready(function(){

                // merge default gallery settings template with yours
                wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
                    template: function(view){
                        return wp.media.template('uxi-custom-gallery-setting')(view);
                    }
                });

            });

        </script>
        <?php
    }
}
