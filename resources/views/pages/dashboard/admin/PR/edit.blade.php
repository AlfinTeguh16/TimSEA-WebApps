@extends('layouts.master')

@section('content')
<section class="bg-white rounded-lg shadow-md p-5 mx-auto">
    <!-- Breadcrumb -->
    <section class="flex flex-wrap gap-3 pb-4">
        <a href="{{ route('admin.pr.get') }}" class="text-neutral-400">All PR</a>
        <p class="text-neutral-400">></p>
        <p class="font-semibold text-neutral-600">Edit PR</p>
    </section>

    <!-- Header -->
    <div class="pb-5 flex justify-between">
        <h1 class="font-semibold text-2xl text-neutral-600">Edit PR</h1>
        <!-- Delete Button -->
        <form action="{{ route('admin.delete-pr.post', $pr->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this PR?');">
            @csrf
            <button type="submit" class="flex items-center justify-center gap-2 p-3 bg-red-600 text-white rounded-md hover:bg-red-700">
                <i class="ph ph-trash"></i>
            </button>
        </form>
    </div>


    <!-- Form -->
    <section>
        <form action="{{ route('admin.update-pr.post', $pr->id) }}" method="POST">
            @csrf
            @method('POST')

            <!-- Company -->
            <div class="w-full">
                <label for="id_company" class="block text-neutral-500 mb-1">
                    Company Name <span class="text-red-500">*</span>
                </label>
                <select id="id_company" name="id_company" class="w-full border px-2 py-3.5 rounded-md">
                    <option value="" disabled>Select a Company</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ $company->id == $pr->id_company ? 'selected' : '' }}>
                            {{ $company->company }}
                        </option>
                    @endforeach
                </select>
                @error('id_company') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Title & URL -->
            <div class="flex flex-col md:flex-row gap-3 w-full mt-3">
                <div class="w-full">
                    <label for="title" class="block text-neutral-500 mb-1">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title" value="{{ $pr->title }}" class="w-full border px-2 py-3.5 rounded-md" placeholder="Enter article title">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="w-full">
                    <label for="URL" class="block text-neutral-500 mb-1">
                        Publish URL <span class="text-red-500">*</span>
                    </label>
                    <input type="url" id="URL" name="URL" value="{{ $pr->URL }}" class="w-full border px-2 py-3.5 rounded-md" placeholder="https://example.com/article">
                    @error('URL') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Author -->
            <div class="w-full mt-3">
                <label for="author" class="block text-neutral-500 mb-1">
                    Author <span class="text-red-500">*</span>
                </label>
                <input type="text" id="author" name="author" value="{{ $pr->author }}" class="w-full border px-2 py-3.5 rounded-md" placeholder="Enter author name">
                @error('author') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div class="w-full mt-3">
                <label for="status" class="block text-neutral-500 mb-1">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status" class="w-full border px-2 py-3.5 rounded-md">
                    <option value="On Progress" {{ $pr->status == 'On Progress' ? 'selected' : '' }}>On Progress</option>
                    <option value="Completed" {{ $pr->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Pending" {{ $pr->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Canceled" {{ $pr->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Buttons (Update & Delete) -->
            <div class="flex justify-end items-center w-full pt-5">

                <!-- Update Button -->
                <button type="submit" class="flex items-center justify-center gap-2 py-3 px-5 bg-primary-500 text-white rounded-md hover:bg-primary-600">
                    <span>Update PR</span>
                </button>
            </div>
        </form>
    </section>
</section>
@endsection
