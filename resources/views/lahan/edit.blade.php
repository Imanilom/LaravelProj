@extends('layouts.user_type.auth')

@section('title', 'Edit Lahan')

@section('content')
    <h1>Edit Lahan</h1>

    <form action="{{ route('lahan.update', $lahan->id) }}" method="POST"> 
        @csrf
        <div>
            <label for="nama_lahan">Nama Lahan</label>
            <input type="text" name="nama_lahan" id="nama_lahan" value="{{ old('nama_lahan', $lahan->nama_lahan) }}" required>
            @error('nama_lahan') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        
        <div>
            <label for="jenis_tanaman">Jenis Tanaman</label>
            <input type="text" name="jenis_tanaman" id="jenis_tanaman" value="{{ old('jenis_tanaman', $lahan->jenis_tanaman) }}">
            @error('jenis_tanaman') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="luas_lahan">Luas Lahan (Ha/m²)</label>
            <input type="number" name="luas_lahan" id="luas_lahan" value="{{ old('luas_lahan', $lahan->luas_lahan) }}">
            @error('luas_lahan') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $lahan->lokasi) }}">
            @error('lokasi') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="catatan">Catatan</label>
            <textarea name="catatan" id="catatan">{{ old('catatan', $lahan->catatan) }}</textarea>
            @error('catatan') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
        <button type="submit">Edit Lahan</button>
    </form>
@endsection
