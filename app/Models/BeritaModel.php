<?php
namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'slug', 'content', 'created_at','id_penulis', 'updated_at', 'featured_image'];
    protected $useTimestamps = true;

    public function getTags($berita_id)
    {
        return $this->db->table('berita_tags')
            ->join('tags', 'tags.id = berita_tags.tag_id')
            ->where('berita_tags.berita_id', $berita_id)
            ->get()
            ->getResult();
    }
}
