<?php
namespace PrototyPressTheme\Providers
{

    use Carbon_Fields\Container\Container;
    use Carbon_Fields\Field\Field;
    use PrototyPressTheme\Core\Block;
    use PrototyPressTheme\Core\OptionsPage;

    class Fields
    {
        static function Init()
        {
            self::PostFields();
            self::PageFields();
            self::ArticleFields();
            self::TermFields();
        }

        static function GeneralOptionsPage()
        {
            if($page = OptionsPage::Get("theme-options")){
                $page->add_fields([
                    Field::make("image", "favicon", __("Site favicon", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("checkbox", "enable_loader", __("Enable loader", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("image", "loader_image", __("Loader image", PROTOTYPRESSTHEME_TEXTDOMAIN))
                        ->set_conditional_logic([['field' => "enable_loader", 'value' => true]])
                ]);
            }
        }

        static function HeaderOptionsPage()
        {
            if($page = OptionsPage::Get("header-options")){
                $page->add_fields([
                    Field::make("image", "header_logo", __("Header logo", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("image", "mobile_header_logo", __("Mobile header logo", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("image", "drawer_logo", __("Mobile menu logo", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                ]);
            }
        }

        static function FooterOptionsPage()
        {
            if($page = OptionsPage::Get("footer-options")){
                $page->add_fields([
                    Field::make("image", "footer_logo", __("Footer logo", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("text", "footer_copyright", __("Copyright line", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("complex", "footer_social", __("Social networks", PROTOTYPRESSTHEME_TEXTDOMAIN))
                        ->add_fields([
                            Field::make("text", "label", __("Label", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                            Field::make("image", "icon", __("Icon", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                            Field::make("text", "url", __("Link", PROTOTYPRESSTHEME_TEXTDOMAIN))
                        ])
                ]);
            }
        }

        static function AdditionalCodeOptionsPage()
        {
            if($page = OptionsPage::Get("additional-code")){
                $page->add_fields([
                    Field::make("header_scripts", "header_scripts", __("Code to insert into <head>")),
                    Field::make("footer_scripts", "footer_scripts", __("Code to insert before closing </body>"))
                ]);
            }
        }

        static function BlockContainer()
        {
            if($block = Block::Get("container")){
                $block->add_fields([
                    Field::make("checkbox", "padding_x", __("Horizontal padding", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("checkbox", "padding_y", __("Vertical padding", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("checkbox", "fluid", __("Full width", PROTOTYPRESSTHEME_TEXTDOMAIN))
                ]);
            }
        }

        static function PostFields()
        {
            Container::make("post_meta", __("Post Fields", PROTOTYPRESSTHEME_TEXTDOMAIN))->where("post_type", "=", "post")
                ->add_fields([
                    Field::make("text", "text_field", __("Text Field", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("image", "image_field", __("Image Field", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("checkbox", "checkbox_field", __("Checkbox Field", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("textarea", "textarea_field", __("Textarea Field", PROTOTYPRESSTHEME_TEXTDOMAIN))
                ]);
        }

        static function PageFields()
        {
            Container::make("post_meta", __("Page Fields", PROTOTYPRESSTHEME_TEXTDOMAIN))->where("post_type", "=", "page")
                ->add_fields([
                    Field::make("text", "text_field", __("Text Field", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("image", "image_field", __("Image Field", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("checkbox", "checkbox_field", __("Checkbox Field", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("textarea", "textarea_field", __("Textarea Field", PROTOTYPRESSTHEME_TEXTDOMAIN))
                ]);
        }

        static function ArticleFields()
        {
            Container::make("post_meta", __("Article Fields", PROTOTYPRESSTHEME_TEXTDOMAIN))->where("post_type", "=", "article")
                ->add_fields([
                    Field::make("text", "text_field", __("Text Field", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("image", "image_field", __("Image Field", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("checkbox", "checkbox_field", __("Checkbox Field", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("textarea", "textarea_field", __("Textarea Field", PROTOTYPRESSTHEME_TEXTDOMAIN))
                ]);
        }

        static function TermFields()
        {
            Container::make("term_meta", __("Period", PROTOTYPRESSTHEME_TEXTDOMAIN))->where("term_taxonomy", "=", "year")
                ->add_fields([
                    Field::make("date", "date_from", __("From", PROTOTYPRESSTHEME_TEXTDOMAIN)),
                    Field::make("date", "date_to", __("To", PROTOTYPRESSTHEME_TEXTDOMAIN))
                ]);
        }
    }
}