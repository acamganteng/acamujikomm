<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPiket;
use App\Models\Personel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalPiketController extends Controller
{
    /**
     * Display a listing of jadwal piket.
     */
    public function index(Request $request)
    {
        $query = JadwalPiket::with('personel');

        // Search and filter
        if ($request->filled('cari')) {
            $query->byPersonel($request->cari);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('unit')) {
            $query->byUnit($request->unit);
        }

        if ($request->filled('shift')) {
            $query->byShift($request->shift);
        }

        $jadwal = $query->latest('tanggal')->paginate(15);
        $units = Personel::distinct()->pluck('unit');

        return view('admin.jadwal-piket.index', [
            'jadwal' => $jadwal,
            'units' => $units,
        ]);
    }

    /**
     * Show the form for creating a new jadwal piket.
     */
    public function create()
    {
        $personel = Personel::aktif()->get();
        return view('admin.jadwal-piket.create', ['personel' => $personel]);
    }

    /**
     * Store a newly created jadwal piket.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'personel_id' => 'required|exists:personel,id',
            'tanggal' => 'required|date',
            'shift' => 'required|in:pagi,siang,malam',
            'tipe_piket' => 'required|in:harian,mingguan,bulanan',
            'lokasi' => 'nullable|string|max:100',
            'catatan' => 'nullable|string|max:500',
        ], [
            'personel_id.required' => 'Personel harus dipilih',
            'personel_id.exists' => 'Personel tidak ditemukan',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'shift.required' => 'Shift harus dipilih',
            'shift.in' => 'Shift tidak valid',
            'tipe_piket.required' => 'Tipe piket harus dipilih',
            'tipe_piket.in' => 'Tipe piket tidak valid',
        ]);

        JadwalPiket::create($validated);

        return redirect()->route('admin.jadwal-piket.index')
            ->with('success', 'Jadwal piket berhasil ditambahkan');
    }

    /**
     * Show the form for editing jadwal piket.
     */
    public function edit(JadwalPiket $jadwalPiket)
    {
        $personel = Personel::aktif()->get();
        return view('admin.jadwal-piket.edit', [
            'jadwal' => $jadwalPiket,
            'personel' => $personel,
        ]);
    }

    /**
     * Update the specified jadwal piket.
     */
    public function update(Request $request, JadwalPiket $jadwalPiket)
    {
        $validated = $request->validate([
            'personel_id' => 'required|exists:personel,id',
            'tanggal' => 'required|date',
            'shift' => 'required|in:pagi,siang,malam',
            'tipe_piket' => 'required|in:harian,mingguan,bulanan',
            'lokasi' => 'nullable|string|max:100',
            'catatan' => 'nullable|string|max:500',
        ]);

        $jadwalPiket->update($validated);

        return redirect()->route('admin.jadwal-piket.index')
            ->with('success', 'Jadwal piket berhasil diperbarui');
    }

    /**
     * Delete the specified jadwal piket.
     */
    public function destroy(JadwalPiket $jadwalPiket)
    {
        $jadwalPiket->delete();
        return redirect()->route('admin.jadwal-piket.index')
            ->with('success', 'Jadwal piket berhasil dihapus');
    }

    /**
     * Bulk create jadwal for weekly or monthly.
     */
    public function bulkCreate()
    {
        $personel = Personel::aktif()->get();
        return view('admin.jadwal-piket.bulk-create', ['personel' => $personel]);
    }

    /**
     * Store bulk jadwal.
     */
    public function bulkStore(Request $request)
    {
        $validated = $request->validate([
            'personel_ids' => 'required|array',
            'personel_ids.*' => 'exists:personel,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'tipe_piket' => 'required|in:harian,mingguan,bulanan',
            'shifts' => 'required|array',
            'shifts.*' => 'in:pagi,siang,malam',
        ]);

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $count = 0;

        foreach ($validated['personel_ids'] as $personelId) {
            for ($date = clone $startDate; $date <= $endDate; $date->addDay()) {
                JadwalPiket::create([
                    'personel_id' => $personelId,
                    'tanggal' => $date->copy(),
                    'shift' => $validated['shifts'][array_rand($validated['shifts'])],
                    'tipe_piket' => $validated['tipe_piket'],
                ]);
                $count++;
            }
        }

        return redirect()->route('admin.jadwal-piket.index')
            ->with('success', "Berhasil membuat {$count} jadwal piket");
    }
}
