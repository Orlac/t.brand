<?php

namespace test;

class Response
{
    public static function redirect($uri, $permanent = false)
    {
        if( $baseurl = S('Template')->getGlob('baseurl') )
        {
            $uri = "$baseurl$uri";
        }

        header("Location: $uri", true, ($permanent ? 301 : 302));
        exit;
    }

    public static function headerForbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        header('Status: 403 Forbidden');
        exit;
    }

    public static function headerNotFound()
    {
        header("HTTP/1.0 404 Not Found");
        header("Status: 404 Not Found");
        exit;
    }

    public static function answer($body, $contentType = 'text/html')
    {
        header("Content-type: $contentType");
        echo $body;
        exit;
    }
}
