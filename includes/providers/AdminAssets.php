<?php
namespace PrototyPressTheme\Providers
{
    class AdminAssets
    {
        static function Init()
        {
            self::RegisterAssets();
            self::EnqueueAssets();
        }

        static function RegisterAssets()
        {
            wp_register_style("prototypresstheme-admin", PROTOTYPRESSTHEME_URL."assets/dist/css/admin.min.css");
            wp_register_script("prototypresstheme-admin", PROTOTYPRESSTHEME_URL."assets/dist/js/admin.bundle.ls");
        }

        static function EnqueueAssets()
        {
            wp_enqueue_style("prototypresstheme-admin");
            wp_enqueue_script("prototypresstheme-admin");
        }
    }
}