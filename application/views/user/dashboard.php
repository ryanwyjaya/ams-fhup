<?php 
$disposisi =$this->db->count_all_results('disposisi');
$surat_masuk =$this->db->count_all_results('surat_masuk');
$surat_keluar =$this->db->count_all_results('surat_keluar');
  ?>
<?php if ($user['role_id']==4): ?>
  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?= $surat_masuk; ?></h3>

              <h4>SURAT MASUK</h4>
            </div>
            <div class="icon">
              <i class="ti-email"></i>
            </div>
            <a href="<?= base_url('surat_masuk'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
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
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $surat_keluar; ?></h3>

              <h4>SURAT KELUAR</h4>
            </div>
            <div class="icon">
              <i class="ti-email"></i>
            </div>
            <a href="<?= base_url('surat_keluar'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
<?php else: ?>

  <?php
  $id = $user['role_id'];
  $sm = $this->db->where('tujuan_surat',$id); 
  $sm = $this->db->count_all_results('surat_masuk');
  $ds = $this->db->where('tujuan',$id); 
  $ds = $this->db->count_all_results('disposisi');
    ?>
  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $sm; ?></h3>

              <h4>SURAT MASUK</h4>
            </div>
            <div class="icon">
              <i class="ti-email"></i>
            </div>
            <a href="<?= base_url('inbox'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $ds; ?></h3>

              <h4>DISPOSISI</h4>
            </div>
            <div class="icon">
              <i class="fa fa-send"></i>
            </div>
            <a href="<?= base_url('inbox/disposisi'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

<?php endif ?>
