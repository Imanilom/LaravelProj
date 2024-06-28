<!-- @extends('layouts.user_type.auth')

@section('title', 'Taripar Hub')

@section('content')

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1>{{ isset($post) ? 'Edit' : 'Create' }} Gambar Peta</h1>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ isset($post) ? route('uploads.update', $post->id) : route('uploads.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @isset($post)
                            @method('put')
                        @endisset

                        <div class="mb-3">
                            <label for="title" class="form-label">Nama Peta</label>
                            <input id="title" name="title" type="text" class="form-control" value="{{ $post->title ?? old('title') }}" required autofocus>
                            @error('title')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Deskripsi</label>
                            <textarea id="content" name="content" class="form-control" required autofocus>{{ $post->content ?? old('content') }}</textarea>
                            @error('content')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Gambar Peta</label>
                            <input type="file" id="featured_image" name="featured_image" accept=".jpg, .jpeg, .png" class="form-control">
                            <div class="shrink-0 my-2">
                                <img id="featured_image_preview" class="img-fluid rounded-md" src="{{ isset($post) ? Storage::url($post->featured_image) : '' }}" alt="Featured image preview">
                            </div>
                            @error('featured_image')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary my-3   ">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('featured_image').onchange = function(evt) {
        const [file] = this.files;
        if (file) {
            document.getElementById('featured_image_preview').src = URL.createObjectURL(file);
        }
    }
</script>
@endsection -->