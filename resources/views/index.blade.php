<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Page</title>
    <link rel="icon" type="image/x-icon" href="img/lts-logo.png" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-image: url('img/ltsbg.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #loader {
            border: 12px solid #f3f3f3;
            border-radius: 50%;
            border-top: 10px solid #1f5db4;
            width: 70px;
            height: 70px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }

        .container {
    backdrop-filter: blur(5px); /* Adjust the blur amount as needed */
    background-color: rgba(255, 255, 255, 0.5); /* Adjust the background color and opacity */
    border-radius: 10px;
    overflow: hidden;
    width: 100%;
    max-width: 400px; /* Adjust the maximum width of the login container */
    padding: 20px; /* Add some padding for better visibility */
    box-sizing: border-box; /* Include padding and border in the box model */
}

        .center {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }
    </style>
</head>
<body>
    <div id="loader" class="center"></div>
    <div class="container-fluid py-3">
        <div class="h-screen bg-slate-50 flex justify-center items-center w-full">
            <form action="{{ route('login-user') }}" method="post">
                @csrf
                <div class="bg-white px-10 py-8 rounded-xl w-full max-w-sm shadow-lg">
                    <a href="/login"><img src="img/lts-logo.png" class="rounded-full w-24 h-24 mx-auto mb-4" alt="Logo nueva viscaya"></a>
                    <div class="space-y-4">
                        <h1 class="text-center text-2xl font-semibold text-gray-600">LOLONG TRUCKING SERVICES</h1>
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('failed'))
                            <div class="alert alert-danger text-center">{{ Session::get('failed') }}</div>
                        @endif
                        <div>
                            <label for="username" class="block mb-1 text-gray-600 font-semibold text-center">Username</label>
                            <input type="text" name="username" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full text-center" autofocus />
                            <center><span class="text-xs text-red-400 text-center">@error('username') {{ $message }} @enderror</span></center>
                        </div>
                        <div class="relative">
                            <label for="password" class="block mb-1 text-gray-600 font-semibold text-center">Password</label>
                            <input type="password" id="password" name="password" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full text-center" />
                            <div class="absolute top-9 right-3">
                                <i class="fas fa-eye cursor-pointer hover:text-gray-700" id="togglePassword"></i>
                            </div>
                            <center><span class="text-xs text-red-400">@error('password') {{ $message }} @enderror</span></center>
                        </div>
                    </div>
                    <button type="submit" class="mt-4 w-full bg-blue-500 text-white font-semibold py-2 rounded-md tracking-wide">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        togglePassword.onclick = async (e) => {
            let pass = document.querySelector('#password');
            const type = pass.getAttribute('type') === 'password' ? 'text' : 'password';
            pass.setAttribute('type', type);
            togglePassword.classList.toggle("fa-eye-slash");
        };

        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector("body").style.visibility = "hidden";
                document.querySelector("#loader").style.visibility = "visible";
            } else {
                document.querySelector("#loader").style.display = "none";
                document.querySelector("body").style.visibility = "visible";
            }
        };
    </script>
</body>
</html>