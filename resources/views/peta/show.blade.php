<!-- @extends('layouts.user_type.auth')

@section('title', 'Tampilkan')

@section('content')

<div class="container-fluid">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
        Tampilkan
    </h2>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900">
                    Nama Peta :
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $post->nama }}
                </p>
            </div>
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900">
                    Deskripsi :
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $post->deskripsi }}
                </p>
            </div>
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900">
                    Tanggal Unggah :
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $post->created_at }}
                </p>
            </div>
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900">
                    Tanggal Perbaharui :
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $post->updated_at }}
                </p>
            </div>
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900">
                    Gambar Peta :
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    <img class="img-fluid" src="{{ Storage::url($post->gambar) }}" alt="{{ $post->nama }}">
                </p>
            </div>
            
            <a href="{{ route('petas.index') }}" class="btn btn-primary" style="text-transform: none;">Kembali</a>
        </div>
    </div>
</div>
@endsection

<style>
    .img-fluid {
        max-width: 100%;
        height: auto;
    }
</style> -->