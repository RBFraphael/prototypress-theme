<?php
namespace PrototyPressTheme\Providers
{
    class Sidebars 
    {
        static function Init()
        {
            self::Blog();
            self::Home();
        }

        static function Blog()
        {
            register_sidebar([
                'name' => __("Sidebar Blog", PROTOTYPRESSTHEME_TEXTDOMAIN),
                "id" => "blog"
            ]);
        }

        static function Home()
        {
            register_sidebar([
                'name' => __("Sidebar Home", PROTOTYPRESSTHEME_TEXTDOMAIN),
                "id" => "home"
            ]);
        }
    }
}
