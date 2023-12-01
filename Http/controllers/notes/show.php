<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

authorize(intval($note['user_id']) === user_id($db));

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);
