<div class="box">
    <div class="box-header bg-aqua"></div>
    <div class="box-body">
        
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif;  ?>

            <form action="<?= base_url('menu/sort'); ?>" method="post">
            <div class="input-group col-md-5">
            <input type="text" class="form-control" placeholder="Search Keyword" name="keyword">
            <div class="input-group-append">
             <input class="btn btn-info btn-sm btn-flat" type="submit" id="button-addon2" autocomplete="off" autofocus name="submit"></input>
            </div>

            </div>
            </form>

            <?= $this->session->flashdata('message'); ?>

            
            
            <div class="table-responsive">
                <h5>Total Rows : <?= $total_rows; ?></h5>
                <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Sort</th>
                        <th scope="col">Action</th>


                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($subMenu)) : ?>
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-danger" role="alert">
                                 Data Not Found!!
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= ++$start;  ?> </th>
                            <td><?= $sm['title'];  ?> </td>
                            <td><?= $sm['sort'];  ?> </td>
                            

                            <td>
                            <div class="btn btn-warning btn-flat btn-sm">
                                <?php echo anchor('menu/edit_sort/'.$sm['id'],'<i  class="fa fa-edit "> <b class="text-danger">Edit</b></i>')?>
                                 </div>
                            
                            </td>
                            

                        </tr>
                        
                    <?php endforeach;  ?>
                </tbody>
            </table>
            
             <?=$this->pagination->create_links();?>
           
    
 
           
</div>
                                
            
         
              
</div>               


</div>


    
            










