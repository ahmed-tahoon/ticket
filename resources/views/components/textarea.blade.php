@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full border-slate-300 rounded-md shadow-sm text-slate-900 sm:text-sm focus:ring-black-500 focus:border-black-500 disabled:bg-slate-100 disabled:cursor-wait dark:border-slate-500 dark:bg-slate-800 dark:placeholder-slate-500 dark:text-slate-200 dark:focus:ring-black-500 dark:focus:border-black-500 dark:focus:placeholder-slate-600']) !!}></textarea>
