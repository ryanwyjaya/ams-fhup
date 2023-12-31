
<div class="box">
    <div class="box-header bg-navy"></div>
    <div class="box-body">
        <div class="row">
        <div class="col-xl-12">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
                     </div>');  ?>


            <?= $this->session->flashdata('message'); ?>
            

            
            <form action="<?= base_url('admin/account'); ?>" method="post">
            <div class="input-group col-md-7 mb-2">
            <a href="" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#newModal"> <i class="fa fa-edit"></i> Add New User</a>
            <input style="margin-bottom: 5px;" type="text" class="form-control ml-5" placeholder="Search Keyword" name="keyword">
            <div class="input-group-append">  
             <input class="btn btn-info btn-sm btn-flat" type="submit" id="button-addon2" autocomplete="off" autofocus name="submit"></input>

            </div>

            </div>
            </form>
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Active</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($account as $m) : ?>
                        <?php if ($m['role_id']==1): ?>
                           <?php else: ?>
                            <tr> 
                            <th scope="row"><?= ++$start;  ?> </th>
                            <td><?= $m['email'];  ?> </td>
                            <td><?= $m['name'];  ?> </td>
                            
                            
                            <td><?= $m['role'];  ?> </td>
                            <td><?= $m['is_active']== '1' ? "Yes" : "No";  ?> </td>
                            
                            <td><?= date('d F Y',$m['date_created']) ;  ?> </td>
                            <td>
                            
                            <img src="<?= base_url('assets/img/profile/') . $m['image'];  ?> " width="50px" height="40px" class="img-thumbnail">



                                <?= $m['image'];  ?> </td>
                            <td>
                                <div class="btn btn-teal teal-icon-notika waves-effect">
                                <?php echo anchor('admin/edit_account/'.$m['id'],'<i  class="fa fa-edit alert-success"> Edit</i>')?>
                                 </div>
                                 <div class="btn btn-teal teal-icon-notika waves-effect">
                                <?php echo anchor('admin/bypass/'.$m['id'],'<i  class="fa fa-unlock alert-danger"> Bypass</i>')?>
                                 </div>
                                
                                <div class="btn btn-teal teal-icon-notika waves-effect" onclick="javascript:return confirm('anda yakin hapus?')">
                                <?php echo anchor('admin/delete_account/'.$m['id'],'<i  class="fa fa-trash "> Delete</i>')?>
                                 </div>

                            </td>

                        </tr>
                        <?php endif ?>
                        
                       
                    <?php endforeach;  ?>
                </tbody>
            </table>
            <?=$this->pagination->create_links();?>

        </div>

    </div>
    </div>
</div>
    





<!-- Modal -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/account'); ?> " method="post">
                <div class="modal-body">
                             <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" value="<?= set_value('name'); ?>">
                                <!-- Validation -->
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" <?= set_value('email'); ?>>
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
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

    


