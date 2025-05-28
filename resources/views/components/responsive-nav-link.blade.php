@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#dd6b10] dark:border-[#dd6b10] text-start text-base font-medium text-[#dd6b10] dark:text-[#dd6b10] bg-[#dd6b10]/20 dark:bg-[#dd6b10]/20 focus:outline-none focus:text-[#dd6b10] dark:focus:text-[#dd6b10] focus:bg-[#dd6b10] dark:focus:bg-[#dd6b10] focus:border-[#dd6b10] dark:focus:border-[#dd6b10] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 dark:text-gray-600 hover:text-gray-800 dark:hover:text-gray-800 hover:bg-gray-50 dark:hover:bg-gray-50 hover:border-gray-300 dark:hover:border-gray-300 focus:outline-none focus:text-gray-800 dark:focus:text-gray-800 focus:bg-gray-50 dark:focus:bg-gray-50 focus:border-gray-300 dark:focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
