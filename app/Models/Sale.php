<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'total',
        'vehicle_id',
    ];

    /**
     * return all available relationship
     *
     * @return array
     */
    public function getRelationship()
    {
        return ['vehicle'];
    }

    /**
     * Get vehicle details.
     * @return belongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}
