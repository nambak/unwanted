<div class="card">
    <div class="card-header">검색</div>

    <div class="card-body">
        <form action="{{ route('articles.index') }}" method="GET">
            <input type="text" name="query" placeholder="키워드를 입력하세요..." value="{{ request('query') }}" />
            <input type="submit" class="btn btn-sm btn-info" value="검색" />
        </form>
    </div>
</div>

<br />

<div class="card">
    <div class="card-header">카테고리</div>

    <div class="card-body">
        <ul>
            @foreach ($all_categories as $category)
                <li>
                    <a href="{{ route('articles.index') }}?category_id={{ $category->id }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<br />

<div class="card">
    <div class="card-header">태</div>

    <div class="card-body">
        <ul>
            @foreach ($all_tags as $tag)
                <li>
                    <a href="{{ route('articles.index') }}?tag_id={{ $tag->id }}">{{ $tag->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>