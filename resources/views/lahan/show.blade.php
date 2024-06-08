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

    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Foto-foto Lahan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($fotos as $foto)
                <div class="flex flex-col">
                    <img src="{{ asset($foto->path) }}" alt="{{ $foto->jenis_foto }}" class="w-48 h-48 object-cover rounded-t-lg">

                    <div class="p-4 bg-gray-100 rounded-b-lg">
                        <p class="text-gray-700 font-semibold text-center">{{ $foto->jenis_foto }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Unggah Foto Baru</h2>

        <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="lahan_id" value="{{ $lahan->id }}">

            <div class="mb-4">
                <label for="jenis_foto" class="block text-gray-700 font-semibold">Jenis Foto:</label>
                <select name="jenis_foto" id="jenis_foto" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="tanaman">Tanaman</option>
                    <option value="drone">Drone</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="foto" class="block text-gray-700 font-semibold">Foto:</label>
                <input type="file" name="foto" id="foto" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Unggah Foto</button>
        </form>
    </div>
</div>
@endsection
