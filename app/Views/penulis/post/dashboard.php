<?= $this->include('penulis/layout/header') ?>

<h1 class="h3">Daftar Artikel</h1>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Slug</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= esc($post['title']) ?></td>
            <td><?= esc($post['slug']) ?></td>
            <td>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('penulis/edit/' . $post['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="<?= base_url('penulis/delete/' . $post['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </div>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php if (session()->get('role') === 'admin_as_penulis'): ?>
    <a href="<?= base_url('admin/kembali') ?>" class="btn btn-secondary mb-3">← Kembali sebagai Admin</a>
<?php endif; ?>


<?= $this->include('penulis/layout/footer') ?>