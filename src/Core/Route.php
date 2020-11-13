<?php

namespace Src\Core;

class Route 
{
    private $pattern;
    private $method;
    private $matches;
    private $callback;

    public function __construct($pattern, $callback, $method = 'GET')
    {
        $this->pattern = $pattern;
        $this->callback = $callback;
        $this->method = $method;
    }

    public function match()
    {
        if (
            preg_match('#^' . $this->pattern . '/?$#', Request::uri(), $this->matches)
            && Request::method() == strtoupper($this->method)
        ) {
            return true;
        }
        return false;
    }

    public function run() {

        if(is_array($this->callback)) {
            return (new $this->callback[0])->{$this->callback[1]}(...array_slice($this->matches, 1));
        }
        return call_user_func_array($this->callback, array_slice($this->matches, 1));

    }
}