<?= $this->session->flashdata('message'); ?>
<div class="card">
	<div class="card-header bg-gradient-dark"></div>
	<div class="card-body">
		<div class="table-responsive">
			<button class="btn btn-dark mb-3" data-toggle="modal" data-target="#add"><strong class="text-white"><i class="fa fa-edit text-white"></i> Tambah</strong></button>
		<table class="table table-sm table-hover table-bordered" id="dataCrud">
			<thead class="alert-primary">
				<th width="1px">No</th>
				<th>Name</th>
				<th>Address</th>
				<th>POS</th>
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
            <form action="<?= base_url('crud/delete'); ?>" method="post">
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

 <!-- modal add -->
 <!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-gradient-dark">
        <h5 class="modal-title font-weight-bold text-white" id="exampleModalLabel">Tambah <?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('crud'); ?>" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label><b class="text-primary">Name</b></label>
        	<input type="text" name="name" class="form-control border-left-dark">
        	<label class="mt-2"><b class="text-primary">Address</b></label>
        	<textarea class="form-control border-left-dark" name="address" rows="3"></textarea>
        	<label class="mt-2"><b class="text-primary">POS</b></label>
        	<input type="number" name="pos" class="form-control border-left-dark">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger bg-gradient-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-primary bg-gradient-primary"><i class="fa fa-check"></i> Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
