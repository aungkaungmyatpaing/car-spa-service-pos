@props(['title'=>'Hero Car Sale & Spa','activeMenu'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/0ca95d7137.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('assets/images/herocarlogo.png') }}">
    <title>{{$title}}</title>
</head>
<body>

    <x-layout.alert-box/>

    <div class="flex flex-row h-screen w-screen">
        <x-layout.sidebar activeMenu={{$activeMenu}}/>
        <div class=" flex-1 h-screen bg-[#eff3f7] flex flex-col relative">
            <div class="w-full h-16 bg-white flex flex-row items-center px-5 justify-between">
                <i id="show_mobile_nav" class="lg:hidden fa-solid fa-bars text-gray-600 text-[1.6rem]"></i>
                <span class="text-xl max-sm:text-sm font-semibold text-gray-600">
                    {{ ucfirst($activeMenu) }}
                </span>
                <div class="flex flex-row items-center justify-end gap-2">
                    <span class="text-sm font-semibold text-gray-600">
                        {{Auth::user()->name}}
                    </span>
                    <div class="w-10 h-10 overflow-hidden rounded-full ml-3" id="user-image">
                        <img src="{{ Auth::user()->getFirstMediaUrl('avatar')}}" alt="" class="object-cover w-full h-full">
                    </div>
                    <div class="relative inline-block text-left">
                        <div>
                            <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="false" aria-haspopup="true">
                                Options
                                <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <div class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" id="dropdown-menu">
                            <div class="py-1" role="none">
                                <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                @if (auth()->user()->role == 'admin')
                                <a href="{{ route('users.edit', auth()->user()->id) }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-0">Account settings</a>
                                @endif
                                <a href="/logout" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-2">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mobile_nav" class="hidden h-[100%] w-[50%] border-r-2 bg-white px-2 overflow-y-scroll z-50 absolute top-0 left-0">
                <div class="flex w-full justify-end h-16 items-center">
                    <div class="flex items-center justify-between py-5">
                        <img src="{{asset('/assets/images/herocarlogo2.png')}}" class="w-48" alt="logo">
                    </div>
                    <i id="hidden_mobile_nav" class="fa-solid fa-xmark mr-5 text-gray-600 text-[1.6rem]"></i>
                </div>
                <nav class="flex flex-col gap-1 font-sans text-base font-normal text-gray-700 mt-5">
                    @if(Auth::user()->role == 'admin')
                        <x-aside-menu active="{{ $activeMenu == 'dashboard'}}" label="Dashboard" icon="fa-solid fa-square-poll-vertical" to="{{ route('dashboard') }}"/>

                        <hr class="mt-1">
                        <span class="my-2">General</span>

                        <x-aside-menu active="{{ $activeMenu == 'categories'}}" label="Categories" icon="fa-solid fa-list" to="{{ route('categories.index') }}"/>

                        <x-aside-menu active="{{ $activeMenu == 'sub-categories'}}" label="Sub Categories" icon="fa-solid fa-box-archive" to="{{ route('sub_categories.index') }}"/>

                        <x-aside-menu active="{{ $activeMenu == 'durations'}}" label="Durations" icon="fa-solid fa-clock" to="{{ route('durations.index') }}"/>

                        <x-aside-menu active="{{ $activeMenu == 'sizes'}}" label="Sizes" icon="fa-solid fa-car-side" to="{{ route('sizes.index') }}"/>



                        <hr class="mt-1">
                        <span class="my-2">Service</span>

                        <x-aside-menu active="{{ $activeMenu == 'services'}}" label="Services" icon="fa-solid fa-paint-roller" to="{{ route('services.index') }}"/>

                    @endif

                    {{-- POS --}}
                    <hr class="mt-1">
                    <span class="my-2">POS</span>

                    <x-aside-menu active="{{ $activeMenu == 'cashier'}}" label="Cashier" icon="fa-solid fa-clipboard" to="{{ route('cashier.index') }}"/>

                    <x-aside-menu active="{{ $activeMenu == 'invoices'}}" label="Invoices" icon="fa-solid fa-receipt" to="{{ route('invoices.index') }}"/>


                    {{-- Variants --}}
                    {{-- <hr class="mt-1">
                    <span class="my-2">Variants</span>

                    <x-aside-menu active="{{ $activeMenu == 'colors'}}" label="Colors" icon="fa-solid fa-palette" to="{{ route('colors.index') }}"/>

                    <x-aside-menu active="{{ $activeMenu == 'sizes'}}" label="Sizes" icon="fa-solid fa-maximize" to="{{ route('sizes.index') }}"/> --}}

                    {{-- Account --}}
                    @if(Auth::user()->role == 'admin')
                    <hr class="mt-1">
                    <span class="my-2">History</span>

                    <x-aside-menu active="{{ $activeMenu == 'invoiceHistories'}}" label="Invoice Histories" icon="fa-solid fa-file" to="{{ route('invoiceHistories.index') }}"/>

                    @endif

                    <hr class="mt-1">
                    <span class="my-2">Account</span>

                    @if(Auth::user()->role == 'admin')
                        <x-aside-menu active="{{ $activeMenu == 'users'}}" label="Users" icon="fa-solid fa-users" to="{{ route('users.index') }}"/>
                    @endif



                    <a href={{route('logout')}} class="mb-20">
                        <div tabindex="0" class="flex items-center w-full bg-red-50 px-3 py-2 rounded-md text-start outline-none ">
                            <div class="w-5 h-7 text-red-400">
                                <i class="fa-solid fa-right-from-bracket text-xl "></i>
                            </div>
                            <span class="ml-3 mr-20 text-sm text-red-400">Logout</span>
                        </div>
                    </a>
                </nav>
            </div>
            <div class="flex flex-col flex-1 overflow-y-scroll overflow-x-hidden">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#custom-alert-box').slideUp();
        }, 3000);

        $("#menu-button").click(function() {
            $("#dropdown-menu").toggleClass("hidden");
            var expanded = $(this).attr("aria-expanded") === "true" || false;
            $(this).attr("aria-expanded", !expanded);
        });

    });

    $('#show_mobile_nav').click(function() {
            $('#mobile_nav').fadeIn(300).removeClass('hidden');
        });

        $('#hidden_mobile_nav').click(function() {
            $('#mobile_nav').fadeOut(300, function() {
                $(this).addClass('hidden');
            });
    });

    $('#user-image').click(function() {
            $('#logout-dropdown').toggle();
        });

        $(document).click(function(event) {
            if (!$(event.target).closest('#user-image').length && !$(event.target).closest('#logout-dropdown').length) {
                $('#logout-dropdown').hide();
            }
    });
</script>

</html>
