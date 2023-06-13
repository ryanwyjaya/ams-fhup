

<div class="Content-wrapper">
	<section class="Content">
		<?php foreach ($subMenu as $e) : ?>
		<form action="<?= base_url().'menu/update_sub_menu'; ?> " method="post">
                
                    <div class="form-group">
                    	<input type="hidden" class="form-control" id="id" name="id" value="<?=$e->id;?>">
                    </div>

                    <div class="form-group">
                        <label class="ml-2">Menu Parent</label>
                        <select type="text" class="form-control" id="menu_id" name="menu_id">
                            
                            <option value="<?=$e->menu_id;?>"><?=$e->menu;?></option>
                            <?php foreach ($menu as $m) : ?>

                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="ml-2">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?=$e->title;?>">
                    </div>
                    <div class="form-group">
                        <label class="ml-2">Url</label>
                        <input type="text" class="form-control" id="url" name="url" value="<?=$e->url;?>">
                    </div>
                    <div class="form-group">
                        <label class="ml-2">Font Awesome</label>
                        <input type="text" class="form-control" id="icon" name="icon" value="<?=$e->icon;?>">
                    </div>
                    <div class="form-group">
                        <label class="ml-2">Is Active</label>
                        <input type="text" class="form-control" id="is_active" name="is_active" value="<?=$e->is_active;?>">
                    </div>
                <div class="form-group">
                    <button type="Reset" class="btn btn-secondary"><i class="fa fa-refresh"></i> Reset</button>
                    <button type="submit" class="btn btn-primary"onclick="javascript:return confirm('anda yakin mau di ubah?')"><i class="fa fa-edit"></i> Edit</button>
                    <a class="btn btn-danger bg-gradient-danger" href="<?= base_url('menu/submenu'); ?>"><strong class="text-white"><i class="fa fa-undo text-white"></i> Kembali</strong></a>
                </div>
            </form>
	<?php endforeach;  ?>
	</section>
</div>



