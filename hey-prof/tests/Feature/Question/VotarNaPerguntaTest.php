<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

test('Deve conseguir votar na questão', function(){
    //Arrange -> Preparação
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    $question = \App\Models\Question::factory()->create();

    //Act -> Execução
    $request = post(route('question.vote', $question));

    //Assert -> Verificação
    assertDatabaseHas('votes', [
        'user_id' => $user->id,
        'question_id' => $question->id,
        'like' => true,
        'unlike' => false,
    ]);

    $request->assertRedirect(route('dashboard'));
});

test('Não pode votar mais de uma vez na questão', function(){
    //Arrange -> Preparação
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    $question = \App\Models\Question::factory()->create();

    //Act -> Execução
    $request = post(route('question.vote', $question));
    $request = post(route('question.vote', $question));

    //Assert -> Verificação
    $request->assertSessionHasErrors(['error' => 'Você já votou nesta pergunta']);
});

