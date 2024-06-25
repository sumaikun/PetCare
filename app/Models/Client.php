<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Str;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone_number',
        'address',
        'notes',
        'photo'
    ];

    protected function performInsert(Builder $query)
    {
        $this->slug = Str::slug($this->name) . '-temp';
        parent::performInsert($query);
    }

    protected static function booted()
    {
        static::created(function ($client) {
            $client->slug = Str::slug($client->name) . '-' . $client->id;
            $client->save();
        });
    }

    public function pets(): HasMany
	{
		return $this->hasMany(Pet::class);
	}

    public function appointments(): HasMany
	{
		return $this->hasMany(Appointment::class);
	}
}
