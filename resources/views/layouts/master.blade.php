<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.tailwindcss.min.css">
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.tailwindcss.min.js"></script>

    @vite(['resources/css/app.css'])
    <title>MyTimSEA</title>
</head>
<body class="text-black font-sans  bg-neutral-100 ">
    <div class="z-10">
        <x-message-card />
    </div>
    
    @include('layouts.sidebar')

</body>
</html>