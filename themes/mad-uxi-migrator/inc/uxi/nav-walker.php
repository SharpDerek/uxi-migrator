<?php

/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * UXi_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */

class UXi_Nav_Walker extends Walker_Nav_Menu {

    private $menuItemID;

    function check_current($classes) {
        return preg_match('/(current[-_])|active|dropdown/', $classes);
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"dropdown-menu\" aria-labelledby=\"dropdown-toggle-{$this->menuItemID}\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

        $this->menuItemID = $item->ID;

        if ($item->is_dropdown) {
            $item_html = preg_replace('/<a (.*?)>(.*?)<\/a>/', '<a class="js-dropdown-toggle dropdown-toggle" id="dropdown-toggle-'.$item->ID.'" $1 role="button" aria-haspopup="true" aria-expanded="false"><span>$2</span><b class="caret"></b></a>', $item_html);
        }
        elseif (stristr($item_html, 'li class="dropdown-divider')) {
            $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
        }
        elseif (stristr($item_html, 'li class="dropdown-header')) {
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
        }
        elseif (stristr($item_html, 'li class="mobile-nav-divider')) {
            $item_html = preg_replace('/(.*?)/', '', $item_html);
        }
        elseif (stristr($item_html, 'li class="mobile-nav-header')) {
            $item_html = preg_replace('/(.*?)/', '', $item_html);
        } else {
            $item_html = preg_replace('/<a (.*?)>(.*?)<\/a>/', '<a $1><span>$2</span></a>', $item_html);
        }

        $item_html = apply_filters('uxi_nav_menu_item', $item_html);
        $output .= $item_html;
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        parent::start_el($item_html, $item, $depth, $args);
        if (
            stristr($item_html, 'li class="mobile-nav-header') ||
            stristr($item_html, 'li class="mobile-nav-divider')
        ) {
            $output .= "";
        } else {
            $output .= "</li>\n";
        }
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

        if ($element->is_dropdown) {
            $element->classes[] = 'js-dropdown dropdown';
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

class UXi_Mobile_Nav_Walker extends Walker_Nav_Menu {

    private $menuItemID;

    function check_current($classes) {
        return preg_match('/(current[-_])|active|dropdown/', $classes);
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"mobile-nav-dropdown-menu\" aria-labelledby=\"mobile-nav-dropdown-toggle-{$this->menuItemID}\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

        $this->menuItemID = $item->ID;

        if ($item->is_dropdown) {
            $item_html = preg_replace('/<a (.*?)>(.*?)<\/a>/', '<a class="js-dropdown-toggle mobile-nav-dropdown-toggle" id="mobile-nav-dropdown-toggle-'.$item->ID.'" $1 role="button" aria-haspopup="true" aria-expanded="false"><span>$2</span><b class="caret"></b></a>', $item_html);
        }
        elseif (stristr($item_html, 'li class="dropdown-divider')) {
            $item_html = preg_replace('/(.*?)/', '', $item_html);
        }
        elseif (stristr($item_html, 'li class="dropdown-header')) {
            $item_html = preg_replace('/(.*?)/', '', $item_html);
        }
        elseif (stristr($item_html, 'li class="mobile-nav-divider')) {
            $item_html = preg_replace('/<a[^>]*>.*?<\/a>/iU', '', $item_html);
        }
        elseif (stristr($item_html, 'li class="mobile-nav-header')) {
            $item_html = preg_replace('/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html);
        } else {
            $item_html = preg_replace('/<a (.*?)>(.*?)<\/a>/', '<a $1><span>$2</span></a>', $item_html);
        }

        $item_html = apply_filters('uxi_nav_menu_item', $item_html);
        $output .= $item_html;
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        parent::start_el($item_html, $item, $depth, $args);
        if (
            stristr($item_html, 'li class="dropdown-header') ||
            stristr($item_html, 'li class="dropdown-divider')
        ) {
            $output .= "";
        } else {
            $output .= "</li>\n";
        }
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

        if ($element->is_dropdown) {
            $element->classes[] = 'js-dropdown mobile-nav-dropdown';
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

class UXi_Menu_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

        if (stristr($item_html, 'li class="dropdown-divider')) {
            $item_html = preg_replace('/(.*?)/', '', $item_html);
        }
        elseif (stristr($item_html, 'li class="dropdown-header')) {
            $item_html = preg_replace('/(.*?)/', '', $item_html);
        }
        elseif (stristr($item_html, 'li class="mobile-nav-divider')) {
            $item_html = preg_replace('/(.*?)/', '', $item_html);
        }
        elseif (stristr($item_html, 'li class="mobile-nav-header')) {
            $item_html = preg_replace('/(.*?)/', '', $item_html);
        } else {
            $item_html = preg_replace('/<a (.*?)>(.*?)<\/a>/', '<a $1><span>$2</span></a>', $item_html);
        }

        $item_html = apply_filters('uxi_nav_menu_item', $item_html);
        $output .= $item_html;
    }
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        parent::start_el($item_html, $item, $depth, $args);
        if (
            stristr($item_html, 'li class="mobile-nav-header') ||
            stristr($item_html, 'li class="mobile-nav-divider') ||
            stristr($item_html, 'li class="dropdown-header') ||
            stristr($item_html, 'li class="dropdown-divider')
        ) {
            $output .= "";
        } else {
            $output .= "</li>\n";
        }
    }
}

/**
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
 */
function uxi_nav_menu_css_class($classes, $item) {
    $slug = sanitize_title($item->title);
    $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'is-active', $classes);
    $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

    $classes[] = 'menu-' . $slug;

    $classes = array_unique($classes);

    $classes = array_filter($classes, function($class){
        $class = trim($class);
        return empty($class) ? false : true;
    });

    return $classes;
}
add_filter('nav_menu_css_class', 'uxi_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');
