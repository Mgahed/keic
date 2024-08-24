<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberShip extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function membershipType()
    {
        return $this->belongsTo(MemberShipType::class, 'member_ship_type_id');
    }
}
