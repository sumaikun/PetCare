<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroomingSession extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'service', 'date', 'notes'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
