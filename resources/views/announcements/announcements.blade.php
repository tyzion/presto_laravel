@extends('layouts.app')

@section('content')

<style>
    .pagination {
        justify-content: center;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Annunci trovati per la categoria: {{$category->name}}</h2>
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($announcements as $announcement)
            @include('includes._announcements')
        @endforeach
    </div>

    <div class="row justify-content-center">
        <div class="col-12 text-center">
            {{ $announcements->links() }}
        </div>
    </div>
</div>
@endsection
