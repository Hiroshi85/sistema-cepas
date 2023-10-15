@props(['checked' => false, 'type' => 'checkbox'])
<input {{ $checked ? 'checked' : '' }} type="{{$type}}" {!! $attributes->merge(['class' => 'px-2 rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800']) !!}>
