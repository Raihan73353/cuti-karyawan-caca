@extends('layouts.app')

@section('title', 'Edit Karyawan')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Data Karyawan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label>Password Baru (opsional)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label>Sisa Cuti</label>
                <input type="number" name="sisa_cuti" class="form-control" value="{{ old('sisa_cuti', $user->sisa_cuti) }}" min="0">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
