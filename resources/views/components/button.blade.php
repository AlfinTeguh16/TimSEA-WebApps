@props([
    'variant' => 'primary', // primary, secondary, outline, ghost
    'type' => 'submit',
])

@php
    $baseClass = 'px-4 py-2 rounded-md font-medium text-sm focus:outline-none focus:ring-2 focus:ring-offset-2';

    switch ($variant) {
        case 'primary':
            $classes = "$baseClass bg-primary-500 text-white hover:bg-primary-600 focus:ring-primary-500";
            break;
        case 'secondary':
            $classes = "$baseClass bg-primary-700 text-white hover:bg-primary-800 focus:ring-primary-700";
            break;
        case 'outline':
            $classes = "$baseClass border border-primary-500 text-primary-500 hover:bg-primary-100 focus:ring-primary-500";
            break;
        case 'ghost':
            $classes = "$baseClass text-primary-500 bg-primary-50 hover:bg-primary-100 focus:ring-primary-500";
            break;
        default:
            $classes = "$baseClass bg-neutral-300 text-neutral-800";
    }
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>