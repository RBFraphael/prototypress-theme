<?php
namespace PrototyPressTheme\Providers
{
    class Assets
    {
        static function Init()
        {
            self::RegisterAssets();
            self::EnqueueAssets();
        }

        static function RegisterAssets()
        {
            wp_register_style("prototypresstheme-frontend", PROTOTYPRESSTHEME_URL."assets/dist/css/main.min.css");
            wp_register_script("prototypresstheme-frontend", PROTOTYPRESSTHEME_URL."assets/dist/js/main.bundle.ls");
        }

        static function EnqueueAssets()
        {
            wp_enqueue_style("prototypresstheme-frontend");
            wp_enqueue_script("prototypresstheme-frontend");
        }
    }
}