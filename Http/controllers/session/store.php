<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if($form->validate($email, $password)){
    if((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }

    $form->error('email',  'No Matching Account For Your Credentials');
}

\Core\Session::flash('errors', $form->errors());

return redirect('/login');
