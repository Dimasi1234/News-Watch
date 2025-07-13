<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <?php if (isset($query)): ?>
                <h4>Hasil pencarian untuk: <strong><?= esc($query) ?></strong></h4>
                <hr>
            <?php endif; ?>

            <?php if (!empty($berita)): ?>
                <div class="featured-post">
                    <?php $item = $berita[0]; ?>
                    <div class="card mb-4">
                        <a href="<?= session()->has('isLoggedIn') ? base_url('/berita/' . $item['slug']) : base_url('/login') ?>">
                            <img class="card-img-top" src="<?= base_url('uploads/images/' . $item['featured_image']) ?>" alt="..." />
                        </a>
                        <div class="card-body">
                            <div class="small text-muted"><?= date('F j, Y', strtotime($item['created_at'])) ?></div>
                            <?php if (!empty($item['tags'])): ?>
                                <div class="mb-2">
                                    <?php foreach ($item['tags'] as $tag): ?>
                                        <a href="<?= base_url('/user/tag/' . $tag['slug']) ?>" class="badge bg-secondary text-decoration-none"><?= esc($tag['nama_tag']) ?></a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <h2 class="card-title"><?= $item['title'] ?></h2>
                            <p class="card-text"><?= word_limiter($item['content'], 30) ?></p>
                            <a class="btn btn-primary" href="<?= session()->has('isLoggedIn') ? base_url('/berita/' . $item['slug']) : base_url('/login') ?>">Read more →</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php foreach (array_slice($berita, 1) as $item): ?>
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
                                                <a href="<?= base_url('/user/tag/' . $tag['slug']) ?>" class="badge bg-secondary text-decoration-none"><?= esc($tag['nama_tag']) ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <h2 class="card-title h4"><?= $item['title'] ?></h2>
                                    <p class="card-text"><?= word_limiter($item['content'], 20) ?></p>
                                    <a class="btn btn-primary" href="<?= session()->has('isLoggedIn') ? base_url('/berita/' . $item['slug']) : base_url('/login') ?>">Read more →</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Tidak ada berita untuk ditampilkan.</p>
            <?php endif; ?>

            <!-- Pagination -->
            <?php if (isset($pager) && $pager !== null): ?>
                <div class="d-flex justify-content-center">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Search widget -->
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

            <!-- Categories Widget (TAG) -->
            <div class="card my-4">
                <h5 class="card-header">Categories</h5>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2" style="max-height: 5rem; overflow: hidden;">
                        <?php if (!empty($tags)): ?>
                            <?php foreach ($tags as $tag): ?>
                                <li>
                                    <a href="<?= base_url('/user/tag/' . $tag['slug']) ?>">
                                        <?= esc($tag['nama_tag']) ?>
                                    </a>
                                </li>
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
    </div> <!-- End .row -->
</div>
