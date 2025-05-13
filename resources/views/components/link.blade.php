@php
  
$clases = " text-sm text-gray-600 dark:text-gray-600 hover:text-gray-900 font-bold dark:hover:text-gray-900 rounded-md focus:outline-none "

@endphp

<a  {{ $attributes->merge(['class' => $clases]) }} >
    {{ $slot }}
</a>