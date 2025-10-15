<?php

namespace App\Http\Controllers;

use App\Models\TravelLetter;
use Illuminate\Http\Request;

class TravelLetterController extends Controller
{
    /**
     * Menampilkan formulir untuk membuat surat baru.
     */
    public function create()
    {
        return view('travel_letter.create');
    }

    /**
     * Menyimpan data surat baru dari formulir ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lecturer_name' => 'required|string|max:255',
            'lecturer_nip' => 'required|string|max:50',
            'lecturer_rank' => 'required|string|max:100', // Validasi baru
            'destination' => 'required|string|max:255',
            'purpose' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'vehicle' => 'required|string|max:100',
            'dipa_number' => 'required|string|max:100', // Validasi baru
            'dipa_date' => 'required|date', // Validasi baru
        ]);

        // Format nomor surat sesuai template (contoh: B-001/Un.13/FST/PP.00.9/01/2024)
        $count = TravelLetter::count() + 1;
        $letterNumber = 'B-' . str_pad($count, 3, '0', STR_PAD_LEFT) . '/Un.13/FST/PP.00.9/' . date('m') . '/' . date('Y');

        $letter = TravelLetter::create([
            'letter_number' => $letterNumber,
            'lecturer_name' => $request->lecturer_name,
            'lecturer_nip' => $request->lecturer_nip,
            'lecturer_rank' => $request->lecturer_rank, // Simpan data baru
            'destination' => $request->destination,
            'purpose' => $request->purpose,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'vehicle' => $request->vehicle,
            'dipa_number' => $request->dipa_number, // Simpan data baru
            'dipa_date' => $request->dipa_date,   // Simpan data baru
        ]);

        return redirect()->route('travel.letter.show', $letter);
    }

    /**
     * Menampilkan surat yang sudah jadi berdasarkan ID.
     */
    public function show(TravelLetter $travelLetter)
    {
        return view('travel_letter.show', ['letter' => $travelLetter]);
    }

    /**
     * Menampilkan daftar semua surat yang pernah dibuat.
     */
    public function index()
    {
        $letters = TravelLetter::latest()->paginate(10);
        return view('travel_letter.index', ['letters' => $letters]);
    }
}