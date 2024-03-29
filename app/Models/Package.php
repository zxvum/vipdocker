<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'title',
        'description',
        'address_id',
        'track_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(PackageHasProduct::class, 'package_id', 'id');
    }

    public function status(){
        return $this->belongsTo(PackageStatus::class, 'status_id', 'id');
    }
}
