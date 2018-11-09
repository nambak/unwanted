@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">새 글 쓰기</div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            제목*:
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" />
                            <br />

                            내용*:
                            <textarea name="article_text" class="form-control" rows="10">{{ old('article_text') }}</textarea>
                            <br />

                            카테고리:
                            <br />
                            @foreach ($categories as $category)
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" /> {{ $category->name }}
                                <br />
                            @endforeach
                            <br />

                            태그 (쉼표로 구분):
                            <input type="text" name="tags" class="form-control" />
                            <br />

                            이미:
                            <br />
                            <input type="file" name="main_image" />
                            <br /><br />

                            <input type="submit" value=" 저장 " class="btn btn-primary" />

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection