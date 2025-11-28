# Sistem Manajemen Jadwal Piket Polres Garut

<p align="center">
  <strong>Aplikasi Web untuk Mengelola dan Menampilkan Jadwal Piket Polres Garut</strong>
</p>

## Fitur Utama

### Untuk Admin
- ✅ Dashboard dengan statistik lengkap
- ✅ Manajemen jadwal piket (CRUD)
- ✅ Bulk create jadwal untuk multiple personel
- ✅ Manajemen data personel dengan foto profil
- ✅ Filter dan pencarian jadwal piket
- ✅ Pengaturan shift (pagi, siang, malam)
- ✅ Tipe piket (harian, mingguan, bulanan)
- ✅ Notifikasi pengingat piket
- ✅ Role-based access control

### Untuk User
- ✅ Lihat jadwal piket
- ✅ Filter berdasarkan tanggal, unit, atau personel
- ✅ Detail jadwal piket lengkap
- ✅ Tampilan responsif dan mobile-friendly

## Teknologi yang Digunakan

- **Backend**: Laravel 11
- **Database**: MySQL
- **Frontend**: Blade Template, Bootstrap 5
- **Styling**: Custom CSS dengan tema biru tua & emas

## Persyaratan Sistem

- PHP >= 8.2
- MySQL >= 5.7
- Composer
- Node.js & npm (opsional untuk asset compilation)

## Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd acam
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jadwal_piket
DB_USERNAME=root
DB_PASSWORD=
```

Buat database di MySQL:
```bash
mysql -u root -p
CREATE DATABASE jadwal_piket;
EXIT;
```

### 5. Jalankan Migration dan Seeder
```bash
php artisan migrate
php artisan db:seed
```

### 6. Generate Assets
```bash
npm run build
```

### 7. Jalankan Server
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## Login Default

### Admin
- Email: `admin@polres.garut.id`
- Password: `admin123`
- URL: `http://localhost:8000/admin-login`

### User
- Email: `any@example.com` (atau email lainnya)
- Password: `user123`
- URL: `http://localhost:8000/login`

## Struktur Database

### Tabel Users
- id
- name
- email
- role (admin/user)
- password
- remember_token
- timestamps

### Tabel Personel
- id
- nama
- pangkat
- jabatan
- unit
- nip
- no_telepon
- foto
- status (aktif/nonaktif)
- catatan
- timestamps

### Tabel Jadwal Piket
- id
- personel_id
- tanggal
- shift (pagi/siang/malam)
- tipe_piket (harian/mingguan/bulanan)
- lokasi
- catatan
- notifikasi_dikirim
- notifikasi_waktu
- timestamps

## Struktur File

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php          # Main layout
│   ├── auth/
│   │   ├── login.blade.php        # User login
│   │   └── admin-login.blade.php  # Admin login
│   ├── dashboard.blade.php        # User dashboard
│   ├── jadwal/
│   │   └── show.blade.php         # Detail jadwal
│   └── admin/
│       ├── dashboard.blade.php    # Admin dashboard
│       ├── jadwal-piket/
│       │   ├── index.blade.php    # List jadwal
│       │   ├── create.blade.php   # Create jadwal
│       │   ├── edit.blade.php     # Edit jadwal
│       │   └── bulk-create.blade.php
│       └── personel/
│           ├── index.blade.php    # List personel
│           ├── create.blade.php   # Create personel
│           ├── edit.blade.php     # Edit personel
│           └── show.blade.php     # Detail personel
app/
├── Models/
│   ├── User.php
│   ├── Personel.php
│   └── JadwalPiket.php
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── JadwalPiketController.php
│   │       └── PersonelController.php
│   └── Middleware/
│       ├── AdminMiddleware.php
│       └── UserMiddleware.php
database/
├── migrations/          # File migrasi database
├── factories/           # Model factories
└── seeders/            # Database seeders
```

## Fitur Detail

### 1. Autentikasi
- Login terpisah untuk Admin dan User
- Password di-hash menggunakan bcrypt
- Session management

### 2. Manajemen Jadwal Piket
- Tambah jadwal individual
- Bulk create jadwal untuk multiple personel dengan date range
- Edit jadwal
- Hapus jadwal
- Filter berdasarkan:
  - Personel/Nama
  - Tanggal
  - Unit
  - Shift

### 3. Manajemen Personel
- CRUD data personel
- Upload foto profil
- Informasi pangkat, jabatan, unit
- Status aktif/nonaktif
- Riwayat jadwal piket

### 4. Dashboard
- **Admin Dashboard**: Statistik personel, jadwal, user
- **User Dashboard**: Lihat jadwal piket mendatang
- **Today Schedule**: Tampilan jadwal hari ini

### 5. Notifikasi
- Tracking notifikasi pengingat
- Status notifikasi per jadwal

## Middleware & Security

- AdminMiddleware: Mengecek role admin
- UserMiddleware: Mengecek user terautentikasi
- CSRF Protection
- Password Hashing

## API Endpoints

### Auth
- `POST /login` - Login user
- `POST /admin-login` - Login admin
- `POST /logout` - Logout

### User
- `GET /dashboard` - User dashboard
- `GET /jadwal/{jadwalPiket}` - Detail jadwal

### Admin
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/jadwal-piket` - List jadwal
- `POST /admin/jadwal-piket` - Create jadwal
- `PUT /admin/jadwal-piket/{jadwalPiket}` - Update jadwal
- `DELETE /admin/jadwal-piket/{jadwalPiket}` - Delete jadwal
- `POST /admin/jadwal-piket/bulk` - Bulk create jadwal
- `GET /admin/personel` - List personel
- `POST /admin/personel` - Create personel
- `PUT /admin/personel/{personel}` - Update personel
- `DELETE /admin/personel/{personel}` - Delete personel

## Troubleshooting

### Database Connection Error
- Pastikan MySQL berjalan
- Cek konfigurasi di `.env`
- Jalankan: `php artisan migrate:fresh --seed`

### Missing Assets
- Jalankan: `npm run build`
- Clear cache: `php artisan view:clear`

### Permission Denied
- Jalankan: `chmod -R 775 storage bootstrap/cache`

## Kontribusi

Untuk kontribusi, silakan buat branch baru dan submit pull request.

## Lisensi

Aplikasi ini dilindungi oleh lisensi MIT.

## Support

Untuk pertanyaan atau masalah, hubungi administrator sistem.

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
