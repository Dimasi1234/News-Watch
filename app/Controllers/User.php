<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\CommentModel;
use App\Models\TagModel;
use App\Models\BeritaTagModel;

class User extends BaseController
{
    protected $beritaModel, $tagModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->tagModel = new TagModel();
    }

    public function index()
    {
        helper('text');

        $beritaList = $this->beritaModel
            ->orderBy('created_at', 'DESC')
            ->paginate(5, 'berita');

        // Konversi ke array
        $beritaList = json_decode(json_encode($beritaList), true);

        $beritaTagModel = new BeritaTagModel();

        // Tambahkan tags
        foreach ($beritaList as &$berita) {
            $tagIds = $beritaTagModel->where('berita_id', $berita['id'])->findColumn('tag_id');
            $tags = !empty($tagIds) ? $this->tagModel->whereIn('id', $tagIds)->findAll() : [];
            $berita['tags'] = $tags;
        }

        $data = [
            'title'  => 'Beranda',
            'berita' => $beritaList,
            'pager'  => $this->beritaModel->pager,
            'tags'   => $this->tagModel->findAll(),
        ];

        return view('user/layout/header', $data)
            . view('user/beranda/home', $data)
            . view('user/layout/footer');
    }

    public function search()
    {
        helper('text');

        $query = $this->request->getGet('q');

        // Ambil berita berdasarkan slug (judul, karena slug biasanya dari judul)
        $beritaByJudul = $this->beritaModel
            ->like('slug', $query)
            ->findAll(null, true); // hasil array

        // Ambil berita berdasarkan tag
        $beritaByTag = $this->beritaModel
            ->join('berita_tags', 'berita_tags.berita_id = berita.id')
            ->join('tags', 'tags.id = berita_tags.tag_id')
            ->like('tags.nama_tag', $query)
            ->select('berita.*')
            ->groupBy('berita.id')
            ->findAll(null, true); // hasil array

        // Gabungkan dan hilangkan duplikat berdasarkan ID
        $gabungan = array_merge($beritaByJudul, $beritaByTag);
        $seen = [];
        $beritaGabungan = [];

        foreach ($gabungan as $b) {
            if (!in_array($b['id'], $seen)) {
                $seen[] = $b['id'];
                $beritaGabungan[] = $b;
            }
        }

        // Tambahkan tags ke setiap berita
        $beritaTagModel = new BeritaTagModel();
        foreach ($beritaGabungan as &$b) {
            $tagIds = $beritaTagModel->where('berita_id', $b['id'])->findColumn('tag_id');
            $tags = !empty($tagIds) ? $this->tagModel->whereIn('id', $tagIds)->findAll() : [];
            $b['tags'] = $tags;
        }

        return view('user/beranda/home', [
            'title' => 'Hasil pencarian: ' . esc($query),
            'berita' => $beritaGabungan,
            'pager'  => $this->beritaModel->pager,
            'tags' => $this->tagModel->findAll()
        ]);
    }

    public function detail($slug)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $berita = $this->beritaModel->where('slug', $slug)->first();
        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Berita tidak ditemukan.");
        }

        $commentModel = new CommentModel();
        $komentar = $commentModel->getKomentarByBerita($berita['id']);

        $data = [
            'title' => $berita['title'],
            'berita' => $berita,
            'komentar' => $komentar
        ];

        return view('user/layout/headerH', $data)
            . view('user/beranda/detail', $data)
            . view('user/layout/footer');
    }

    public function submitKomentar()
    {
        $commentModel = new CommentModel();

        $commentModel->save([
            'berita_id' => $this->request->getPost('berita_id'),
            'user_id'   => session()->get('id'),
            'komentar'  => $this->request->getPost('komentar'),
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim.');
    }

    public function filterByTag($slug)
    {
        helper('text');

        $tag = $this->tagModel->where('slug', $slug)->first();

        if (!$tag) {
            return redirect()->to('/user');
        }

        $beritaTagModel = new BeritaTagModel();
        $beritaIds = $beritaTagModel
            ->where('tag_id', $tag['id'])
            ->findColumn('berita_id');

        $beritaList = $this->beritaModel
            ->whereIn('id', $beritaIds)
            ->orderBy('created_at', 'DESC')
            ->findAll(null, true); // hasil array

        // Tambahkan tags ke setiap berita
        foreach ($beritaList as &$berita) {
            $tagIds = $beritaTagModel->where('berita_id', $berita['id'])->findColumn('tag_id');
            $tags = !empty($tagIds) ? $this->tagModel->whereIn('id', $tagIds)->findAll() : [];
            $berita['tags'] = $tags;
        }

        return view('user/beranda/home', [
            'title' => 'Berita dengan Tag: ' . $tag['nama_tag'],
            'berita' => $beritaList,
            'pager'  => $this->beritaModel->pager,
            'tags' => $this->tagModel->findAll()
        ]);
    }
}
