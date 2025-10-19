@extends('layouts.app')

@section('title', 'Data Cuti')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Cuti</h5>
        @if (Auth::user()->role === 'karyawan')
            <a href="{{ route('cuti.create') }}" class="btn btn-primary btn-sm">+ Ajukan Cuti</a>
        @endif
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    @if (Auth::user()->role === 'admin')
                        <th>Nama Karyawan</th>
                    @endif
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Alasan</th>
                    <th>Status</th>
                    @if (Auth::user()->role === 'admin')
                        <th width="20%">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($cutis as $index => $cuti)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        @if (Auth::user()->role === 'admin')
                            <td>{{ $cuti->user->name }}</td>
                        @endif
                        <td>{{ $cuti->tanggal_mulai }}</td>
                        <td>{{ $cuti->tanggal_selesai }}</td>
                        <td>{{ $cuti->alasan }}</td>
                        <td>
                            @if ($cuti->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif ($cuti->status == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            @if (Auth::user()->role === 'admin' && $cuti->status === 'pending')
                                <form action="{{ route('cuti.approve', $cuti->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                </form>
                                <form action="{{ route('cuti.reject', $cuti->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                            @elseif (Auth::user()->role === 'karyawan')
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role === 'admin' ? 7 : 6 }}" class="text-center text-muted">
                            Belum ada pengajuan cuti.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
