@props([
    'typeButton' => 'primary',
    'link' => false
])

@php
    $global = 'inline-flex items-center px-4 py-2 rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150';

    $classes = [
        'primary' => 'bg-gray-900 border border-transparent text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900',
        'secondary' => 'bg-white border border-gray-300 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 active:bg-white',
        'outline' => 'border border-gray-300 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 active:bg-white',
    ];
@endphp

@if($link)
    <a {{ $attributes->merge(['href' => '#', 'class' =>  "$global $classes[$typeButton]"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' =>  "$global $classes[$typeButton]"]) }}>
            {{ $slot }}
    </button>
@endif



