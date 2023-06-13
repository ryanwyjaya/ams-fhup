<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inbox extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Inbox_model','i');
        $this->load->model('Master_model','m');
    }
    public function index()
    {
        $data['parent'] = 'Inbox';
        $data['title'] = 'Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('inbox/index', $data);
        $this->load->view('inbox/js/index_js');
    }
    
    public function ambilData()
    {
        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table
            $list = $this->i->get_datatables();
            $data = [];
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = [];

                $btn="
                <div class='form-group'>
                <a target='_blank' href='./assets/upload/$field->file' class=\"btn btn-info btn-sm\"><i class=\"fa fa-file\"> Lihat File</i></a>
                
                 </div>
                 <div class='form-group' style='margin-top:10px;'>
                
                <a href='surat_masuk/tambah_dispo/$field->id' class=\"btn btn-success btn-sm\"><i class=\"fa fa-send\"></i> Disposisi</a>
                 </div>

                                                    ";
                $dispo = "$field->total_disposisi <a href='surat_masuk/dispo/$field->id' class=\"btn btn-info btn-sm\"><i class=\"fa fa-eye\"></i> Lihat</a>";
                
                // Memanggil data dari tabel submenu
                $row[] = '<font class="text-primary font-weight-bold">'.$no.'</font>';
                $row[] = $field->no_surat;
                $row[] = $field->perihal;
                $row[] = $field->sifat=="Rahasia"?"<b class='text-danger'>$field->sifat</b>": $field->sifat;
                $row[] = $field->tanggal_surat;
                $row[] = $field->role;
                $row[] = $field->asal_surat;
                $row[] = $field->isi_surat;
                $row[] = $field->tanggal_diterima;
                $row[] = $field->total_disposisi==0?$field->total_disposisi : $dispo;
                $row[] = $btn;
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->i->count_all(),
                "recordsFiltered" => $this->i->count_filtered(),
                "data" => $data,
            ];
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }
    public function disposisi()
    {
        $data['parent'] = 'Inbox';
        $data['title'] = 'Disposisi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('inbox/disposisi', $data);
        $this->load->view('inbox/js/disposisi_js');
    }
    public function dispoData()
    {
        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table
            $list = $this->i->get_datatables_d();
            $data = [];
            $no = $_POST['start'];
            $u = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
            foreach ($list as $field) {

                $no++;
                $row = [];

                $btn="
                <a target='_blank' href='../disposisi/cetak/$field->param' class=\"btn btn-primary btn-sm\"><i class=\"fa fa-print\"></i></a> 
                <a style='margin-top:10px;' href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class=\"btn btn-danger btn-sm\" id='hapus-sm' data-id='$field->param'><i class=\"fa fa-trash\"></i> Hapus</a>
                 ";
                 $btn4="<a target='_blank' href='../disposisi/cetak/$field->param' class=\"btn btn-primary btn-sm\"><i class=\"fa fa-print\"></i></a>";
                 $btn5="cetak";

                $btn3=" 
                <a target='_blank' href='../disposisi/cetak/$field->param' class=\"btn btn-primary btn-sm\"><i class=\"fa fa-print\"></i></a>
                 ";
                $btn2="
                <a style='margin-top:10px;' href=\"\" data-toggle=\"modal\" data-target=\"#setuju\" class=\"btn btn-success btn-sm\" id='tindakan' data-id='$field->param'><i class=\"fa fa-send\"></i> Setujui</a> 
                <a style='margin-top:10px;' href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class=\"btn btn-danger btn-sm\" id='hapus-sm' data-id='$field->param'><i class=\"fa fa-trash\"></i> Hapus</a>
                 ";
                 $belum = "<b class='text-warning'>Waiting</b>";
                 $proses = "<b class='text-primary'>Terproses</b>";
                 $selesai = "<b class='text-success'>Selesai</b>";
                 // $u = $user['role_id'];
                
                // Memanggil data dari tabel submenu
                $row[] = '<font class="text-primary font-weight-bold">'.$no.'</font>';
                $row[] = $field->no_surat;
                $row[] = $field->asal_surat;
                $row[] = $field->role;
                $row[] = $field->tanggal_disposisi;
                $row[] = $field->isi;
                $row[] = $field->dikembalikan;
                $row[] = "<b class='font-weight-bold text-danger'>".$field->tindakan."<b/>";
                if ($field->ds==0) {
                   $row[] = $belum; 
                }
                elseif ($field->ds==1) {
                   $row[] = $proses; 
                }
                else{
                   $row[] = $selesai;
                }
                if ($field->tujuan_surat == $u['role_id'] && $field->ds==2) {
                     $row[] = $btn3;
                }elseif ($field->tujuan_surat == $u['role_id'] && $field->ds==1) {
                    $row[] = $btn;
                }elseif ($field->tujuan_surat == $u['role_id'] && $field->ds==0) {
                    $row[] = $btn;
                }elseif ($field->tujuan_surat == $u['role_id'] && $field->ds==3) {
                    $row[] = $btn5;
                }elseif ($field->ds==1) {
                    $row[] = $btn4;
                }elseif ($field->ds==2) {
                    $row[] = $btn3;
                }elseif ($field->ds==3) {
                    $row[] = $btn5;
                }
                else{
                     $row[] = $btn2;
                }
               
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->i->count_all_d(),
                "recordsFiltered" => $this->i->count_filtered_d(),
                "data" => $data,
            ];
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }
    public function delete_dispo()
    {
        $id = $this->input->post('id');
        $data['surat'] = $this->i->getDispo($id);
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
        redirect('inbox/disposisi');

    }
    public function setujui()
    {
        $id = $this->input->post('id');
        $tindakan = $this->input->post('tindakan');
        $s = 1;
        $data['surat'] = $this->i->getDispo($id);
        $this->db->set('tindakan', $tindakan);
        $this->db->set('status', $s);
        $this->db->where('id', $id);
        $this->db->update('disposisi');
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Akses Arsip Digital Di Tampilkan !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
        redirect('inbox/disposisi');

    }


    
    
}
