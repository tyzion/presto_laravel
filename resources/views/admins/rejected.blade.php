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
                <a href="{{ route( 'announcements.show', compact('announcement') ) }}">
                    <img src="{{ Storage::url( $announcement->img ) }}" class="img-fluid" alt="">
                </a>
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route( 'announcements.show', compact('announcement') ) }}">{{ $announcement->title }}</a>
                    </div>

                    <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                {{ $announcement->description }}
                            </div>

                        {{ $announcement->price }}
                        {{ $announcement->category->name }}
                        {{ $announcement->created_at->format('d-m-Y') }}
                        <a href="{{ route( 'announcements.show', compact('announcement') ) }}">{{ $announcement->user->name }}</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.announcement.accepted', $announcement->id) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn btn-success">Accetta</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('admin.announcement.delete', $announcement->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
