<div class="box">
    <div class="box-header bg-info"></div>
    <div class="box-body">
         <div class="row">
        <div class="col-lg-6">


            <?= $this->session->flashdata('message'); ?>

            <h5> This Role : <?= $role['role'];  ?> </h5>
            <table class="table table-hover">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Access</th>

                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i;  ?> </th>
                            <td><?= $m['menu'];  ?> </td>
                            <td>

                                <div class="form-check">
                                    <!-- membuat helper Checked dan Ajax  -->
                                    <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']);  ?> data-role="<?= $role['id'];  ?>" data-menu="<?= $m['id']; ?>">

                                </div>
                            </td>

                        </tr>
                        <?php $i++;  ?>
                    <?php endforeach;  ?>
                </tbody>
            </table>
            <div class="form-group-row justify-content-end">
                <div class="col-sm-10"> 
                    <a class="btn btn-danger bg-gradient-danger" href="<?= base_url('admin/role'); ?>"><strong class="text-white"><i class="fa fa-undo text-white"></i> Kembali</strong></a>
                </div>
            </div>

        </div>

    </div>


    </div>
</div>

   