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
    Tambah Article
@endsection

@section('content')

     <form action="/article" method="POST" enctype="multipart/form-data">
                @csrf
    
                <div class="form-group">
                    <label for="title">Title</label>
                    <textarea class="form-control" name="title" id="title" placeholder="Masukkan Title"></textarea>
                    @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" placeholder="Masukkan Content"></textarea>
                    @error('content')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            
            
                <div class="form-group">
                    <label for="image">image</label>
                    <input type="file" class="form-control" name="image" id="" placeholder="Silakan pilih salah satu gambar">
                </div>
                    @error('image')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    
    <div class="form-group">
        <label for="category">category</label>
        <select name="category_id" class="form-control" id="">
            <option value="">--Pilih category--</option>
            @forelse ($category as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @empty
                <option value="">--Tidak ada category--</option>
            @endforelse
        </select>
    </div>
    
    {{-- <div class="form group">
        <label>Gambar</label>
        <textarea></textarea>
    </div> --}}

    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/category" class="btn btn-light"> Kembali </a>

</form>
          </div>
        </div>
    </div>
    
@endsection