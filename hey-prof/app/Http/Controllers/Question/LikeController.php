<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        if($question->votes()->where('user_id', auth()->id())->exists()){
            // Caso o usuário já tenha votado na pergunta
            return back()->withErrors(['error' => 'Você já votou nesta pergunta']);
        }

        auth()->user()->like($question);

        return to_route('dashboard');
    }
}
