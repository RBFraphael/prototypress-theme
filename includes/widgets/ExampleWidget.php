<?php
namespace PrototyPressTheme\Widgets
{
    use Carbon_Fields\Widget;
    use Carbon_Fields\Field\Field;
    use PrototyPressTheme\Core\Render;

    class ExampleWidget extends Widget
    {
        function __construct()
        {
            $this->setup("example_widget", __("Example Widget", PROTOTYPRESSTHEME_TEXTDOMAIN), __("An example widget", PROTOTYPRESSTHEME_TEXTDOMAIN), [
                Field::make("text", "title", __("Title", PROTOTYPRESSTHEME_TEXTDOMAIN))->set_default_value("Lorem Ipsum"),
                Field::make("textarea", "text", __("Text", PROTOTYPRESSTHEME_TEXTDOMAIN))->set_default_value("Ullamco ex ea dolore consequat deserunt non. Aliquip culpa enim occaecat dolore proident reprehenderit dolore mollit qui. Nulla ea sint amet laborum consectetur aute qui labore."),
            ]);
        }

        function front_end($args, $instance)
        {
            Render::Widget("example", $args, $instance);
        }
    }
}