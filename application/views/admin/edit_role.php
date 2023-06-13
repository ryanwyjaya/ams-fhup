<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

<div class="Content-wrapper">
	<section class="Content">
		<?php foreach ($edit as $m) : ?>
		<form action="<?= base_url().'admin/update_role'; ?> " method="post">
                <div class="form-group">
                    <div class="form-group">
                    	<input type="hidden" class="form-control" id="id" name="id" value="<?=$m->id;?>">
                        <input type="text" class="form-control" id="role" name="role" value="<?=$m->role;?>">
                    </div>
                </div>
                <div class="form-group-row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                    <a class="btn btn-danger bg-gradient-danger" href="<?= base_url('admin/role'); ?>"><strong class="text-white"><i class="fa fa-undo text-white"></i> Kembali</strong></a>
                </div>
            </div>
            </form>
	<?php endforeach;  ?>
	</section>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->