<?php
namespace PrototyPressTheme\Core
{
    use Carbon_Fields\Container\Container;

    class OptionsPage
    {
        private static $_PAGES = [];

        static function Create($title, $slug)
        {
            $page = Container::make("theme_options", $title)->set_page_file($slug);
            self::$_PAGES[$slug] = $page;
            return self::$_PAGES[$slug];
        }

        static function CreateChild($title, $slug, $parent_slug)
        {
            if($parent = self::Get($parent_slug)){
                $page = Container::make("theme_options", $title)->set_page_file($slug);
                $page->set_page_parent($parent);
                self::$_PAGES[$slug] = $page;
                
                return self::$_PAGES[$slug];
            }
            
            return null;
        }

        static function Get($slug)
        {
            if(isset(self::$_PAGES[$slug])){
                return self::$_PAGES[$slug];
            }

            return false;
        }
    }
}