@if(session('success') || session('error') || $errors->any())
    <div id="floating-message"
        class="fixed top-5 right-5 z-50 max-w-sm w-full sm:max-w-md md:max-w-lg lg:max-w-sm p-4 rounded-lg shadow-lg transition-all transform translate-x-0
        {{ session('success') ? 'bg-green-500 text-white' : '' }}
        {{ session('error') || $errors->any() ? 'bg-red-500 text-white' : '' }}">

        <div class="flex items-start justify-between">
            <div class="flex items-center">
                @if(session('success'))
                    <i class="ph ph-check-circle mr-2 text-xl"></i>
                @elseif(session('error') || $errors->any())
                    <i class="ph ph-warning-circle mr-2 text-xl"></i>
                @endif
                <p class="text-sm sm:text-base">
                    {{ session('success') ?? session('error') ?? $errors->first() }}
                </p>
            </div>
            <button onclick="hideMessage()" class="text-white text-lg leading-none focus:outline-none ml-4">
                &times;
            </button>
        </div>
    </div>

    <script>
        function hideMessage() {
            let messageBox = document.getElementById('floating-message');
            if (messageBox) {
                messageBox.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    messageBox.style.display = 'none';
                }, 500);
            }
        }

        // Auto-hide message after 5 seconds
        setTimeout(hideMessage, 5000);

        // Responsif: Pindahkan ke tengah di mobile
        function adjustMessagePosition() {
            let messageBox = document.getElementById('floating-message');
            if (messageBox) {
                if (window.innerWidth < 640) { // Jika ukuran layar < 640px (Mobile)
                    messageBox.classList.remove('right-5');
                    messageBox.classList.add('top-2', 'left-1/2', 'transform', '-translate-x-1/2');
                } else { // Jika ukuran layar >= 640px (Desktop)
                    messageBox.classList.remove('top-2', 'left-1/2', '-translate-x-1/2');
                    messageBox.classList.add('right-5');
                }
            }
        }

        window.addEventListener('resize', adjustMessagePosition);
        adjustMessagePosition(); // Jalankan saat pertama kali dimuat
    </script>
@endif
