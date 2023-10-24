@props([
    'question' => null,
])
<p class="text-sm text-gray-500 mt-4">
    @if($question->votes->count() > 0)
    <span class="mr-2">{{ $question->votes->count() }}</span>{{ $question->votes->count() > 1 ? 'Votos' : 'Voto' }}
    @else
        Sem votos
    @endif
</p>
