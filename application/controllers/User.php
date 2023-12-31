<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    //Memaksa ke controler login jika user ingin masuk ke dalam page user
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        
        
    }
    public function index()
    {
        $data['parent'] = 'User';
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        
         $this->template->render_page('user/index', $data);
    }
     public function Dashboard()
    {
        $data['parent'] = 'User';
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('user/dashboard', $data);

        
    }
    //edit profile
    public function edit()
    {
        $data['parent'] = 'User';
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {

             $this->template->render_page('user/edit-profile', $data);
        } else {
            $email = $this->input->post('email');
            $name = $this->input->post('name');
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

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your Profile Has Been Updated! </div>');
            redirect('user');
        }
    }
    public function changePassword()
    {
        $data['parent'] = 'User';
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
        $this->form_validation->set_rules(
            'new_password1',
            'New Password',
            'trim|required|min_length[3]|matches[new_password2]'
        );
        $this->form_validation->set_rules(
            'new_password2',
            'Repeat Password',
            'trim|required|min_length[3]|matches[new_password1]'
        );

        if ($this->form_validation->run() == false) {

             $this->template->render_page('user/changepassword', $data);
             
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong Current Password! </div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Your Current Password Cannod Be The Same As New Password! </div>');
                    redirect('user/changepassword');
                } else {
                    //pasword sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your Password is Change! </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    
}
