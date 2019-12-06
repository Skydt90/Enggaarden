<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'message', 'group', 'user_id', 'subject', 'member_id'
    ];

    // static attributes for server validation
    public const MAIL_GROUPS = [
        'Primære', 'Sekundære', 'Eksterne', 'Bestyrelsen', 'Alle' 
    ];

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    //scopes
    public function scopeWithRelations(Builder $query)
    {
       return $query->with(['user', 'member']);
    }
}
