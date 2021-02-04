@extends('layouts.app')

@section('content')


<style>

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

input[type=number] { 
    -moz-appearance: textfield;
    appearance: textfield;
    margin: 0; 
}

</style>

@auth

<div class="container">

    <div class="row justify-content-center">
        @if (session('message'))
            <div class="col-8 alert alert-success text-center" role="alert">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('announcements.update', compact('announcement') ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="title">Titolo del prodotto</label>
                    <input type="text" name="title" value="{{ old('title', $announcement->title) }}" class="form-control" id="title">
                </div>
                <div class="form-group">
                    <label for="description">Descrizione del prodotto</label>
                    <input type="text" name="description" value=" {{ old('description', $announcement->description) }}" class="form-control" id="description">
                </div>
                <div class="form-group">
                    <label for="price">Prezzo del prodotto</label>
                    <input type="string" name="price" value=" {{ old('price', $announcement->price) }}" class="form-control" id="price">
                </div>
                <div class="form-group">
                    <label for="categories">Categorie</label>
                    <select name="category" id="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="img">Immagine del prodotto</label>
                    <input type="file" name="img" class="form-control" id="img">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endauth

@guest

@endguest

@endsection