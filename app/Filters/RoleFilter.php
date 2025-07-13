<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
{
    $session = session();

    // Pastikan user sudah login dan punya role
    if (!$session->has('role')) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $userRole = $session->get('role');

    // Alias: perlakukan 'admin_as_penulis' sebagai 'penulis'
    if ($userRole === 'admin_as_penulis') {
        $userRole = 'penulis';
    }

    // Jika ada argumen role yang dibutuhkan
    if ($arguments !== null && !in_array($userRole, $arguments)) {
        return redirect()->to('/')->with('error', 'Akses ditolak.');
    }
}

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak digunakan
    }
}
