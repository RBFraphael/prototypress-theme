<?php
namespace PrototyPressTheme\Callbacks
{

    use PrototyPressTheme\Core\Render;

    class Shortcodes
    {
        static function ExampleShortcode($attrs, $content = "")
        {
            return Render::Shortcode("example", $attrs, $content);
        }
    }
}