<?= $this->session->flashdata('message'); ?>
<div class="box">
	<div class="box-header"></div>
	<div class="box-body">
		
		<a style="margin-bottom: 10px;" class="btn btn-primary" href="<?= base_url('surat_keluar/tambah'); ?>"><strong class="text-white"><i class="fa fa-edit text-white"></i> Tambah Surat</strong></a>
		<div class="table-responsive">
		<table class="table table-sm table-hover table-bordered" id="dataCrud">
			<thead>
				<th class="text-uppercase">no agenda</th>
				<th class="text-uppercase">no surat</th>
				<th class="text-uppercase">sifat</th>
				<th class="text-uppercase">perihal</th>
				<th class="text-uppercase">tanggal surat</th>
				<th class="text-uppercase">tujuan surat</th>
				<th class="text-uppercase">asal surat</th>
				<th class="text-uppercase">isi</th>
				<th class="text-uppercase">jenis surat</th>
				<th class="text-uppercase">tanggal dibuat</th>
				<th class="text-uppercase">action</th>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		</div>
		
	</div>
</div>

<!-- modal hapus datatables -->

            <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
            <form action="<?= base_url('surat_keluar/delete'); ?>" method="post">
                <div class="modal-body">
                    <h3><b class="text-uppercase">Apakah anda yakin ingin menghapus data ini?</b></h3>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Yakin</button>
                </div>
            </form>
        </div>
        </div>
        </div>