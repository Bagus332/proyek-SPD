<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = ['travel_letter_id', 'name', 'nip', 'rank'];

    public function travelLetter()
    {
        return $this->belongsTo(TravelLetter::class);
    }
}