<?php
namespace PrototyPressTheme\Providers
{
    use PrototyPressTheme\Core\Block;

    class Blocks 
    {
        static function Init()
        {
            self::Container();
        }

        static function Container()
        {
            Block::Create(__("_Container_", PROTOTYPRESSTHEME_TEXTDOMAIN), "container", "container")->set_inner_blocks();
            Fields::BlockContainer();
        }
    }
}
