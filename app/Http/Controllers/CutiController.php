<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CutiRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $cutis = CutiRequest::with('user')->latest()->get();
        } else {
            $cutis = CutiRequest::where('user_id', Auth::id())->latest()->get();
        }

        return view('cuti.index', compact('cutis'));
    }

    /**
     * Form pengajuan cuti baru (karyawan)
     */
    public function create()
    {
        if (Auth::user()->role !== 'karyawan') {
            abort(403, 'Hanya karyawan yang bisa mengajukan cuti.');
        }

        return view('cuti.create');
    }

    /**
     * Simpan pengajuan cuti
     */
    public function store(Request $request)
    {

        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        CutiRequest::create([
            'user_id' => $user->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);

        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil dikirim.');
    }

    /**
     * Setujui cuti (admin)
     */
    public function approve($id)
    {
        $cuti = CutiRequest::with('user')->findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat mengkonfirmasi cuti.');
        }

        if ($cuti->status !== 'pending') {
            return back()->with('error', 'Cuti sudah diproses sebelumnya.');
        }

        $user = $cuti->user;

        // Cek apakah masih punya sisa cuti
        if ($user->sisa_cuti < 1) {
            return back()->with('error', 'Sisa cuti karyawan sudah habis.');
        }

        // Kurangi hanya 1 poin setiap pengajuan disetujui
        $user->sisa_cuti -= 1;
        $user->save();

        // Update status cuti menjadi approved
        $cuti->update(['status' => 'approved']);

        return back()->with('success', 'Pengajuan cuti telah disetujui (potong 1 jatah cuti).');
    }

    /**
     * Tolak cuti (admin)
     */
    public function reject($id)
    {
        $cuti = CutiRequest::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat menolak cuti.');
        }

        if ($cuti->status !== 'pending') {
            return back()->with('error', 'Cuti sudah diproses sebelumnya.');
        }

        $cuti->update(['status' => 'rejected']);

        return back()->with('success', 'Pengajuan cuti telah ditolak.');
    }
}
