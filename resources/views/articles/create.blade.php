@extends('layouts.app')

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">새 글 쓰기</p>
        </header>
        <div class="card-content">

            @if ($errors->any())
                <div class="notification is-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <article-form :categories="{{ $categories }}"></article-form>
        </div>
    </div>
@endsection
