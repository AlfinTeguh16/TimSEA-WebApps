@extends('layouts.master')

@section('content')
<section class="bg-white rounded-lg shadow-md p-5 mx-auto">
    <section class="flex flex-wrap gap-3 pb-4">
        <a href="/admin/super-team" class="text-neutral-400">All Projects</a>
        <p class="text-neutral-400">></p>
        <p class="font-semibold text-neutral-600">Create New Projects</p>
    </section>

    <div class="pb-5">
        <h1 class="font-semibold text-2xl text-neutral-600">Create New Projects</h1>
    </div>       

    <section>
        <form action="{{ route('admin.create-super-team.post') }}" method="post">
            @csrf

            <div class="w-full">
                <label for="company" class="block text-neutral-500 mb-1">Company Name <span class="text-red-500">*</span></label>
                <select id="company" name="company" class="w-full border px-2 py-3.5 rounded-md">
                    @foreach($companiesList as $company)
                        <option value="{{ $company->id }}">{{ $company->company }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col md:flex-row gap-3 w-full mt-3">
                <div class="w-full">
                    <label for="project_name" class="block text-neutral-500 mb-1">Project Title <span class="text-red-500">*</span></label>
                    <x-form id="project_name" name="project_name" placeholder="e.g., Acme Corp / John Doe" class="w-full"></x-form>
                </div>
                <div class="w-full">
                    <label for="category" class="block text-neutral-500 mb-1">Project Category <span class="text-red-500">*</span></label>
                    <select id="category" name="category" class="w-full border px-2 py-3.5 rounded-md">
                        <option value="" disabled selected>Select Category</option>
                        <option value="Web Development">Web Development</option>
                        <option value="Mobile Development">Mobile Development</option>
                        <option value="Community Building">Community Building</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-3 w-full mt-3">
                
                <div class="w-full">
                    <label for="field" class="block text-neutral-500 mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea id="field" name="field" rows="10" cols="50" placeholder="e.g., Technology, Healthcare, Media" class="w-full border-2 rounded-md p-2"></textarea>
                </div>
            </div>

            <div class="flex justify-end w-full pt-5">
                <button type="submit" class="w-full md:w-auto flex items-center justify-center gap-2 py-3 px-5 bg-primary-500 text-white rounded-md">
                    <span>Create projects</span>
                </button>
            </div>   
        </form>
    </section>
</section>
@endsection
