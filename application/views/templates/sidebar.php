
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('assets/img/profile/').$user['image']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <?php 
          $where = $user['role_id'];
          $role = $this->db->where('id',$where);
          $role = $this->db->get('user_role')->row_array();
           ?>
          <p><?= $role['role']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header text-center text-white"><b class="text-danger">MAIN NAVIGATION</b></li>
 
<?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "  SELECT `user_menu`.`id` ,`menu`,`font`
                        FROM `user_menu`
                        JOIN `user_access_menu` ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                        WHERE `user_access_menu`.`role_id` = $role_id
                        ORDER BY `user_access_menu`.`menu_id` ASC

        
       ";
        $menu = $this->db->query($queryMenu)->result_array();

        ?>
        <?php foreach ($menu as $m) : ?>
        <li class="treeview">

          <a href="">
            <?php if ($parent == $m['menu']): ?>
               <i class="<?= $m['font']; ?> text-danger"></i> <span class="font-weight-bold text-danger"><?= $m['menu']; ?></span>
              <?php else: ?>
                 <i class="<?= $m['font']; ?>"></i> <span><?= $m['menu']; ?></span>
            <?php endif ?>
           
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php
                $menuId = $m['id'];
                $querySubMenu = "SELECT *
                                FROM `user_sub_menu` JOIN `user_menu`
                                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                 WHERE `user_sub_menu`.`menu_id` = $menuId
                                 AND `user_sub_menu`.`is_active` = 1
                                 ORDER BY `user_sub_menu`.`sort` ASC
                                 ";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>
             <?php foreach ($subMenu as $sm) : ?>
              <?php if ($title == $sm['title']): ?>
                <li><a class="font-weight-bold text-danger" href="<?= base_url($sm['url']); ?>"><i class="<?= $sm['icon']; ?> font-weight-bold text-danger"></i> <?= $sm['title']; ?></a></li>
               <?php else: ?> 
                <li><a href="<?= base_url($sm['url']); ?>"><i class="<?= $sm['icon']; ?> font-weight-bold text-white"></i> <?= $sm['title']; ?></a></li>
              <?php endif ?>
             
            <?php endforeach;  ?> 
          </ul>
        </li>
        <?php endforeach;  ?> 

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo format_indo(date('Y-m-d H:i:s'));?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cog"></i> <?= $title; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">