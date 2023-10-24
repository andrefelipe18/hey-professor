<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        $regras = [
            'question' => 'required|min:10|max:255|ends_with:?',
        ];

        $messagens = ['question.required' => 'O campo pergunta é obrigatório', 'question.min' => 'O campo pergunta deve ter no mínimo 10 caracteres', 'question.max' => 'O campo pergunta deve ter no máximo 255 caracteres', 'question.ends_with' => 'O campo pergunta deve terminar com ?'];

        $request->validate($regras, $messagens);

        Question::create([
            'question' => $request->question,
        ]);

        return to_route('dashboard');
    }

    public function vote(Question $question): RedirectResponse
    {
        if($question->votes()->where('user_id', auth()->id())->exists()){
            // Caso o usuário já tenha votado na pergunta
            return back()->withErrors(['error' => 'Você já votou nesta pergunta']);
        }

        $question->votes()->create([
            'user_id' => auth()->id(),
            'like' => true,
        ]);

        return to_route('dashboard');
    }

    public function show(Question $question)
    {
        //
    }

    public function edit(Question $question)
    {
        //
    }


    public function update(Request $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        //
    }
}
