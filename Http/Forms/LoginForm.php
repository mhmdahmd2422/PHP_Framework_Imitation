<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($email, $password)
    {
        if(! Validator::email($email)){
            $this->errors['email'] = 'Please Provide A Valid Email';
        }

        if(! Validator::string($password, 8, 10)){
            $this->errors['password'] = 'Please Provide A Valid Password';
        }

        return empty($this->errors);
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }

    public function errors()
    {
        return $this->errors;
    }
}