@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#dd6b10] dark:border-[#dd6b10] text-sm font-medium leading-5 text-gray-900 dark:text-gray-900 focus:outline-none focus:border-[#dd6b10] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-500 hover:text-gray-700 dark:hover:text-gray-700 hover:border-gray-300 dark:hover:border-gray-300 focus:outline-none focus:text-gray-700 dark:focus:text-gray-700 focus:border-gray-300 dark:focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
