
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #435d7d; }
        .active-nav-link { background: #577D86; }
        .nav-item:hover { background: #87CBB9 }
        .profile-link:hover,
        .logout-link:hover,
        .account-link:hover { background: #87CBB9; }
      
    /* Define the custom bg-orange class with the desired background color */
    .bg-orange {
        background-color: #435d7d; /* Replace with your preferred shade of orange */
    }
    </style>
</head>

<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="/home" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Staff</a>
           
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('dashboard') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item @if(request()->routeIs('dashboard')) active-nav-link @else @endif ">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
        
            <a href="{{ route('project') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item @if(request()->routeIs('project')) active-nav-link @else @endif">
                <i class="fas fa-table mr-3"></i>
                Project
            </a>
            <a href="{{ route('materials') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item  @if(request()->routeIs('materials')) active-nav-link @else @endif">
                <i class="fas fa-align-left mr-3"></i>
                Inventories
            </a>
            <a href="{{ route('requestmaterials') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item  @if(request()->routeIs('materials')) active-nav-link @else @endif">
                <i class="fas fa-align-left mr-3"></i>
                Request Materials
            </a>
            <a href="{{ route('analytics') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item @if(request()->routeIs('analytics')) active-nav-link @else @endif">
                <i class="fas fa-tablet-alt mr-3"></i>
                Analytics
            </a>
          
        </nav>
      
    </aside>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
       
   
        <header class="w-full items-center bg-orange py-2 px-6 hidden sm:flex">
        <span class="labelheader" style="font-size: 20px; padding-right: 350px; white-space: nowrap;  color: white;">A King Inventory</span>

            <div class="w-1/2"></div>
        
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="https://thumbs.dreamstime.com/b/unknown-male-avatar-profile-image-businessman-vector-unknown-male-avatar-profile-image-businessman-vector-profile-179373829.jpg">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">   <div>{{ Auth::user()->name }}</div></a>
                  
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="profile-link">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}" >
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="logout-link">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="index.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
           
        </header>
        
        </body>
        </html>