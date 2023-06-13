
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif;  ?>



            <?= $this->session->flashdata('message'); ?>

            
            
            
            <div class="box-body">
                <a href="" class="btn btn-primary" style="margin-bottom: 15px;" data-toggle="modal" data-target="#newSubModal"><i class="fa fa-edit"></i> Add New Submenu</a>
                            <div class="table-responsive">
                                
            <table class="table table-hover table-bordered" id="dataSm">
                <thead class="alert-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>


                    </tr>
                </thead>
                <tbody>
                    
                    
                   
                </tbody>
            </table>

            
            
            
            
              </div>
               </div>

        </div>

    </div>




<!-- Modal add -->
<div class="modal fade" id="newSubModal" tabindex="-1" role="dialog" aria-labelledby="newSubModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubModalLabel">Add New Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?> " method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
                    </div>

                    <div class="form-group">
                        <select type="text" class="form-control" id="menu_id" name="menu_id">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>

                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">

                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                    </div>
                    <div class="form-group">

                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                        
                    </div>
                    <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    <div class="form-group">

                        <input type="number" class="form-control" id="sort" name="sort" placeholder="Sort Your Position">
                        
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Add</button>
                </div>
            </form>
        </div>
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
            <form action="<?= base_url('menu/delete_sub_datatables'); ?>" method="post">
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
        

