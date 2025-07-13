<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'komentar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['berita_id', 'user_id', 'komentar', 'created_at'];
    protected $useTimestamps = false;

    public function getKomentarByBerita($berita_id)
{
    return $this->select('komentar.*, users.username')
                ->join('users', 'users.id = komentar.user_id', 'left')
                ->where('berita_id', $berita_id)
                ->orderBy('komentar.created_at', 'DESC')
                ->findAll();
}
}
