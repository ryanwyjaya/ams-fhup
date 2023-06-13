<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda_sm extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Agendasm_model','sm');
        $this->load->model('Master_model','m');
    }
    public function index()
    {
        $data['parent'] = 'Buku Agenda';
        $data['title'] = 'Agenda Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('agenda/sm/index', $data);
        $this->load->view('agenda/sm/index_js');
    }
    public function cetak_all()
    {
        $data['parent'] = 'Buku Agenda';
        $data['title'] = 'Agenda Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->print('agenda/sm/cetak_all', $data);
    }
     public function cetak()
    {
        $data['parent'] = 'Buku Agenda';
        $data['title'] = 'Agenda Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['tahun'] = $this->sm->gettahun();
        $this->template->render_page('agenda/sm/cetak', $data);
        $this->load->view('agenda/sm/cetak_js');
    }

    function filter(){
        $tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
        $tahun1 = $this->input->post('tahun1');
        $bulanawal = $this->input->post('bulanawal');
        $bulanakhir = $this->input->post('bulanakhir');
        $tahun2 = $this->input->post('tahun2');
        $nilaifilter = $this->input->post('nilaifilter');


        if ($nilaifilter == 1) {
            
            $data['title'] = "Rekap Buku Agenda Surat Masuk Periode Tanggal";
            $data['subtitle'] = "Dari tanggal : ".format_indo($tanggalawal).' Sampai tanggal : '.format_indo($tanggalakhir);
            $data['datafilter'] = $this->sm->filterbytanggal($tanggalawal,$tanggalakhir);
            
            $this->template->print('agenda/sm/print_periode',$data);

        }elseif ($nilaifilter == 2) {
            
            $data['title'] = "Rekap Buku Agenda Surat Masuk Periode Bulan";
            $data['subtitle'] = "Dari Bulan : ".bulan($bulanawal).' - '.bulan($bulanakhir).' '.$tahun1;
            $data['datafilter'] = $this->sm->filterbybulan($tahun1,$bulanawal,$bulanakhir);
            $this->template->print('agenda/sm/print_periode',$data);

        }elseif ($nilaifilter == 3) {
            $data['title'] = "Rekap Buku Agenda Surat Masuk Periode Tahun";
            $data['subtitle'] = ' Tahun : '.$tahun2;
            $data['datafilter'] = $this->sm->filterbytahun($tahun2);

            $this->template->print('agenda/sm/print_periode',$data);

        }
    }

    public function ambilData()
    {
        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table
            $list = $this->sm->get_datatables();
            $data = [];
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = [];

                $btn="

                <div class='form-group'>
                <a target='_blank' href='./assets/upload/$field->file' class=\"btn btn-info btn-sm\"><i class=\"fa fa-file\"></i></a>
                <a href='surat_masuk/tambah_dispo_kp/$field->id' class=\"btn btn-success btn-sm\"><i class=\"fa fa-send\"></i></a>
                 <a href='surat_masuk/edit/$field->id' class=\"btn btn-warning btn-sm\"><i class=\"fa fa-edit\"></i></a>
                <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class=\"btn btn-danger btn-sm\" id='hapus-sm' data-id='$field->id'><i class=\"fa fa-trash\"></i></a>
                 </div>
                

                                                    ";
                $btn2= "<div class=\"btn-group\">
                  <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
                    <span class=\"caret\"></span>
                    <span class=\"sr-only\">Toggle Dropdown</span>
                  </button>
                  <ul class=\"dropdown-menu\" role=\"menu\">
                    <li><a target='_blank' href='./assets/upload/$field->file'><i class=\"fa fa-file text-info\"> Lihat File</i></a></li>
                    <li><a href='surat_masuk/tambah_dispo_kp/$field->id'><i class=\"fa fa-send text-success\"> Disposisi</i></a></li>
                    <li> <a href='surat_masuk/edit/$field->id'><i class=\"fa fa-edit text-warning\"> Edit</i></a></li>
                    <li><a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" id='hapus-sm' data-id='$field->id'><i class=\"fa fa-trash text-danger\"> Hapus</i></a></li>
                  </ul>
                </div>";
                $dispo = "$field->total_disposisi <a href='surat_masuk/lihat_dispo/$field->id' class=\"btn btn-info btn-sm\"><i class=\"fa fa-eye\"></i> Lihat</a>";
                $kp = "Kasi Pelayanan";
                $ay = " <a href=\"\" data-toggle=\"modal\" data-target=\"#ay\" class=\"btn btn-success btn-sm\" id='hapus-sm' data-id='$field->id'><i class=\"fa fa-check\"></i></a>";
                $at = " <a href=\"\" data-toggle=\"modal\" data-target=\"#at\" class=\"btn btn-warning btn-sm\" id='hapus-sm' data-id='$field->id'><i class=\"fa fa-close\"></i></a>";
                
                // Memanggil data dari tabel submenu
                $row[] = '<font class="text-primary font-weight-bold">'.$field->no_agenda.'</font>';
                $row[] = $field->no_surat;
                $row[] = $field->perihal;
                $row[] = $field->sifat=="Rahasia"?"<b class='text-danger'>$field->sifat</b>": $field->sifat;
                $row[] = format_indo($field->tanggal_surat);
                $row[] = $field->role;
                $row[] = $field->asal_surat;
                $row[] = format_indo($field->tanggal_diterima);
                $row[] = $field->nama_pengirim;
                $row[] = $field->alamat_pengirim;
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->sm->count_all(),
                "recordsFiltered" => $this->sm->count_filtered(),
                "data" => $data,
            ];
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    
    
    
}
