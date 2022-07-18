<?php
namespace PrototyPressTheme\Core
{
    class Render
    {
        static function Shortcode($template_file, $attrs, $content = "", $return = true)
        {
            $template_file = PROTOTYPRESSTHEME_PATH."/templates/shortcodes/".$template_file.".php";
            if(file_exists($template_file)){
                ob_start();
                include($template_file);
                $output = ob_get_contents();
                ob_end_clean();

                if($return){
                    return $output;
                }

                echo $output;
            }
        }

        static function Block($template_file, $fields, $attrs, $inner_blocks)
        {
            $template_file = PROTOTYPRESSTHEME_PATH."/templates/blocks/".$template_file.".php";
            if(file_exists($template_file)){
                extract($fields);

                ob_start();
                include($template_file);
                $output = ob_get_contents();
                ob_end_clean();

                echo $output;
            }
        }

        static function Widget($template_file, $args, $instance)
        {
            $template_file = PROTOTYPRESSTHEME_PATH."/templates/widgets/".$template_file.".php";
            if(file_exists($template_file)){
                extract($instance);

                ob_start();
                include($template_file);
                $output = ob_get_contents();
                ob_end_clean();

                echo $output;
            }
        }
    }
}