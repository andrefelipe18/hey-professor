<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        if($user->unliked($question)) {
            $user->votes()->where('question_id', $question->id)->delete();
            $user->like($question);
            return to_route('dashboard');
        }

        //Se o usuário já votou na pergunta, não pode votar novamente
        if($user->liked($question)) {
            return back()->withErrors(['error' => 'Você já votou nesta pergunta']);
        }

        $user->like($question);

        return to_route('dashboard');
    }
}
