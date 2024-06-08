@extends('layouts.user_type.auth')

@section('title', 'Taripar Hub')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Lahan</h1>

    <div class="mb-4">
        <a href="{{ route('lahan.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Tambah Lahan</a>
    </div>

    <div class="overflow-x-auto"> 
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Nama Lahan
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Jenis Tanaman
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Luas Lahan
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($lahan as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $item->nama_lahan }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $item->jenis_tanaman }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ $item->luas_lahan }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap flex space-x-2">
                            <a href="{{ route('lahan.show', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded text-xs">
                                Lihat
                            </a>
                            <a href="{{ route('lahan.edit', $item->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded text-xs">
                                Edit
                            </a>
                            <form action="{{ route('lahan.destroy', $item->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded text-xs">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
