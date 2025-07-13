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

## 👤 Struktur Role & Akses Pengguna
| Role    | Akses                                                               |
| ------- | ------------------------------------------------------------------- |
| Guest   | Lihat daftar berita, cari berita, login/register                    |
| User    | Detail berita, komentar, profil, logout                             |
| Penulis | CRUD berita, tambah tag, upload gambar, CKEditor, dashboard penulis |
| Admin   | Kelola user, penulis, statistik, hapus berita                       |

---

## 📊 Struktur Tabel Database (utama)
- users: username, email, password, role, status
- berita: title, slug, content, id_penulis, featured_image, created_at
- tags: id, nama_tag, slug
- berita_tags: berita_id, tag_id (many-to-many)
- komentar: id, berita_id, user_id, komentar, created_at

---

## 📂 Struktur Folder (utama)
app/
├── Controllers/
│   ├── Auth.php
│   ├── User.php
│   ├── Penulis.php
│   └── Admin.php
├── Models/
│   ├── BeritaModel.php
│   ├── TagModel.php
│   ├── BeritaTagModel.php
│   ├── CommentModel.php
│   └── UserModel.php
├── Views/
│   ├── user/
│   ├── penulis/
│   ├── admin/
│   └── auth/
public/
├── assets/
│   ├── admin/
│   └── user/
uploads/
└── images/

---

## 🚀 Cara Install dan Menjalankan

### 1. Clone Repository
```bash
git clone https://github.com/username/news-watch.git
cd news-watch
