<?php
namespace PrototyPressTheme\Core
{
    class Menu
    {
        static function GetContent($menu_location)
        {
            $menus = get_nav_menu_locations();
            if(isset($menus[$menu_location]) && $menu_data = $menus[$menu_location]){
                $menu_content = wp_nav_menu([
                    'menu' => $menu_data,
                    'echo' => false
                ]);
                return $menu_content;
            }
            return false;
        }
    }
}