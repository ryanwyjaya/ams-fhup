<div class="box">
	<div class="box-header bg-info"></div>
	<?= $this->session->flashdata('message'); ?>
	<div class="box-body">
		<?= form_open_multipart('surat_masuk/tambah') ?>
		
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<?php 
					$no = $this->db->count_all_results('surat_masuk');
					  ?>
					<label><b>No Surat</b></label>
					<input type="text" name="no_surat" class="form-control" required>
					<label style="margin-top: 10px;"><b class="text-uppercase">No Agenda</b></label>
				<input type="number" class="form-control" name="no_agenda" value="<?= $no+1; ?>">
					<label style="margin-top: 10px;"><b>Perihal</b></label>
					<input type="text" name="perihal" class="form-control" required>
					<label style="margin-top: 10px;"><b>Tanggal Surat</b></label>
					<input type="date" name="tanggal_surat" class="form-control" required>
					<label style="margin-top: 10px;"><b>Tujuan Surat</b></label>
					<?php 
					$id = 1;
					// $id2 = 4 ;
					$role = $this->db->where('id !=',$id);
					// $role = $this->db->where('id !=',$id2);
					$role = $this->db->get('user_role')->result_array();
					  ?>
					 <select class="form-control js-example-basic-single" name="tujuan_surat" selected>
					 	<option>Pilih</option>
					 	<?php foreach ($role as $key => $value): ?>
					 	<option value="<?= $value['id']; ?>"><?= $value['role']; ?></option>	
					 	<?php endforeach ?>
					 	
					 </select>
					 <label style="margin-top: 10px;"><b>Sifat</b></label>
					 <select class="form-control" name="sifat">
					 	<option>Pilih</option>
					 	<option value="Terbuka">Terbuka</option>
					 	<option value="Segera">Segera</option>
					 	<option value="Rahasia">Rahasia</option>
					 	<option value="Biasa">Biasa</option>
					 </select>
				</div>
				<div class="custom-file form-control">
  			<input type="file" class="custom-file-input" id="customFile" name="file">
  			<label style="margin-top: 10px;" class="custom-file-label" for="customFile">Silahkan Upload File / Scan Surat Disini.</label>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label><b>Asal Surat</b></label>
					<input type="text" name="asal_surat" class="form-control">
					<label style="margin-top: 10px;"><b>Tanggal Diterima</b></label>
					<input type="date" name="tanggal_diterima" class="form-control" value="<?= date('Y-m-d'); ?>">
					<label style="margin-top: 10px;"><b>Nama Pengirim</b></label>
					<input type="text" name="nama_pengirim" class="form-control">
					<label style="margin-top: 10px;"><b>Alamat Pengirim</b></label>
					<textarea class="form-control" name="alamat_pengirim"></textarea>
					<label style="margin-top: 10px;"><b>Isi Surat</b></label>
					<textarea id="ckeditor" class="ckeditor" name="isi_surat"></textarea>
				</div>
			</div>
			<div class="col-sm-12" style="margin-top: 30px;">
				<a class="btn btn-danger" href="<?= base_url('surat_masuk'); ?>"><strong class="text-white"><i class="fa fa-arrow-left text-white"></i> Kembali</strong></a>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
  				<i class="fa fa-edit"></i> SIMPAN
				</button>
				<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Anda Yakin Ingin Menambah Data?</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>

			</div>
		</div>
		           
		<?= form_close() ?>
	</div>
</div>