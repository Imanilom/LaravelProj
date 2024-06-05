@extends('layouts.user_type.auth')

@section('title', 'Detail Lahan')

@section('content')
    <h1>Detail Lahan: {{ $lahan->nama_lahan }}</h1>
    
    <p>Jenis Tanaman: {{ $lahan->jenis_tanaman }}</p>
    <p>Luas Lahan: {{ $lahan->luas_lahan }}</p>
    <p>Lokasi: {{ $lahan->lokasi }}</p>
    <p>Catatan: {{ $lahan->catatan }}</p>

    <a href="{{ route('lahan.edit', $lahan->id) }}">Edit</a>
    <form action="{{ route('foto.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <input type="hidden" name="lahan_id" value="{{ $lahan->id }}">
        <div>
            <label for="jenis_foto">Jenis Foto:</label>
            <select name="jenis_foto" id="jenis_foto">
                <option value="tanaman">Tanaman</option>
                <option value="drone">Drone</option>
            </select>
        </div>
        <div>
            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto">
        </div>
        <button type="submit">Unggah Foto</button>
    </form>
    <form action="{{ route('lahan.destroy', $lahan->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
@endsection
