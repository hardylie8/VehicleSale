<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'engine',
        'capacity',
        'type',
    ];

    /**
     * Get vehicle details.
     * @return hasOne
     */
    public function vehicle()
    {
        return $this->belongsToMany(Vehicle::class);
    }
}
