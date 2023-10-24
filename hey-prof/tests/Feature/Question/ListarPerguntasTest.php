<?php

use App\Models\Question;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('Lista todas as questões', function () {
    //Arrange -> Preparação
    $user = User::factory()->create(); // Cria um usuário
    actingAs($user); // Autentica o usuário

    $questions = Question::factory()->count(5)->create(); // Cria 5 perguntas

    //Act -> Execução
    $response = get(route('dashboard')); // Acessa a rota dashboard

    //Assert -> Verificação
    foreach ($questions as $question) {
        $response->assertSee($question->question); // Verifica se a pergunta está sendo exibida na tela
    }
});
