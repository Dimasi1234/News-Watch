<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaTagModel extends Model
{
    protected $table = 'berita_tags';
    protected $primaryKey = 'id';
    protected $allowedFields = ['berita_id', 'tag_id'];
    public $timestamps = false;
}
