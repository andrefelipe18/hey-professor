<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

test('Pode criar um nova questão com até 255 caracteres', function () {

    //Arrange -> Preparação
    $user = \App\Models\User::factory()->create();
    actingAs($user); //Faz login como o usuário criado

    //Act -> Ação
    $request = post(route('question.store'), [
        'question' => str_repeat('a', 254) . '?',
    ]);

    //Assert -> Verificação
    $request->assertRedirect(route('dashboard')); //Verifica se foi redirecionado para a dashboard
    assertDatabaseCount('questions', 1); //Verifica se existe 1 registro na tabela questions
    assertDatabaseHas('questions', [ //Verifica se existe um registro na tabela questions com os dados abaixo
        'question' => str_repeat('a', 254) . '?',
    ]);
});


test('Uma questão deve ter ? no final', function(){
    //Arrange -> Preparação
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    //Act -> Ação
    $request = post(route('question.store'), [
        'question' => 'Qual a cor do cavalo branco de Napoleão',
    ]);

    //Assert -> Verificação
    $request->assertSessionHasErrors(['question']); //Verifica se existe um erro na sessão com o nome question
    assertDatabaseCount('questions', 0); //Verifica se não existe nenhum registro na tabela questions
});


test('Uma questão deve ter no mínimo 10 caracteres', function(){
    //Arrange -> Preparação
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    //Act -> Ação
    $request = post(route('question.store'), [
        'question' => 'Menosde10',
    ]);

    //Assert -> Verificação
    $request->assertSessionHasErrors(['question']); //Verifica se existe um erro na sessão com o nome question
    assertDatabaseCount('questions', 0); //Verifica se não existe nenhum registro na tabela questions
});
