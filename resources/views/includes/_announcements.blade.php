<div class="col-3">
    @foreach($announcement->images as $image)
    <a href="{{ route( 'announcements.show', compact('announcement') ) }}">
        <img src="{{ $image->getUrl( 300,150 ) }}" class="img-fluid" alt="">
    </a>
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