@props(['activeMenu'])

<aside class="relative lg:flex hidden flex-col text-gray-700 h-screen overflow-y-scroll bg-white px-5 shadow-md shadow-gray-200">
    <div class="flex items-center justify-between py-5">
        <img src="{{asset('/assets/images/herocarlogo2.png')}}" class="w-48" alt="logo">
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

    <script>
        //
    </script>
</aside>
