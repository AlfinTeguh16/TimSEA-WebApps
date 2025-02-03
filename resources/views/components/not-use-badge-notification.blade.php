@props(['type' => 'info', 'message' => ''])

@php
    $classes = match ($type) {
        'success' => 'bg-green-100 text-green-800 border-green-500',
        'error' => 'bg-red-100 text-red-800 border-red-500',
        'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-500',
        default => 'bg-blue-100 text-blue-800 border-blue-500',
    };
@endphp

<div {{ $attributes->merge(['class' => "border-l-4 p-4 rounded-md $classes"]) }}>
    <div class="flex justify-between items-center">
        <span class="font-medium capitalize">{{ ucfirst($type) }}:</span>
        <button type="button" class="text-lg font-semibold text-gray-600 hover:text-gray-800" onclick="this.parentElement.parentElement.remove();">&times;</button>
    </div>
    <p class="text-sm mt-1">{{ $message }}</p>
</div>
