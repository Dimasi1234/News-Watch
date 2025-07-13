<?= $this->include('admin/layout/header') ?>
                    
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah User</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <h4><?= $jumlah_user ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Jumlah Penulis</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <h4><?= $jumlah_penulis ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Jumlah Buku</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <h4><?= $jumlah_berita ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Daftar Berita
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Penulis</th>
                                            <th>Judul Berita</th>
                                            <th>Tanggal Publikasi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Penulis</th>
                                            <th>Judul Berita</th>
                                            <th>Tanggal Publikasi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($beritaList as $berita): ?>
                                        <tr>
                                            <td><?= esc($berita['nama_penulis']) ?></td>
                                            <td><?= esc($berita['title']) ?></td>
                                            <td><?= date('d-m-Y', strtotime($berita['created_at'])) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
<?= $this->include('admin/layout/footer') ?>