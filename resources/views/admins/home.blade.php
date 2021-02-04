@extends('layouts.app')

@section('content')

@guest (session('access.denied.revisor.only') )
    <div class="alert alert-danger">
        Accesso non consentito - Solo per revisori
    </div>
@endguest

@if($announcement)

<div class="container">
    <div class="row justify-content-center">
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route( 'announcements.show', compact('announcement') ) }}">{{ $announcement->title }}</a>
                </div>

                <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ $announcement->description }}
                            {{ $announcement->category->name }}
                        </div>

                    {{ $announcement->price }}
                    {{ $announcement->created_at->format('d-m-Y') }}
                    <a href="{{ route( 'announcements.show', compact('announcement') ) }}">{{ $announcement->user->name }}</a>
                </div>
                <div class="card-footer">
                    <form action="{{ route('admin.announcement.accepted', $announcement->id) }}" method="POST">
                    @csrf
                        <button type="submit" class="btn btn-success">Accetta</button>
                    </form>
                    <form action="{{ route('admin.announcement.rejected', $announcement->id) }}" method="POST">
                    @csrf
                        <button type="submit" class="btn btn-danger">Rifiuta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"><h3>Immagini</h3></div>
        <div class="col-md-10">
            @foreach($announcement->images as $image)
                <div class="row mb-2">
                    <div class="col-md-4">
                        <img src="{{ $image->getUrl(300, 150) }}" class="rounded" alt="">
                    </div>
                    <div class="col-md-8">
                    <ul>
                        <li> Adult: {{ $image->adult }}</li>
                        <li> medical: {{ $image->medical }}</li>
                        <li> spoof: {{ $image->spoof }}</li>
                        <li> violence: {{ $image->violence }}</li>
                        <li> racy: {{ $image->racy }}</li>
                    </ul>

                    <b>Labels</b>
                    <ul>
                        @if($image->labels)
                            @foreach($image->labels as $label)
                                <li> {{ $label }} </li>
                            @endforeach
                        @endif
                    </ul>

                    {{ $image->id }}
                    {{ $image->file }}
                    {{ Storage::url($image->file) }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@else

<div class="container">
    <div class="row justify-content-center">
        <div class="col-10">
            <h2>Non ci sono più annunci da revisionare</h2>
        </div>
    </div>
</div>

@endif
    
@endsection
