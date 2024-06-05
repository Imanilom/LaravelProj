
@extends('layouts.user_type.auth')

@section('title', 'Taripar Hub')

@section('content')
<table>
    <thead>
        <tr>
            <th>Nama Lahan</th>
            <th>Jenis Tanaman</th>
            <th>Luas Lahan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lahan as $item)
            <tr>
                <td>{{ $item->nama_lahan }}</td>
                <td>{{ $item->jenis_tanaman }}</td>
                <td>{{ $item->luas_lahan }}</td>
                <td>
                    <a href="{{ route('lahan.show', $item->id) }}">Lihat</a>
                    <a href="{{ route('lahan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a> 
                    <form action="{{ route('lahan.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('lahan.create') }}">Tambah Lahan</a>
@endsection