<?= $this->session->flashdata('message'); ?>
<div class="box">
	<div class="box-header bg-info"></div>
	<div class="box-body">
		<div class="table-responsive">
		<table class="table table-sm table-hover table-bordered" id="dataCrud">
			<thead class="alert-primary">
				<th width="1px">No</th>
				<th>No Surat</th>
                <th>Asal Surat</th>
                <th>Tujuan Surat</th>
                <th>Tanggal Disposisi</th>
                <th>Isi Disposisi</th>
                <th>Dikembalikan Ke</th>
                <th>Tindakan</th>
                <th>Status</th>
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
            <form action="<?= base_url('inbox/delete_dispo'); ?>" method="post">
                <div class="modal-body">
                    <h4><b class="text-uppercase">Apakah anda yakin ingin menghapus data ini?</b></h4>
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
        <!-- modal hapus datatables -->

            <div class="modal fade" id="setuju" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="false">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
            <form action="<?= base_url('inbox/setujui'); ?>" method="post">
                <div class="modal-body">
                    <h4><b class="text-uppercase">Apakah anda yakin ingin Mensetujui disposisi ini?</b></h4>
                    <input type="hidden" name="id" id="id">
                    <label style="margin-top: 10px;"><b>Status Tindakan Disposisi</b></label>
                <select class="form-control" name="tindakan">
                    <option value="Arsip Saja">Arsip Saja</option>
                    <option value="Ditindak Lanjuti Saja">Ditindak Lanjuti Saja</option>
                    <option value="Ditindak Lanjuti & Arsipkan">Ditindak Lanjuti & Arsipkan</option>
                </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Setuju</button>
                </div>
            </form>
        </div>
        </div>
        </div>

