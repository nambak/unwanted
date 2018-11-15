@extends('layouts.app')

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
                                <li class="list-group-item">{{ $category['name'] }}</li>
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