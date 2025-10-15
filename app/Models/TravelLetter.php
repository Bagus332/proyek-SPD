<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelLetter extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'letter_number',
        'lecturer_name',
        'lecturer_nip',
        'lecturer_rank', // Ditambahkan
        'destination',
        'purpose',
        'start_date',
        'end_date',
        'vehicle',
        'dipa_number',   // Ditambahkan
        'dipa_date',     // Ditambahkan
    ];
}