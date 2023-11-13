
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #618264; }
        .active-nav-link { background: #79AC78; }
        .nav-item:hover { background: #B0D9B1 }
        .profile-link:hover,
        .logout-link:hover,
        .account-link:hover { background: #B0D9B1; }
      
    /* Define the custom bg-orange class with the desired background color */
    .bg-orange {
        background-color: #79AC78; /* Replace with your preferred shade of orange */
    }
    </style>
</head>

<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="/home" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
           
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('home') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item @if(request()->routeIs('home')) active-nav-link @else @endif ">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
        
            <a href="{{ route('projects') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item @if(request()->routeIs('project')) active-nav-link @else @endif">
                <i class="fas fa-table mr-3"></i>
                Project
            </a>
            <a href="{{ route('material') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item  @if(request()->routeIs('materials')) active-nav-link @else @endif">
                <i class="fas fa-align-left mr-3"></i>
                Inventories
            </a>
            <a href="{{ route('admin.requests') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item @if(request()->routeIs('analytics')) active-nav-link @else @endif">
                <i class="fas fa-tablet-alt mr-3"></i>
                Requests
            </a>
            <a href="{{ route('analytic') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item @if(request()->routeIs('analytics')) active-nav-link @else @endif">
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
         
        
        </header>
        
        </body>
        </html>