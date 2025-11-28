<?php

namespace App\Http\Controllers;

use App\Models\JadwalPiket;
use App\Models\Personel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show user dashboard.
     */
    public function index(Request $request)
    {
        $query = JadwalPiket::with('personel')->upcoming();

        // Filter by date
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter by unit
        if ($request->filled('unit')) {
            $query->byUnit($request->unit);
        }

        // Filter by personel name
        if ($request->filled('cari')) {
            $query->byPersonel($request->cari);
        }

        // Filter by shift
        if ($request->filled('shift')) {
            $query->byShift($request->shift);
        }

        $jadwal = $query->paginate(15);
        $units = Personel::distinct()->pluck('unit');
        $todaySchedule = JadwalPiket::today()->with('personel')->get();

        return view('dashboard', [
            'jadwal' => $jadwal,
            'units' => $units,
            'todaySchedule' => $todaySchedule,
        ]);
    }

    /**
     * Show jadwal detail.
     */
    public function show(JadwalPiket $jadwalPiket)
    {
        return view('jadwal.show', ['jadwal' => $jadwalPiket]);
    }
}
