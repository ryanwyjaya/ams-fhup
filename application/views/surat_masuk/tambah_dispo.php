<div class="box">
	<div class="box-header bg-info"></div>
	<div class="box-body">
	<div class="row">
		<form action="<?= base_url('surat_masuk/proses_dispo'); ?>" method="post">
			<?php 
			$id = $edit['tujuan_surat'];
			$role = $this->db->where('id',$id);
			$role = $this->db->get('user_role')->row_array();
			  ?>
		<div class="col-sm-6">
			<div class="form-group">
				<input type="hidden" name="id_surat_masuk" value="<?= $edit['id']; ?>">
				<input type="hidden" name="tujuan" value="<?= $role['id']; ?>">

				<label><b>No Agenda</b></label>
				<input type="text" name="" class="form-control" value="<?= $edit['no_agenda']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Surat Dari</b></label>
				<input type="text" name="" class="form-control" value="<?= $edit['asal_surat']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Disposisi Oleh</b></label>
				<input type="text" name="track" class="form-control" value="<?= $role['role']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Tanggal Surat</b></label>
				<input type="date" name="" class="form-control" value="<?= $edit['tanggal_surat']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Perihal</b></label>
				<input type="text" name="" class="form-control" value="<?= $edit['perihal']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Setelah Digunakan Dikembalikan Ke</b></label>
				<input type="text" name="dikembalikan" class="form-control" value="BAGIAN UMUM DAN TATA USAHA" readonly>
				<label style="margin-top: 10px;"><b>Tanggal Disposisi</b></label>
				<input type="date" name="tanggal_disposisi" class="form-control" value="<?= date('Y-m-d'); ?>">
				<label style="margin-top: 10px;"><b>Status Tindakan Disposisi</b></label>
				<select class="form-control" name="tindakan">
					<option value="Arsip Saja">Arsip Saja</option>
					<option value="Ditindak Lanjuti Saja">Ditindak Lanjuti Saja</option>
					<option value="Ditindak Lanjuti & Arsipkan">Ditindak Lanjuti & Arsipkan</option>
				</select>
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
			</div>					 
			<div class="form-group">
				<a class="btn btn-danger" href="<?= base_url('inbox'); ?>"><strong class="text-white"><i class="fa fa-arrow-left text-white"></i> Kembali</strong></a>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
  				<i class="fa fa-edit"></i> SIMPAN
				</button>
				<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title font-weight-bold" id="exampleModalLabel">Anda Yakin Ingin Menambah Data?</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="false">&times;</span>
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
		<div class="col-sm-6">
			<div class="form-group">
				<label><b>Isi Disposisi</b></label>
				<textarea id="ckeditor" class="ckeditor" name="isi"></textarea>
			</div>
		</div>


		</form>
	</div>		
	</div>
</div>