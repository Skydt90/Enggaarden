<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // static member_types
    public const MEMBER_TYPES = [
        'Ekstern', 'Sekundær', 'Primær'
    ];

    protected $fillable = [
        'first_name', 'last_name', 'email',
        'phone_number', 'is_board', 'member_type'
    ];

    // relationships
    public function address() {
        return $this->hasOne(Address::class);
    }

}
