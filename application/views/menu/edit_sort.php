

<div class="Content-wrapper">
	<section class="Content">
		<?php foreach ($subMenu as $e) : ?>
		<form action="<?= base_url().'menu/update_sort'; ?> " method="post">
                
                    <div class="form-group">
                    	<input type="hidden" class="form-control" id="id" name="id" value="<?=$e->id;?>">
                    </div>

                    

                    <div class="form-group">
                        <input type="text" class="form-control" id="sort" name="sort" value="<?=$e->sort;?>">
                    </div>
                    
                <div class="form-group">
                    <button type="Reset" class="btn btn-secondary"><i class="fa fa-refresh"></i> Reset</button>
                    <button type="submit" class="btn btn-primary"onclick="javascript:return confirm('anda yakin mau di ubah?')"><i class="fa fa-edit"></i> Edit</button>
                    <a class="btn btn-danger bg-gradient-danger" href="<?= base_url('menu/sort'); ?>"><strong class="text-white"><i class="fa fa-undo text-white"></i> Kembali</strong></a>
                </div>
            </form>
	<?php endforeach;  ?>
	</section>
</div>
