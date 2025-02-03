@extends('layouts.master')

@section('content')
<section class="bg-white rounded-lg shadow-md p-5  mx-auto">
    <section class="flex flex-wrap gap-3 pb-4">
        <a href="/admin/user-client" class="text-neutral-400">All Client Account</a>
        <p class="text-neutral-400">></p>
        <p class="font-semibold text-neutral-600">Edit Client Account</p>
    </section>

    <div class="pb-5">
        <h1 class="font-semibold text-2xl text-neutral-600">Edit Client Account</h1>
    </div>       

    <section>
        <form action="{{ route('admin.update-user.client.post', $user->id) }}" method="POST">
            @csrf

            <div class="flex flex-col md:flex-row gap-3 w-full">
                <div class="w-full">
                    <label for="company" class="block text-neutral-500 mb-1">Company Name / Your Name <span class="text-red-500">*</span></label>
                    <x-form id="company" name="company" placeholder="e.g., Acme Corp / John Doe" value="{{ old('company', $company->company) }}" class="w-full"></x-form>
                </div>
                <div class="w-full">
                    <label for="email" class="block text-neutral-500 mb-1">Email Address <span class="text-red-500">*</span></label>
                    <x-form id="email" name="email" placeholder="e.g., contact@yourcompany.com" value="{{ old('email', $user->email) }}" class="w-full"></x-form>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-3 w-full mt-3">
                <div class="w-full">
                    <label for="country" class="block text-neutral-500 mb-1">Company Location <span class="text-red-500">*</span></label>
                    <select id="country" name="country" class="w-full border px-2 py-3.5 rounded-md">
                        <option value="Indonesia" {{ old('country', $company->country) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="USA" {{ old('country', $company->country) == 'USA' ? 'selected' : '' }}>USA</option>
                        <option value="UK" {{ old('country', $company->country) == 'UK' ? 'selected' : '' }}>UK</option>
                        <option value="Germany" {{ old('country', $company->country) == 'Germany' ? 'selected' : '' }}>Germany</option>
                        <option value="France" {{ old('country', $company->country) == 'France' ? 'selected' : '' }}>France</option>
                        <option value="Other" {{ old('country', $company->country) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="w-full">
                    <label for="field" class="block text-neutral-500 mb-1">Industry Type <span class="text-red-500">*</span></label>
                    <x-form id="field" name="field" placeholder="e.g., Technology, Healthcare, Media" value="{{ old('field', $company->field) }}" class="w-full"></x-form>
                </div>
            </div>

            <h1 class="text-xl text-neutral-400 pt-5 pb-2">Login Data</h1>
            <div class="flex flex-col md:flex-row gap-3 w-full">
                <div class="w-full">
                    <label for="username" class="block text-neutral-500 mb-1">Username <span class="text-red-500">*</span></label>
                    <x-form id="username" name="username" placeholder="Enter username" value="{{ old('username', $user->username) }}" class="w-full"></x-form>
                </div>
                <div class="w-full">
                    <label for="password" class="block text-neutral-500 mb-1">Password (Leave blank if not changing)</label>
                    <x-form id="password" name="password" placeholder="Enter new password (optional)" class="w-full"></x-form>
                </div>
            </div>

            <div class="flex justify-end w-full pt-5">
                <button type="submit" class="w-full md:w-auto flex items-center justify-center gap-2 py-3 px-5 bg-primary-500 text-white rounded-md">
                    <span>Update account</span>
                </button>
            </div>   
        </form>
    </section>
</section>
@endsection
