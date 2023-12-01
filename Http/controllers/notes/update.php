<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize(intval($note['user_id']) === user_id($db));

$errors=[];

if(! Validator::string($_POST['body'], 1, 1000)){
    $errors['body'] = 'A body of no more than 1000 letters is required';
}

if(!empty($errors)){
    view("notes/edit.view.php", [
        'heading' => 'Edit Note',
        'note' => $note,
        'errors' => $errors
    ]);

    exit();
}

$db->query('update notes set body = :body where id = :id', [
    'body' => $_POST['body'],
    'id' => $_POST['id']
]);

redirect('/notes');
