@extends('layouts.master')

@section('content')

<section class="mb-5">
    <div class="flex flex-col lg:flex-row gap-5">
        <div class="py-8 px-10 w-fit flex flex-row rounded-md bg-gradient-to-r from-secondary-500 to-primary-500 gap-20">
            <div class="flex flex-col text-white">
                <h1>Total Project</h1>
                <p class="text-3xl">
                    {{ $totalProjects }}
                </p>
            </div>
            <div class="flex justify-end">
                <span>
                    <i class="ph ph-article p-3 rounded-full bg-white"></i>
                </span>
            </div>
        </div>  

        <div class="py-8 px-[37px] w-fit flex flex-row rounded-md bg-white border-2 border-neutral-300 gap-20">
            <div class="flex flex-col text-neutral-600">
                <h1>Total Project On Progres</h1>
                <p class="text-3xl">
                    {{ $onProgressProjects }}
                </p>
            </div>
            <div class="flex justify-end text-blue-500">
                <span>
                    <i class="ph ph-article p-3 border border-blue-500 rounded-full bg-white"></i>
                </span>
            </div>
        </div>  

        <div class="py-8 px-[37px] w-fit flex flex-row rounded-md bg-white border-2 border-neutral-300 gap-20">
            <div class="flex flex-col text-neutral-600">
                <h1>Total Project Finish</h1>
                <p class="text-3xl">
                    {{ $completedProjects }}
                </p>
            </div>
            <div class="flex justify-end text-blue-500">
                <span>
                    <i class="ph ph-article p-3 border border-blue-500 rounded-full bg-white"></i>
                </span>
            </div>
        </div>  
    </div>
</section>

<section class="bg-white rounded-lg shadow-md p-5 mx-auto" x-data="{ activeTab: 'pr' }">
    <!-- Toggle Buttons -->
    <div class="flex gap-3 pb-4 border-b-2">
        <button 
            @click="activeTab = 'pr'" 
            :class="activeTab === 'pr' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white' : 'border border-primary-500 text-blue-500'"
            class="px-4 py-2 rounded-md transition-all"
        >
            Show PR Activity
        </button>
        <button 
            @click="activeTab = 'project'" 
            :class="activeTab === 'project' ? 'bg-gradient-to-r from-secondary-500 to-primary-500 text-white' : 'border border-primary-500 text-blue-500'"
            class="px-4 py-2 rounded-md transition-all"
        >
            Show Projects
        </button>
    </div>

    <!-- PR Activity -->
    <div x-show="activeTab === 'pr'" x-transition class="mt-4">
        <h2 class="text-lg font-semibold">PR Activity</h2>
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
                <a href="{{ route('admin.edit-pr.get', $pr->id) }}" class="bg-neutral-400 text-white px-4 py-2 rounded-lg flex items-center space-x-2 hover:bg-neutral-500">
                    <span>Edit</span> 
                    <i class="ph ph-pencil-simple"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Projects -->
    <div x-show="activeTab === 'project'" x-transition class="mt-4">
        <h2 class="text-lg font-semibold">Super Team Projects</h2>
        @foreach ($projects as $item)
            <div class="w-full border-2 border-dashed border-spacing-7 border-gray-200 p-6 rounded-lg flex justify-between items-center my-3">
                    <div class="flex flex-col ">
                        <h1 class="text-2xl">{{$item->project_name}}</h1>
                        <h2>{{$item->description}}</h2>
                        
                        <div class="flex flex-row py-4 ">
                            @php
                                $statusClass = match($item->status) {
                                    'On Progress' => 'text-primary-500',
                                    'Complete' => 'text-green-600',
                                    'Canceled' => 'text-gray-500',
                                    default => ''
                                };
                            @endphp

                            <span class="py-3 mr-3">
                                <p class="font-semibold {{ $statusClass }}">
                                    {{ $item->status }}
                                </p>
                            </span>

                            <a href="{{ route('admin.super-team.show.get', $item->id) }}" 
                                class="p-3 bg-primary-500 text-white rounded-md">
                                Detail Project
                             </a>
                        </div>
                    </div>

                    <div class="flex flex-col w-fit">
                        <h1 class="text-neutral-600 flex justify-start">Team Member</h1>

                        <div class="flex flex-row">
                            <img src="{{ $item->project_manager_picture ?? asset('asset/img/default-user.png') }}" 
                            class="w-10 h-10 rounded-full border" 
                            alt="Project Manager">

                            @if($item->talents_pictures)
                                @foreach(explode(',', $project->talents_pictures) as $picture)
                                    <img src="{{ $picture ?? asset('asset/img/default-user.png') }}" 
                                        class="w-10 h-10 rounded-full border" 
                                        alt="Talent">
                                @endforeach
                            @else
                                <img src="{{ asset('asset/img/default-user.png') }}" 
                                    class="w-10 h-10 rounded-full border" 
                                    alt="No Team Members">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
