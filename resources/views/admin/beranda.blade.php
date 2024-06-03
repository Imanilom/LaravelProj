@extends('layouts.user_type.auth')

@section('title', 'Manajemen User')

@section('content')

    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0"></h5>
                            </div>

                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-transform: none;">
                                            Nama
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-transform: none;">
                                            No. Telepon
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-transform: none;">
                                            Tanggal Dibuat
                                        </th>
                                    </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-transform: none;">
                                            Opsi
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->phone }}</td>
                                        <td class="text-center">{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('beranda', $user->id) }}" class="btn btn-primary btn-sm" style="text-transform: none;">
                                                <i class="fas fa-eye"></i> Lihat Beranda
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection