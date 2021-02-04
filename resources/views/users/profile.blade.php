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
            {{$user->name}}
            {{$user->email}}
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach ($user->announcements as $announcement)
            @include('includes._announcements')
        @endforeach
    </div>

</div>
@endsection
