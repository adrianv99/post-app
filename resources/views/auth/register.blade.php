@extends('layouts.app')

@section('content')
    <div class="flex justify-center my-10">
        <div class="w-6/12 bg-white rounded-lg p-6">
            <h1 class="text-xl text-gray-800 font-bold mt-5 mb-8">
                Register
            </h1>
            <form method="post" action="{{ route('register') }}">
                @csrf
                <input type="text" class="bg-gray-100 border-2 w-full p-4 rounded-lg my-2 @error('name') bg-red-300 @enderror" 
                placeholder="Name" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
                <input type="text" class="bg-gray-100 border-2 w-full p-4 rounded-lg my-2" 
                placeholder="Username" name="username" id="username" value="{{ old('username') }}">
                @error('username')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
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
                <input type="password" class="bg-gray-100 border-2 w-full p-4 rounded-lg my-2" 
                placeholder="Password confirmation" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
                <button type="submit" class="bg-indigo-500 text-white w-full rounded-lg p-4 my-2">Register</button>
            </form>
        </div>
    </div>
@endsection