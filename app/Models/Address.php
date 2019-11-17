<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $fillable = [
        'member_id', 'street_name', 
        'zip_code', 'city'
    ];

    // relationships
    public function members() {
        return $this->belongsTo(Member::class);
    }
}
