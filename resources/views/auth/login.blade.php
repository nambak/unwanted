@extends('layouts.app')

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">로그인</p>
        </header>
        <div class="card-content">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email" class="label">이메일</label>
                    <div class="control">
                        <input id="email" type="email"
                               class="input {{ $errors->has('email') ? ' is-danger' : '' }}" name="email"
                               value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <p class="help is-danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </p>
                        @endif</div>
                </div>

                <div class="field">
                    <label for="password" class="label">비밀번호</label>
                    <div class="control">
                        <input id="password" type="password"
                               class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
                               name="password"
                               required>

                        @if ($errors->has('password'))
                            <p class="help is-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <label class="checkbox" for="remember">
                            <input type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            아이디 저장
                        </label>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button">
                            로그인
                        </button>
                    </div>
                </div>
                <div class="field has-text-right">
                    <a href="{{ route('password.request') }}">
                        비밀번호 찾기
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
