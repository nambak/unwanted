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

            <article-form :categories="{{ $categories }}"></article-form>
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
