<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $password_confirm = $this->request->getPost('password_confirm');

            if ($password !== $password_confirm) {
                return redirect()->back()->withInput()->with('error', 'Password tidak sama.');
            }

            $userModel = new UserModel();

            // Cek duplikat username/email
            if ($userModel->where('username', $username)->first()) {
                return redirect()->back()->withInput()->with('error', 'Username sudah digunakan.');
            }

            if ($userModel->where('email', $email)->first()) {
                return redirect()->back()->withInput()->with('error', 'Email sudah digunakan.');
            }

            $simpan = $userModel->save([
                'username' => $username,
                'email'    => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role'     => 'user',
                'status'   => 'active'
            ]);

            if ($simpan) {
                return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data.');
            }
        }

        return view('auth/auth/register');
    }

    public function login()
    {
        return view('auth/auth/login');
    }

    public function do_login()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);

            if ($user['role'] == 'admin') {
                return redirect()->to('/admin');
            } elseif ($user['role'] == 'penulis') {
                return redirect()->to('/penulis');
            } else {
                return redirect()->to('/');
            }
        } else {
            // Jika login gagal, beri pesan error
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        // Hapus session user dan redirect ke login page
        session()->destroy();
        return redirect()->to('/login');
    }
}
