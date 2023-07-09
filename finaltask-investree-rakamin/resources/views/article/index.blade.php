@extends('layouts.master')

@section('content')
    
<a href="/article/create" class="btn btn-primary mb-3">Tambah Artikel</a>

<div class="row">
    @forelse ($article as $item)
        <div class = "col-4">
            <div class = "card">
                <img class="card-img-top" src="{{asset('images/'. $item->image)}}" alt="Card image cap" width="100px" height="180px">
                <div class="card-body">
                    <h5><a href="/article/{{$item->id}}"  class="text-bold">{{Str::limit($item->title, 20)}}</a></h5>
                <h6 class="card-text">Penulis : {{ $item->user->name }}</h6>
                <h6><a href="/category/{{$item->id}}"  class="text-bold">
                    <button class="badge badge-warning">{{$item->category->name}}</button></a></h6>
              {{-- <p class="card-text"><small class="text-muted">{{$item->created_at->diffForHumans()}}</small></p> --}}

                    <form action="/article/{{$item->id}}" method="POST">
                        <a href="/article/{{$item->id}}/edit" class="btn btn-primary btn-sm">Edit</a>
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger btn-sm my-1" value="Delete">
                        </form>
      
                </div>
            </div>
        </div>
    @empty
        <h1>Tida ada article</h1>
    @endforelse
</div>


@endsection