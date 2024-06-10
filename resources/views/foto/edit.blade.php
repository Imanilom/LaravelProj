@extends('layouts.user_type.auth')

@section('title', 'Edit Foto')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Foto</h1>

    <form action="{{ route('foto.update', $foto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="jenis_foto" class="block text-gray-700 font-semibold">Jenis Foto:</label>
            <select name="jenis_foto" id="jenis_foto" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="tanaman" {{ $foto->jenis_foto == 'tanaman' ? 'selected' : '' }}>Tanaman</option>
                <option value="drone" {{ $foto->jenis_foto == 'drone' ? 'selected' : '' }}>Drone</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Simpan Perubahan</button>
    </form>
</div>
@endsection
