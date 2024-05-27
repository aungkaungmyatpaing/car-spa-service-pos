<div>
    @if (session('success'))
        <div role="alert" id="custom-alert-box" class="rounded border-s-4 border-green-500 bg-white shadow-normal p-4 w-[400px] right-10 top-10 fixed">
            <strong class="block font-medium text-green-500"> Success </strong>

            <p class="mt-2 text-sm text-gray-500">
                {{ session('success') }}
            </p>
        </div>
    @endif

    @if($errors->any())
        <div role="alert" id="custom-alert-box" class="rounded border-s-4 border-red-500 bg-white shadow-normal p-4 w-[400px] right-10 top-10 fixed">
            <strong class="block font-medium text-red-500"> Error </strong>

            <p class="mt-2 text-sm text-gray-500">
                {{$errors->all()[0]}}
            </p>
        </div>
    @endif

    @if (Session::get('error'))
        <div role="alert" id="custom-alert-box" class="rounded border-s-4 border-red-500 bg-white shadow-normal p-4 w-[400px] right-10 top-10 fixed">
            <strong class="block font-medium text-red-500"> Error </strong>

            <p class="mt-2 text-sm text-gray-500">
                {{ Session::get('error') }}
            </p>
        </div>
    @endif

</div>
