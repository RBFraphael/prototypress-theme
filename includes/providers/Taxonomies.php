<?php
namespace PrototyPressTheme\Providers
{
    class Taxonomies 
    {
        static function Init()
        {
            self::Year();
        }

        static function Year()
        {
            $labels = [
                'name' => __("Years", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'singular_name' => __("Year", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'search_items' => __("Search years", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'all_items' => __("All years", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'parent_item' => __("Parent year", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'parent_item_colon' => __("Parent year:", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'edit_item' => __("Edit year", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'update_item' => __("Update year", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'add_new_item' => __("Add new year", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'new_item_name' => __("New year", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'menu_name' => __("Year", PROTOTYPRESSTHEME_TEXTDOMAIN),
            ];
            
            $settings = [
                'hierarchical' => false,
                'labels' => $labels,
                'show_ui' => true,
                'show_admin_column' => true,
                'query_var' => true,
                'rewrite' => ['slug' => 'year'],
            ];
            
            register_taxonomy("year", ['article'], $settings);
        }
    }
}
