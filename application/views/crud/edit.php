<div class="card">
	<div class="card-header bg-gradient-dark"></div>
	<div class="card-body">
		<form action="<?= base_url('crud/update'); ?>" method="post">
			<div class="form-group">
				<input type="hidden" name="id" value="<?= $edit['id']; ?>">
				<label><b class="text-primary">Name</b></label>
				<input type="text" name="name" class="form-control border-left-dark" value="<?= $edit['name']; ?>">
				<label class="mt-2"><b class="text-primary">Address</b></label>
				<textarea class="form-control border-left-dark" name="address" rows="3"><?= $edit['address']; ?></textarea>
				<label class="mt-2"><b class="text-primary">POS</b></label>
				<input type="text" name="pos" class="form-control border-left-dark" value="<?= $edit['pos']; ?>">

			</div>
			<div class="form-group">
				<a data-toggle="modal" data-target="#alert" class="btn btn-primary text-white"><i class="fa fa-edit"></i> Edit</a>
                <a class="btn btn-danger bg-gradient-danger" href="<?= base_url('crud'); ?>"><strong class="text-white"><i class="fa fa-undo text-white"></i> Kembali</strong></a>
			</div>
			<!-- Modal -->
		<div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    	<div class="modal-content">
      <div class="modal-header bg-gradient-dark">
        <h5 class="modal-title font-weight-bold text-white" id="exampleModalLabel"><?= $title; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b class="text-dark">Anda Yakin Data Sudah Benar?</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger bg-gradient-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-primary bg-gradient-primary"><i class="fa fa-check"></i> Yakin</button>
      </div>
    </div>
  </div>
</div>
		</form>
	</div>
</div>