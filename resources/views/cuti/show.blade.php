@extends('layouts.app')

@section('title', 'Detail Cuti')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detail Pengajuan Cuti</h5>
    </div>
    <div class="card-body">
        <p><strong>Nama:</strong> {{ $cuti->user->nama }}</p>
        <p><strong>Tanggal Mulai:</strong> {{ $cuti->tanggal_mulai }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ $cuti->tanggal_selesai }}</p>
        <p><strong>Alasan:</strong> {{ $cuti->alasan }}</p>
        <p><strong>Status:</strong> {{ ucfirst($cuti->status) }}</p>
        <a href="{{ route('cuti.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
