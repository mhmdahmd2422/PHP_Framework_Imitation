<?php

use Core\Response;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404) {
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN) {
    if (! $condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    return require base_path('views/'. $path);
}

function user_id($db){
    if($_SESSION['user']){
        $user = $db->query('select * from users where email = :email', [
            'email' => $_SESSION['user']['email'],
        ])->find();

        return $user['id'];
    }
}


function redirect($path)
{
    header("location: {$path}");
    exit();
}