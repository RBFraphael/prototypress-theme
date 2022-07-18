<?php
namespace PrototyPressTheme\Providers
{
    class Filters 
    {
        static function TheContent($content)
        {
            if($html = str_get_html($content)){

                foreach($html->find("img") as $img){
                    if(!$img->hasClass("img-fluid") && !$img->hasClass("no-fluid")){
                        $img->addClass("img-fluid");
                    }
    
                    if(!$img->hasAttribute("data-src") && !$img->hasClass("lazy")){
                        $src = $img->getAttribute("src");
                        $img->setAttribute("src", "");
                        $img->setAttribute("data-src", $src);
                        $img->addClass("lazy");
                    }
    
                    if($img->hasClass("aligncenter")){
                        $img->outertext = "<p class=\"text-center\">".$img->outertext."</p>";
                    }
                }
    
                foreach($html->find("iframe") as $iframe){
                    if(!$iframe->hasClass("no-fluid")){
                        $iframe->outertext = "<div class=\"ratio ratio-16x9\">".$iframe->outertext."</div>";
                    }
    
                    if(!$iframe->hasAttribute("data-src") && !$iframe->hasClass("lazy")){
                        $src = $iframe->getAttribute("src");
                        $iframe->setAttribute("src", "");
                        $iframe->setAttribute("data-src", $src);
                        $iframe->addClass("lazy");
                    }
                }
    
                return $html;
            }
            return $content;
        }

        static function ExcerptLength($length)
        {
            return 30;
        }

        static function ExcerptEnding($ending)
        {
            return "...";
        }

        static function BlockCategoriesAll($categories, $post)
        {
            $categories[] = [
                'slug' => PROTOTYPRESSTHEME_TEXTDOMAIN,
                'title' => __("PrototyPress Theme", PROTOTYPRESSTHEME_TEXTDOMAIN),
                'icon' => "dashicons-admin-customizer"
            ];
            return $categories;
        }

        static function LoginEnqueueScripts()
        {
            ?>
            <style type="text/css">
                body.login {
                    background-color: #FFF;
                    background-image: url('<?= PROTOTYPRESSTHEME_URL; ?>/assets/dist/img/login-background.jpg');
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center;
                }

                body.login div#login h1 a {
                    background-image: url('<?= PROTOTYPRESSTHEME_URL; ?>/assets/dist/img/login-logo.png');
                    background-size: 100% 100%;
                    background-repeat: no-repeat;
                    background-position: center;
                    margin: 0 auto 32px;
                }

                body.login div#login form#loginform {
                    background-color: rgba(255, 255, 255, 0.5);
                }
            </style>
            <?php
        }

        static function UseBlockEditorForPostType($status, $post_type)
        {
            if($post_type == "post"){
                return false;
            }
            return $status;
        }

        static function AdminFooterText($text)
        {
            $text = "<span><i>".sprintf(__("Developed by %s.", PROTOTYPRESSTHEME_TEXTDOMAIN), '<a href="https://github.com/rbfraphael" target="_blank" rel="noopener noreferrer">RBFraphael</a>')."</i></span>";
            return $text;
        }

        static function UpdateFooter($text)
        {
            $text = "<span>".sprintf(__("Wordpress %s", "starter-theme"), get_bloginfo("version", "display"))."</span>";
            return $text;
        }

        static function BlockEditorRestApiPreloadPaths($preload_paths)
        {
            global $post;

            $rest_path = rest_get_route_for_post($post);
            $remove_path = add_query_arg("context", "edit", $rest_path);
            
            return array_filter($preload_paths, function($url) use($remove_path){
                return $url !== $remove_path;
            });
        }
    }
}
