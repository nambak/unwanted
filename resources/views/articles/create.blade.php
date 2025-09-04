@extends('layouts.app')

@section('content')
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
@endsection
