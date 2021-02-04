@extends('layouts.app')

@section('content')

@if (session('access.denied.revisor.only') )
    <div class="alert alert-danger">
        Accesso non consentito - Solo per revisori
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        @foreach ($announcements as $announcement)
            <div class="col-3">
                @foreach($announcement->images as $image)
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <img src="{{ $image->getUrl(300, 150) }}" class="rounded" alt="">
                        </div>
                    </div>
                @endforeach
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route( 'announcements.show', compact('announcement') ) }}">{{ $announcement->title }}</a>
                    </div>

                    <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                {{ $announcement->description }}
                            </div>

                        {{ $announcement->price }}
                        {{ $announcement->created_at->format('d-m-Y') }}
                        <a href="{{ route( 'announcements.show', compact('announcement') ) }}">{{ $announcement->user->name }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
