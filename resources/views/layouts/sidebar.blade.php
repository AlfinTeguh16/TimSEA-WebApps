<div class="flex h-screen">
    <!-- Overlay for closing sidebar on mobile -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden lg:hidden"></div>
    
    <!-- Side Menu -->
    <div id="side-menu" class="w-[80%] md:w-[30%] lg:w-1/5 fixed md:relative h-[100%] bg-white shadow-md transition-transform duration-300 transform -translate-x-full md:translate-x-0">
        <section id="side-menu-content" class="h-full flex flex-col border-solid">
            <div class="flex justify-center items-center h-[190px]">
                <img src="{{ asset('asset/img/LogoTS.png') }}" alt="logo" class="max-w-[50px] max-h-[50px]">
            </div>
            <div id="main-menu" class="flex flex-col px-6">
                <p class="mb-2">Main Menu</p>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard.get') }}" 
                        class="menu-item {{ request()->routeIs('admin.dashboard.get') ? 'bg-primary-500 text-white' : 'bg-white text-neutral-500 hover:bg-neutral-200 hover:text-neutral-700' }}">
                        <i class="ph-bold ph-house mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.show-user-client.get') }}" 
                        class="menu-item {{ request()->routeIs(['admin.show-user-client.get', 'admin.create-user.client.get', 'admin.edit-user.client.get']) ? 'bg-primary-500 text-white' : 'bg-white text-neutral-500 hover:bg-neutral-200 hover:text-neutral-700' }}">
                        <i class="ph-bold ph-user-plus mr-2"></i> User Client
                    </a>
                    <a href="{{ route('admin.super-team.get') }}" 
                        class="menu-item {{ request()->routeIs(['admin.super-team.get', 'admin.create-super-team.get', 'admin.complete-project-super-team.get', 'admin.super-team.show.get']) ? 'bg-primary-500 text-white' : 'bg-white text-neutral-500 hover:bg-neutral-200 hover:text-neutral-700' }}">
                        <i class="ph-bold ph-users-four mr-2"></i>Super Team
                    </a>
                    <a href="{{ route('admin.pr.get') }}" 
                        class="menu-item {{ request()->routeIs(['admin.pr.get', 'admin.create-pr.get', 'admin.show-pr.get', 'admin.edit-pr.get']) ? 'bg-primary-500 text-white' : 'bg-white text-neutral-500 hover:bg-neutral-200 hover:text-neutral-700' }}">
                        <i class="ph-bold ph-devices mr-2"></i>Press Release
                    </a>
                @endif

                @if(auth()->user()->role === 'company')
                    <a href="{{ route('company.dashboard.get') }}" 
                        class="menu-item {{ request()->routeIs(['company.dashboard.get', 'company.super-team.show.get']) ? 'bg-primary-500 text-white' : 'bg-white text-neutral-500 hover:bg-neutral-200 hover:text-neutral-700' }}">
                        <i class="ph-bold ph-house mr-2"></i>Dashboard
                    </a>

                @endif
            </div>
        </section>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="flex-1 flex flex-col transition-all duration-300 md:ml-1/4 lg:ml-1/5">
        <!-- Top Menu -->
        <section id="top-menu" class="h-[50px] w-full flex items-center bg-white px-4">
            <div class="flex justify-between md:justify-end w-full">
                <button id="btn-menu" class="ph-bold ph-list p-2 bg-primary-500 hover:bg-primary-700 text-white rounded-md cursor-pointer md:hidden"></button>
                <div class="flex items-center space-x-4">
                    <i class="ph ph-bell-ringing text-gray-600 cursor-pointer hover:text-gray-800"></i>
                    <img src="{{ auth()->user()->profile_picture ? asset(auth()->user()->profile_picture) : asset('asset/img/default-user.png') }}" 
                        alt="user-profile" 
                        class="rounded-md h-8 w-8 object-cover cursor-pointer">
                </div>
            </div>
        </section>

        <!-- Content Area -->
        <div class="flex-1 p-4 overflow-y-auto">
            @yield('content')
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const btnMenu = document.getElementById('btn-menu');
    const sideMenu = document.getElementById('side-menu');
    const overlay = document.getElementById('overlay');
    
    btnMenu.addEventListener('click', () => {
        sideMenu.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });
    
    overlay.addEventListener('click', () => {
        sideMenu.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
});
</script>

<style>
#side-menu.hidden {
    transform: translateX(-100%);
    width: 0;
    overflow: hidden;
}

#main-content.expanded {
    flex: 1 1 100%;
    width: 100%;
}

.menu-item {
    display: block;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    margin: 0.25rem 0;
    text-decoration: none;
    font-size: 0.875rem;
}
</style>