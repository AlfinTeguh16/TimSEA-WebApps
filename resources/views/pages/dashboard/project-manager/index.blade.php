@extends('layouts.master')

@section('content')

<section class="bg-white rounded-lg p-4">
    <div class="flex py-3 flex-col md:flex-row justify-between items-center">
        <div>
            <h1 class="font-medium text-2xl text-neutral-600">All Projects</h1>
        </div>

        {{-- <div>
            <input type="text" id="tableSearch" name="search" 
                class="border border-gray-300 rounded-md px-4 py-2 w-full"
                placeholder="Search">
        </div> --}}

        <div>
            <a href="/admin/super-team/create" class="flex items-center w-fit gap-x-2 p-3 bg-primary-500 text-white rounded-md">
                <i class="ph ph-plus-square text-lg"></i>
                <span>Create new projects</span>
            </a>
        </div>        
    </div>

    <div>
        <div>
            @foreach ($projects as $item)
            <div class="w-full border-2 border-spacing-7 border-gray-200 p-6 rounded-lg flex justify-between items-center my-3">
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

        
          </div>
          
    </div>
    

    
</section>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#tableSearch").on("keyup", function() {
        let query = $(this).val();

        $.ajax({
            url: "{{ route('search-projects') }}", // Route untuk pencarian
            type: "GET",
            data: { q: query },
            beforeSend: function() {
                $("section div > div").fadeOut(100); // Sembunyikan list sebelumnya
            },
            success: function(response) {
                let resultContainer = $("section div > div"); // Container project list
                resultContainer.empty(); // Hapus hasil pencarian sebelumnya

                if (response.data.length > 0) {
                    let newHtml = "";

                    $.each(response.data, function(index, item) {
                        let teamImages = "";

                        if (item.talents_pictures) {
                            let pictures = item.talents_pictures.split(",");
                            $.each(pictures, function(i, picture) {
                                teamImages += `<img src="${picture || '{{ asset('asset/img/default-user.png') }}'}" 
                                               class="w-10 h-10 rounded-full border" alt="Talent">`;
                            });
                        } else {
                            teamImages = `<img src="{{ asset('asset/img/default-user.png') }}" 
                                           class="w-10 h-10 rounded-full border" alt="No Team Members">`;
                        }

                        newHtml += `
                            <div class="w-full md:w-1/3 p-3">
                                <div class="border-2 border-gray-200 p-6 rounded-lg flex flex-col gap-3 shadow-md">
                                    <div>
                                        <h1 class="text-2xl">${item.project_name}</h1>
                                        <h2 class="text-gray-500">${item.description}</h2>
                                    </div>
                                    
                                    <div class="flex flex-row items-center justify-between">
                                        <span class="py-3 text-gray-700 font-semibold">${item.status}</span>
                                        <a href="/admin/super-team/${item.id}" 
                                           class="p-3 bg-primary-500 text-white rounded-md text-center">
                                           Detail Project
                                        </a>
                                    </div>

                                    <div class="flex flex-col items-center">
                                        <h1 class="text-neutral-600 text-sm">Team Member</h1>
                                        <div class="flex flex-row space-x-2">
                                            <img src="${item.project_manager_picture || '{{ asset('asset/img/default-user.png') }}'}" 
                                                 class="w-10 h-10 rounded-full border" alt="Project Manager">
                                            ${teamImages}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    resultContainer.append(newHtml).fadeIn(200); // Tambahkan hasil baru dan tampilkan dengan animasi
                } else {
                    resultContainer.append('<p class="text-center text-gray-500 py-4">No projects found</p>').fadeIn(200);
                }
            }
        });
    });
});

</script>

@endsection
