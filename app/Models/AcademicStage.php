<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AcademicStage extends Model
{
    use HasTranslations;

    protected $guarded = [];
    public $translatable = ['name'];
}
