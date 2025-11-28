# Entity Relationship Diagram (ERD)
# Sistem Jadwal Piket Polres Garut

```
┌─────────────────────────────────────────────────────────────────────────────────────────────────┐
│                            SISTEM JADWAL PIKET POLRES GARUT                                    │
└─────────────────────────────────────────────────────────────────────────────────────────────────┘

                                    ┌──────────────┐
                                    │    USERS     │
                                    ├──────────────┤
                                    │ id (PK)      │
                                    │ name         │
                                    │ email (UK)   │
                                    │ password     │
                                    │ role (enum)  │
                                    │ timestamps   │
                                    └──────────────┘
                                           △
                                           │
                                           │ 1:N
                                           │ Authentication
                                           │


                    ┌──────────────────┐                      ┌─────────────────┐
                    │    PERSONEL      │                      │  JADWAL_PIKET   │
                    ├──────────────────┤                      ├─────────────────┤
                    │ id (PK)          │◄─────1:N─────────────│ id (PK)         │
                    │ nama             │  FK: personel_id     │ personel_id (FK)│
                    │ pangkat          │                      │ tanggal         │
                    │ jabatan          │                      │ shift           │
                    │ unit             │                      │ tipe_piket      │
                    │ nip (UK)         │                      │ lokasi          │
                    │ foto             │                      │ catatan         │
                    │ no_telepon       │                      │ notifikasi_*    │
                    │ status (enum)    │                      │ timestamps      │
                    │ catatan          │                      └─────────────────┘
                    │ timestamps       │
                    └──────────────────┘


KETERANGAN RELASI:
• USERS (1) ──→ JADWAL_PIKET (N)     : Seorang user dapat melihat banyak jadwal
• PERSONEL (1) ──→ JADWAL_PIKET (N)  : Seorang personel dapat memiliki banyak jadwal piket

TIPE DATA:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

TABLE: USERS
┌──────────────┬──────────────┬─────────────────────────────────────────────────┐
│ Field        │ Type         │ Description                                     │
├──────────────┼──────────────┼─────────────────────────────────────────────────┤
│ id           │ bigIncrements│ Primary Key (Auto Increment)                    │
│ name         │ string(255)  │ Nama pengguna                                   │
│ email        │ string(255)  │ Email unik pengguna                             │
│ password     │ string(255)  │ Password ter-hash (bcrypt)                      │
│ role         │ enum         │ 'admin' atau 'user'                             │
│ created_at   │ timestamp    │ Tanggal dibuat                                  │
│ updated_at   │ timestamp    │ Tanggal diupdate                                │
└──────────────┴──────────────┴─────────────────────────────────────────────────┘

TABLE: PERSONEL
┌──────────────┬──────────────┬─────────────────────────────────────────────────┐
│ Field        │ Type         │ Description                                     │
├──────────────┼──────────────┼─────────────────────────────────────────────────┤
│ id           │ bigIncrements│ Primary Key (Auto Increment)                    │
│ nama         │ string(255)  │ Nama lengkap personel polisi                    │
│ pangkat      │ string(100)  │ Pangkat/Grade (Brigadir, Bintara, dll)         │
│ jabatan      │ string(100)  │ Posisi/Job Title                                │
│ unit         │ string(100)  │ Unit kerja (Unit Laka Lantas, Unit Reserse, dll)│
│ nip          │ string(20)   │ Nomor Induk Pegawai (Unik)                     │
│ foto         │ string(255)  │ Path foto personel (storage/personel/)          │
│ no_telepon   │ string(20)   │ Nomor telepon kontak                            │
│ status       │ enum         │ 'aktif' atau 'nonaktif'                         │
│ catatan      │ text         │ Catatan tambahan                                │
│ created_at   │ timestamp    │ Tanggal dibuat                                  │
│ updated_at   │ timestamp    │ Tanggal diupdate                                │
└──────────────┴──────────────┴─────────────────────────────────────────────────┘

TABLE: JADWAL_PIKET
┌──────────────────────┬──────────────┬──────────────────────────────────────┐
│ Field                │ Type         │ Description                          │
├──────────────────────┼──────────────┼──────────────────────────────────────┤
│ id                   │ bigIncrements│ Primary Key (Auto Increment)         │
│ personel_id          │ bigInteger   │ Foreign Key ke PERSONEL              │
│ tanggal              │ date         │ Tanggal piket                        │
│ shift                │ enum         │ 'pagi' / 'siang' / 'malam'           │
│ tipe_piket           │ enum         │ 'harian' / 'mingguan' / 'bulanan'    │
│ lokasi               │ string(255)  │ Lokasi/Tempat piket                  │
│ catatan              │ text         │ Catatan khusus                       │
│ notifikasi_dikirim   │ boolean      │ Status notifikasi (true/false)       │
│ notifikasi_waktu     │ timestamp    │ Waktu notifikasi dikirim             │
│ created_at           │ timestamp    │ Tanggal dibuat                       │
│ updated_at           │ timestamp    │ Tanggal diupdate                     │
└──────────────────────┴──────────────┴──────────────────────────────────────┘


ENUM VALUES:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

USERS.role:
  • 'admin'  - Administrator dengan akses penuh
  • 'user'   - User biasa dengan akses terbatas

PERSONEL.status:
  • 'aktif'    - Personel aktif melayani
  • 'nonaktif' - Personel tidak aktif

JADWAL_PIKET.shift:
  • 'pagi'   - 06:00 - 14:00 (Shift Pagi)
  • 'siang'  - 14:00 - 22:00 (Shift Siang)
  • 'malam'  - 22:00 - 06:00 (Shift Malam)

JADWAL_PIKET.tipe_piket:
  • 'harian'    - Piket satu hari
  • 'mingguan'  - Piket seminggu
  • 'bulanan'   - Piket sebulan


INDEXES & CONSTRAINTS:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

PRIMARY KEYS:
  • users.id (Unique identifier untuk setiap user)
  • personel.id (Unique identifier untuk setiap personel)
  • jadwal_piket.id (Unique identifier untuk setiap jadwal)

UNIQUE KEYS (UK):
  • users.email (Email harus unik, tidak boleh ada yang sama)
  • personel.nip (NIP harus unik, tidak boleh ada yang sama)

FOREIGN KEYS (FK):
  • jadwal_piket.personel_id → personel.id (ON DELETE CASCADE)

INDEXES:
  • jadwal_piket.personel_id (untuk performa query)
  • jadwal_piket.tanggal (untuk filter berdasarkan tanggal)
  • personel.unit (untuk filter berdasarkan unit)


RELASI ANTAR TABEL:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

1. USERS → JADWAL_PIKET (One-to-Many):
   Relasi: User dapat melihat jadwal piket
   Query: SELECT * FROM jadwal_piket WHERE personel_id IN (SELECT id FROM personel)
   Note: User melihat jadwal dari seluruh personel (berbeda tergantung role)

2. PERSONEL → JADWAL_PIKET (One-to-Many):
   Relasi: Satu personel dapat memiliki banyak jadwal piket
   Query: SELECT * FROM jadwal_piket WHERE personel_id = X
   Note: Ketika personel dihapus, jadwal piketnya juga akan terhapus (CASCADE)

3. PERSONEL → USERS (Tidak Langsung):
   Relasi: Personel tidak memiliki FK ke users, tapi user dapat mengelola personel
   Query: Admin dapat mengelola semua personel dan jadwal piket


DATABASE QUERIES EXAMPLES:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

-- Cari semua jadwal piket untuk personel tertentu
SELECT jp.*, p.nama, p.unit 
FROM jadwal_piket jp
JOIN personel p ON jp.personel_id = p.id
WHERE jp.personel_id = 1
ORDER BY jp.tanggal DESC;

-- Cari jadwal piket berdasarkan unit dan tanggal
SELECT jp.*, p.nama, p.unit 
FROM jadwal_piket jp
JOIN personel p ON jp.personel_id = p.id
WHERE p.unit = 'Unit Laka Lantas' 
  AND jp.tanggal BETWEEN '2025-12-01' AND '2025-12-07'
ORDER BY jp.tanggal ASC;

-- Hitung total jadwal piket per unit
SELECT p.unit, COUNT(jp.id) as total_jadwal
FROM personel p
LEFT JOIN jadwal_piket jp ON p.id = jp.personel_id
WHERE p.status = 'aktif'
GROUP BY p.unit;

-- Cari personel yang belum mendapat jadwal piket minggu ini
SELECT p.* 
FROM personel p
WHERE p.status = 'aktif'
  AND p.id NOT IN (
    SELECT DISTINCT personel_id 
    FROM jadwal_piket 
    WHERE WEEK(tanggal) = WEEK(CURDATE())
  );

-- Update status notifikasi jadwal piket
UPDATE jadwal_piket 
SET notifikasi_dikirim = 1, notifikasi_waktu = NOW()
WHERE tanggal = CURDATE() 
  AND notifikasi_dikirim = 0;
```

---

## 📊 Visualisasi Relasi

```
┏━━━━━━━━━━━┓
┃   USERS   ┃
┃───────────┃
┃ id (PK)   ┃
┃ name      ┃
┃ email     ┃
┃ password  ┃
┃ role      ┃
┗━━━━━━━━━━━┛
      │
      │ (Admin dapat mengelola)
      │
      ▼
┏━━━━━━━━━━━━━━┓          1:N           ┏━━━━━━━━━━━━━┓
┃  PERSONEL    ┃◄──────────────────────┫JADWAL_PIKET ┃
┃──────────────┃ (personel_id FK)      ┃─────────────┃
┃ id (PK)      ┃                       ┃ id (PK)     ┃
┃ nama         ┃                       ┃ personel_id ┃
┃ pangkat      ┃                       ┃ tanggal     ┃
┃ jabatan      ┃                       ┃ shift       ┃
┃ unit         ┃                       ┃ tipe_piket  ┃
┃ nip          ┃                       ┃ lokasi      ┃
┃ foto         ┃                       ┃ catatan     ┃
┃ no_telepon   ┃                       ┃ notifikasi* ┃
┃ status       ┃                       ┗━━━━━━━━━━━━━┛
┃ catatan      ┃
┗━━━━━━━━━━━━━━┛
```

---

## 🔄 Data Flow

```
┌─────────────┐
│   LOGIN     │
└──────┬──────┘
       │
       ▼
   ┌───────┐
   │ ROLE? │
   └───┬───┘
       │
   ┌───┴─────────────┐
   │                 │
   ▼                 ▼
┌─────────┐    ┌──────────┐
│ ADMIN   │    │   USER   │
└────┬────┘    └─────┬────┘
     │               │
     │               │ (View Only)
     │               ▼
     │          ┌─────────────────┐
     │          │ VIEW DASHBOARD  │
     │          │ - Lihat jadwal  │
     │          │ - Filter jadwal │
     │          └─────────────────┘
     │
     ▼
┌──────────────────────────┐
│  ADMIN DASHBOARD         │
├──────────────────────────┤
│ 1. Manage PERSONEL       │
│    ├─ Create             │
│    ├─ Read               │
│    ├─ Update             │
│    └─ Delete             │
│                          │
│ 2. Manage JADWAL_PIKET   │
│    ├─ Create             │
│    ├─ Read               │
│    ├─ Update             │
│    ├─ Delete             │
│    ├─ Bulk Create        │
│    └─ Filter             │
│                          │
│ 3. View STATISTICS       │
│    ├─ Total Personel     │
│    ├─ Total Jadwal       │
│    ├─ Jadwal Per Unit    │
│    └─ Notifikasi Pending │
└──────────────────────────┘
```

---

Generated: November 28, 2025  
System: Sistem Jadwal Piket Polres Garut v1.0
