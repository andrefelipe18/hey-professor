<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-question.create-form />

            <hr class="border-gray-800 border-dashed my-4">

            {{-- List --}}

            <div class="mt-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Perguntas') }}
                </h2>

                <x-question.card :questions="$questions" />
            </div>
        </div>
    </div>
</x-app-layout>
