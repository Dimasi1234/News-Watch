<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BeritaModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $beritaModel;

    public function __construct()
    {
        helper('url');
        $this->userModel = new UserModel();
        $this->beritaModel = new BeritaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'jumlah_user' => $this->userModel->where('role', 'user')->countAllResults(),
            'jumlah_penulis' => $this->userModel->where('role', 'penulis')->countAllResults(),
            'jumlah_berita' => $this->beritaModel->countAllResults(),
        ];
        $beritaList = $this->beritaModel
            ->select('berita.title as title, berita.created_at as created_at, users.username as nama_penulis')
            ->join('users', 'users.id = berita.id_penulis')
            ->orderBy('berita.created_at', 'DESC')
            ->findAll();

        $data = [
            'title' => 'Dashboard Admin',
            'jumlah_user' => $this->userModel->where('role', 'user')->countAllResults(),
            'jumlah_penulis' => $this->userModel->where('role', 'penulis')->countAllResults(),
            'jumlah_berita' => $this->beritaModel->countAllResults(),
            'beritaList' => $beritaList
        ];
        return view('admin/panel/dashboard', $data);
    }

    public function user()
    {
        $data = [
            'title' => 'Data User',
            'users' => $this->userModel->where('role', 'user')->findAll()
        ];
        return view('admin/panel/user', $data);
    }

    public function penulis()
    {
        $data = [
            'title' => 'Data Penulis',
            'penulis' => $this->userModel->where('role', 'penulis')->findAll()
        ];
        return view('admin/panel/penulis', $data);
    }

    public function tambah_penulis()
    {
    $data = [
        'username' => $this->request->getPost('username'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role' => 'penulis',
        'status' => 'active',
    ];

    $this->userModel->insert($data);

    return redirect()->to('admin/panel/penulis')->with('success', 'Akun penulis berhasil ditambahkan.');
    }

    public function hapus_akun($id)
    {
    $user = $this->userModel->find($id);

    if (!$user) {
        return redirect()->back()->with('error', 'Akun tidak ditemukan.');
    }

    // Admin tidak boleh menghapus akun admin lain
    if ($user['role'] === 'admin') {
        return redirect()->back()->with('error', 'Akun admin tidak dapat dihapus.');
    }

    $this->userModel->delete($id);
    return redirect()->back()->with('success', 'Akun berhasil dihapus.');
    }

    public function lihat_penulis($id)
    {
        $penulis = $this->userModel->find($id);
    
        if (!$penulis || $penulis['role'] !== 'penulis') {
            return redirect()->back()->with('error', 'Akun penulis tidak ditemukan.');
        }
    
        // Set session seolah-olah admin adalah penulis ini
        session()->set([
            'id' => $penulis['id'],
            'username' => $penulis['username'],
            'role' => 'admin_as_penulis', // tanda bahwa ini admin yang login sebagai penulis
        ]);
    
        return redirect()->to('/penulis');
    }
    public function kembali_ke_admin()
    {
        if (session()->get('role') === 'admin_as_penulis') {
            session()->set('role', 'admin');
        }
        return redirect()->to('/admin');
    }

    public function profil()
    {
        // Misalnya admin hanya bisa mengedit profilnya sendiri
        $adminId = session()->get('id');
        $data = [
            'title' => 'Profil Admin',
            'admin' => $this->adminModel->find($adminId)
        ];
        return view('admin/profil', $data);
    }
}
