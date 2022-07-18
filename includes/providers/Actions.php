<?php
namespace PrototyPressTheme\Providers
{

    class Actions
    {
        static function WpHead()
        {
            /**
             * Enqueue Roboto font from Google Fonts
             */
            ?>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
            <?php

            /**
             * Just an example script
             */
            ?>
            <script type="text/javascript"> console.log("Frontend header code") </script>
            <?php
        }

        static function WpBodyOpen()
        {
            /**
             * Just an example script
             */
            ?>
            <script type="text/javascript"> console.log("Frontend body code") </script>
            <?php
        }

        static function WpFooter()
        {
            /**
             * Just an example script
             */
            ?>
            <script type="text/javascript"> console.log("Frontend footer code") </script>
            <?php
        }

        static function AdminHead()
        {
            /**
             * Just an example script
             */
            ?>
            <script type="text/javascript"> console.log("Admin head code") </script>
            <?php
        }

        static function AdminFooter()
        {
            /**
             * Just an example script
             */
            ?>
            <script type="text/javascript"> console.log("Admin footer code") </script>
            <?php
        }

        static function WpBeforeAdminBarRender()
        {
            /**
             * Remove WordPress logo from admin bar
             */

            global $wp_admin_bar;
            $wp_admin_bar->remove_menu("wp-logo");
        }

        static function WpDashboardSetup()
        {
            /**
             * Hide all metaboxes from Admin's dashboard
             */
            $metaboxes = [
                ["dashboard_activity", "dashboard", "normal"],
                ["dashboard_site_health", "dashboard", "normal"],
                ["dashboard_recent_comments", "dashboard", "normal"],
                ["dashboard_quick_press", "dashboard", "side"],
                ["dashboard_incoming_links", "dashboard", "normal"],
                ["dashboard_plugins", "dashboard", "normal"],
                ["dashboard_primary", "dashboard", "side"],
                ["dashboard_secondary", "dashboard", "side"],
                ["dashboard_recent_drafts", "dashboard", "side"],
                ["dashboard_right_now", "dashboard", "normal"],
                ["yoast_db_widget", "dashboard", "normal"],
                ["wpseo-dashboard-overview", "dashboard", "normal"]
            ];

            foreach($metaboxes as $metabox){
                remove_meta_box($metabox[0], $metabox[1], $metabox[2]);
            }

            remove_action( 'welcome_panel', 'wp_welcome_panel' );
        }

        static function AfterSetupTheme()
        {
            /**
             * Set theme textdomain and path for translations
             */
            load_theme_textdomain(PROTOTYPRESSTHEME_TEXTDOMAIN, PROTOTYPRESSTHEME_PATH."/languages");

            /**
             * Set theme supported features
             */
            add_theme_support("automatic-feed-links");
            add_theme_support("html5", ["comment-list", "comment-form", "search-form", "gallery", "caption", "style", "script"]);
            add_theme_support("menus");
            add_theme_support("post-thumbnails");
            add_theme_support("responsive-embeds");
            add_theme_support("title-tag");

            /**
             * Add default menus
             */
            register_nav_menu("header", __("Header Menu", "starter-theme"));
            register_nav_menu("footer", __("Footer Menu", "starter-theme"));
        }

        static function Init()
        {
            PostTypes::Init();
            Taxonomies::Init();
            Shortcodes::Init();
        }

        static function RestApiInit()
        {
            RestApi::Init();
        }

        static function WidgetsInit()
        {
            Sidebars::Init();
            Widgets::Init();
        }

        static function WpEnqueueScripts()
        {
            Assets::Init();
        }

        static function AdminEnqueueScripts()
        {
            AdminAssets::Init();
        }

        static function CarbonFieldsRegisterFields()
        {
            Fields::Init();
            OptionsPages::Init();
            Blocks::Init();
        }

        static function CarbonFieldsThemeOptionsContainerSaved()
        {
            $favicon = intval(carbon_get_theme_option("favicon"));
            update_option("site_icon", $favicon);
        }
    }
}