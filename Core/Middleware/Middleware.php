<?php

namespace Core\Middleware;

class Middleware
{
    public const Map = [
        'guest' => Guest::class,
        'auth' => Auth::class,
    ];

    public static function resolve($key)
    {
        if(!$key){
            return;
        }

        $middleware = static::Map[$key] ?? false;

        if(!$middleware){
            throw new \Exception("No Matching Middleware Found for key '{$key}'");
        }

        (new $middleware)->handle();
    }

}