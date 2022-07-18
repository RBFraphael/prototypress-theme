<?php
namespace PrototyPressTheme\Providers
{
    class CustomFilters
    {
        static function DesktopMenu($menu)
        {
            if($html = str_get_html($menu)){
                foreach($html->find("a") as $link){
                    $link->addClass("text-decoration-none text-dark");
                }
    
                foreach($html->find("ul.menu") as $menu){
                    $menu->addClass("list-inline mb-0");
                    $menu->setAttribute("id", "header-navlinks");
                }
    
                foreach($html->find("ul.menu > li") as $menu_item){
                    $menu_item->addClass("list-inline-item mx-3");
                }
    
                foreach($html->find("ul.sub-menu") as $sub_menu){
                    $sub_menu->addClass("dropdown-menu");
                }
    
                foreach($html->find("ul.sub-menu li") as $sub_menu_item){
                    $sub_menu_item->addClass("dropdown-item");
                }
    
                foreach($html->find("ul.menu > li.menu-item-has-children") as $menu_item_with_children){
                    $menu_item_with_children->addClass("dropdown");
                }
    
                foreach($html->find("ul.menu > li.menu-item-has-children li.menu-item-has-children") as $sub_menu_item_with_children){
                    $sub_menu_item_with_children->addClass("dropdown-submenu");
                }
    
                foreach($html->find("ul.menu > li.menu-item-has-children > a") as $link){
                    $link->addClass("dropdown-toggle");
                }
    
                foreach($html->find("ul.sub-menu > li.menu-item-has-children > a") as $sub_menu_link){
                    $sub_menu_link->addClass("dropdown-toggle");
                }
    
                return $html;
            }
    
            return $menu;
        }

        static function MobileMenu($menu)
        {
            if($html = str_get_html($menu)){
                foreach($html->find("ul") as $menu){
                    $menu->addClass("list-unstyled p-0 m-0");
                }
    
                foreach($html->find("ul.sub-menu") as $menu){
                    $menu->addClass("pl-3");
                }
    
                foreach($html->find("a") as $link){
                    $link->addClass("btn btn-light w-100 text-start");
                }
    
                $collapse_link = 1;
                foreach($html->find("li.menu-item-has-children > a") as $submenu_link){
                    $submenu_link->addClass("dropdown-toggle");
                    $submenu_link->setAttribute("data-bs-toggle", "collapse");
                    $submenu_link->setAttribute("data-bs-target", "#collapse-".$collapse_link);
                    $collapse_link++;
                }
    
                $collapse_menu = 1;
                foreach($html->find("li.menu-item-has-children > ul.sub-menu") as $submenu_link){
                    $submenu_link->addClass("collapse");
                    $submenu_link->setAttribute("id", "collapse-".$collapse_menu);
                    $collapse_menu++;
                }
    
                return $html;
            }
            
            return $menu;
        }
    }
}