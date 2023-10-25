<?php

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

test('Deve conseguir marcar como não gostei na questão', function () {
    //Arrange -> Preparação
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    $question = \App\Models\Question::factory()->create();

    //Act -> Execução
    $request = post(route('question.unvote', $question));

    //Assert -> Verificação
    assertDatabaseHas('votes', [
        'user_id' => $user->id,
        'question_id' => $question->id,
        'like' => false,
        'unlike' => true,
    ]);

    $request->assertRedirect(route('dashboard'));
});

test('Não pode marcar como não gostei mais de uma vez na questão', function () {
    //Arrange -> Preparação
    $user = \App\Models\User::factory()->create();
    actingAs($user);

    $question = \App\Models\Question::factory()->create();

    //Act -> Execução
    $request = post(route('question.unvote',$question));

    $request = post(route('question.unvote', $question));

    //Assert -> Verificação
    assertDatabaseCount('votes', 1);
    $request->assertSessionHasErrors(['error' => 'Você já marcou como não gostei nesta pergunta']);
});

