@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header"><h1>{{ $article->title }}</h1></div>

                    <div class="card-body">

                        <p>
                            <img src="{{ $article->getFirstMediaUrl('main_images', 'main') }}" />
                        </p>

                        <p>
                            <b>작성자:</b> {{ $article->author->name }}
                        </p>
                        <p>
                            <b>카테고리:</b>
                            {!! $article->categories_links !!}
                        </p>
                        <p>
                            <b>태그:</b>
                            {!! $article->tags_links !!}
                        </p>

                        <p>{!! nl2br($article->article_text) !!}</p>

                    </div>
                </div>
                @auth
                    <a class="btn btn-info text-white" href="{{ route('articles.edit', ['article' => $article->id]) }}">수정</a>
                    <form method="post" action="/articles/{{ $article->id }}" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger text-white">삭제</button>
                    </form>
                @endauth
            </div>
            <div class="col-md-4">
                @include('articles.sidebar')
            </div>
        </div>
    </div>
@endsection