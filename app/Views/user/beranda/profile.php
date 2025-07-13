<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <h2 class="section-heading text-center text-uppercase text-secondary mb-0">Profil Anda</h2>
            <hr class="my-4" />

            <!-- Display User Info -->
            <div class="profile-info">
                
                <div class="mt-4">
                    <p><strong>Username:</strong> <?= esc($user['username']) ?></p>
                    <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="text-center mt-4">
                <a href="<?= base_url('/profile/logout') ?>" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>