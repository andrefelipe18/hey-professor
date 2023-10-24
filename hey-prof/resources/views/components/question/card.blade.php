@props([
    'questions' => [],
])
<ul>
    @foreach($questions as $q)
    <li class="my-2 rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3 dark:text-gray-400">
        <p>{{ $q->question }}</p>

        <x-question.vote.count :question="$q" />
        <x-question.vote.buttons :question="$q" />
    </li>
    @endforeach
</ul>
