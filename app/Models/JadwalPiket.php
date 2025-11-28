<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class JadwalPiket extends Model
{
    use HasFactory;

    protected $table = 'jadwal_piket';

    protected $fillable = [
        'personel_id',
        'tanggal',
        'shift',
        'tipe_piket',
        'lokasi',
        'catatan',
        'notifikasi_dikirim',
        'notifikasi_waktu',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'notifikasi_waktu' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'notifikasi_dikirim' => 'boolean',
    ];

    /**
     * Get the personel associated with the jadwal piket.
     */
    public function personel(): BelongsTo
    {
        return $this->belongsTo(Personel::class, 'personel_id');
    }

    /**
     * Get jadwal by date range.
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('tanggal', [$startDate, $endDate]);
    }

    /**
     * Get jadwal by unit.
     */
    public function scopeByUnit($query, $unit)
    {
        return $query->whereHas('personel', function ($q) use ($unit) {
            $q->where('unit', $unit);
        });
    }

    /**
     * Get jadwal by personel name.
     */
    public function scopeByPersonel($query, $nama)
    {
        return $query->whereHas('personel', function ($q) use ($nama) {
            $q->where('nama', 'like', '%' . $nama . '%');
        });
    }

    /**
     * Get jadwal by shift.
     */
    public function scopeByShift($query, $shift)
    {
        return $query->where('shift', $shift);
    }

    /**
     * Get jadwal by tipe piket.
     */
    public function scopeByTipe($query, $tipe)
    {
        return $query->where('tipe_piket', $tipe);
    }

    /**
     * Get upcoming jadwal.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('tanggal', '>=', Carbon::today())->orderBy('tanggal');
    }

    /**
     * Get jadwal for today.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('tanggal', Carbon::today());
    }

    /**
     * Get jadwal that haven't sent notification.
     */
    public function scopeNotNotified($query)
    {
        return $query->where('notifikasi_dikirim', false);
    }
}
