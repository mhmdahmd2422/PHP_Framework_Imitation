<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if(! Validator::email($email)){
    $errors['email'] = 'Please Provide A Valid Email';
}

if(! Validator::string($password, 8, 255)){
    $errors['password'] = 'Please Provide A Valid Password';
}

if(!empty($errors)){
    view("registration/create.view.php", [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if(!$user){
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    login([
        'email' => $email
    ]);

    redirect('/');
}else {
    redirect('/');
}