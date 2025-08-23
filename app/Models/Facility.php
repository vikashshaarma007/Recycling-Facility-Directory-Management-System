<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['business_name', 'last_update_date', 'street_address'];

    public function materials()
    {
        return $this->belongsToMany(Material::class);
    }
}
