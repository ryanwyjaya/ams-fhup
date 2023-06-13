<?= $this->session->flashdata('message'); ?>
<div class="box">
	<div class="box-header bg-info"></div>
	<div class="box-body">
		<div class="table-responsive">
		<table class="table table-sm table-hover table-bordered" id="dataCrud">
			<thead class="alert-primary">
				<th width="1px">No</th>
				<th>No Surat</th>
        <th>Perihal</th>
        <th>Sifat</th>
        <th>Tanggal Surat</th>
        <th>Tujuan Surat</th>
        <th>Asal Surat</th>
        <th>Isi Surat</th>
        <th>Tanggal Diterima</th>
        <th>Total Disposisi</th>
				<th>Action</th>
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
            <div class="modal-header badge-dark">
                <h5 class="modal-title">Hapus <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('surat_masuk/delete'); ?>" method="post">
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus data ini?
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

