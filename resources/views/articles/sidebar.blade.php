<section class="sidebar">
    <p class="title is-4">최근글</p>
    <ul class="content is-small text-dark">
        @foreach($recentArticles as $recent)
            <li>
                <a href="{{ route('articles.show', $recent->id) }}">
                    <p class="text is-6">{{ $recent->title }}</p>
                </a>
                <p class="has-text-grey-light">{{ $recent->created_at->format('Y-m-d') }}</p>
            </li>
        @endforeach
    </ul>
</section>
