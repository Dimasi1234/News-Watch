<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileUser extends BaseController
{
    public function index()
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login');
        }
        $userId = session()->get('id');
        $model = new UserModel();
        $user = $model->find($userId);

        return view('user/layout/headerH', ['title' => 'Profile'])
            . view('user/beranda/profile', ['user' => $user]) // nanti buat view ini
            . view('user/layout/footer');
    }
    public function logout()
    {
        // Hapus session dan arahkan ke halaman login
        session()->destroy();
        return redirect()->to('/');
    }
}
