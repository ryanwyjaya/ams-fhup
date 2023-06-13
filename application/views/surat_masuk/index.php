<?= $this->session->flashdata('message'); ?>
<div class="box">
	<div class="box-header bg-info"></div>
	<div class="box-body">
		
			<a href="<?= base_url('surat_masuk/tambah'); ?>" style="margin-bottom: 10px;" class="btn btn-primary"><strong class="text-white"><i class="fa fa-edit text-white"></i> Tambah</strong></a>
            <div class="table-responsive">
		<table class="table table-sm table-hover table-bordered" id="dataCrud">
			<thead class="alert-primary">
				<th width="1px">No Agenda</th>
				<th>No Surat</th>
        <th>Perihal</th>
        <th>Sifat</th>
        <th>Tanggal Surat</th>
        <th>Tujuan Surat</th>
        <th>Asal Surat</th>
        <th>Isi Surat</th>
        <th>Tanggal Diterima</th>
        <th>Total Disposisi</th>
        <th>Arsip</th>
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
            <form action="<?= base_url('surat_masuk/delete'); ?>" method="post">
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

<!-- modal akses open datatables -->

            <div class="modal fade" id="at" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">AKSES ARSIP DIGITAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('surat_masuk/akses_open'); ?>" method="post">
                <div class="modal-body">
                    <h4>APAKAH INGIN MENGARSIPKAN KE ARSIP DIGITAL?</h4>
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
<!-- modal akses tutup datatables -->

            <div class="modal fade" id="ay" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">AKSES ARSIP DIGITAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('surat_masuk/akses_tutup'); ?>" method="post">
                <div class="modal-body">
                    <h4>APAKAH INGIN MENUTUP DARI ARSIP DIGITAL?</h4>
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
