<!-- @extends('layouts.user_type.auth')

@section('title', 'Edit')

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
                    <form method="POST" action="{{ isset($post) ? route('petas.update', $post->id) : route('petas.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @isset($post)
                            @method('PUT')
                        @endisset

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Peta</label>
                            <input id="nama" name="nama" type="text" class="form-control" value="{{ $post->nama ?? old('nama') }}" required autofocus>
                            @error('nama')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Lokasi Peta</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control" required autofocus>{{ $post->deskripsi ?? old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Peta</label>
                            <input type="file" id="gambar" name="gambar" accept=".jpg, .jpeg, .png" class="form-control">
                            <div class="shrink-0 my-2">
                                <img id="gambar_preview" class="img-fluid rounded-md" src="{{ isset($post) ? Storage::url($post->gambar) : '' }}" alt="">
                            </div>
                            @error('gambar')
                                <div class="mt-2 text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary my-3" style="text-transform: none;">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('gambar').onchange = function(evt) {
        const [file] = this.files;
        if (file) {
            document.getElementById('gambar_preview').src = URL.createObjectURL(file);
        }
    }
</script>
@endsection -->