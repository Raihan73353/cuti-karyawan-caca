@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div class="row">

        <!-- Total Karyawan -->
        <div class="col-md-3 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Karyawan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKaryawan }}</div>
                    </div>
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Total Pengajuan Cuti -->
        <div class="col-md-3 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengajuan Cuti</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCuti }}</div>
                    </div>
                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Disetujui -->
        <div class="col-md-3 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cuti Disetujui</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cutiApproved }}</div>
                    </div>
                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <!-- Ditolak -->
        <div class="col-md-3 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cuti Ditolak</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cutiRejected }}</div>
                    </div>
                    <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Pengajuan Cuti Terbaru -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Pengajuan Cuti Terbaru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            @if (Auth::user()->role === 'admin')

                                <th>Alasan</th>
                            @endif
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latestCuti as $i => $cuti)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $cuti->user->name }}</td>
                                <td>{{ $cuti->tanggal_mulai }}</td>
                                <td>{{ $cuti->tanggal_selesai }}</td>
                                @if (Auth::user()->role === 'admin')

                                <td>{{ $cuti->alasan }}</td>
                                @endif
                                <td>
                                    @if ($cuti->status == 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif ($cuti->status == 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada pengajuan cuti</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
