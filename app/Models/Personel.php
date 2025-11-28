<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Personel extends Model
{
    use HasFactory;

    protected $table = 'personel';

    protected $fillable = [
        'nama',
        'pangkat',
        'jabatan',
        'unit',
        'foto',
        'nip',
        'no_telepon',
        'catatan',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the jadwal piket for the personel.
     */
    public function jadwalPiket(): HasMany
    {
        return $this->hasMany(JadwalPiket::class, 'personel_id');
    }

    /**
     * Get active personel.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Get personel by unit.
     */
    public function scopeByUnit($query, $unit)
    {
        return $query->where('unit', $unit);
    }
}
