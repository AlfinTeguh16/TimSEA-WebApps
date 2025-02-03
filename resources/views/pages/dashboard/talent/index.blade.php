@extends('layouts.master')

@section('content')
<section class="p-4">
    <div class="mb-5">
        <h1 class="text-neutral-600 text-3xl">Hello, {{ Auth::user()->username ?? 'Guest' }}</h1>
    </div>

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
                    <h1>Total Project On Progress</h1>
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
                    <h1>Total Project Finished</h1>
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

    <section class="bg-white rounded-lg shadow-md p-5 mx-auto">
        <h2 class="text-lg font-semibold">Super Team Projects</h2>
        @foreach ($teams as $item)
            <div class="w-full border-2 border-dashed border-spacing-7 border-gray-200 p-6 rounded-lg flex justify-between items-center my-3">
                <div class="flex flex-col">
                    <h1 class="text-2xl">{{ $item->project_name }}</h1>
                    <h2>{{ $item->description }}</h2>
                    
                    <div class="flex flex-row py-4">
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

                        <a href="{{ route('talent.super-team.show.get', $item->id) }}" 
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
                            @foreach(explode(',', $item->talents_pictures) as $picture)
                                <img src="{{ asset($picture) }}" 
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
    </section>
</section>
@endsection
