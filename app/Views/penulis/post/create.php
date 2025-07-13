<?= $this->include('penulis/layout/header') ?>

<h2>Tulis Artikel Baru</h2>

<form action="<?= base_url('penulis/store') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?> <!-- CSRF token untuk keamanan -->

    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Tag Berita</label>
        <select name="tags[]" id="tags" class="form-control" multiple>
            <?php foreach ($tags as $tag): ?>
                <option value="<?= esc($tag['nama_tag']) ?>"><?= esc($tag['nama_tag']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
        <div class="form-group mt-3">
        <label for="tags_baru">Tambahkan Tag Baru (pisahkan dengan koma):</label>
        <input type="text" name="tags_baru" id="tags_baru" class="form-control" placeholder="contoh: sains, lingkungan">
    </div>

    <div class="mb-3">
        <label>Gambar Utama</label>
        <input type="file" name="featured_image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Konten</label>
        <textarea name="content" id="editor" class="form-control" rows="10" required></textarea>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= base_url('penulis') ?>" class="btn btn-secondary">Kembali</a>
</form>

<!-- CKEditor -->
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log('Editor siap digunakan', editor);
        })
        .catch(error => {
            console.error('CKEditor gagal dimuat:', error);
        });
</script>

<!-- Select2 untuk tag -->
<script>
    $(document).ready(function () {
        $('#tags').select2({
            tags: true,
            placeholder: 'Pilih atau buat tag (maksimal 3)',
            maximumSelectionLength: 3,
            tokenSeparators: [',', ' ']
        });
    });
</script>

<?= $this->include('penulis/layout/footer') ?>
