<?= $this->session->flashdata('message'); ?>
<?php 
$sc = $this->db->get('site_config')->row_array();
  ?>
<div class="box">
	<div class="box-header bg-info"></div>
	<div class="box-body">
		<?= form_open_multipart('site_config/update') ?>
		
			<div class="row">
				<div class="col-sm-12">
				<div class="form-group">
				<input type="hidden" name="id" value="<?= $sc['id']; ?>">
				<label><b class="text-primary">Nama Website</b></label>
				<input type="text" name="site_name" class="form-control border-primary" value="<?= $sc['site_name']; ?>">
				</div>	
				</div>

				<div class="col-sm-6">
				<div class="form-group">
					<label><b class="text-primary">Alamat</b></label>
					<textarea class="ckeditor" id="ckeditor" name="alamat">
						<?= $sc['alamat']; ?>
					</textarea>
				</div>
				</div>
				<div class="col-sm-6">
					<label><b class="text-primary">Logo</b></label><br>
					<img width="300" height="300" src="<?= base_url('assets/img/logo/') . $sc['logo'];  ?> " class="img-thumbnail">
					<div class="custom-file">
  					<input name="logo" type="file" class="custom-file-input" id="customFile">
  					<label class="custom-file-label" for="customFile">Pilih Choose file Untuk Merubah Logo</label>
					</div>
				</div>
				<div class="col-sm-12">
					<label><b class="text-primary">Header</b></label>
					<textarea class="ckeditor" id="ckeditor" name="header">
						<?= $sc['header']; ?>
					</textarea>
				</div>

				<div class="col-sm-12" style="margin-top: 10px;">
					<div class="form-group">
						<button class="btn btn-md btn-primary btn-block" type="submit"><strong class="text-white"><i class="fa fa-edit text-white"></i> Simpan</strong></button>
					</div>
				</div>
				
			</div>
			
		<?= form_close() ?>
	</div>
</div>