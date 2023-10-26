@props(['disabled' => false])

<x-button :disabled="$disabled" {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-black-600 hover:bg-black-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black-500 dark:hover:bg-black-500 dark:focus:ring-offset-slate-800']) }}>
    {{ $slot }}
</x-button>
