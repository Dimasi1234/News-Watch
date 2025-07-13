<?= $this->include('user/layout/header') ?>

<!-- Page content -->
<div class="container">
    <div class="row">
        <!-- Blog entries -->
        <div class="col-lg-8">
            <h4>Berita dengan tag: <strong><?= esc($tag_name) ?></strong></h4>
            <hr>

            <?php if (!empty($berita)): ?>
                <?php foreach ($berita as $index => $item): ?>
                    <?php if ($index === 0): ?>
                        <div class="card mb-4">
                            <a href="<?= session()->has('isLoggedIn') ? base_url('/berita/' . $item['slug']) : base_url('/login') ?>">
                                <img class="card-img-top" src="<?= base_url('uploads/images/' . $item['featured_image']) ?>" alt="..." />
                            </a>
                            <div class="card-body">
                                <div class="small text-muted"><?= date('F j, Y', strtotime($item['created_at'])) ?></div>
                                <?php if (!empty($item['tags'])): ?>
                                    <div class="mb-2">
                                        <?php foreach ($item['tags'] as $tag): ?>
                                            <a href="<?= base_url('/user/tag/' . $tag['slug']) ?>" class="badge bg-secondary"><?= esc($tag['nama_tag']) ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <h2 class="card-title"><?= $item['title'] ?></h2>
                                <p class="card-text"><?= word_limiter($item['content'], 30) ?></p>
                                <a class="btn btn-primary" href="<?= session()->has('isLoggedIn') ? base_url('/berita/' . $item['slug']) : base_url('/login') ?>">Read more →</a>
                            </div>
                        </div>
                        <div class="row">
                    <?php else: ?>
                        <div class="col-lg-6 d-flex">
                            <div class="card mb-4 flex-fill d-flex flex-column">
                                <a href="<?= session()->has('isLoggedIn') ? base_url('/berita/' . $item['slug']) : base_url('/login') ?>">
                                    <img class="card-img-top" src="<?= base_url('uploads/images/' . $item['featured_image']) ?>" alt="..." />
                                </a>
                                <div class="card-body">
                                    <div class="small text-muted"><?= date('F j, Y', strtotime($item['created_at'])) ?></div>
                                    <?php if (!empty($item['tags'])): ?>
                                        <div class="mb-2">
                                            <?php foreach ($item['tags'] as $tag): ?>
                                                <a href="<?= base_url('/user/tag/' . $tag['slug']) ?>" class="badge bg-secondary"><?= esc($tag['nama_tag']) ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <h2 class="card-title h4"><?= $item['title'] ?></h2>
                                    <p class="card-text"><?= word_limiter($item['content'], 20) ?></p>
                                    <a class="btn btn-primary" href="<?= session()->has('isLoggedIn') ? base_url('/berita/' . $item['slug']) : base_url('/login') ?>">Read more →</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                        </div>
            <?php else: ?>
                <p><em>Belum ada berita dengan tag ini.</em></p>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Search -->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <form action="<?= base_url('/user/search') ?>" method="get" class="input-group">
                        <input class="form-control" name="q" type="text" placeholder="Cari berita..." required />
                        <button class="btn btn-primary" type="submit">
                            Search <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tags -->
            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2" style="max-height: 5rem; overflow: hidden;">
                        <?php if (!empty($tags)): ?>
                            <?php foreach ($tags as $t): ?>
                                <li><a href="<?= base_url('/user/tag/' . $t['slug']) ?>"><?= esc($t['nama_tag']) ?></a></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><em>Tidak ada tag tersedia.</em></li>
                        <?php endif; ?>
                    </div>
                    <div class="mt-2">
                        <a href="<?= base_url('/user/tags') ?>" class="btn btn-sm btn-outline-secondary">Lihat semua tag</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('user/layout/footer') ?>
