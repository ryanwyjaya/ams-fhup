


    <div class="row">
        <div class="col-lg-6">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
                     </div>');  ?>


            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3 " data-toggle="modal" data-target="#newRole"> <i class="fa fa-edit"></i> Add New Role Menu</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $r) : ?>
                        <tr>
                            <th scope="row"><?= $i;  ?> </th>
                            <td><?= $r['role'];  ?> </td>
                            <td>
                                <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="badge badge-warning">Access</a>
                                <div class="badge badge-polos">
                                <?php echo anchor('admin/edit_role/'.$r['id'],'<i  class="fa fa-edit alert-success"> Edit</i>')?>
                                 </div>
                                
                                <div class="badge badge-polos" onclick="javascript:return confirm('anda yakin hapus?')">
                                <?php echo anchor('admin/delete_role/'.$r['id'],'<i  class="fa fa-trash alert-danger "> Delete</i>')?>
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
<div class="modal fade" id="newRole" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRolelLabel">Add New Role Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/role'); ?> " method="post">
                <div class="modal-body">
                    <div class="form-group">

                        <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
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

