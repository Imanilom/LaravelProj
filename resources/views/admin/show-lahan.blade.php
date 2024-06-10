@extends('layouts.user_type.auth')

@section('title', 'Beranda ' . $user->name)

@section('content')
<div class="container mt-4">
    <h1 class="display-4 mb-4">Beranda: {{ $user->name }}</h1>

    <h2 class="display-6 mb-3">Lahan Milik {{ $user->name }}</h2>

    @foreach ($lahans as $lahan)
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">{{ $lahan->nama_lahan }}</h3>
            </div>
            <div class="card-body">

                @php
                    $fotosTanaman = $lahan->fotos->where('jenis_foto', 'tanaman')->sortByDesc('created_at');
                    $fotosDrone = $lahan->fotos->where('jenis_foto', 'drone')->sortByDesc('created_at');
                @endphp

                @if ($fotosTanaman->isNotEmpty())
                    <h5 class="card-subtitle mb-2 text-muted">Foto-foto Lahan (Tanaman)</h5>
                    <div class="row">
                        @foreach ($fotosTanaman as $foto)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset($foto->path) }}" alt="{{ $foto->jenis_foto }}" class="img-fluid rounded">
                                <p class="text-gray-700 font-semibold text-center">{{ $foto->updated_at }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($fotosDrone->isNotEmpty())
                    <h5 class="card-subtitle mb-2 text-muted">Foto-foto Lahan (Drone)</h5>
                    <div class="row">
                        @foreach ($fotosDrone as $foto)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset($foto->path) }}" alt="{{ $foto->jenis_foto }}" class="img-fluid rounded">
                                <p class="text-gray-700 font-semibold text-center">{{ $foto->updated_at }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    @endforeach
</div>
@endsection
