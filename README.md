# 📚 Pustakara — Pusat Pengelolaan dan Peminjaman Karya

Pustakara adalah sistem manajemen perpustakaan berbasis web yang dibangun dengan Laravel 12. Dirancang untuk memudahkan pengelolaan koleksi buku, peminjaman, dan pengembalian buku di lingkungan akademik.

---

## ✨ Fitur

**Admin**
- Login sebagai administrator
- CRUD buku & kategori (dengan soft delete & trash)
- Registrasi anggota (user tidak bisa daftar sendiri)
- Konfirmasi / tolak pengajuan peminjaman
- Proses pengembalian buku
- Hitung denda otomatis berdasarkan keterlambatan
- Kelola data denda & status pembayaran

**Anggota**
- Login sebagai anggota
- Telusuri katalog buku
- Ajukan peminjaman buku
- Lihat riwayat peminjaman
- Pantau status & denda

---

## 🛠️ Tech Stack

- **Framework**: Laravel 12
- **Frontend**: Blade + Tailwind CSS
- **Database**: MySQL
- **Auth**: Laravel Breeze

---
## Preview UI Halaman
- **Login Page**:
<img width="790" height="469" alt="Screenshot 2026-05-17 100220" src="https://github.com/user-attachments/assets/2f07e316-3465-4287-a6cc-f81b9b8e1175" />

--------------------------------

- **Dashboard Admin**:
- <img width="833" height="499" alt="image" src="https://github.com/user-attachments/assets/638944da-7395-48c5-a331-264fb09eed30" />

--------------------------------

- **Dashboard User**:
- <img width="815" height="485" alt="image" src="https://github.com/user-attachments/assets/ddd7c046-7a93-47bb-bb85-5e57a2cf3e13" />

---

## ⚙️ Cara Install

```bash
# 1. Clone repo
git clone https://github.com/NanditaDindaI/Pustakara.git
cd Pustakara

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
DB_DATABASE=pustakara
DB_USERNAME=root
DB_PASSWORD=

# 5. Migrasi & seed
php artisan migrate

# 6. Jalankan
php artisan serve
npm run dev
```

---

## 👤 Default Login

| Role | Email | Password |
|------|-------|----------|
| Administrator | admin@gmail.com | *(sesuai setup)* |
| Anggota | *(didaftarkan oleh admin)* | *(sesuai saat registrasi)* |

---

## 📁 Struktur Role

- **Administrator** — mengelola semua data sistem
- **Anggota** — hanya bisa meminjam & melihat riwayat

---

— Pustakara 2026*
