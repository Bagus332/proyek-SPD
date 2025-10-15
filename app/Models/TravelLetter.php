<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_number',
        'destination',
        'purpose',
        'start_date',
        'end_date',
        'vehicle',
        'dipa_number',
        'dipa_date',
    ];

    // Relasi: Satu surat memiliki banyak dosen
    public function lecturers()
    {
        return $this->hasMany(Lecturer::class);
    }
}