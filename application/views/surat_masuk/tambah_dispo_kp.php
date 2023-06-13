<div class="box">
	<div class="box-header bg-info"></div>
	<div class="box-body">
	<div class="row">
		<form action="<?= base_url('surat_masuk/proses_dispo_kp'); ?>" method="post">
			<?php 
			$role = $this->db->get('user_role')->result_array();
			  ?>

			 <?php 
			$id = $edit['tujuan_surat'];
			$role2 = $this->db->where('id',$id);
			$role2 = $this->db->get('user_role')->row_array();
			  ?>
		<div class="col-sm-6">
			<div class="form-group">
				<input type="hidden" name="id_surat_masuk" value="<?= $edit['id']; ?>">
				

				<label><b>No Agenda</b></label>
				<input type="text" name="" class="form-control" value="<?= $edit['no_agenda']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Surat Dari</b></label>
				<input type="text" name="" class="form-control" value="<?= $edit['asal_surat']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Tujuan Surat</b></label>
				<input type="text" name="" class="form-control" value="<?= $role2['role']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Tanggal Surat</b></label>
				<input type="date" name="" class="form-control" value="<?= $edit['tanggal_surat']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Perihal</b></label>
				<input type="text" name="" class="form-control" value="<?= $edit['perihal']; ?>" readonly>
				<label style="margin-top: 10px;"><b>Setelah Digunakan Dikembalikan Ke</b></label>
				<input type="text" name="dikembalikan" class="form-control" value="Bagian Umum dan Tata Usaha" readonly>
				<label style="margin-top: 10px;"><b>Tanggal Disposisi</b></label>
				<input type="date" name="tanggal_disposisi" class="form-control" value="<?= date('Y-m-d'); ?>">
				<input type="hidden" name="tindakan" value="Isi">
			</div>
			<div class="form-group">
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
		<div class="col-sm-6">
			<div class="form-group">
				<label><b>Tujuan Disposisi</b></label>
				<select class="form-control js-example-basic-single" name="tujuan">
					<?php foreach ($role as $key => $value): ?>
						<?php if ($value['id']==1): ?>
						<option value="<?= $value['id']; ?>"><?= $value['role']; ?></option>
							<?php else: ?>
								
						<?php endif ?>
						
					<?php endforeach ?>
					
				</select>
			</div>
			<div class="form-group">
				<label><b>Isi Disposisi</b></label>
				<textarea id="ckeditor" class="ckeditor" name="isi"></textarea>
			</div>
		</div>


		</form>
	</div>		
	</div>
</div>