@extends('layouts.master')

@section('content')
<section class="bg-white rounded-lg shadow-md p-5 mx-auto">
    <!-- Breadcrumb -->
    <section class="flex flex-wrap gap-3 pb-4">
        <a href="{{ route('admin.pr.get') }}" class="text-neutral-400">All PR</a>
        <p class="text-neutral-400">></p>
        <p class="font-semibold text-neutral-600">Create New PR</p>
    </section>

    <!-- Header -->
    <div class="pb-5">
        <h1 class="font-semibold text-2xl text-neutral-600">Create New PR</h1>
    </div>

    <!-- Form -->
    <section>
        <form action="{{ route('admin.store-pr.post') }}" method="POST">
            @csrf

            <!-- Company -->
            <div class="w-full">
                <label for="id_company" class="block text-neutral-500 mb-1">
                    Company Name <span class="text-red-500">*</span>
                </label>
                <select id="id_company" name="id_company" class="w-full border px-2 py-3.5 rounded-md">
                    <option value="" disabled selected>Choose a Company</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company }}</option>
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
                    <input type="text" id="title" name="title" class="w-full border px-2 py-3.5 rounded-md" placeholder="Enter article title">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="w-full">
                    <label for="URL" class="block text-neutral-500 mb-1">
                        Publish URL <span class="text-red-500">*</span>
                    </label>
                    <input type="url" id="URL" name="URL" class="w-full border px-2 py-3.5 rounded-md" placeholder="https://example.com/article">
                    @error('URL') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Author -->
            <div class="w-full mt-3">
                <label for="author" class="block text-neutral-500 mb-1">
                    Author <span class="text-red-500">*</span>
                </label>
                <input type="text" id="author" name="author" class="w-full border px-2 py-3.5 rounded-md" placeholder="Enter author name">
                @error('author') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Status -->
            <div class="w-full mt-3">
                <label for="status" class="block text-neutral-500 mb-1">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status" class="w-full border px-2 py-3.5 rounded-md">
                    <option value="On Progress">On Progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                    <option value="Canceled">Canceled</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end w-full pt-5">
                <button type="submit" class="w-full md:w-auto flex items-center justify-center gap-2 py-3 px-5 bg-primary-500 text-white rounded-md hover:bg-primary-600">
                    <span>Create PR</span>
                </button>
            </div>
        </form>
    </section>
</section>
@endsection
