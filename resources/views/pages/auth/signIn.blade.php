<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    @vite(['resources/css/app.css'])
    <title>Register - MyTimSEA</title>
</head>
<body class="text-black font-sans">
    <section class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-[50px] bg-white rounded shadow-md">
            <div class="flex justify-center">
                <h1 class="text-3xl mb-[50px]">Welcome Back</h1>
            </div>
            <form action="{{ route('signin.post') }}" method="post">
                @csrf
                @method('POST')
                <div class="mb-5">
                    <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">
                        Email<span class="required">*</span>
                    </label>
                    <x-form type="email" name="email" placeholder="Enter your email" />
                </div>
                <div>
                    <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">
                        Password<span class="required">*</span>
                    </label>
                    <x-form variant="password" name="password" placeholder="Enter your password" />
                </div>
                <button type="submit" class="w-full my-5 py-2 px-4 bg-gradient-to-r from-secondary-500 to-primary-500 hover:from-secondary-600 hover:to-primary-600 text-white font-medium rounded-md ">
                    Sign In
                </button>
            </form>
            @if ($errors->any())
                <div class="text-red-500 text-sm mt-2">
                    {{ $errors->first('error') }}
                </div>
            @endif
        </div>
    </section>
    

</body>
</html>

