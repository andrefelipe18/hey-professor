<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;

class UnlikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        /**
         * @var User $user
         */
        $user = auth()->user();

        if($user->liked($question)) {
            $user->votes()->where('question_id', $question->id)->delete();
            $user->unlike($question);
            return to_route('dashboard');
        }

        //Se o usuário já votou na pergunta, não pode votar novamente
        if($user->unliked($question)) {
            return back()->withErrors(['error' => 'Você já marcou como não gostei nesta pergunta']);
        }

        $user->unlike($question);

        return to_route('dashboard');
    }
}
