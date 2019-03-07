@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column is-four-fifths">
            @forelse ($articles as $article)
                <article>
                    <a href="{{ route('articles.show', $article->id) }}">
                        <span class="title is-2">{{ $article->title }}</span>
                    </a>
                    <p class="subtitle is-6 has-text-grey-lighter">{{ $article->created_at->format('Y-m-d') }}</p>

                    <img src="https://placeimg.com/1280/480/tech?id={{$article->id}}">
                    {{--<img src="{{ $article->getFirstMediaUrl('main_images', 'thumb') }}" />--}}

                    <p class="text">
                        @if (strlen($article->article_text) >= 2000)
                            {!! str_replace("\r","\n", substr($article->article_text, 0, 2000)) !!}...
                        @else
                            {!! str_replace("\r","\n", $article->article_text) !!}
                        @endif
                    </p>
                    <p class="content is-small">
                        <span><b>Category </b>{!! $article->categories_links !!}</span>
                        <span><b>Tag </b>{!! $article->tags_links !!}</span>
                    </p>
                </article>
            @empty
                아직 글이 없습니다.
            @endforelse
        </div>
        <div class="column is-one-fifths">

            @include('articles.sidebar')

        </div>
    </div>
@endsection
