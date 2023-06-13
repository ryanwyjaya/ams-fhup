<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Admin_model','admin');
    }


    public function index()
    {
        $data['title'] = 'Control Panel';
        $data['parent'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('admin/index', $data);       
    }

    public function role()
    {
        $data['parent'] = 'Admin';
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {

            $this->template->render_page('admin/role', $data);
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);

            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Role Telah Berhasil Ditambahkan!\',
                \'\',
                \'success\')</script>');
            redirect('admin/role');
        }
    }

    public function edit_role($id){
        $data['parent'] = 'Admin';
        $data['title'] = 'Role Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $this->load->model('Admin_model', 'admin');
        $data['edit'] = $this->admin->edit_user($where,'user_role')->result();
           $this->template->render_page('admin/edit_role', $data);
        
    }
    public function update_role(){
            $id = $this->input->post('id');
            $role = $this->input->post('role');
            $data  = array(
                'role' => $role );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'user_role');
            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Role Telah Berhasil Diubah!\',
                \'\',
                \'success\')</script>');
            redirect('admin/role');
    }

    public function delete_role($id){

        $where  = array('id' =>$id );
        $this->load->model('Admin_model', 'admin');
        $this->admin->delete_user($where,'user_role');
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Role Berhasil Dihapus !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
            redirect('admin/role');
    }

    public function roleAccess($role_id)
    {
        $data['parent'] = 'Admin';
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        //mengakali admin agar tidak muncul di role access
        $this->db->where('id !=', 1);
        //tutup ngakalin admin
        $data['menu'] = $this->db->get('user_menu')->result_array();
        
        $this->template->render_page('admin/role-access', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Access Telah Berhasil Diubah!\',
                \'\',
                \'success\')</script>');
    }
    public function account()
    {
        $data['parent'] = 'Admin';
        $data['title'] = 'User Account';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $data['account'] = $this->db->get('user')->result_array();
        $this->load->library('pagination');

        //ambil data keywoard
        if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword'] = $this->session->userdata('keyword');
        }
        //config
        $this->db->like('name',$data['keyword']);
        $this->db->or_like('email',$data['keyword']);
        $this->db->from('user');
        $url = (isset($_SERVER['HTTPS']) ? "https://" : "http://"); 
        $url .= $_SERVER['HTTP_HOST']. str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
        $config['base_url'] = $url.'admin/account';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        // Styling nomor kanan dan kiri jika mau distyle
        // idupin script ini,, jika datanya banyak
        // $config['num_links'] = 5;

        //styling
        $config['full_tag_open']='<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']='</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open']='<li class="page-item">';
        $config['first_tag_close']='</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open']='<li class="page-item">';
        $config['last_tag_close']='</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open']='<li class="page-item">';
        $config['next_tag_close']='</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open']='<li class="page-item">';
        $config['prev_tag_close']='</li>';

        // styling active
        $config['cur_tag_open']='<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close']='</a></li>';

        // styling no active for digit
        $config['num_tag_open']='<li class="page-item">';
        $config['num_tag_close']='</li>';

        //atribut class
        $config['attributes'] = array('class'=>'page-link');


        ///initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['account'] = $this->admin->page_getaccount($config['per_page'],$data['start'],$data['keyword']);

       $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email Already Registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match !',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
             $this->template->render_page('admin/user_account', $data);
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'avatar.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()

            ];
            $this->db->insert('user', $data);
            // $this->_sendEmail();
            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Account Telah Berhasil Ditambahkan!\',
                \'\',
                \'success\')</script>');
            redirect('admin/account');
        }
    
    }
    public function create_account()
    {
        $data['parent'] = 'Admin';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email Already Registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match !',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
             $this->template->render_page('admin/user_account', $data);
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'avatar.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()

            ];
            $this->db->insert('user', $data);
            // $this->_sendEmail();
            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Account Telah Berhasil Ditambahkan!\',
                \'\',
                \'success\')</script>');
            redirect('admin/account');
        }
    }
    public function delete_account($id){

        $where  = array('id' =>$id );
        $this->load->model('Admin_model', 'admin');
        $this->admin->delete_user($where,'user');
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Data User Berhasil Dihapus !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
            redirect('admin/account');
    }
    public function bypass($id){
        $data['parent'] = 'Admin';
        $data['title'] = 'Bypass';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $where = array('id' =>$id);
        $data['edit'] = $this->admin->edit_user($where,'user')->result();
        $data['join'] = $this->admin->join_menu($id);
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->template->render_page('admin/bypass', $data);
        
    }
    public function update_bypass(){

            $id = $this->input->post('id');
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $password = $this->input->post('password');
            $new_password = password_hash($this->input->post('new_password'),PASSWORD_DEFAULT);
            $role_id = $this->input->post('role_id');
            if ($new_password=="") {
                 $this->db->set('password', $password);
            }else{
                $this->db->set('password', $new_password); 
            }
            
            $data  = array(
                'name' => $name,
                'role_id' => $role_id );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'user');
            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Password Telah Berhasil Diubah!\',
                \'\',
                \'success\')</script>');
            redirect('admin/account');
        
    }

    public function edit_account($id){
        $data['parent'] = 'Admin';
        $data['title'] = 'User Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $where = array('id' =>$id);
        $data['edit'] = $this->admin->edit_user($where,'user')->result();
        $data['join'] = $this->admin->join_menu($id);
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->template->render_page('admin/user_account_edit', $data);
        
    }
    public function update_account(){

            $id = $this->input->post('id');
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $password = $this->input->post('password');
            $new_password = password_hash($this->input->post('new_password'),PASSWORD_DEFAULT);
            $role_id = $this->input->post('role_id');
            // if ($new_password=="") {
            //      $this->db->set('password', $password);
            // }else{
            //     $this->db->set('password', $new_password); 
            // }
            
            //cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/profile';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'avatar.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }


                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $data  = array(
                'name' => $name,
                'role_id' => $role_id );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'user');
            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Data User Telah Berhasil Diubah!\',
                \'\',
                \'success\')</script>');
            redirect('admin/account');
        
    }
    public function fa(){
        $data['parent'] = 'Menu';
        $data['title'] = 'Font Awesome';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('admin/font_awesome',$data);
    }
     public function mdi(){
        $data['parent'] = 'Admin';
        $data['title'] = 'MDI Icons';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('admin/mdi_icon',$data);
    }

     public function ti(){
        
        $this->load->view('admin/themify_icons');
    }

}