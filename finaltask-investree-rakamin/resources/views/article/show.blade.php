@extends('layouts.master')

{{-- @push('scripts')
<script src="https://cdn.tiny.cloud/1/y0aei2hae802rnizhu7dvrnheypn7rvwfw3d2oao66re3c6t/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
    toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>
@endpush --}}

@section('title')
    Detail Artikel
@endsection

@section('content')
    <div class="col-lg-12 stretch-card">
        <div class="card">
        <div class="card-body">
             {{-- @auth
            @if (Auth::user()->id == $article->user->id)
            <i class="bi bi-three-dots-vertical float-right" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7">
            <form action="/article/{{$article->id}}" method="POST">
                <a href="/article/{{$article->id}}/edit" class="dropdown-item">Edit</a>
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="dropdown-item" value="Delete">
                </form>
            </div>
            @endif
            @endauth  --}}
            <h1 class="card-description text-dark">{{$article->title}}</h1>
            <h6 class="card-text">Ditulis oleh : {{$article->user->name ?? 'none'}}</h6>
            <p class="card-text"><small class="text-muted">{{$article->created_at->diffForHumans()}}</small></p>
            <div class = 'text-center'>
                <img src="{{asset('images/'. $article->image)}}" style=" width: 50vh; height: 300px" alt="">
            </div>
    <p class="text-left badge badge-primary">Kategori : {{$article->category->name}}</p>

    
    <p class="text-left text-dark">{{$article->content}}</p>

    <a href="/article" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
        </div>
    </div>

@endsection