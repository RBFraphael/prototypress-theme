<?php
namespace PrototyPressTheme\Providers
{
    class Widgets
    {
        static function Init()
        {
            self::AutoloadWidgets();

            register_widget("PrototyPressTheme\Widgets\ExampleWidget");
        }

        static function AutoloadWidgets()
        {
            $widgets_dir = PROTOTYPRESSTHEME_PATH."/includes/widgets";
            foreach(scandir($widgets_dir) as $widget_class){
                $file_path = $widgets_dir."/".$widget_class;
                if($widget_class !== "." && $widget_class !== ".." && !is_dir($file_path)){
                    if(strtolower(trim(pathinfo($file_path, PATHINFO_EXTENSION))) === "php"){
                        include_once($widgets_dir."/".$widget_class);
                    }
                }
            }
        }
    }
}