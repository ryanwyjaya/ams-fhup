<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Disposisi extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Disposisi_model','ds');
        $this->load->model('Master_model','m');
    }
    public function index()
    {
        $data['parent'] = "Disposisi";
        $data['title'] = 'Data Disposisi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('disposisi/index', $data);
        $this->load->view('disposisi/js/index_js');
        
    }

    public function ambilData()
    {
        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table
            $list = $this->ds->get_datatables();
            $data = [];
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = [];

                $btn="
                <div class ='form-group'>
                    <a href='surat_keluar/balasan/$field->id' class=\"btn btn-info btn-sm\"><i class=\"fa fa-send\"></i></a>
                     <a href=\"\" data-toggle=\"modal\" data-target=\"#modalSelesai\" class=\"btn btn-success btn-sm\" id='hapus-sm' data-id='$field->param'><i class=\"fa fa-check\"></i></a>
                </div>
                <div class ='form-group' style='margin-top:2px;'>
                     <a target='_blank' href='disposisi/cetak/$field->param' class=\"btn btn-primary btn-sm\"><i class=\"fa fa-print\"></i></a>
                    <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class=\"btn btn-danger btn-sm\" id='hapus-sm' data-id='$field->param'><i class=\"fa fa-trash\"></i></a>
                </div>
                                                    ";
                $btn2="
                <a target='_blank' href='disposisi/cetak/$field->param' class=\"btn btn-primary btn-sm\"><i class=\"fa fa-print\"></i></a>
                                                    ";

                $belum = "<b class='text-warning'>Waiting</b>";
                 $proses = "<b class='text-primary'>Terproses</b>";
                 $selesai = "<b class='text-success'>Selesai</b>";
                
                // Memanggil data dari tabel submenu
                $row[] = '<font class="text-primary font-weight-bold">'.$field->no_agenda.'</font>';
                $row[] = $field->no_surat;
                $row[] = $field->asal_surat;
                $row[] = '<font class="text-primary font-weight-bold">'.$field->role.'</font>';
                $row[] = $field->tanggal_disposisi;
                $row[] = $field->isi;
                 $row[] = '<font class="text-danger font-weight-bold">'.$field->tindakan.'</font>';
                if ($field->ds ==0) {
                    $row[] = $belum;
                }elseif ($field->ds==1) {
                    $row[] = $proses;
                }else{
                    $row[] = $selesai;
                }
                $row[] = $field->ds==2?$btn2:$btn;
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->ds->count_all(),
                "recordsFiltered" => $this->ds->count_filtered(),
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
        $data['crud'] = $this->ds->getDispo($id);
        $this->db->delete('disposisi', ['id' => $id]);
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Data Berhasil Dihapus !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
        redirect('disposisi');
    }
     public function selesai()
    {
        $id = $this->input->post('id');
        $data['disposisi'] = $this->ds->getDispo($id);
        $a = 2;
        $this->db->set('status',$a);
        $this->db->where('id',$id);
        $this->db->update('disposisi');
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Disposisi Telah Diselesaikan !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
        redirect('disposisi');
    }
    public function cetak($id){
        $data['title'] = 'Cetak Disposisi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->m->edit($where,'disposisi')->row_array();
        $this->template->print('disposisi/cetak', $data);
        
    }


    
}
