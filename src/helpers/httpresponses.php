<?php

class HttpResponses {
    public static array $message = [
        'status' => '',
        'message' => ''
    ];

    public static function ok(string $res)
    {
        http_response_code(200);
        self::$message['status'] = 200;
        self::$message['message'] = $res;
        return self::$message;
    }

    public static function created(array $res)
    {
        http_response_code(201);
        self::$message['status'] = 201;
        self::$message['message'] = $res;
        return self::$message;
    }

    public static function noContent()
    {
        http_response_code(204);
        self::$message['status'] = 204;
        return self::$message;
    }

    public static function notFound(string $res = "404 Not Found")
    {
        http_response_code(404);
        self::$message['status'] = 404;
        self::$message['message'] = $res;
        return self::$message;
    }
}