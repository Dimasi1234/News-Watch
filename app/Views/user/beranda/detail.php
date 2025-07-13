<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?= esc($berita['title']) ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on <?= date('F j, Y', strtotime($berita['created_at'])) ?><?= isset($berita['author']) ? ' by ' . esc($berita['author']) : '' ?></div>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4">
                    <img class="img-fluid rounded" src="<?= base_url('uploads/images/' . $berita['featured_image']) ?>" alt="..." />
                </figure>
                <!-- Post content-->
                <section class="mb-5">
                    <?= $berita['content'] ?>
                </section>
            </article>

            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form action="<?= base_url('/komentar/simpan') ?>" method="post" class="mb-4">
                            <?= csrf_field() ?>
                            <input type="hidden" name="berita_id" value="<?= $berita['id'] ?>">
                            <textarea name="komentar" class="form-control mb-2" rows="3" placeholder="Tulis komentar..." required></textarea>
                            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                        </form>

                        <!-- Tampilkan komentar -->
                        <?php if (!empty($komentar)): ?>
                            <?php foreach ($komentar as $komen): ?>
                                <div class="d-flex mb-4">
                                    <div class="flex-shrink-0">
                                        <img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." />
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-bold"><?= esc($komen['username'] ?? 'Anonim') ?></div>
                                        <?= esc($komen['komentar']) ?>
                                        <div class="text-muted small"><?= $komen['created_at'] ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Belum ada komentar.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
