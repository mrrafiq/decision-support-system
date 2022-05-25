<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .login_img_section {
            background: linear-gradient(rgba(2, 2, 2, .7), rgba(0, 0, 0, .7)), url(https://images.unsplash.com/photo-1650825556125-060e52d40bd0?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80) center center;
        }

    </style>
</head>

<body>
    <div class="h-screen flex">
        <div class="hidden lg:flex w-full lg:w-1/2 login_img_section justify-around items-center">
            <div
                class="
                bg-black
                opacity-20
                inset-0
                z-0">
            </div>
            <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
                <h1 class="text-white font-bold text-4xl font-sans">Simple App</h1>
                <p class="text-white mt-1">The simplest app to use</p>
                <div class="flex justify-center lg:justify-start mt-6">
                    <a href="#"
                        class="hover:bg-indigo-700 hover:text-white hover:-translate-y-1 transition-all duration-500 bg-white text-indigo-800 mt-4 px-4 py-2 rounded-2xl font-bold mb-2">Get
                        Started</a>
                </div>
            </div>
        </div>
        <div class="flex w-full lg:w-1/2 justify-center items-center bg-white space-y-8">
            <div class="w-full px-8 md:px-32 lg:px-24">
                <form class="bg-white rounded-md shadow-2xl p-5" action="{{ route('post-register') }}" method="POST">
                    {{ csrf_field() }}
                    <h1 class="text-gray-800 font-bold text-2xl mb-1">Registrasi</h1>
                    <p class="text-sm font-normal text-gray-600 mb-8">Daftarkan akun baru</p>
                    <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <input id="username" class=" pl-2 w-full outline-none border-none" required type="text"
                            name="username" placeholder="Username" />
                    </div>
                    <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input id="email" class=" pl-2 w-full outline-none border-none" type="email" name="email"
                            placeholder="Email" required />
                    </div>
                    <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fillRule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clipRule="evenodd" />
                        </svg>
                        <input class="pl-2 w-full outline-none border-none" type="password" name="password"
                            id="password" placeholder="Password" onkeyup='check();' required />
                    </div>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl " id="pass">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fillRule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clipRule="evenodd" />
                        </svg>
                        <input class="pl-2 w-full outline-none border-none" type="password" name="password_confirm"
                            id="password_confirm" placeholder="Password Confirmation" onkeyup='check();' required />
                    </div>
                    <button type="submit"
                        class="block w-full bg-sky-500 mt-5 py-2 rounded-2xl hover:bg-sky-700 hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2">Register</button>
                    <div class="flex justify-between mt-4">
                        <a href="/login"
                            class="text-sm ml-2 hover:text-blue-500 cursor-pointer hover:-translate-y-1 duration-500 transition-all">Sudah
                            punya akun?</a>
                    </div>
                </form>
                @if ($errors->any())
                    <div class="basis-1/2 border-2 mt-6 rounded-2xl border-red-200 text-red-900 py-2 px-3 bg-red-100"
                        role="alert">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>

<script>
    var check = function() {
        if (document.getElementById('password').value == document.getElementById('password_confirm').value) {
            document.getElementById('pass').style.color = 'green';
        } else {
            document.getElementById('pass').style.color = 'red';
        }
    }
</script>
