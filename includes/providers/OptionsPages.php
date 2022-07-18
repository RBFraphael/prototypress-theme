<?php
namespace PrototyPressTheme\Providers
{
    use PrototyPressTheme\Core\OptionsPage;

    class OptionsPages
    {
        static function Init()
        {
            self::General();
            self::Header();
            self::Footer();
            self::AdditionalCode();
        }

        static function General()
        {
            OptionsPage::Create(__("Theme Options", PROTOTYPRESSTHEME_TEXTDOMAIN), "theme-options");
            Fields::GeneralOptionsPage();
        }

        static function Header()
        {
            OptionsPage::CreateChild(__("Header", PROTOTYPRESSTHEME_TEXTDOMAIN), "header-options", "theme-options");
            Fields::HeaderOptionsPage();
        }

        static function Footer()
        {
            OptionsPage::CreateChild(__("Footer", PROTOTYPRESSTHEME_TEXTDOMAIN), "footer-options", "theme-options");
            Fields::FooterOptionsPage();
        }

        static function AdditionalCode()
        {
            OptionsPage::CreateChild(__("Additional Code", PROTOTYPRESSTHEME_TEXTDOMAIN), "additional-code", "theme-options");
            Fields::AdditionalCodeOptionsPage();
        }
    }
}