<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
    @vite(['resources/css/app.css'])
    <title>MyTimSEA</title>
</head>
<body class="text-black font-sans">

  <div class="flex min-h-screen">
    <!-- Left Section -->
    <div class="w-1/2 bg-white flex flex-col justify-center p-8">
      <div class="max-w-md mx-auto">
        <div class="flex justify-center mb-6">
          <img src="asset/img/LogoTS.png" alt="Logo" class="h-12">
        </div>
        <h2 class="text-2xl font-bold text-center mb-2">Showcase Your Skills on TimSea</h2>
        <p class="text-gray-600 text-center mb-6">Showcase your expertise, connect with clients, and grow your career.</p>
        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
          @csrf
          <!-- Form 1 -->
          <div id="form-1">
            <div>
              <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">Full Name<span class="required">*</span></label>
              <x-form name="username" placeholder="Enter your full name" />
            </div>
            <div>
              <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">Email<span class="required">*</span></label>
              <x-form name="email" placeholder="Enter your email" type="email" />
            </div>
            <div>
              <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">Phone<span class="required">*</span></label>
              <x-form name="phone" placeholder="Enter your phone number" type="text" />
            </div>
        
            <div class="flex flex-row justify-between">
              <div>
                <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">Password<span class="required">*</span></label>
                <x-form id="password" name="password" placeholder="Enter your password" variant="password" />
              </div>
              <div>
                <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">Confirm Password<span class="required">*</span></label>
                <x-form name="password_confirmation" variant="password" placeholder="Re-enter your password" required />
              </div>
            </div>
        
            <!-- Next Button -->
            <x-button id="next-btn" variant="outline" type="button" class="w-full mt-5">Next</x-button>
            <!-- Validation Message -->
            <p id="password-error" class="text-red-500 text-sm hidden">Password and Confirm Password do not match!</p>
          </div>
        
        
          <!-- Form 2 -->
          <div id="form-2" class="hidden">
            <div>
              <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">Field of Interest<span class="required">*</span></label>
              <select name="field" id="field" placeholder="Enter your field" 
                class="border border-neutral-300 rounded-lg w-full p-3 focus:ring-2 focus:ring-primary-500 focus:outline-none bg-white appearance-none">
                <option value="">Select Field</option>
                <option value="project_manager">Project Manager</option>
                <option value="community_manager">Community Manager</option>
                <option value="community_moderator">Community Moderator</option>
                <option value="social_media_manager">Social Media Manager</option>
                <option value="content_creator">Content Creator</option>
                <option value="graphic_designer">Graphic Designer</option>
                <option value="ui_ux_designer">UI/UX Designer</option>
                <option value="fullstack_developer">Fullstack Developer</option>
                <option value="frontend_developer">Frontend Developer</option>
                <option value="backend_developer">Backend Developer</option>
                <option value="unity_game_developer">Unity Game Developer</option>
                <option value="3d_designer">3D Designer</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">LinkedIn Profile<span class="required">*</span></label>
              <x-form name="linkedin" placeholder="Enter your Linkedin URL" />
            </div>
            <div>
              <label class="block text-sm font-medium md:text-base text-gray-700 mb-1 mt-3">URL Portfolio</label>
              <x-form name="url_portfolio" placeholder="Enter your porfolio URL" />
            </div>
        
            <x-button variant="primary" type="submit" class="w-full mt-5">Register</x-button>
          </div>
        </form>
      
      </div>
    </div>
    <!-- Right Section -->
    <div class="w-1/2 bg-cover bg-center flex items-center justify-center" style="background-image: url('asset/img/imgRegister.png');">
      <div class="text-white h-full text-center bg-black bg-opacity-50 p-8 rounded-lg">
        <div class="flex flex-col justify-center items-center h-full">
          <h2 class="text-3xl font-bold mb-4">Success Starts at TimSea</h2>
          <p class="text-lg">TimSea allows you to access global talent and get quality work done faster. Join now and seize unlimited opportunities!</p>
        </div>        
      </div>
    </div>
  </div>


  <script>
    // JavaScript untuk menampilkan form-2 dan menyembunyikan form-1
    document.getElementById('next-btn').addEventListener('click', function () {
      const form1 = document.getElementById('form-1');
      const form2 = document.getElementById('form-2');
  
      // Sembunyikan form-1
      form1.classList.add('hidden');
  
      // Tampilkan form-2
      form2.classList.remove('hidden');
    });
  </script>


</body>
</html>
