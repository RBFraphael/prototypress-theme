<?php
namespace PrototyPressTheme\Providers
{
    use PrototyPressTheme\Callbacks\Shortcodes as Callbacks;

    class Shortcodes 
    {
        static function Init()
        {
            self::ExampleShortcode();
        }

        static function ExampleShortcode()
        {
            add_shortcode("example-shortcode", "Callbacks::ExampleShortcode");
        }
    }
}
