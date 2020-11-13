<?php

namespace Src\Core;

class Request 
{

    public static function uri() {
        return trim($_SERVER["REQUEST_URI"]);
    }

    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getContent() {
        return file_get_contents('php://input');
    }

}