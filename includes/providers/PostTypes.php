<?php
namespace PrototyPressTheme\Providers
{
    class PostTypes 
    {
        static function Init()
        {
            self::Article();
        }

        static function Article()
        {
            $intl = [
                'name' => __("Articles", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'singular_name' => __("Article", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'menu_name' => __("Articles", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'name_admin_bar' => __("Article", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'add_new' => __("Add new", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'add_new_item' => __("Add new article", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'new_item' => __("New article", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'edit_item' => __("Edit article", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'view_item' => __("View article", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'all_items' => __("All articles", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'search_items' => __("Search articles", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'parent_item_colon' => __("Parent article:", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'not_found' => __("No articles found", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'not_found_in_trash' => __("No articles found in trash", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'featured_image' => __("Article cover image", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'set_featured_image' => __("Set cover image", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'remove_featured_image' => __("Remove cover image", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'use_featured_image' => __("Use as cover image", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'archives' => __("Article archives", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'insert_into_item' => __("Insert into article", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'uploaded_to_this_item' => __("Upload to this article", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'filter_items_list' => __("Filter articles list", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'items_list_navigation' => __("Articles list navigation", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'items_list' => __("Articles list", PROTOTYPRESSTHEME_TEXTDOMAIN),
            ];
    
            $settings = [
                'labels' => $intl,
                'description' => __("Articles are very useful for magazines instead blogs.", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => [
                    'slug' => "article"
                ],
                'capability_type' => "post",
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => [
                    "title",
                    "editor",
                    "author",
                    "thumbnail",
                    "excerpt",
                    "comments"
                ],
                'taxonomies' => [
                    "category",
                    "tag",
                    "year"
                ],
                'show_in_rest' => true
            ];
    
            register_post_type("article", $settings);
        }
    }
}
