<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\TravelLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Import Log facade

class TravelLetterController extends Controller
{
    public function create()
    {
        return view('travel_letter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required|string|max:255',
            'purpose' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'vehicle' => 'required|string|max:100',
            'dipa_number' => 'required|string|max:100',
            'dipa_date' => 'required|date',
            'lecturers' => 'required|array|min:1',
            'lecturers.*.name' => 'required|string|max:255',
            'lecturers.*.nip' => 'required|string|max:50',
            'lecturers.*.rank' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $count = TravelLetter::count() + 1;
            $letterNumber = 'B-' . str_pad($count, 3, '0', STR_PAD_LEFT) . '/Un.13/FST/PP.00.9/' . date('m') . '/' . date('Y');

            $letter = TravelLetter::create([
                'letter_number' => $letterNumber,
                'destination' => $request->destination,
                'purpose' => $request->purpose,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'vehicle' => $request->vehicle,
                'dipa_number' => $request->dipa_number,
                'dipa_date' => $request->dipa_date,
            ]);

            foreach ($request->lecturers as $lecturerData) {
                $letter->lecturers()->create($lecturerData);
            }

            DB::commit();

            return redirect()->route('travel.letter.show', $letter);

        } catch (\Exception $e) {
            DB::rollBack();

            // =======================================================
            // || START: BARIS INI AKAN MENCATAT ERROR KE LOG FILE ||
            // =======================================================
            Log::error('Gagal menyimpan Surat Tugas: ' . $e->getMessage());
            // =======================================================
            // || END: BARIS YANG DITAMBAHKAN                      ||
            // =======================================================

            // Kirim pesan error yang lebih detail ke view untuk debugging
            return back()
                ->withErrors(['error' => 'Gagal menyimpan data. Detail Error: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show(TravelLetter $travelLetter)
    {
        $travelLetter->load('lecturers');
        return view('travel_letter.show', ['letter' => $travelLetter]);
    }

    public function index()
    {
        $letters = TravelLetter::latest()->withCount('lecturers')->paginate(10);
        return view('travel_letter.index', ['letters' => $letters]);
    }
}