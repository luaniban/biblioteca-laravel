@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => ' bg-gray-100 text-gray-600 focus:border-gray-300  focus:ring-gray-300 rounded-md shadow-sm']) !!}>
