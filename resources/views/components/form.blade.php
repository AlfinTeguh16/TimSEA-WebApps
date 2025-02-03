@props([
    'type' => '',
    'variant' => null,
    'name' => '',
    'placeholder' => '',
])


<div class="relative w-full">
    @if($variant === 'password')
        <div class="relative w-full">
            <input
                id="passes"
                type="password"
                name="{{ $name }}"
                placeholder="{{ $placeholder }}"
                class="passes w-full border border-neutral-300 rounded-lg p-3 focus:ring-2 focus:ring-primary-500 focus:outline-none"
            />
            <span
                id="eye-icon"
                class="ph ph-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gray-700"
            ></span>
        </div>
        
        <script>
            var input = document.getElementById('passes');
            let eyeIcon = document.getElementById('eye-icon');
        
            eyeIcon.addEventListener('click', function () {
                if (input.type === 'password') {
                    input.type = 'text';
                    eyeIcon.classList.remove('ph-eye'); 
                    eyeIcon.classList.add('ph-eye-slash'); 
                } else {
                    input.type = 'password';
                    eyeIcon.classList.remove('ph-eye-slash'); 
                    eyeIcon.classList.add('ph-eye');
                }
            });
        </script>
        
    @elseif($variant === 'search')
        <input 
            type="text"
            name="{{ $name }}"
            placeholder="{{ $placeholder }} "
            class="border border-neutral-300 rounded-lg p-3 pl-10 focus:ring-2 focus:ring-primary-500 focus:outline-none"
        />
        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i class="ph ph-magnifying-glass text-neutral-400"></i>
        </div>
        <button type="button" class="px-4 py-3 rounded-lg bg-primary-100">
            <i class="ph-bold ph-magnifying-glass text-primary-300"></i>
        </button>
    @else
        <input 
            id="{{ $id ?? '' }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            class="border border-neutral-300 rounded-lg w-full p-3 focus:ring-2 focus:ring-primary-500 focus:outline-none"
        />
    @endif
</div>