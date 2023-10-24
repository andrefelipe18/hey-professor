@props([
    'questions' => [],
])
<ul>
    @foreach($questions as $q)
    <li class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3 dark:text-gray-400">
        <p>{{ $q->question }}</p>
    </li>
    @endforeach
</ul>
