<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'theme_id',
        'status_id',
        'text'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function theme(){
        return $this->belongsTo(SupportTheme::class, 'theme_id', 'id');
    }

    public function status(){
        return $this->belongsTo(SupportStatus::class, 'status_id', 'id');
    }

    public function attachments(){
        return $this->hasMany(SupportAttachment::class, 'support_id', 'id');
    }

    public function deleteAttachments(){
        return $this->attachments()->delete();
    }
}
