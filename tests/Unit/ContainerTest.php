<?php

test('resolve out of container', function () {
    // arrange
    $container = new \Core\Container();
    $container->bind('foo', fn() => 'bar');

    // act
    $result = $container->resolve('foo');

    // assert
    expect($result)->toEqual('bar');
});
