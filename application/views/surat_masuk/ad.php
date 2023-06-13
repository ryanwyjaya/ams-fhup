<div class="box">
	<div class="box-header bg-info"></div>
	
	<div class="box-body">
	<h3 align="center"><b class="text-primary">Arsip Digital <?= $title; ?></b></h3>
	 <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif;  ?>

            <form action="<?= base_url('surat_masuk/ad'); ?>" method="post">
            <div class="input-group col-sm-12">
            <input type="text" class="form-control" placeholder="Search Keyword" name="keyword">
            <div class="input-group-append">
             <input class="btn btn-info btn-sm btn-flat" type="submit" id="button-addon2" autocomplete="off" autofocus name="submit"></input>
            </div>

            </div>
            </form>

            <?= $this->session->flashdata('message'); ?>
           <!--  <h5>Total Rows : <?= $total_rows; ?></h5> -->
	</div>
</div>
<div class="box-group">
	<div class="row">
	<?php foreach ($sm as $key => $value): ?>
	<div class="col-sm-3">
	<div class="box-body text-center">
    <img height="100" src="<?= base_url('assets/ad.png'); ?>" class="box-img-top" alt="...">
    <div class="box-body">
    	<p class="box-text text-center"><small class="text-muted">NO SURAT <b class="text-danger"><?= $value['no_surat']; ?></b> </small></p>
    	<p class="box-text text-center"><small class="text-muted">ASAL SURAT <b class="text-danger"><?= $value['asal_surat']; ?></b> </small></p>
      <?php if (empty($value['file'])): ?>
       <p class="box-text text-center"><small class="text-muted"><a href="" class="text-danger">File Kosong</a></small></p> 
      <?php else: ?>
       <p class="box-text text-center"><small class="text-muted"><a target="_blank" href="<?= base_url('assets/upload/').$value['file']; ?>">Download File</a></small></p> 
      <?php endif ?>
    </div>
  </div>
		</div>	
	<?php endforeach ?>
	
	<?=$this->pagination->create_links();?>


	</div>
  
  
  </div>
</div>