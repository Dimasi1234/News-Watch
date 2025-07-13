<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'username' => 'arcanist',
                'email'    => 'arcanist@gmail.com',
                'password' => password_hash('penulis123', PASSWORD_DEFAULT),
                'role' => 'penulis',
                'status' => 'active',
            ],
            [
                'username' => 'panthomfive',
                'email'    => 'pfive@gmail.com',
                'password' => password_hash('penulis321', PASSWORD_DEFAULT),
                'role' => 'penulis',
                'status' => 'active',
            ],
            [
                'username' => 'lunamaroon',
                'email'    => 'lunamar@gmail.com',
                'password' => password_hash('penulis231', PASSWORD_DEFAULT),
                'role' => 'penulis',
                'status' => 'active',
            ],
            [
                'username' => 'Dimast12',
                'email'    => 'dimast12@gmail.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'username' => 'jackjack',
                'email'    => 'jacky24@gmail.com',
                'password' => password_hash('user321', PASSWORD_DEFAULT),
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'username' => 'nanaminto',
                'email'    => 'nanamin6@gmail.com',
                'password' => password_hash('user231', PASSWORD_DEFAULT),
                'role' => 'user',
                'status' => 'active',
            ],
            [
                'username' => 'mraffi',
                'email'    => 'rafiajah2@gmail.com',
                'password' => password_hash('user213', PASSWORD_DEFAULT),
                'role' => 'user',
                'status' => 'active',
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
