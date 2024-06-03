@extends('layouts.app')

@section('content')
    <h1>Beranda</h1>

    @foreach ($lahan as $item)
        <h2>{{ $item->nama_lahan }}</h2>

        <div id="map-{{ $item->id }}" style="height: 300px;"></div> <script>
            // Inisialisasi dan tampilkan peta di sini (menggunakan library peta pilihan Anda)
            // Contoh menggunakan Leaflet:
            var map = L.map('map-{{ $item->id }}').setView([{{ $item->lokasi }}], 13); // Ganti dengan koordinat yang sesuai

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([{{ $item->lokasi }}]).addTo(map)
                .bindPopup('{{ $item->nama_lahan }}')
                .openPopup();
        </script>

        <h3>Foto Tanaman Terbaru</h3>
        <div class="foto-tanaman">
            @foreach ($item->fotoTanaman as $foto)
                <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="Foto Tanaman">
            @endforeach
        </div>

        <h3>Foto Drone Terbaru</h3>
        <div class="foto-drone">
            @foreach ($item->fotoDrone as $foto)
                <img src="{{ asset('storage/' . $foto->path_foto) }}" alt="Foto Drone">
            @endforeach
        </div>
    @endforeach
@endsection
