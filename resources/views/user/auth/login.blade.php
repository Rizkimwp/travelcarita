<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Akun</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Travelix Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/login.css') }}">
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Daftar / Login untuk memulai Perjalanan</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="{{ route('registrasi') }}" method="POST">
                @csrf
                @method('POST')
                <h1>Daftar Akun</h1>

                {{-- Nama Lengkap --}}
                <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
                    value="{{ old('nama_lengkap') }}" />
                @error('nama_lengkap')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Email --}}
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" />
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Nomor Telepon --}}
                <input type="text" name="phone" placeholder="Nomor Telepon" value="{{ old('phone') }}" />
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Password --}}
                <input type="password" name="password" placeholder="Password" />
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Konfirmasi Password --}}
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" />

                <button type="submit">Daftar</button>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form action="{{ route('signin') }}" method="POST">
                @csrf
                <h1>Login</h1>

                {{-- Email --}}
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                {{-- Password --}}
                <input type="password" name="password" placeholder="Password" required />
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <a href="#">Forgot your password?</a>

                <button type="submit">Login</button>
            </form>

        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Selamat Datang Bro!</h1>
                    <p>Untuk selalu tersambung bersama kita, ayoo login!</p>
                    <button class="ghost" id="signIn">Login</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Halo, Guys!</h1>
                    <p>Masukan detail akun Lo, dan Mulai Petualangan bersama kita !</p>
                    <button class="ghost" id="signUp">Daftar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
</body>

</html>
