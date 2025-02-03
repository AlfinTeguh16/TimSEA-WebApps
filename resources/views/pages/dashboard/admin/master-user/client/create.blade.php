@extends('layouts.master')

@section('content')
<section class="bg-white rounded-lg shadow-md p-5 mx-auto">
    <section class="flex flex-wrap gap-3 pb-4">
        <a href="/admin/user-client" class="text-neutral-400">All Client Account</a>
        <p class="text-neutral-400">></p>
        <p class="font-semibold text-neutral-600">Create New Client Account</p>
    </section>

    <div class="pb-5">
        <h1 class="font-semibold text-2xl text-neutral-600">Create New Client Account</h1>
    </div>       

    <section>
        <form action="{{ route('admin.create-user.client.post') }}" method="post">
            @csrf

            <div class="flex flex-col md:flex-row gap-3 w-full">
                <div class="w-full">
                    <label for="company" class="block text-neutral-500 mb-1">Company Name / Your Name <span class="text-red-500">*</span></label>
                    <x-form id="company" name="company" placeholder="e.g., Acme Corp / John Doe" class="w-full"></x-form>
                </div>
                <div class="w-full">
                    <label for="email" class="block text-neutral-500 mb-1">Email Address <span class="text-red-500">*</span></label>
                    <x-form id="email" name="email" placeholder="e.g., contact@yourcompany.com" class="w-full"></x-form>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-3 w-full mt-3">
                <div class="w-full">
                    <label for="country" class="block text-neutral-500 mb-1">Company Location <span class="text-red-500">*</span></label>
                    <select id="country" name="country" class="w-full border px-2 py-3.5 rounded-md">
                        <option value="" disabled selected>Select a country</option>
                        <option value="usa">USA</option>
                        <option value="uk">UK</option>
                        <option value="germany">Germany</option>
                    </select>
                </div>
                <div class="w-full">
                    <label for="field" class="block text-neutral-500 mb-1">Industry Type <span class="text-red-500">*</span></label>
                    <x-form id="field" name="field" placeholder="e.g., Technology, Healthcare, Media" class="w-full"></x-form>
                </div>
            </div>

            <h1 class="text-xl text-neutral-400 pt-5 pb-2">Login Data</h1>
            <div class="flex flex-col md:flex-row gap-3 w-full">
                <div class="w-full">
                    <label for="username" class="block text-neutral-500 mb-1">Username <span class="text-red-500">*</span></label>
                    <x-form id="username" name="username" placeholder="Enter username" class="w-full"></x-form>
                </div>
                <div class="w-full">
                    <label for="password" class="block text-neutral-500 mb-1">Password <span class="text-red-500">*</span></label>
                    <x-form id="password" name="password" placeholder="Enter Password" class="w-full"></x-form>
                </div>
            </div>

            <div class="flex justify-end w-full pt-5">
                <button type="submit" class="w-full md:w-auto flex items-center justify-center gap-2 py-3 px-5 bg-primary-500 text-white rounded-md">
                    <span>Create account</span>
                </button>
            </div>   
        </form>
    </section>
</section>
@endsection
