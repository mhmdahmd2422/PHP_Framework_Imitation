<?php
use Core\App;
use Core\Database;
use Core\Validator;


$db = App::resolve(Database::class);

$errors = [];

if(! Validator::string($_POST['body'], 1, 1000)){
    $errors['body'] = 'A body of no more than 1000 letters is required';
}

if(!empty($errors)){
    view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);

    exit();
}

$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => user_id($db)
]);

redirect('notes');
