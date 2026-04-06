<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address', 'city', 'state', 'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isChannelPartner(): bool { return $this->role === 'channel_partner'; }
    public function isEmployee(): bool { return $this->role === 'employee'; }
    public function isCustomer(): bool { return $this->role === 'customer'; }

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'channel_partner_id');
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class, 'channel_partner_id');
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(EmployeeAttendance::class);
    }
}
