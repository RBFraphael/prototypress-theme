<?php

namespace PrototyPressTheme
{
    use PrototyPressTheme\Core\Core;

    class Main
    {
        static function Init()
        {
            Core::Init();

            self::RegisterActions();
            self::RegisterFilters();
        }

        static function RegisterActions()
        {
            add_action("wp_head", "PrototyPressTheme\Providers\Actions::WpHead");
            add_action("wp_body_open", "PrototyPressTheme\Providers\Actions::WpBodyOpen");
            add_action("wp_footer", "PrototyPressTheme\Providers\Actions::WpFooter");
            add_action("admin_head", "PrototyPressTheme\Providers\Actions::AdminHead");
            add_action("admin_footer", "PrototyPressTheme\Providers\Actions::AdminFooter");
            add_action("wp_before_admin_bar_render", "PrototyPressTheme\Providers\Actions::WpBeforeAdminBarRender");
            add_action("wp_dashboard_setup", "PrototyPressTheme\Providers\Actions::WpDashboardSetup");
            add_action("after_setup_theme", "PrototyPressTheme\Providers\Actions::AfterSetupTheme");
            add_action("init", "PrototyPressTheme\Providers\Actions::Init");
            add_action("rest_api_init", "PrototyPressTheme\Providers\Actions::RestApiInit");
            add_action("widgets_init", "PrototyPressTheme\Providers\Actions::WidgetsInit");
            add_action("wp_enqueue_scripts", "PrototyPressTheme\Providers\Actions::WpEnqueueScripts");
            add_action("admin_enqueue_scripts", "PrototyPressTheme\Providers\Actions::AdminEnqueueScripts");
            add_action("carbon_fields_register_fields", "PrototyPressTheme\Providers\Actions::CarbonFieldsRegisterFields");
            add_action("carbon_fields_theme_options_container_saved", "PrototyPressTheme\Providers\Actions::CarbonFieldsThemeOptionsContainerSaved");

            add_action("desktop_menu", "PrototyPressTheme\Providers\CustomActions::DesktopMenu");
            add_action("mobile_menu", "PrototyPressTheme\Providers\CustomActions::MobileMenu");
        }

        static function RegisterFilters()
        {
            add_filter("the_content", "PrototyPressTheme\Providers\Filters::TheContent");
            add_filter("excerpt_length", "PrototyPressTheme\Providers\Filters::ExcerptLength");
            add_filter("excerpt_ending", "PrototyPressTheme\Providers\Filters::ExcerptEnding");
            add_filter("block_categories_all", "PrototyPressTheme\Providers\Filters::BlockCategoriesAll", 10, 2);
            add_filter("login_enqueue_scripts", "PrototyPressTheme\Providers\Filters::LoginEnqueueScripts");
            add_filter("use_block_editor_for_post_type", "PrototyPressTheme\Providers\Filters::UseBlockEditorForPostType", 10, 2);
            add_filter("admin_footer_text", "PrototyPressTheme\Providers\Filters::AdminFooterText", 10, 1);
            add_filter("update_footer", "PrototyPressTheme\Providers\Filters::UpdateFooter", PHP_INT_MAX, 1);
            add_filter("block_editor_rest_api_preload_paths", "PrototyPressTheme\Providers\Filters::BlockEditorRestApiPreloadPaths", 10, 1);

            add_filter("desktop_menu", "PrototyPressTheme\Providers\CustomFilters::DesktopMenu");
            add_filter("mobile_menu", "PrototyPressTheme\Providers\CustomFilters::MobileMenu");
        }
    }
}