<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'cabang_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke cabang
    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class);
    }

    // Relasi ke transaksi
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    // Relasi ke mutasi stok
    public function mutasiStoks(): HasMany
    {
        return $this->hasMany(MutasiStok::class);
    }
}