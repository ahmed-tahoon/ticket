@props(['disabled' => false])

<x-button :disabled="$disabled" {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-black hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black-900 dark:hover:bg-gray-700 dark:focus:ring-offset-slate-900']) }}>
    {{ $slot }}
</x-button>
