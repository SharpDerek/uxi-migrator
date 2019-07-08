<?php


new UXI_SEO_Dynamic_Content();

/**
 * This class contains methods for helping to minimize the number of landing pages that have to be built by
 * replacing words wrapped in tags like {kw1} with the value of a query string parameter key of the same name as
 * the tag. The tags must be prefixed with 'kw' to function and can only be used in specific widget settings and
 * the post content. When writing html, the words must be wrapped in an element classed with a prefix of
 * 'm360dc-kw', for example 'class="m360dc-kw1"'.
 *
 * Dynamic Content will not work with the Jumbotron 2's multiple headings when using the typed effect.
 * Slide and fade work fine.
 *
 * @since 2.5.9
 * @author Kyle Geminden <kyle@madwire.com>
 */
class UXI_SEO_Dynamic_Content {

    public function __construct() {
        // the higher priority number ensures the filter runs after the shortcodes are rendered
        add_filter( 'the_content', [ $this, 'filter_post_content' ], 100 );
        add_filter( 'wp_nav_menu_items', [ $this, 'filter_nav_menu_items' ] );
    }

    /**
     * Searches a string and replaces all tags with spans. So {kw1}City Name{/kw1} would become
     * <span class="m360dc-kw1>City Name</span>.
     * @since 2.5.9
     * @author Kyle Geminden <kyle@madwire.com>
     * @used-by uxi_dynamic_content()
     * @used-by UXI_SEO_Dynamic_Content::filter_post_content()
     * @used-by UXI_SEO_Dynamic_Content::filter_nav_menu_items()
     * @param string $content
     * @return null|string
     */
    public static function render_tags( $content ) {

        if ( is_string( $content ) ) {

            $pattern = '/(\{kw(\d+)\})(.*?)(\{\/kw(\d+)\})/m';

            $replaced_content = preg_replace( $pattern, '<span class="m360dc-kw${2}">${3}</span>', $content );

            return ! is_null( $replaced_content ) /* && uxi_is_live() */ ? $replaced_content : $content;
        }

        return $content;
    }

    /**
     * Renders the dynamic content tags in the post content.
     * @since 2.5.9
     * @author Kyle Geminden <kyle@madwire.com>
     * @see https://developer.wordpress.org/reference/hooks/the_content/
     * @uses UXI_SEO_Dynamic_Content::render_tags()
     * @param string $content
     * @return null|string
     */
    public function filter_post_content( $content ) {

        $content = self::render_tags( $content );

        return $content;
    }

    /**
     * Renders the dynamic content tags in the navigation menu items.
     * @since 2.5.9
     * @author Kyle Geminden <kyle@madwire.com>
     * @see https://developer.wordpress.org/reference/hooks/wp_nav_menu_items/
     * @uses UXI_SEO_Dynamic_Content::render_tags()
     * @param string $items
     * @return null|string
     */
    public function filter_nav_menu_items( $items ) {

        $items = self::render_tags( $items );

        return $items;
    }
}

/**
 * Helper function rendering dynamic content tags.
 * @since 2.5.9
 * @author Kyle Geminden <kyle@madwire.com>
 * @uses UXI_SEO_Dynamic_Content::render_tags()
 * @param string $content
 * @return null|string
 */
function uxi_dynamic_content( $content ) {
    return UXI_SEO_Dynamic_Content::render_tags( $content );
}
