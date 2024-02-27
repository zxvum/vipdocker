<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'status_id',
        'package_id',
        'order_id',
        'tax',
        'total_price',
        'due_date',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(InvoiceStatus::class);
    }

    public function services() {
        return $this->hasMany(InvoiceService::class);
    }

    public function package() {
        return $this->belongsTo(Package::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
