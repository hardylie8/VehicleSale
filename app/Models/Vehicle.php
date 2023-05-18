<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "year",
        'price',
        'color',
        'stock',
        'car_id',
        'motorcycle_id',
    ];

    /**
     * return relationship
     *
     * @var array<int, string>
     */
    protected $with = ['car', 'motorcycle'];

    /**
     * Get cars details.
     * @return belongsTo
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * Get motorcycle details.
     * @return belongsTo
     */
    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class, );
    }
}
