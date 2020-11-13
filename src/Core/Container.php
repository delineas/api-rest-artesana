<?php 

namespace Src\Core;

class Container {

    static $stack = [];

    public static function add($label, $item) {
        self::$stack[$label] = $item;
    }

    public static function get($label) {
        if (!array_key_exists($label, static::$stack)) {
            throw new \Exception("No {$label} is founded");
        }
        return self::$stack[$label];
    }

}