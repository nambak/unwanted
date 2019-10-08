@extends('layouts.app')

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">글 수정</p>
        </header>
        <div class="card-content">

            @include('error')

            <article-edit
                :categories="{{ $categories }}"
                :article="{{ $article }}"
            ></article-edit>
        </div>
    </div>
@endsection
