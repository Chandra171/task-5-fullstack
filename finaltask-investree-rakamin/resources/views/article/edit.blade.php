@extends('layouts.master')

{{-- @push('scripts')
<script src="{{asset ('/tinymce/js\tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    p {margin: 0; padding: 0;}
    forced_root_block : false,
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
    Halaman edit article
@endsection

@section('content')
    
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <form action="/article/{{$article->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">title</label>
                <textarea class="form-control" name="title" value="" 
                    id="title" placeholder="Masukkan title">{{ $article->title }}</textarea>
                @error('title')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                </div>    

                <div class="form-group">
                    <label for="content">content</label>
                    <textarea class="form-control" name="content" value="" 
                        id="content" placeholder="Masukkan content">{{ $article->content }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>    


        <div class="form-group">
            <label for="article">Gambar</label>
            <input type="file" class="form-control" name="image" id="">{{ $article->image }}
            @error('image')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="article">Kategori</label>
            <select class="form-control" name="category_id" value="{{old('category_id', $article->category_id)}}" id="" placeholder="Masukkan Kategori article">
            <option value="">--Pilih Salah satu Kategoti--</option>
            @forelse ($category as $item)
                @if ($item->id === $article->category_id)
                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                
                @else 
                <option value="{{$item->id}}">{{$item->name}}</option> 
                @endif
                   
            @empty
                <option value="">Tidak ada Kategori</option>
            @endforelse
        @error('category_id')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/article" class="btn btn-light"> Kembali </a>
    </form>
</div>
    </div>
</div>
@endsection
