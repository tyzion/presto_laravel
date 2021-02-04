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
        @if ($errors->any())
            <div class="col-8 alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="row justify-content-center">
        <div class="col-8">
            <h3>Debug Secret: {{ $uniqueSecret}}</h3>
            <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="uniqueSecret" value="{{ $uniqueSecret }}">
                <div class="form-group">
                    <label for="title">Titolo del prodotto</label>
                    <input type="text" name="title" value=" {{ old('title') }}" class="form-control" id="title">
                </div>
                <div class="form-group">
                    <label for="description">Descrizione del prodotto</label>
                    <input type="text" name="description" value=" {{ old('description') }}" class="form-control" id="description">
                </div>
                <div class="form-group">
                    <label for="categories">Categorie</label>
                    <select name="category" id="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Prezzo del prodotto</label>
                    <input type="number" name="price" value=" {{ old('price') }}" class="form-control" id="prezzo">
                </div>
                
                <div class="form-group row">
                    <label for="images">Immagine del prodotto</label>
                    <div class="col-md-12">
                        <div class="dropzone" id="drophere"></div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endauth


@endsection