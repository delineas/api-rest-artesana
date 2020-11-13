<?php

namespace Src\Core;

class ExceptionHandler
{

    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
        set_exception_handler([$this, 'fire']);
    }

    public function fire($exception) 
    {
        $exceptionMethod = 'handler' . get_class($exception);
        if(method_exists($this, $exceptionMethod)) {
            return $this->{$exceptionMethod}($exception);
        }
        return $this->handlerDefault($exception);
    }
    
    public function handlerDefault($exception) {
        return $this->response->sendError($exception->getMessage(), 500);
    }

    public function handlerNotFoundException($exception) {
        return $this->response->sendError('Url not found', 404);
    }
}