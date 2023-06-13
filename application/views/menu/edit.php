<!-- Begin Page Content -->


<div class="Content-wrapper">
	<section class="Content">
		<?php foreach ($edit as $m) : ?>
		<form action="<?= base_url().'menu/update_menu'; ?> " method="post">
                <div class="form-group">
                    <div class="form-group">
                    	<input type="hidden" class="form-control" id="id" name="id" value="<?=$m->id;?>">
                        <label>Nama Menu</label>
                        <input type="text" class="form-control" id="menu" name="menu" value="<?=$m->menu;?>">
                        <label>Font Embed</label>
                        <input type="text" class="form-control" id="font" name="font" value="<?=$m->font;?>">
                    </div>
                </div>
                <div class="form-group">
                    <button type="Reset" class="btn btn-secondary"><i class="fa fa-refresh"></i> Reset</button>
                    <button type="submit" class="btn btn-primary"onclick="javascript:return confirm('anda yakin mau di ubah?')"><i class="fa fa-edit"></i> Edit</button>
                    <a class="btn btn-danger bg-gradient-danger" href="<?= base_url('menu'); ?>"><strong class="text-white"><i class="fa fa-undo text-white"></i> Kembali</strong></a>
                </div>
            </form>
	<?php endforeach;  ?>
	</section>
</div>
