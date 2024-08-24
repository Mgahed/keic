<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MemberShipType extends Model
{
    use HasTranslations;

    protected $guarded = [];
    public $translatable = ['name'];

    public function memberShips()
    {
        return $this->hasMany(MemberShip::class, 'membership_type_id');
    }
}
