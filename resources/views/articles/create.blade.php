@extends('layouts.app')

@section('content')
    <div class="card" xmlns="http://www.w3.org/1999/html">
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

            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="field">
                    <label for="title" class="label">제목:</label>
                    <div class="control">
                        <input type="text" id="title" name="title" class="input" value="{{ old('title') }}"/>
                    </div>
                </div>

                <div class="field">
                    <label for="articleText" class="label">내용:</label>
                    <div class="control">
                        {{-- TODO: medium-editor로 대체 --}}
                        <textarea id="articleText" name="article_text" class="textarea" rows="10">{{ old('article_text') }}</textarea>
                    </div>
                </div>

                <div class="field">
                    <label for="categories" class="label">카테고리:</label>
                    <div class="control">
                        @foreach ($categories as $category)
                            <label class="checkbox">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"/>
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="field">
                    <label for="tags">태그:</label>
                    <div class="control">
                        <input type="text" id="tags" name="tags" class="input"/>
                    </div>
                    <p class="help">쉼표로 구분</p>
                </div>

                <div class="field">
                    <label for="main_image" class="label">이미지:</label>
                    <div class="file has-name">
                        <label class="file-label">
                            <input type="file" id="main_image" name="main_image" class="file-input">
                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    파일 선택
                                </span>
                            </span>
                            <span class="file-name">
                                선택된 파일 없음
                            </span>
                        </label>
                    </div>
                </div>
                <input type="submit" value=" 저장 " class="btn btn-primary"/>

            </form>

        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            var file = $('#main_image');

            file.change(function () {
                if (this.files[0].size > 0) {
                    $('.file-name').html(this.files[0].name);
                }
            });
        });
    </script>
@endsection
