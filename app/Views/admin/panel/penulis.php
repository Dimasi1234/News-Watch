<?= $this->include('admin/layout/header') ?>

<h1 class="h3 mb-3">Daftar Penulis</h1>

<!-- Tombol Tambah Akun -->
<a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPenulis">+ Tambah akun</a>

<!-- Tabel Penulis -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($penulis as $p): ?>
            <tr>
                <td><?= esc($p['username']) ?></td>
                <td><?= esc($p['email']) ?></td>
                <td>
                    <a href="<?= base_url('admin/lihat_penulis/' . $p['id']) ?>" class="btn btn-info btn-sm">Lihat</a>
                    <a href="<?= base_url('admin/hapus_akun/' . $p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus akun ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal Tambah Penulis -->
<div class="modal fade" id="modalTambahPenulis" tabindex="-1" aria-labelledby="modalTambahPenulisLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/tambah_penulis') ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahPenulisLabel">Tambah Akun Penulis</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?= $this->include('admin/layout/footer') ?>