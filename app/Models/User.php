<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'balance',
        'is_delete'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function orders() {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function packages() {
        return $this->hasMany(Package::class, 'user_id', 'id');
    }

    public function ips(){
        return $this->hasMany(UserIp::class, 'user_id', 'id');
    }

    public function documents() {
        return $this->hasMany(UserDocument::class, 'user_id', 'id');
    }

    public function tickets(){
        return $this->hasMany(Support::class, 'user_id', 'id');
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class, 'user_id', 'id');
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function fullname() {
        return $this->name.' '.$this->surname;
    }
}
