@extends('layouts.master')

@section('content')
<h2>Tambah Data</h2>
<form action="/category" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nama Kategori</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Kategori">
        @error('name')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Tambah</button>
</form>
@endsection