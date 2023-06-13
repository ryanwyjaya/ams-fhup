
  <?php 
    $disposisi =$this->db->count_all_results('disposisi');
    $surat_masuk =$this->db->count_all_results('surat_masuk');
    $surat_keluar =$this->db->count_all_results('surat_keluar');
    $user =$this->db->count_all_results('user');
  ?>

    <div class="pad margin no-print">
      <div class="callout callout-warning" style="margin-bottom: 0!important; font-size: 25px;">
       <marquee><b>SELAMAT DATANG, DI SISTEM INFORMASI APLIKASI SISMADIP </b></marquee>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?= $disposisi; ?></h3>

              <h4>DISPOSISI</h4>
            </div>
            <div class="icon">
              <i class="fa fa-send"></i>
            </div>
            <a href="<?= base_url('disposisi'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $surat_masuk; ?></h3>

              <h4>SURAT MASUK</h4>
            </div>
            <div class="icon">
              <i class="fa fa-send"></i>
            </div>
            <a href="<?= base_url('surat_masuk'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $surat_keluar; ?></h3>

              <h4>SURAT KELUAR</h4>
            </div>
            <div class="icon">
              <i class="fa fa-send"></i>
            </div>
            <a href="<?= base_url('surat_keluar'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $user; ?></h3>

              <h4>ROLE DATA</h4>
            </div>
            <div class="icon">
              <i class="fa fa-send"></i>
            </div>
            <a href="<?= base_url('admin/role'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
