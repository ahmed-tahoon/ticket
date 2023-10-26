@props(['disabled' => false])

<x-button :disabled="$disabled" {{ $attributes->merge(['type' => 'button', 'class' => 'bg-black-100 text-black-700 hover:bg-black-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black-500 dark:bg-slate-700 dark:border-slate-500 dark:text-slate-200 dark:hover:border-slate-400 dark:focus:ring-offset-slate-800']) }}>
    {{ $slot }}
</x-button>
