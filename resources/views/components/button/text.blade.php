@props(['disabled' => false])

<x-button :disabled="$disabled" {{ $attributes->merge(['type' => 'button', 'class' => 'text-black-600 hover:text-black-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black-500 dark:text-black-400 dark:hover:text-black-300 dark:focus:ring-offset-slate-800']) }}>
    {{ $slot }}
</x-button>
