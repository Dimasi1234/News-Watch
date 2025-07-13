<?php

namespace App\Controllers;
use App\Models\BeritaModel;
use App\Models\TagModel;
use App\Models\BeritaTagModel;

class Penulis extends BaseController
{
    protected $beritaModel, $tagModel, $beritaTagModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->tagModel = new TagModel();
        $this->beritaTagModel = new BeritaTagModel();
    }

    public function index()
    {
        $berita = $this->beritaModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('penulis/post/dashboard', [
            'title' => 'Dashboard Penulis',
            'posts' => $berita
        ]);
    }

    public function create()
    {
        $tags = $this->tagModel->findAll();
        $tagNames = $this->request->getPost('tags'); // ini isi dari <select multiple>
        $tagIds = [];

        if ($tagNames) {
            foreach ($tagNames as $name) {
                $name = trim($name);
                $existing = $this->tagModel->where('nama_tag', $name)->first();

                if ($existing) {
                    $tagIds[] = $existing['id'];
                } else {
                    $this->tagModel->insert(['nama_tag' => $name]);
                    $tagIds[] = $this->tagModel->getInsertID();
                }
            }
        }
        foreach ($tagIds as $tagId) {
            $this->beritaTagModel->insert([
                'berita_id' => $beritaId,
                'tag_id' => $tagId,
            ]);
        }

        return view('penulis/post/create', [
            'title' => 'Tulis Berita',
            'tags' => $tags
        ]);
    }

    public function store()
    {
        $judul = $this->request->getPost('title');
        $slug = url_title($judul, '-', true);
        $content = $this->request->getPost('content');
        $tagNames = $this->request->getPost('tags') ?? []; // Tag dari checkbox
        $tagsBaru = $this->request->getPost('tags_baru'); // Tag dari input teks
        $tagIds = [];
        $featuredImage = $this->request->getFile('featured_image');
        $idPenulis = session()->get('id');

        // Gabungkan tags baru ke dalam array tagNames
        if (!empty($tagsBaru)) {
            $baruArray = array_map('trim', explode(',', $tagsBaru));
            $tagNames = array_merge($tagNames, $baruArray);
        }

        // Handle upload gambar
        $imageName = null;
        if ($featuredImage && $featuredImage->isValid() && !$featuredImage->hasMoved()) {
            $imageName = $featuredImage->getRandomName();
            $featuredImage->move('uploads/images/', $imageName);
        }

        // Simpan berita terlebih dahulu
        $this->beritaModel->insert([
            'title' => $judul,
            'slug' => $slug,
            'content' => $content,
            'id_penulis' => $idPenulis,
            'featured_image' => $imageName,
        ]);
        $beritaId = $this->beritaModel->getInsertID();

        // Simpan tag ke tabel tag jika belum ada
        foreach ($tagNames as $name) {
            $name = trim($name);
            if ($name === '') continue;

            // Cek apakah tag sudah ada
            $existing = $this->tagModel->where('nama_tag', $name)->first();

            if ($existing) {
                $tagId = $existing['id'];
            } else {
                // Insert tag baru
                $slugTag = url_title($name, '-', true);
                $this->tagModel->insert([
                    'nama_tag' => $name,
                    'slug' => $slugTag
                ]);
                $tagId = $this->tagModel->getInsertID();
            }

            // Simpan relasi tag dan berita
            $this->beritaTagModel->insert([
                'berita_id' => $beritaId,
                'tag_id' => $tagId,
            ]);
        }

        return redirect()->to('/penulis')->with('success', 'Berita berhasil disimpan.');
    }

    public function edit($id)
    {
        $post = $this->beritaModel->find($id);
        $tags = $this->tagModel->findAll();
        $selectedTags = $this->beritaTagModel->where('berita_id', $id)->findColumn('tag_id');

        if (!$post) {
            return redirect()->to('/penulis');
        }

        return view('penulis/post/update', [
            'title' => 'Edit Berita',
            'post' => $post,
            'tags' => $tags,
            'selectedTags' => $selectedTags ?? []
        ]);
    }

    public function update($id)
    {
        $post = $this->beritaModel->find($id);
        $file = $this->request->getFile('featured_image');
        $filename = $post['featured_image'];
        $tagIds = $this->request->getPost('tags');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads/images/', $filename);
        }

        $this->beritaModel->update($id, [
            'title'   => $this->request->getPost('title'),
            'slug'    => url_title($this->request->getPost('title'), '-', true),
            'content' => $this->request->getPost('content'),
            'featured_image' => $filename,
        ]);

        // Update tag relasi
        $this->beritaTagModel->where('berita_id', $id)->delete();
        if (!empty($tagIds)) {
            foreach ($tagIds as $tagId) {
                $this->beritaTagModel->insert([
                    'berita_id' => $id,
                    'tag_id' => $tagId,
                ]);
            }
        }

        return redirect()->to('/penulis')->with('success', 'Berita berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->beritaModel->delete($id);
        $this->beritaTagModel->where('berita_id', $id)->delete();
        return redirect()->to('/penulis')->with('success', 'Berita berhasil dihapus.');
    }
}
