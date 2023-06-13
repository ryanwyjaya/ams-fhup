<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda_sk extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Agendask_model','sk');
        $this->load->model('Master_model','m');
    }
    public function index()
    {
        $data['parent'] = 'Buku Agenda';
        $data['title'] = 'Agenda Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('agenda/sk/index', $data);
        $this->load->view('agenda/sk/index_js');
    }

    public function ambilData()
    {
        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table
            $list = $this->sk->get_datatables();
            $data = [];
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = [];
                
                // Memanggil data dari tabel submenu
                $row[] = '<font class="text-primary font-weight-bold">'.$field->no_agenda.'</font>';
                $row[] = $field->no_surat;
                if ($field->sifat=="Rahasia") {
                     $row[] = '<font class="text-danger font-weight-bold">'.$field->sifat.'</font>';
                }else{
                     $row[] = '<font class="text-primary font-weight-bold">'.$field->sifat.'</font>';
                }
               
                $row[] = $field->perihal;
                $row[] = format_indo($field->tanggal_surat);
                $row[] = $field->tujuan_surat;
                $row[] = $field->asal_surat;
                $row[] = $field->isi;
                if ($field->jenis_surat=="Baru") {
                    $row[] = '<font class="text-primary font-weight-bold">'.$field->jenis_surat.'</font>';
                }else{
                    $row[] = '<font class="text-danger font-weight-bold">'.$field->jenis_surat.'</font>';
                }
                
                $row[] = format_indo($field->tanggal_dibuat);
                $row[] = $field->pemohon;
                $row[] = $field->alamat; 
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->sk->count_all(),
                "recordsFiltered" => $this->sk->count_filtered(),
                "data" => $data,
            ];
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }
    public function cetak_all()
    {
        $data['parent'] = 'Buku Agenda';
        $data['title'] = 'Agenda Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->print('agenda/sk/cetak_all', $data);
    }
     public function cetak()
    {
        $data['parent'] = 'Buku Agenda';
        $data['title'] = 'Agenda Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['tahun'] = $this->sk->gettahun();
        $this->template->render_page('agenda/sk/cetak', $data);
        $this->load->view('agenda/sk/cetak_js');
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
            
            $data['title'] = "Rekap Buku Agenda Surat Keluar Periode Tanggal";
            $data['subtitle'] = "Dari tanggal : ".format_indo($tanggalawal).' Sampai tanggal : '.format_indo($tanggalakhir);
            $data['datafilter'] = $this->sk->filterbytanggal($tanggalawal,$tanggalakhir);
            
            $this->template->print('agenda/sk/print_periode',$data);

        }elseif ($nilaifilter == 2) {
            
            $data['title'] = "Rekap Buku Agenda Surat Keluar Periode Bulan";
            $data['subtitle'] = "Dari Bulan : ".bulan($bulanawal).' - '.bulan($bulanakhir).' '.$tahun1;
            $data['datafilter'] = $this->sk->filterbybulan($tahun1,$bulanawal,$bulanakhir);
            $this->template->print('agenda/sk/print_periode',$data);

        }elseif ($nilaifilter == 3) {
            $data['title'] = "Rekap Buku Agenda Surat Keluar Periode Tahun";
            $data['subtitle'] = ' Tahun : '.$tahun2;
            $data['datafilter'] = $this->sk->filterbytahun($tahun2);

            $this->template->print('agenda/sk/print_periode',$data);

        }
    }
    
    
}
