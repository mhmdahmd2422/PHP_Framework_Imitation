<?php

it('validates a string', function (){
    $result = \Core\Validator::string('foobar');

    expect($result)->toBeTrue();
});

it('validates a string with minimum length', function (){
    $result = \Core\Validator::string('foobar', 10);

    expect($result)->toBeFalse();
});

it('validates an email', function (){
    expect(\Core\Validator::email('email@gmail.com'))->toBeTrue()
        ->and(\Core\Validator::email('notAnEmail'))->toBeFalse();
});

it('validates number greater than value', function (){
    expect(\Core\Validator::greaterThan(10, 1))->toBeTrue()
        ->and(\Core\Validator::greaterThan(10, 11))->toBeFalse();
});

