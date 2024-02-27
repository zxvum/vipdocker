<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'template_file',
        'example_file',
        'is_active',
        'order'
    ];

    public function userDocuments() {
        return $this->hasMany(UserDocument::class);
    }
}
