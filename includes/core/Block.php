<?php
namespace PrototyPressTheme\Core
{

    use Carbon_Fields\Block as CbfBlock;

    class Block
    {
        private static $_BLOCKS = [];

        static function Create($title, $slug, $template)
        {
            $block = CbfBlock::make($title)->set_render_callback(function($fields, $attrs, $inner_blocks) use($template){
                Render::Block($template, $fields, $attrs, $inner_blocks);
            });
            self::$_BLOCKS[$slug] = $block;
            return $block;
        }

        static function Get($slug)
        {
            if(isset(self::$_BLOCKS[$slug])){
                return self::$_BLOCKS[$slug];
            }

            return false;
        }
    }
}