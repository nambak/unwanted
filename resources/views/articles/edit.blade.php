@extends('layouts.app')

@section('content')
    <div class="containter">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">글 수정</div>

                    <div class="card-body">

                        @include('error')

                        <form action="{{ route('articles.update', ['article' => $article->id ]) }}" method="post" enctype="multipart/form-data">
                            @method('patch')

                            @csrf

                            제목*:
                            <input type="text" name="title" class="form-control" value="{{ $article->title }}" />
                            <br />

                            내용*:
                            <textarea name="article_text" class="form-control" rows="10">{{ $article->article_text }}</textarea>
                            <br />

                            카테고리:
                            <br />
                            @foreach ($categories as $category)
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" /> {{ $category->name }}
                                <br />
                            @endforeach
                            <br />

                            태그 (쉼표로 구분):
                            <input type="text" name="tags" class="form-control" value="">
                            <br />

                            이미지:
                            <br />
                            <input type="file" name="main_image" class="form-control-file mb-3">
                            <input type="submit" value=" 저장 " class="btn btn-primary" />

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection