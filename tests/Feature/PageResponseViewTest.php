<?php

use function Pest\Laravel\get;

test('A Rota dashboard está utilizando a view dashboard', function(){
    $response = get('/dashboard');

    $response->assertViewIs('dashboard');
});

test('A Rota da API está retornando o json correto', function(){
    $response = get('/dashboard');

    $response->assertJson([
        'name' => 'Teste'
    ]);
});
