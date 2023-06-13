
    <div class="row">

        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image'];  ?> " class="img-thumbnail"></div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?> </h5>
                    <p class="card-text"><?= $user['email']; ?>.</p>
                    <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $user['date_created']);  ?> </small></p>
                    
                </div>
            </div>
        </div>
    </div>

