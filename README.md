<div align="center">
  <h1>🎬 Movie Tracker API</h1>
  <p>Tugas Akhir/Proyek RESTful API menggunakan Laravel 11 untuk melacak tontonan film, lengkap dengan sistem Autentikasi dan Dokumentasi Otomatis.</p>
</div>

---

## ✨ Fitur Utama
- **CRUD Movies**: Tambah, Lihat, Edit, dan Hapus data film.
- **Custom Validation**: Validasi strict untuk input data (contoh: mood hanya boleh `happy`, `sad`, `excited`, atau `bored`).
- **Autentikasi Aman**: Menggunakan **Laravel Sanctum** berbasis Bearer Token.
- **Auto-Documentation**: Integrasi dengan `dedoc/scramble` untuk dokumentasi API otomatis.
- **Data dummy (Seeder)**: Dilengkapi seeder awal untuk langsung mengetes API.

## 🛠️ Teknologi yang Digunakan
- **PHP** 8.2+
- **Laravel** 11.x
- **Laravel Sanctum** (Autentikasi)
- **Scramble** (Dokumentasi API / OpenAPI)
- **MySQL/SQLite** (Database)

---

## 🚀 Cara Instalasi & Menjalankan Project

Jika kamu baru saja men-clone repositori ini, ikuti langkah-langkah berikut:

**1. Install Dependensi PHP**
```bash
composer install
```

**2. Setup Environment Variables**
Copy file `.env.example` menjadi `.env` (jika belum ada), lalu bangkitkan APP_KEY:
```bash
cp .env.example .env
php artisan key:generate
```
*Pastikan konfigurasi database di `.env` (seperti `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) sudah sesuai.*

**3. Jalankan Migrasi & Seeder Database**
Langkah ini akan membuat tabel yang dibutuhkan dan mengisi 5 data film awal ke dalam sistem:
```bash
php artisan migrate --seed
```

**4. Jalankan Server Lokal**
```bash
php artisan serve
```
Aplikasi sekarang berjalan di `http://127.0.0.1:8000`.

---

## 📖 Dokumentasi API Otomatis (Scramble)

Semua endpoint, parameter, dan cara penggunaan API dapat dilihat secara interaktif lewat dokumentasi UI bawaan Scramble.

**Buka di Browser:**
👉 **[http://127.0.0.1:8000/docs/api](http://127.0.0.1:8000/docs/api)**

*(Pastikan server `php artisan serve` sedang berjalan saat membuka link ini).*

---

## 🔑 Rangkuman Endpoint API (REST)

*Semua request ke `/api/movies` **wajib** menyertakan header `Authorization: Bearer <token>`.*

### Authentication:
| Method | Endpoint | Deskripsi |
| --- | --- | --- |
| `POST` | `/api/register` | Mendaftarkan user baru dan mendapatkan Token |
| `POST` | `/api/login` | Login user untuk mendapatkan Token |
| `POST` | `/api/logout` | *(Requires Token)* Logout dan menghapus Token dari database |

### Movies Data:
| Method | Endpoint | Deskripsi |
| --- | --- | --- |
| `GET` | `/api/movies` | Menampilkan seluruh list daftar film |
| `GET` | `/api/movies/{id}` | Menampilkan detail spesifik 1 film berdasarkan ID |
| `POST` | `/api/movies` | Menambahkan data film baru |
| `PUT` | `/api/movies/{id}` | Meng-update (edit) data film berdasarkan ID |
| `DELETE` | `/api/movies/{id}` | Menghapus film berdasarkan ID |

---
*Dibuat untuk keperluan Tugas TIS / Pemrograman API.*
