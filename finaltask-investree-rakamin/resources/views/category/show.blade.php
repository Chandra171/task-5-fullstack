@extends('layouts.master')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h5 class="card-description">
            List Kategori #{{ $category->name }}
        </h5>
@if (session('msg'))
<div class="alert alert-success">
    <p> {{session('msg')}} </p>
</div>
@endif
<div class="row">
    @forelse ($category->article as $item)
    <div class="col-4">
        <div class="card border shadow mb-3">
            <img class="card-img-top" src="{{asset('images/'. $item->image)}}" alt="Card image cap" width="100px" height="180px">
            <div class="card-body">
                <h5><a href="/article/{{$item->id}}"  class="text-bold">{{$item->title}}</a></h5>
                <h6 class="card-text">Penulis : {{$item->user->name ?? 'none'}}</h6>
                <h6><a href="/category/{{$item->category->id}}"  class="text-bold"><button class="badge badge-warning">{{$item->category->name}}</button></a></h6>
              <p class="card-text"><small class="text-muted">{{$item->created_at->diffForHumans()}}</small></p>
              @auth
              @if (Auth::user()->id == $item->user->id)
              <form action="/article/{{$item->id}}" method="POST">
                  <a href="/article/{{$item->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                      @csrf
                      @method('DELETE')
                      <input type="submit" class="btn btn-danger btn-sm my-1" value="Delete">
                  </form>
              @endif
              @endauth
            </div>
          </div>
    </div>
    @empty
    <h1>Tidak ada Artikel</h1>
    @endforelse
</div>
      </div>
    </div>

@endsection