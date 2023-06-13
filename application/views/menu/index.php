


    <div class="row">
        <div class="col-lg-6">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
                     </div>');  ?>


            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3 " data-toggle="modal" data-target="#newModal"><i class="fa fa-edit"></i> Add New Menu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr> 
                            <th scope="row"><?= $i;  ?> </th>
                            <td><?= $m['menu'];  ?> </td>
                            <td>
                                <div class="badge badge-polos">
                                <?php echo anchor('menu/edit_menu/'.$m['id'],'<i  class="fa fa-edit alert-success"> Edit</i>')?>
                                 </div>
                                
                                <div class="badge badge-polos" onclick="javascript:return confirm('anda yakin hapus?')">
                                <?php echo anchor('menu/delete_menu/'.$m['id'],'<i  class="fa fa-trash alert-danger"> Delete</i>')?>
                                 </div>

                            </td>

                        </tr>
                        <?php $i++;  ?>
                    <?php endforeach;  ?>
                </tbody>
            </table>

        </div>

    </div>




<!-- Modal -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?> " method="post">
                <div class="modal-body">
                    <div class="form-group">

                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="font" name="font" placeholder="Font Embed">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

