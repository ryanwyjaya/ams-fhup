

    <div class="row">
        <div class="col-lg-8">
            <?php foreach ($join as $e) : ?>
            <?= form_open_multipart('admin/update_bypass'); ?>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?=$e->id;?>">
                    <input type="text" class="form-control" id="email" name="email" value="<?=$e->email;?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label"> Full name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?=$e->name;?>" readonly>
                </div>
            </div>
            <div class="form-group">
                        <select type="text" class="form-control" id="role_id" name="role_id" readonly>
                            
                            <option value="<?=$e->role_id;?>"><?=$e->role;?></option>
                        </select>
                    </div>
                <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label"> Ganti Password</label>
                <div class="col-sm-10">
                    <input type="hidden" name="password" value="<?= $e->password; ?>">
                    <input type="text" class="form-control" id="new_password" name="new_password">
                </div>
            </div>
            <div class="form-group-row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                    <a class="btn btn-danger bg-gradient-danger" href="<?= base_url('admin/account'); ?>"><strong class="text-white"><i class="fa fa-undo text-white"></i> Kembali</strong></a>
                </div>
            </div>
            </form>
            <?php endforeach;  ?>
        </div>
    </div>
