<?php
namespace PrototyPressTheme\Core
{
    use Carbon_Fields\Carbon_Fields;

    class Core
    {
        static function Init()
        {
            add_action("after_setup_theme", "PrototyPressTheme\Core\Core::BootCarbonFields");

            $templates = ["404", "archive", "attachment", "author", "category", "date", "embed", "frontpage", "home", "index", "page", "paged", "privacypolicy", "search", "single", "singular", "tag", "taxonomy"];
            foreach($templates as $template){
                add_filter($template."_template_hierarchy", "PrototyPressTheme\Core\Core::TemplateHierarchy");
            }

            add_action("get_header", "PrototyPressTheme\Core\Core::GetHeader", 10, 2);
            add_action("get_footer", "PrototyPressTheme\Core\Core::GetFooter", 10, 2);
            add_action("get_search_form", "PrototyPressTheme\Core\Core::GetSearchForm");
            
        }

        static function BootCarbonFields()
        {
            Carbon_Fields::boot();
        }

        static function TemplateHierarchy($templates)
        {
            $base_dir = PROTOTYPRESSTHEME_PATH."/templates/";
            $templates = array_map(function($template) use($base_dir){
                if(file_exists($base_dir.$template)){
                    return "templates/".$template;
                }
                return $template;
            }, $templates);
            return $templates;
        }

        static function GetHeader($name = "", $args = [])
        {
            get_template_part("templates/partials/header", $name, $args);
        }

        static function GetFooter($name = null, $args = [])
        {
            get_template_part("templates/partials/footer", $name, $args);
        }

        static function GetSearchForm()
        {
            get_template_part("templates/partials/searchform");
        }

    }
}