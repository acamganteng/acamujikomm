<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Personel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonelController extends Controller
{
    /**
     * Display a listing of personel.
     */
    public function index(Request $request)
    {
        $query = Personel::query();

        // Search
        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%')
                  ->orWhere('nip', 'like', '%' . $request->cari . '%');
        }

        // Filter by unit
        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $personel = $query->paginate(15);
        $units = Personel::distinct()->pluck('unit');

        return view('admin.personel.index', [
            'personel' => $personel,
            'units' => $units,
        ]);
    }

    /**
     * Show form for creating new personel.
     */
    public function create()
    {
        return view('admin.personel.create');
    }

    /**
     * Store newly created personel.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'pangkat' => 'required|string|max:50',
            'jabatan' => 'required|string|max:100',
            'unit' => 'required|string|max:50',
            'nip' => 'required|unique:personel|string|max:20',
            'no_telepon' => 'nullable|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'catatan' => 'nullable|string|max:500',
        ], [
            'nama.required' => 'Nama harus diisi',
            'pangkat.required' => 'Pangkat harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'unit.required' => 'Unit harus diisi',
            'nip.required' => 'NIP harus diisi',
            'nip.unique' => 'NIP sudah terdaftar',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('personel', 'public');
            $validated['foto'] = $path;
        }

        Personel::create($validated);

        return redirect()->route('admin.personel.index')
            ->with('success', 'Data personel berhasil ditambahkan');
    }

    /**
     * Show form for editing personel.
     */
    public function edit(Personel $personel)
    {
        return view('admin.personel.edit', ['personel' => $personel]);
    }

    /**
     * Update personel.
     */
    public function update(Request $request, Personel $personel)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'pangkat' => 'required|string|max:50',
            'jabatan' => 'required|string|max:100',
            'unit' => 'required|string|max:50',
            'nip' => 'required|unique:personel,nip,' . $personel->id . '|string|max:20',
            'no_telepon' => 'nullable|string|max:15',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old foto
            if ($personel->foto) {
                Storage::disk('public')->delete($personel->foto);
            }
            $path = $request->file('foto')->store('personel', 'public');
            $validated['foto'] = $path;
        }

        $personel->update($validated);

        return redirect()->route('admin.personel.index')
            ->with('success', 'Data personel berhasil diperbarui');
    }

    /**
     * Delete personel.
     */
    public function destroy(Personel $personel)
    {
        // Delete foto if exists
        if ($personel->foto) {
            Storage::disk('public')->delete($personel->foto);
        }

        $personel->delete();

        return redirect()->route('admin.personel.index')
            ->with('success', 'Data personel berhasil dihapus');
    }

    /**
     * Show personel detail.
     */
    public function show(Personel $personel)
    {
        $jadwal = $personel->jadwalPiket()->upcoming()->take(10)->get();
        return view('admin.personel.show', [
            'personel' => $personel,
            'jadwal' => $jadwal,
        ]);
    }
}
