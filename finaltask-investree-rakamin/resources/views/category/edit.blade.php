@extends('layouts.master')

@section('content')
    
<div>
    <h2>Edit Kategori {{$category->id}}</h2>
    <form action="/category/{{$category->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Kategori</label>
            <input type="text" class="form-control" name="name" value="{{$category->name}}" id="name" placeholder="Masukkan Kategori">
            @error('name')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
@endsection