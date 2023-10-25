<?php

use function Pest\Laravel\get;

test('Assim que acessar a página / retornar 200', function(){
    $response = get('/');

    $response->assertOk();
});

test('Assim que acessar a página /404 retornar 404', function(){
    $response = get('/404');

    $response->assertNotFound();
});

test('Se não tiver permissão retornar código 403', function(){
    $response = get('/no-permission');

    $response->assertForbidden();
});
