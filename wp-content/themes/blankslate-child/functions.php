<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')):
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('chld_thm_cfg_parent_css')):
    function chld_thm_cfg_parent_css()
    {
        wp_enqueue_style('chld_thm_cfg_parent', trailingslashit(get_template_directory_uri()) . 'style.css', array());
    }
endif;
add_action('wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10);

// END ENQUEUE PARENT ACTION
// Masquer le lien Admin si l'utilisateur n'est pas connecté
function planty_hide_admin_link($items, $args)
{
    if ($args->theme_location == 'main-menu') {
        if (!is_user_logged_in()) {
            // Parcourir les éléments du menu
            foreach ($items as $key => $item) {
                // Supprimer l'élément "Admin"
                if (strtolower($item->title) === 'admin') {
                    unset($items[$key]);
                }
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'planty_hide_admin_link', 10, 2);
