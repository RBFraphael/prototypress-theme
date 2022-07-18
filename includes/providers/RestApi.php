<?php
namespace PrototyPressTheme\Providers
{
    use PrototyPressTheme\Callbacks\RestApi as Callbacks;

    class RestApi 
    {
        static function Init()
        {
            self::ExampleGet();
            self::ExamplePost();
            self::ExampleMulti();
            self::ExampleError();
        }

        static function ExampleGet()
        {
            register_rest_route("example/v1", "get", [
                'methods' => ["GET"],
                'callback' => "Callbacks::ExampleGet",
                'permission_callback' => "__return_true"
            ]);
        }

        static function ExamplePost()
        {
            register_rest_route("example/v1", "post", [
                'methods' => ["POST"],
                'callback' => "Callbacks::ExamplePost",
                'permission_callback' => "__return_true"
            ]);
        }

        static function ExampleMulti()
        {
            register_rest_route("example/v1", "multi", [
                'methods' => ["GET", "POST"],
                'callback' => "Callbacks::ExampleMulti",
                'permission_callback' => "__return_true"
            ]);
        }

        static function ExampleError()
        {
            register_rest_route("example/v1", "error", [
                'methods' => ["GET", "POST"],
                'callback' => "Callbacks::ExampleError",
                'permission_callback' => "__return_true"
            ]);
        }
    }
}
