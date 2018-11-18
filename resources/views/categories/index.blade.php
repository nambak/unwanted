@extends('layouts.app')

@section('style')
    <style>
        .categoryDelete { cursor: pointer; }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">카테고리</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('categories.create')}}" class="btn btn-primary" role="button">카테고리 추가</a>
                        </div>
                        <ul class="list-group">
                            @forelse($categories as $category)
                                <li class="list-group-item">
                                    {{ $category['name'] }}
                                    @if (auth()->check())
                                    <span class="float-right text-danger categoryDelete"
                                          data-category-id="{{ $category->id }}"><i class="fas fa-trash-alt"></i>
                                    </span>
                                    @endif
                                </li>
                            @empty
                                <li class="list-group-item text-center">카테고리가 없습니다.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.categoryDelete').click(function () {
                var categoryId = $(this).data('category-id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/categories/' + categoryId,
                    method: 'delete'
                })
                .done(function () {
                    location.reload();
                });
            });
        });
    </script>
@endsection