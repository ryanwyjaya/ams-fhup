<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site_config extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Master_model','m');
    }
    
    public function index(){
        $data['parent'] = 'Setting';
        $data['title'] = 'Site Config';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('admin/site_config', $data);
        
    }
    public function update(){

            $id = $this->input->post('id');
            $site_name = $this->input->post('site_name');
            $header = $this->input->post('header');
            $alamat = $this->input->post('alamat');
            $data['site_config'] = $this->db->get_where('site_config', ['id' => $id])->row_array();
            $upload_image = $_FILES['logo']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/logo';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo')) {
                    $old_image = $data['site_config']['logo'];
                    if ($old_image != 'logo.png') {
                        unlink(FCPATH . 'assets/img/logo/' . $old_image);
                    }


                    $new_image = $this->upload->data('file_name');
                    $this->db->set('logo', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data  = array(
                'site_name' => $site_name,
                'header' => $header,
                'alamat' => $alamat

                 );
            $where = array('id'=>$id);
            $this->m->update($where,$data,'site_config');
            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Data Telah Berhasil Diubah!\',
                \'\',
                \'success\')</script>');
            redirect('site_config');
    }
    public function test(){
        $data['title'] = "Test Header";
        $this->template->print('admin/test',$data);
    }
    
}
