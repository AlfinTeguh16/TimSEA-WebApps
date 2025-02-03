<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    @vite(['resources/css/app.css'])
    <title>Document</title>
</head>
<body>
    <section id="main-section" class="bg-white flex flex-col justify-center items-center min-h-screen w-full">
        <div class="my-2 text-center">
            <h1 class="font-bold text-2xl">Build Your Dream Team</h1>
            <p class="text-center text-gray-700">Choose the perfect package tailored to your needs and kickstart your project with our top freelancers.</p>
        </div>
    
        <div class="flex flex-wrap flex-col md:flex-row justify-center items-center gap-6 mt-6">
            <div id="super-team-card" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center">
                <img src="asset/img/super-team.svg" alt="Super Team" class="w-full h-auto max-h-[150px] object-contain">
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Super Team</h2>
            </div>
            <div id="press-release-card" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center">
                <img src="asset/img/press-release.svg" alt="Press Release" class="w-full h-auto max-h-[150px] object-contain">
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Press Release</h2>
            </div>
            <div id="all-in-one-package-card" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center">
                <img src="asset/img/all-in-one-package.svg" alt="All-in-One Package" class="w-full h-auto max-h-[150px] object-contain">
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">All-in-One Package</h2>
            </div>
        </div>
    </section>
    
    
    <div id="super-team-page" class="hidden bg-white flex-col justify-center items-center min-h-screen w-full">
        <div class="my-2 text-center">
            <h1 class="font-bold text-2xl">Customize Your Super Team</h1>
            <p class="text-center text-gray-700">Select the category that matches your project goals. We'll connect you with the best professionals.</p>
        </div>
    
        <div class="flex flex-wrap flex-col md:flex-row justify-center items-center gap-6 mt-6">
            <!-- Existing Cards -->
            <div id="web-dev-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-code text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Web Development</h2>
            </div>
    
            <div id="mobile-dev-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-android-logo text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Mobile App Dev</h2>
            </div>
    
            <!-- New Cards -->
            <!-- Community Roles -->
            <div id="community-manager-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-users text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Community Manager</h2>
            </div>
    
            <div id="community-moderator-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-shield-check text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Community Moderator</h2>
            </div>
    
            <!-- Social Media & Content -->
            <div id="social-media-manager-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-share-network text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Social Media Manager</h2>
            </div>
    
            <div id="content-creator-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-pencil-simple-line text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Content Creator</h2>
            </div>
    
            <!-- Design Roles -->
            <div id="graphic-designer-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-paint-brush text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Graphic Designer</h2>
            </div>
    
            <div id="ui-ux-designer-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-layout text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">UI/UX Designer</h2>
            </div>
    
            <!-- Development Roles -->
            <div id="fullstack-dev-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-stack text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Fullstack Developer</h2>
            </div>
    
            <div id="frontend-dev-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-browser text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Frontend Developer</h2>
            </div>
    
            <div id="backend-dev-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-database text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Backend Developer</h2>
            </div>
    
            <!-- Game & 3D Design -->
            <div id="unity-dev-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-game-controller text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">Unity Game Developer</h2>
            </div>
    
            <div id="3d-designer-card-p" class="w-[372px] h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-[38px] flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[150px] relative">
                    <i class="ph-fill ph-cube text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4">3D Designer</h2>
            </div>
        </div>
    </div>

    <div id="press-release-page" class="hidden bg-white  flex-col justify-center items-center min-h-screen w-full px-4">
        <div class="my-4 text-center max-w-[90%] md:max-w-[80%] lg:max-w-full">
            <h1 class="font-bold text-2xl md:text-3xl lg:text-4xl">Craft the Perfect Story</h1>
            <p class="text-center text-gray-700 text-sm md:text-base lg:text-lg">
                Select the type of press release that suits your needs and let our experts handle the rest.
            </p>
        </div>
    
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6 w-full max-w-[90%] md:max-w-[80%] lg:max-w-full">

            <div id="press-release-p" class="w-full min-h-[250px] sm:min-h-[280px] md:min-h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-6 sm:p-8 md:p-10 flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[120px]">
                    <i class="ph-fill ph-rocket text-[80px] sm:text-[100px] md:text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4 text-base md:text-lg lg:text-xl">Products Launch</h2>
            </div>
    
            <div id="influencer-p" class="w-full min-h-[250px] sm:min-h-[280px] md:min-h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-6 sm:p-8 md:p-10 flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[120px]">
                    <i class="ph-fill ph-calendar text-[80px] sm:text-[100px] md:text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4 text-base md:text-lg lg:text-xl">Event Announcement</h2>
            </div>
        </div>
    </div>
    
    <div id="all-in-one-page" class="hidden bg-white  flex-col justify-center items-center min-h-screen w-full px-4">
        <div class="my-4 text-center max-w-[90%] md:max-w-[80%] lg:max-w-full">
            <h1 class="font-bold text-2xl md:text-3xl lg:text-4xl">Everything You Need, All in One</h1>
            <p class="text-center text-gray-700 text-sm md:text-base lg:text-lg">
                Choose the focus areas for your comprehensive package and watch your project come to life.
            </p>
        </div>
    
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6 w-full max-w-[90%] md:max-w-[80%] lg:max-w-full">
            <!-- Branding & Identity Card -->
            <div id="branding-identity-p" class="w-full min-h-[250px] sm:min-h-[280px] md:min-h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-6 sm:p-8 md:p-10 flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[120px]">
                    <i class="ph-fill ph-identification-badge text-[80px] sm:text-[100px] md:text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4 text-base md:text-lg lg:text-xl">Branding & Identity</h2>
            </div>
    
            <!-- Marketing Campaigns Card -->
            <div id="marketing-campaigns-p" class="w-full min-h-[250px] sm:min-h-[280px] md:min-h-[300px] bg-neutral-50 hover:bg-primary-100 rounded-md hover:border-2 hover:border-primary-300 p-6 sm:p-8 md:p-10 flex flex-col items-center text-center group">
                <span class="flex items-center justify-center w-full h-[120px]">
                    <i class="ph-fill ph-shopping-bag text-[80px] sm:text-[100px] md:text-[120px] text-neutral-600 transition-all duration-300 group-hover:text-transparent group-hover:bg-gradient-to-r from-secondary-500 to-primary-500 bg-clip-text"></i>
                </span>
                <h2 class="text-neutral-800 hover:text-primary-500 mt-4 text-base md:text-lg lg:text-xl">Super Team</h2>
            </div>
    </div>



    <div id="submit-form" class="hidden absolute bg-white flex-col justify-center items-center min-h-screen w-full px-4">
        <div class="my-4 text-center max-w-[90%] md:max-w-[80%] lg:max-w-full">
            <h1 class="font-bold text-2xl md:text-3xl lg:text-4xl">Let's Get Started</h1>
            <p class="text-center text-gray-700 text-sm md:text-base lg:text-lg">
                Tell us a bit about yourself so we can tailor the best experience for you. Your information helps us connect you with the right experts.
            </p>
        </div>

    
        <div class="w-full flex justify-center">
            <form action="{{ route('submit.form') }}" method="POST" class="w-4/5 max-w-3xl bg-white p-6">
                @csrf
                <!-- Initial Data -->
                <h2 class="text-lg font-thin text-neutral-400 mb-4">Initial Data</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label for="package-name" class="font-base">Package Name <span class="text-red-500">*</span></label>
                        <input type="text" id="package-name" name="package-name" readonly class="border bg-neutral-200 border-gray-300 rounded-md w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label for="category" class="font-base">Category <span class="text-red-500">*</span></label>
                        <input type="text" id="category" name="category" readonly class="border bg-neutral-200 border-gray-300 rounded-md w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>
        
                <!-- Company Informations -->
                <h2 class="text-lg font-thin text-neutral-400 mt-6 mb-4">Company Informations</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label for="company-name" class="font-base">Company Name / Your Name <span class="text-red-500">*</span></label>
                        <input type="text" id="company-name" name="company-name" placeholder="e.g., Acme Corp / John Doe" class="border border-gray-300 rounded-md w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label for="email" class="font-base">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" placeholder="e.g., contact@yourcompany.com" class="border border-gray-300 rounded-md w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label for="location" class="font-base">Company Location <span class="text-red-500">*</span></label>
                        <input type="text" id="location" name="location" placeholder="e.g., New York, USA" class="border border-gray-300 rounded-md w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div class="flex flex-col">
                        <label for="industry" class="font-base">Industry Type <span class="text-red-500">*</span></label>
                        <input type="text" id="industry" name="industry" placeholder="e.g., Technology, Healthcare, Media, etc" class="border border-gray-300 rounded-md w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div class="flex flex-col md:col-span-2">
                        <label for="telegram" class="font-base">Telegram Username <span class="text-red-500">*</span></label>
                        <input type="text" id="telegram" name="telegram" placeholder="e.g., @yourusername" class="border border-gray-300 rounded-md w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>
        
                <!-- Project Informations -->
                <h2 class="text-lg font-thin text-neutral-400 mt-6 mb-4">Project Informations</h2>
                <div class="flex flex-col">
                    <label for="project-title" class="font-base">Project Title <span class="text-red-500">*</span></label>
                    <input type="text" id="project-title" name="project-title" placeholder="e.g., Project Name App" class="border border-gray-300 rounded-md w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="flex flex-col mt-4">
                    <label for="project-desc" class="font-base">Project Brief / Description <span class="text-red-500">*</span></label>
                    <textarea id="project-desc" name="project-desc" placeholder="Enter project details..." rows="4" class="border border-gray-300 rounded-md w-full p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>
        
                <!-- Submit Button -->
                <div class="flex justify-end mt-6">
                    <button type="button" onclick="showAlert()" class="bg-blue-600 text-white font-medium px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none flex items-center gap-2">
                        Finish Setup 
                        <i class="ph-bold ph-paper-plane-tilt"></i>
                    </button>
                </div>
                
                
                <!-- Alert Box -->
                <section id="alert-box" class="fixed inset-0 hidden items-center justify-center z-50 ">
                    <div onclick="hideAlert()" class="absolute inset-0 bg-black opacity-50"></div>
                    
                    <div class="relative bg-white rounded-lg shadow-lg max-w-md w-full">
                        <div class="bg-blue-500 flex justify-center items-center py-4 rounded-t-lg">
                            <i class="ph ph-info text-white text-4xl"></i>
                        </div>

                        <div class="p-6 text-center">
                            <h1 class="text-xl font-semibold text-gray-900 mb-3">Confirm Your Request!</h1>
                            <p class="text-gray-600 text-sm">
                                Please review your details before proceeding. By confirming, we'll notify our team about your request and send a confirmation email to your inbox.
                            </p>
                        </div>

                        <div class="flex justify-center gap-4 p-4 border-t">
                            <button type="submit" id="confirm-btn" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">
                                Confirm & Submit
                            </button>
                            <button type="button" onclick="hideAlert()" id="review-btn" class="border border-gray-300 px-4 py-2 rounded-md hover:bg-gray-100 transition">
                                Review Again
                            </button>
                        </div>
                    </div>
                </section>

            </form>
        </div>
        

    </div>





<script>
    document.addEventListener('DOMContentLoaded', function() {
    const mainSection = document.getElementById('main-section');

    const superTeamCard       = document.getElementById('super-team-card');
    const pressReleaseCard    = document.getElementById('press-release-card');
    const allInOnePackageCard = document.getElementById('all-in-one-package-card');

    const superTeamPage       = document.getElementById('super-team-page');
    const pressReleasePage    = document.getElementById('press-release-page');
    const allInOnePage        = document.getElementById('all-in-one-page');

    function hideAllPages() {
            mainSection.classList.add('hidden');
            mainSection.classList.remove('flex'); 
            superTeamPage.classList.add('hidden');
            superTeamPage.classList.remove('flex');
            pressReleasePage.classList.add('hidden');
            pressReleasePage.classList.remove('flex');
            allInOnePage.classList.add('hidden');
            allInOnePage.classList.remove('flex');
        }
        superTeamCard.addEventListener('click', function() {
            hideAllPages();
            superTeamPage.classList.remove('hidden');
            superTeamPage.classList.add('flex'); 
        });
        pressReleaseCard.addEventListener('click', function() {
            hideAllPages();
            pressReleasePage.classList.remove('hidden');
            pressReleasePage.classList.add('flex');
        });
        allInOnePackageCard.addEventListener('click', function() {
            hideAllPages();
            allInOnePage.classList.remove('hidden');
            allInOnePage.classList.add('flex');
        });
        document.querySelectorAll('.back-btn').forEach(button => {
            button.addEventListener('click', function() {
                hideAllPages();
                mainSection.classList.remove('hidden');
                mainSection.classList.add('flex');
            });
        });
    });

    const superTeamPage    = document.getElementById('super-team-page');
    const pressReleasePage = document.getElementById('press-release-page');
    const allInOnePage     = document.getElementById('all-in-one-page');

    function unhideSubmitForm() {
        document.getElementById("submit-form").style.display = "flex";
        document.getElementById("submit-form").classList.remove = "hidden";
        

        superTeamPage.classList.remove('flex');
        superTeamPage.classList.add('hidden');

        pressReleasePage.classList.remove('flex');
        pressReleasePage.classList.add('hidden');

        allInOnePage.classList.remove('flex');
        allInOnePage.classList.add('hidden');

    }

    document.getElementById("super-team-card").addEventListener("click", function() {
        document.getElementById("package-name").value = "Super Team";
    });

    document.getElementById("press-release-card").addEventListener("click", function() {
        document.getElementById("package-name").value = "Press Release";
    });

    document.getElementById("all-in-one-package-card").addEventListener("click", function() {
        document.getElementById("package-name").value = "All In One Package";
    });

    // Super Team
    // Existing listeners
    document.getElementById("web-dev-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Web Development";
        unhideSubmitForm();
    });

    document.getElementById("mobile-dev-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Mobile Development";
        unhideSubmitForm();
    });

    // New event listeners
    document.getElementById("community-manager-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Community Manager";
        unhideSubmitForm();
    });

    document.getElementById("community-moderator-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Community Moderator";
        unhideSubmitForm();
    });

    document.getElementById("social-media-manager-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Social Media Manager";
        unhideSubmitForm();
    });

    document.getElementById("content-creator-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Content Creator";
        unhideSubmitForm();
    });

    document.getElementById("graphic-designer-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Graphic Designer";
        unhideSubmitForm();
    });

    document.getElementById("ui-ux-designer-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "UI/UX Designer";
        unhideSubmitForm();
    });

    document.getElementById("fullstack-dev-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Fullstack Developer";
        unhideSubmitForm();
    });

    document.getElementById("frontend-dev-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Frontend Developer";
        unhideSubmitForm();
    });

    document.getElementById("backend-dev-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Backend Developer";
        unhideSubmitForm();
    });

    document.getElementById("unity-dev-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "Unity Game Developer";
        unhideSubmitForm();
    });

    document.getElementById("3d-designer-card-p").addEventListener("click", function() {
        document.getElementById("category").value = "3D Designer";
        unhideSubmitForm();
    });
    // Press Release
    document.getElementById("press-release-p").addEventListener("click", function() {
        document.getElementById("category").value = "Press Release";
        unhideSubmitForm();
    });

    document.getElementById("influencer-p").addEventListener("click", function() {
        document.getElementById("category").value = "Influencer";
        unhideSubmitForm();
    });

    // All in One Package
    document.getElementById("branding-identity-p").addEventListener("click", function() {
        document.getElementById("category").value = "Branding & Identity";
        unhideSubmitForm();
    });

    document.getElementById("marketing-campaigns-p").addEventListener("click", function() {
        document.getElementById("category").value = "Marketing Campaigns";
        unhideSubmitForm();
    });

    document.getElementById("technical-development-p").addEventListener("click", function() {
        document.getElementById("category").value = "Technical Development";
        unhideSubmitForm();
    });

    document.getElementById("community-engagement-p").addEventListener("click", function() {
        document.getElementById("category").value = "Community Engagement";
        unhideSubmitForm();
    });
    


    function showAlert() {
        document.getElementById('alert-box').classList.remove('hidden');
        document.getElementById('alert-box').classList.add('flex');
    }

    function hideAlert() {
        document.getElementById('alert-box').classList.add('hidden');
    }

    document.getElementById('review-btn').addEventListener('click', hideAlert);
</script>
    
    
</body>
</html>
