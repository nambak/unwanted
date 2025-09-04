@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <category-index 
                    :categories="{{ $categories->toJson() }}"
                    :is-authenticated="{{ auth()->check() ? 'true' : 'false' }}"
                ></category-index>
            </div>
        </div>
    </div>
@endsection