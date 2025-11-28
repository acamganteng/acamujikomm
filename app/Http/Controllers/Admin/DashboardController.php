<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPiket;
use App\Models\Personel;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard.
     */
    public function index()
    {
        $totalPersonel = Personel::count();
        $personelAktif = Personel::aktif()->count();
        $totalJadwal = JadwalPiket::count();
        $jadwalHariIni = JadwalPiket::today()->count();
        $totalUser = User::where('role', 'user')->count();
        $totalAdmin = User::where('role', 'admin')->count();

        // Jadwal minggu ini
        $jadwalMingguIni = JadwalPiket::with('personel')
            ->byDateRange(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek())
            ->get();

        // Jadwal yang akan datang
        $jadwalMendatang = JadwalPiket::with('personel')
            ->upcoming()
            ->take(10)
            ->get();

        // Statistik piket per unit
        $piketPerUnit = Personel::select('unit')
            ->selectRaw('COUNT(jadwal_piket.id) as jadwal_piket_count')
            ->leftJoin('jadwal_piket', 'personel.id', '=', 'jadwal_piket.personel_id')
            ->groupBy('personel.unit')
            ->pluck('jadwal_piket_count', 'unit');

        // Notifikasi yang belum dikirim
        $notifikasiPending = JadwalPiket::notNotified()
            ->where('tanggal', '>=', Carbon::now())
            ->where('tanggal', '<=', Carbon::now()->addDays(1))
            ->count();

        return view('admin.dashboard', [
            'totalPersonel' => $totalPersonel,
            'personelAktif' => $personelAktif,
            'totalJadwal' => $totalJadwal,
            'jadwalHariIni' => $jadwalHariIni,
            'totalUser' => $totalUser,
            'totalAdmin' => $totalAdmin,
            'jadwalMingguIni' => $jadwalMingguIni,
            'jadwalMendatang' => $jadwalMendatang,
            'piketPerUnit' => $piketPerUnit,
            'notifikasiPending' => $notifikasiPending,
        ]);
    }
}
