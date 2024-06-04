@extends('layouts.user_type.auth')

@section('title', 'Detail Lahan')

@section('content')
    <h1>Detail Lahan: {{ $lahan->nama_lahan }}</h1>
    
    <p>Jenis Tanaman: {{ $lahan->jenis_tanaman }}</p>
    <p>Luas Lahan: {{ $lahan->luas_lahan }}</p>
    <p>Lokasi: {{ $lahan->lokasi }}</p>
    <p>Catatan: {{ $lahan->catatan }}</p>

    <a href="{{ route('lahan.edit', $lahan->id) }}">Edit</a>
    
    <form action="{{ route('lahan.destroy', $lahan->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus</button>
    </form>
@endsection
