@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-300 dark:bg-white dark:text-gray-700 focus:border-[#dd6b10] dark:focus:border-[#dd6b10] focus:ring-[#dd6b10] dark:focus:ring-[#dd6b10] rounded-md shadow-sm']) }}>
