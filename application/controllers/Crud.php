<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Crud_model','c');
        $this->load->model('Master_model','m');
    }
    public function index()
    {
        $data['title'] = 'Example';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == false) {

            $this->template->render_page('crud/index', $data);
            $this->load->view('crud/js/index_js');
        } else {
            $this->db->insert('example', [
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'pos' => $this->input->post('pos')
        ]);

            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Data Telah Berhasil Ditambahkan!\',
                \'\',
                \'success\')</script>');
            redirect('crud');
        }
    }

    public function ambilData()
    {
        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table
            $list = $this->c->get_datatables();
            $data = [];
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = [];

                // tombol aksi
                $btnAction = "<div class=\"dropdown\">
                    <button class=\"btn btn-sm btn-info dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        <i class=\"fa fa-fw fa-list\"></i>
                    </button>
                    <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                        
                        
                        <a href='edit_sub_menu/$field->id' class='dropdown-item'>Edit</a>
                        <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class='dropdown-item' id='hapus-sm' data-id='$field->id'>Hapus</a>
                    </div>
                </div>";
                $btn="<a href='crud/edit/$field->id' class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit\"></i></a>
                    <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class=\"btn btn-danger btn-sm\" id='hapus-sm' data-id='$field->id'><i class=\"fa fa-trash\"></i></a>
                                                    ";
                
                // Memanggil data dari tabel submenu
                $row[] = '<font class="text-primary font-weight-bold">'.$no.'</font>';
                $row[] = $field->name;
                $row[] = $field->address;
                $row[] = $field->pos;
                $row[] = $btn;
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->c->count_all(),
                "recordsFiltered" => $this->c->count_filtered(),
                "data" => $data,
            ];
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $data['crud'] = $this->c->getExample($id);
        $this->db->delete('example', ['id' => $id]);
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Data Berhasil Dihapus !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
        redirect('crud');
    }

    public function edit($id){
        $data['title'] = 'Edit Example';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->m->edit($where,'example')->row_array();
        $this->template->render_page('crud/edit', $data);
        
    }
    public function update(){
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $pos = $this->input->post('pos');
            $data  = array(
                'name' => $name,
                'address' => $address,
                'pos' => $pos

                 );
            $where = array('id'=>$id);
            $this->m->update($where,$data,'example');
            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Data Telah Berhasil Diubah!\',
                \'\',
                \'success\')</script>');
            redirect('crud');
    }
    
}
