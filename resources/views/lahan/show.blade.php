@extends('layouts.user_type.auth')

@section('title', 'Detail Lahan')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detail Lahan: {{ $lahan->nama_lahan }}</h1>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-700 font-semibold">Jenis Tanaman:</p>
                <p>{{ $lahan->jenis_tanaman }}</p>
            </div>
            <div>
                <p class="text-gray-700 font-semibold">Luas Lahan:</p>
                <p>{{ $lahan->luas_lahan }}</p>
            </div>
            <div>
                <p class="text-gray-700 font-semibold">Lokasi:</p>
                <p>{{ $lahan->lokasi }}</p>
            </div>
            <div>
                <p class="text-gray-700 font-semibold">Catatan:</p>
                <p>{{ $lahan->catatan }}</p>
            </div>
        </div>
    </div>

    <div class="mt-4 flex space-x-4">
        <a href="{{ route('lahan.edit', $lahan->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
        <form action="{{ route('lahan.destroy', $lahan->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
        </form>
    </div>

    @php
        $fotosTanaman = $lahan->fotos->where('jenis_foto', 'tanaman')->sortByDesc('created_at');
        $fotosDrone = $lahan->fotos->where('jenis_foto', 'drone')->sortByDesc('created_at');
    @endphp

    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Foto-foto Lahan (Tanaman)</h2>
        <div class="row">
            @foreach ($fotosTanaman as $foto)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset($foto->path) }}" class="card-img-top" alt="{{ $foto->jenis_foto }}" style="max-height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <p class="text-gray-700 font-semibold text-center">{{ $foto->jenis_foto }}</p>
                        <p class="text-gray-700 font-semibold text-center">{{ $foto->updated_at }}</p>
                        <div class="flex justify-center">
                            <a href="{{ route('foto.edit', $foto->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Foto-foto Lahan (Drone)</h2>
        <div class="row">
            @foreach ($fotosDrone as $foto)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset($foto->path) }}" class="card-img-top" alt="{{ $foto->jenis_foto }}" style="max-height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <p class="text-gray-700 font-semibold text-center">{{ $foto->jenis_foto }}</p>
                        <p class="text-gray-700 font-semibold text-center">{{ $foto->updated_at }}</p>
                        <div class="flex justify-center">
                            <a href="{{ route('foto.edit', $foto->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                            <form action="{{ route('foto.destroy', $foto->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    </div>
</div>
@endsection
