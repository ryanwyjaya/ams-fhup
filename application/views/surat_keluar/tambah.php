<?= $this->session->flashdata('message'); ?>
<div class="box">
	<div class="box-header bg-info"></div>
	<div class="box-body">
		<?= form_open_multipart('surat_keluar/tambah') ?>
		<div class="row">
		
			<div class="col-sm-4">
				<?php 
				$a = $this->db->count_all_results('surat_keluar');
				  ?>
				<label><b class="text-uppercase">No surat</b></label>
				<input type="text" class="form-control" name="no_surat" required>
				<label style="margin-top: 10px;"><b class="text-uppercase">tujuan surat</b></label>
				<input type="text" class="form-control" name="tujuan_surat" required>
				<label style="margin-top: 10px;"><b class="text-uppercase">asal surat</b></label>
				<input type="text" class="form-control" name="asal_surat" required>
				<div class="custom-file form-control" style="margin-top: 10px;">
  			<input type="file" class="custom-file-input" id="customFile" name="file">
  			<label style="margin-top: 10px;" class="custom-file-label" for="customFile">Silahkan Upload File / Scan Surat Disini.</label>
				</div>
			</div>
			<div class="col-sm-4">
				<label><b class="text-uppercase">Perihal</b></label>
				<input type="text" class="form-control" name="perihal" required>
				<label style="margin-top: 10px;"><b class="text-uppercase">jenis surat</b></label>
				<input type="text" class="form-control" name="jenis_surat" value="Baru" readonly>
				<label style="margin-top: 10px;"><b class="text-uppercase">tanggal dibuat</b></label>
				<input type="date" class="form-control" name="tanggal_dibuat" value="<?= date('Y-m-d'); ?>">
				<label style="margin-top: 10px;"><b class="text-uppercase">No Agenda</b></label>
				<input type="number" class="form-control" name="no_agenda" value="<?= $a+1; ?>">
			</div>
			<div class="col-sm-4">
				<label><b class="text-uppercase">tanggal surat</b></label>
				<input type="date" class="form-control" name="tanggal_surat" required>
				<label style="margin-top: 10px;"><b class="text-uppercase">pemohon</b></label>
				<input type="text" class="form-control" name="pemohon" required>
				<label style="margin-top: 10px;"><b class="text-uppercase">alamat pemohon</b></label>
				<input type="text" class="form-control" name="alamat">
				<label style="margin-top: 10px;"><b class="text-uppercase">Sifat</b></label>
					 <select class="form-control" name="sifat">
					 	<option>Pilih</option>
					 	<option value="Terbuka">Terbuka</option>
					 	<option value="Segera">Segera</option>
					 	<option value="Rahasia">Rahasia</option>
					 	<option value="Biasa">Biasa</option>
					 </select>
			</div>
			<div class="col-sm-12" style="margin-top: 10px;" align="center">
				<label><b class="text-uppercase">ISI SURAT KELUAR</b></label>
				<textarea id="ckeditor" class="ckeditor" name="isi"></textarea>
			</div>

			<div class="col-sm-12" style="margin-top: 30px;">
				<a class="btn btn-danger" href="<?= base_url('surat_keluar'); ?>"><strong class="text-white"><i class="fa fa-arrow-left text-white"></i> Kembali</strong></a>
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