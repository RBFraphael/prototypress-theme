<?php
namespace PrototyPressTheme\Callbacks
{
    use WP_REST_Request;
    use WP_Error;

    class RestApi
    {
        static function ExampleGet(WP_REST_Request $request)
        {
            return [
                'error' => false,
                'method' => "GET",
                'data' => $request->get_params()
            ];
        }

        static function ExamplePost(WP_REST_Request $request)
        {
            return [
                'error' => false,
                'method' => "POST",
                'data' => $request->get_params()
            ];
        }

        static function ExampleMulti(WP_REST_Request $request)
        {
            return [
                'error' => false,
                'method' => $request->get_method(),
                'data' => $request->get_params()
            ];
        }

        static function ExampleError(WP_REST_Request $request)
        {
            $params = $request->get_params();
            return new WP_Error('awesome_server_error', "Your awesome server error", [
                'status' => isset($params['status']) ? $params['status'] : 500
            ]);
        }
    }
}
