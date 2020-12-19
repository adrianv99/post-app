@extends('layouts.app')

@section('content')
    <div class="flex justify-center my-10">
        <div class="w-6/12 bg-white rounded-lg p-6">
            <h1 class="text-xl text-gray-800 font-bold mt-5 mb-8">
                Login
            </h1>
            @if (session('status'))
              <p class="text-red-500 text-sm">{{ session('status') }}</p>  
            @endif
            <form method="post" action="{{ route('login') }}">
                @csrf
                <input type="email" class="bg-gray-100 border-2 w-full p-4 rounded-lg my-2" 
                placeholder="E-mail" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
                <input type="password" class="bg-gray-100 border-2 w-full p-4 rounded-lg my-2" 
                placeholder="Password" name="password" id="password">
                @error('password')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
                <button type="submit" class="bg-indigo-500 text-white w-full rounded-lg p-4 my-2">Login</button>

                <input type="checkbox" class="rounded-lg my-4" name="remember" id="remenber">
                <label class="my-4 text-indigo-500" for="Remember me">Remember me</label>
            </form>
        </div>
    </div>
@endsection