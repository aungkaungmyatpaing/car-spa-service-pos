<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hero Car Sale & Spa</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/herocarlogo.png') }}">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Keyframe animation for bouncing */
        @keyframes bounce {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }

        /* Add a class to apply bouncing animation */
        .bounce-animation {
            animation: bounce 1s ease infinite;
        }
    </style>
</head>
<body>
    <div class="w-screen h-screen flex flex-col items-center justify-center">
        <img  id="heroCarLogo"  src="{{asset('/assets/images/herocarlogo.png')}}" style="width:300px">
        {{-- <span class="text-3xl font-bold text-gray-400">iPhone Cover World</span>
        <span class="text-sm text-gray-500 my-3">iPhone Cover Store in Myanmar</span> --}}
    </div>
    <script>
        // Get the image element
        const heroCarLogo = document.getElementById('heroCarLogo');

        // Function to bounce the image
        function bounceImage() {
            // Add class to apply bouncing animation
            heroCarLogo.classList.add('bounce-animation');

            // After 2 seconds, remove the animation class and redirect to /admin/login
            setTimeout(function() {
                heroCarLogo.classList.remove('bounce-animation');
                window.location.href = "/admin/login";
            }, 3000);
        }

        // Call bounceImage function immediately
        bounceImage();
    </script>
</body>
</html>
