# 📰 Aplikasi Web Portal Berita — *News Watch*

Proyek ini adalah aplikasi web portal berita yang dibangun menggunakan **CodeIgniter 4** sebagai framework backend dan HTML/CSS dengan **SB Admin & Clean Blog** sebagai template UI. Aplikasi ini mendukung multi-role user: **admin**, **penulis**, dan **user pembaca**.

---

## 📌 Daftar Isi

- [📌 Daftar Isi](#-daftar-isi)  
- [📌 Fitur Utama](#-fitur-utama)  
- [📌 Teknologi yang Digunakan](#-teknologi-yang-digunakan)  
- [🚀 Cara Install dan Menjalankan](#-cara-install-dan-menjalankan)  
- [👤 Struktur Role & Akses Pengguna](#-struktur-role--akses-pengguna)  
- [📊 Struktur Tabel Database](#-struktur-tabel-database)  
- [📂 Struktur Folder](#-struktur-folder)  
- [🛠️ Rencana Pengembangan Berikutnya](#️-rencana-pengembangan-berikutnya)  

---

## 📌 Fitur Utama

### Guest
- Melihat daftar berita pada halaman beranda.
- Tidak dapat membuka detail berita sebelum login.
- Dapat melakukan pencarian berdasarkan judul/tag.

### User (pembaca)
- Registrasi dan login menggunakan username.
- Melihat daftar berita & detail berita.
- Memberikan komentar di setiap berita.
- Memiliki halaman profil.

### Penulis
- Dashboard penulis dengan berita milik sendiri.
- CRUD berita (buat, ubah, hapus).
- Tambah tag dinamis saat menulis berita.
- Upload gambar utama berita.
- Penggunaan CKEditor untuk konten berita.

### Admin
- Dashboard admin berbasis SB Admin.
- CRUD user & penulis.
- Melihat statistik jumlah berita, user, komentar.
- Menghapus berita dari semua penulis.

---

## 📌 Teknologi yang Digunakan

### 🔧 Backend:
- PHP 8+
- CodeIgniter 4
- MySQL/MariaDB
- Composer
- CSRF Protection + Password Bcrypt

### 🎨 Frontend:
- SB Admin 2 Template (untuk admin & penulis)
- Clean Blog Template (untuk user)
- Bootstrap 5
- CKEditor 5 (editor berita)
- Select2 (multiple tag select)

---

## 🚀 Cara Install dan Menjalankan

### 1. Clone Repository
```bash
git clone https://github.com/username/news-watch.git
cd news-watch
