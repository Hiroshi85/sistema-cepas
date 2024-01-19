@props(['name', 'label', 'type' => 'text', 'placeholder' => '', 'value' => '', 'required' => false, 'disabled' => false, 'options' => [], 'message' => '', 'class' => '', 'readonly' => false])

<div class="flex flex-col gap-2 {{ $class ?? '' }}">
    <label for="{{ $name }}" class='block font-medium text-sm text-gray-700 dark:text-gray-200'>
        {{ $label }}
    </label>


    @if ($type == 'textarea')
        <textarea {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {{ $required ? 'required' : '' }}" id="{{ $name }}"
            name="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" rezise="none"
            class='border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md 
            shadow-sm bg-transparent'>{{ old($name) ?? $value }}</textarea>
    @elseif ($type == 'select')
        <select {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }}" id="{{ $name }}"
            name="{{ $name }}"
            class='border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-transparent capitalize'>
            <option value="">Seleccione una opción</option>
            @foreach ($options as $option)
                <option value="{{ $option->value }}" {{ (old($name) ?? $value) == $option->value ? 'selected' : '' }}>
                    {{ $option->label }}
                </option>
            @endforeach
        </select>
    @else
        <input {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} id="{{ $name }}"
            value="{{ old($name) ?? $value }}" name="{{ $name }}" type="{{ $type ?? 'text' }}"
            placeholder="{{ $placeholder ?? '' }}"
            class='border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-transparent'>
    @endif



    @error($name)
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror
</div>
