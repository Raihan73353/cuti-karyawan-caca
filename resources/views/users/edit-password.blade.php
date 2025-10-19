@extends('layouts.app')

@section('title', 'Ubah Password')
@section('page-title', 'Ubah Password')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('user.updatePassword') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Password Lama</label>
                <input type="password" name="current_password" class="form-control" required>
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password Baru</label>
                <input type="password" name="new_password" class="form-control" required>
                @error('new_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
