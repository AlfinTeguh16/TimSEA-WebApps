@extends('layouts.master')

@section('content')

<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">PR Activity</h2>
        <div class="relative">
            <div>
                <a href="/admin/press-release/create" class="flex items-center w-fit gap-x-2 p-3 bg-primary-500 text-white rounded-md">
                    <i class="ph ph-plus-square text-lg"></i>
                    <span>Create new PR projects</span>
                </a>
            </div>   
        </div>
    </div>

    <!-- PR List -->
    <div class="bg-white shadow-md rounded-md p-4">
        @foreach ($prs as $pr)
        <div class="border-dashed border-2 border-gray-300 rounded-lg p-4 mb-4 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold"> {{ $pr->title }} </h3>
                <p class="text-gray-600">
                    Publish at: 
                    <a href="{{ $pr->URL }}" class="text-blue-500 underline" target="_blank">
                        {{ $pr->URL }}
                    </a>
                </p>
                <p class="text-gray-700">Author: {{ $pr->author }}</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Status -->
                @php
                    $statusClasses = [
                        'Completed' => 'text-green-500',
                        'On Progress' => 'text-blue-500',
                        'Pending' => 'text-yellow-500',
                        'Canceled' => 'text-red-500'
                    ];
                @endphp
                <span class="text-sm font-medium {{ $statusClasses[$pr->status] ?? 'text-gray-500' }}">
                    {{ $pr->status }}
                </span>

                <!-- Button -->
                <a href="{{ $pr->URL }}" target="_blank" class="bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover:bg-blue-600">
                    <span>Go to url</span> 
                    <i class="ph ph-paper-plane-tilt"></i>
                </a>
                <a href="{{ route('admin.edit-pr.get', $pr->id) }}" class="bg-neutral-400 text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover:bg-neutral-500">
                    <span>Update</span> 
                    <i class="ph ph-pencil-simple"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

