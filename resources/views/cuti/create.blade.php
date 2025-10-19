@extends('layouts.app')

@section('title', 'Ajukan Cuti')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Form Pengajuan Cuti</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('cuti.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}" required>
            </div>
            <div class="mb-3">
                <label>Alasan</label>
                <textarea name="alasan" class="form-control" rows="3" required>{{ old('alasan') }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
            <a href="/cuti" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
