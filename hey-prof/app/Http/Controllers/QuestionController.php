<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        $regras = [
            'question' => 'required|min:10|max:255|ends_with:?'
        ];

        $messagens = [ 'question.required' => 'O campo pergunta é obrigatório', 'question.min' => 'O campo pergunta deve ter no mínimo 10 caracteres', 'question.max' => 'O campo pergunta deve ter no máximo 255 caracteres', 'question.ends_with' => 'O campo pergunta deve terminar com ?' ];

        $request->validate($regras, $messagens);

        Question::create([
            'question' => $request->question
        ]);

        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
