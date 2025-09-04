@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">로그인</h3>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-6">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">이메일</label>
                                <input id="email" type="email"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent {{ $errors->has('email') ? 'border-red-500' : '' }}" 
                                       name="email"
                                       value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <p class="mt-2 text-sm text-red-600">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </p>
                                @endif
                            </div>

                            <div class="mb-6">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">비밀번호</label>
                                <input id="password" type="password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent {{ $errors->has('password') ? 'border-red-500' : '' }}"
                                       name="password"
                                       required>

                                @if ($errors->has('password'))
                                    <p class="mt-2 text-sm text-red-600">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </p>
                                @endif
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center">
                                    <input type="checkbox" name="remember" id="remember" 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                           {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="ml-2 text-sm text-gray-700">
                                        아이디 저장
                                    </label>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    로그인
                                </button>
                                
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500">
                                    비밀번호 찾기
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
@endsection
