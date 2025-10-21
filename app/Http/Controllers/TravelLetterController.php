<?php

namespace App\Http\Controllers;

use App\Models\TravelLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TravelLetterController extends Controller
{
    /**
     * Tampilkan daftar surat perjalanan dinas
     */
    public function index()
    {
        // Ambil semua surat (tanpa relasi jika tidak ada relasi)
        $letters = TravelLetter::latest()->paginate(10);

        return view('travel_letter.index', compact('letters'));
    }

    /**
     * Tampilkan form create
     */
    public function create()
    {
        return view('travel_letter.create');
    }

    /**
     * Simpan ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'ppk_nama' => 'required|string|max:255',
            'ppk_nip' => 'nullable|string|max:255',
            'pegawai_nama' => 'required|string|max:255',
            'pegawai_nip' => 'required|string|max:255',
            'pegawai_pangkat_golongan' => 'nullable|string|max:255',
            'pegawai_jabatan' => 'nullable|string|max:255',
            'pengikut' => 'nullable|array',
            'pengikut.*.nama' => 'nullable|string|max:255',
            'pengikut.*.nip' => 'nullable|string|max:255',
            'keperluan' => 'required|string',
            'alat_angkut' => 'nullable|string|max:255',
            'tempat_berangkat' => 'nullable|string|max:255',
            'tempat_tujuan' => 'required|string|max:255',
            'tanggal_berangkat' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_berangkat',
            'lama_perjalanan' => 'nullable|integer|min:1',
            'instansi' => 'nullable|string|max:255',
            'akun' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $count = TravelLetter::count() + 1;
            $letterNumber = 'B-' . str_pad($count, 3, '0', STR_PAD_LEFT) . '/Un.13/FST/PP.00.9/' . date('m') . '/' . date('Y');

            $data = TravelLetter::create([
                'letter_number' => $letterNumber,
                'ppk_nama' => $request->ppk_nama,
                'ppk_nip' => $request->ppk_nip,
                'pegawai_nama' => $request->pegawai_nama,
                'pegawai_nip' => $request->pegawai_nip,
                'pegawai_pangkat_golongan' => $request->pegawai_pangkat_golongan,
                'pegawai_jabatan' => $request->pegawai_jabatan,
                'pengikut' => $request->pengikut ? json_encode($request->pengikut) : null,
                'keperluan' => $request->keperluan,
                'alat_angkut' => $request->alat_angkut,
                'tempat_berangkat' => $request->tempat_berangkat ?? 'Padang',
                'tempat_tujuan' => $request->tempat_tujuan,
                'tanggal_berangkat' => $request->tanggal_berangkat,
                'tanggal_kembali' => $request->tanggal_kembali,
                'lama_perjalanan' => $request->lama_perjalanan,
                'instansi' => $request->instansi ?? 'UIN Imam Bonjol Padang',
                'akun' => $request->akun ?? '525115',
                'keterangan' => $request->keterangan,
            ]);

            DB::commit();

            return redirect()->route('travel.letter.show', $data->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menyimpan Perjalanan Dinas: ' . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Gagal menyimpan data. Detail Error: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Tampilkan detail surat
     * (sementara masih pakai blade, nanti kita ganti ke Word)
     */
    public function show(TravelLetter $travelLetter)
    {
        return view('travel_letter.show', compact('travelLetter'));
    }
}
