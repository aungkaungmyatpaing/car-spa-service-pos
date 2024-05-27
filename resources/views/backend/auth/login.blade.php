<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/0ca95d7137.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/images/herocarlogo.png') }}">
    @vite('resources/css/app.css')
</head>
<body>
        @if (Session::get('fail'))
            <div role="alert" id="error-message" class="rounded border-s-4 border-red-500 bg-white shadow-normal p-4 w-[400px] right-10 top-10 fixed">
                <strong class="block font-medium text-red-500"> Error </strong>

                <p class="mt-2 text-sm text-gray-500">
                    {{ Session::get('fail') }}
                </p>
            </div>
        @endif



    <div class="w-screen h-screen bg-gray-100 flex flex-row">
        <div class="h-screen flex-1 items-center justify-center max-xs:hidden max-sm:hidden max-md:hidden lg:flex flex-col">
            <img src="{{asset('/assets/images/herocarlogo.png')}}" style="width:400px">
        </div>
        <div class="lg:w-2/5 max-xs:w-full max-sm:px-10 max-sm:w-full max-md:w-full flex flex-col items-center justify-center bg-white">
            <img src="{{asset('/assets/images/herocarlogo.png')}}" class="lg:hidden" style="width:200px">
            <form action="{{ route('admin.login') }}" method="post" class="flex flex-col sm:w-[380px] sm:min-w-[380px] min-w-full rounded-lg">
                @csrf
                <span class="text-2xl font-bold">Login</span>
                <hr class="my-3 w-[100px]">
                <div class="mb-5">
                    <label for="email" class="block mb-2">Email</label>
                    <input type="email" placeholder="example@gmail.com" name="email" id="email" class="w-full p-2 border rounded-md text-sm" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2">Password</label>
                    <div class="flex items-center border rounded-md">
                        <input type="password" placeholder="password" name="password" id="password" class="w-full p-2 rounded-md text-sm">
                        <i id="togglePassword" class="fa-solid fa-eye text-gray-400 mx-1 cursor-pointer"></i>
                    </div>
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm">Remember me</label>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-md w-full">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#error-message').slideUp();
        }, 5000);
        $('#togglePassword').on('click', function() {
            const passwordInput = $('#password');
            const icon = $(this);

            // Toggle the type attribute
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>

</html>
