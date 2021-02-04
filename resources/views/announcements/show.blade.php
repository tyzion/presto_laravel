@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach($announcement->images as $image)
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <img src="{{ $image->getUrl(300, 150) }}" class="rounded" alt="">
                        </div>
                    </div>
                @endforeach
                <div class="card-header">{{ $announcement->title }}</div>

                <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ $announcement->description }}
                        </div>

                    {{ $announcement->price }}
                    {{ $announcement->created_at->format('d-m-Y') }}
                    {{ $announcement->category->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
