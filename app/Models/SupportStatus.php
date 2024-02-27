<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_custom',
        'bg_color',
        'text_color',
        'color_name'
    ];
}
