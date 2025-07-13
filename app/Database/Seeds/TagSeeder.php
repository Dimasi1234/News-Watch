<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = ['Teknologi', 'Olahraga', 'Politik', 'Pendidikan', 'Hiburan', 'Musik', 'Film'];

        foreach ($tags as $tag) {
            $this->db->table('tags')->insert([
                'nama_tag' => $tag
            ]);
        }
    }
}
