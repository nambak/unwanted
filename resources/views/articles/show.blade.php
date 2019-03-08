@extends('layouts.app')

@section('content')
    <div class="columns">
        <div class="column is-four-fifths">
            <article>
                <h1 class="title is-2">{{ $article->title }}</h1>
                <p class="subtitle is-6 has-text-grey-lighter">
                    {{$article->created_at->format('Y-m-d')}}
                </p>

                @if ($article->getFirstMediaUrl('main_images'))
                <p>
                    <img src="{{ $article->getFirstMediaUrl('main_images') }}"/>
                </p>
                @endif

                <p class="text">
                    {!! nl2br($article->article_text) !!}
                </p>

                <p class="content is-small">
                    @if ($article->catorgories_link)
                        <span><b>Category </b>{!! $article->categories_links !!}</span>
                    @endif

                    @if ($article->tags_links !== 'none')
                        <span><b>Tag </b>{!! $article->tags_links !!}</span>
                    @endif
                </p>
            </article>

            @auth
                <div class="has-text-right">
                    <a class="button is-small" href="{{ route('articles.edit', ['article' => $article->id]) }}">수정</a>
                    <form method="post" action="/articles/{{ $article->id }}" style="display: inline;">
                        @csrf
                        @method('DELETE')

                        <button class="button is-small" type="submit">삭제</button>
                    </form>
                </div>
            @endauth

            <div id="disqus_thread"></div>
            <script>

                /**
                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                /*
                var disqus_config = function () {
                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                */
                (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://unwanted-1.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

        </div>
        <div class="column is-one-fifths">

            @include('articles.sidebar')

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#showList').on('click', function () {
                history.back();
            });
        });
    </script>
@endsection
