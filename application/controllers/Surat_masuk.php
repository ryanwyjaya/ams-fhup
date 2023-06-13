<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Suratmasuk_model','sm');
        $this->load->model('Master_model','m');
    }
    public function index()
    {
        $data['parent'] = 'Surat Masuk';
        $data['title'] = 'Data Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('surat_masuk/index', $data);
        $this->load->view('surat_masuk/js/index_js');
    }
    public function ad()
    {
        $data['parent'] = 'Arsip Digital';
        $data['title'] = 'Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->library('pagination');

        //ambil data keywoard
        if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword'] = $this->session->userdata('keyword');
        }
        //config
        $this->db->like('no_surat',$data['keyword']);
        $this->db->or_like('file',$data['keyword']);
        $this->db->or_like('asal_surat',$data['keyword']);
        $where = "Rahasia";
        $where2 = 0;
        $this->db->where('akses_arsip !=',$where2);
        $this->db->where('sifat !=',$where);
        $this->db->from('surat_masuk');
        $url = (isset($_SERVER['HTTPS']) ? "https://" : "http://"); 
        $url .= $_SERVER['HTTP_HOST']. str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
        $config['base_url'] = $url.'surat_masuk/ad';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 4;

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
        $data['sm'] = $this->sm->ad($config['per_page'],$data['start'],$data['keyword']);
        $this->template->render_page('surat_masuk/ad', $data);
    }
    public function tambah()
    {
        $data['parent'] = 'Surat Masuk';
        $data['title'] = 'Tambah Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('no_surat', 'No_surat', 'required');

        if ($this->form_validation->run() == false) {
            $this->template->render_page('surat_masuk/tambah', $data);
        } else {
          // cek jika ada gambar yang akan diupload
        $upload_file = $_FILES['file']['name'];

        // jika ada file yang diupload
        if ($upload_file) {
            // konfigurasi
            $config['upload_path']          = './assets/upload';
            $config['allowed_types']        = 'pdf|jpg|png|docx|doc|xls';
            $config['max_size']             = 5000;

            // load library upload
            $this->load->library('upload', $config);

            // jika yang diupload sesuai dengan config
            if ($this->upload->do_upload('file')) {
                // ambil file_name nya
                $file = $this->upload->data('file_name');
                $file = str_replace('', '_', $file);
            } else {
                // jika tidak sesuai (error)
                $this->session->set_flashdata('message', '<div class="text-sm text-danger">' . $this->upload->display_errors() . '</div>');
                redirect('surat_masuk/tambah');
            }
        }
          $data = [
                'no_surat' => $this->input->post('no_surat'),
                'perihal' => $this->input->post('perihal'),
                'sifat' => $this->input->post('sifat'),
                'tanggal_surat' => $this->input->post('tanggal_surat'),
                'tujuan_surat' => $this->input->post('tujuan_surat'),
                'asal_surat' => $this->input->post('asal_surat'),
                'isi_surat' => $this->input->post('isi_surat'),
                'tanggal_diterima' => $this->input->post('tanggal_diterima'),
                'no_agenda' => $this->input->post('no_agenda'),
                'nama_pengirim' => $this->input->post('nama_pengirim'),
                'alamat_pengirim' => $this->input->post('alamat_pengirim'),
                'file' =>$file,
                'total_disposisi' => 0,
                'akses_arsip' => 0
            ];
        $this->db->insert('surat_masuk',$data);

            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Data Surat Masuk Telah Berhasil Ditambahkan!\',
                \'\',
                \'success\')</script>');
            redirect('surat_masuk');
        }
    }
    public function edit($id){
        $data['parent'] = 'Surat Masuk';
        $data['title'] = 'Edit Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->m->edit($where,'surat_masuk')->row_array();
        $this->template->render_page('surat_masuk/edit', $data);
        
    }
    public function update(){
            $id = $this->input->post('id');
            $no_surat = $this->input->post('no_surat');
            $no_agenda = $this->input->post('no_agenda');
            $perihal = $this->input->post('perihal');
            $sifat = $this->input->post('sifat');
            $tanggal_surat = $this->input->post('tanggal_surat');
            $tujuan_surat = $this->input->post('tujuan_surat');
            $asal_surat = $this->input->post('asal_surat');
            $isi_surat = $this->input->post('isi_surat');
            $tanggal_diterima = $this->input->post('tanggal_diterima');
            $nama_pengirim = $this->input->post('nama_pengirim');
            $alamat_pengirim = $this->input->post('alamat_pengirim');
           
            $data['surat'] = $this->db->get_where('surat_masuk', ['id' => $id])->row_array();

        // cek jika ada gambar yang akan diupload
        $upload_file = $_FILES['file']['name'];

        // jika ada file yang diupload
        if ($upload_file) {
            // konfigurasi
            $config['upload_path']          = './assets/upload';
            $config['allowed_types']        = 'pdf|jpg|png|docx|doc|xls';
            $config['max_size']             = 2000;

            // load library upload
            $this->load->library('upload', $config);

            // jika yang diupload sesuai dengan config
            if ($this->upload->do_upload('file')) {
                // ambil file_name nya
                $file = $this->upload->data('file_name');
                $file = str_replace('', '_', $file);

                $this->db->set('file', $file);

                unlink(FCPATH . './assets/upload/' . $data['surat']['file']);
            } else {
                // jika tidak sesuai (error)
                $this->session->set_flashdata('message', '<div class="text-sm text-danger">' . $this->upload->display_errors() . '</div>');
                redirect('surat_masuk/edit/' . $id);
            }
        }

            $this->db->set('no_surat', $no_surat);
            $this->db->set('no_agenda', $no_agenda);
            $this->db->set('perihal', $perihal);
            $this->db->set('sifat', $sifat);
            $this->db->set('tanggal_surat', $tanggal_surat);
            $this->db->set('tujuan_surat', $tujuan_surat);
            $this->db->set('asal_surat', $asal_surat);
            $this->db->set('isi_surat', $isi_surat);
            $this->db->set('tanggal_diterima', $tanggal_diterima);
            $this->db->set('nama_pengirim', $nama_pengirim);
            $this->db->set('alamat_pengirim', $alamat_pengirim);
            $this->db->where('id', $id);
            $this->db->update('surat_masuk');
            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Data Surat Masuk Telah Berhasil Diubah!\',
                \'\',
                \'success\')</script>');
            redirect('surat_masuk');
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
                $row[] = $field->tanggal_surat;
                $row[] = $field->role;
                $row[] = $field->asal_surat;
                $row[] = $field->isi_surat;
                $row[] = $field->tanggal_diterima;
                $row[] = $field->total_disposisi==0?$field->total_disposisi : $dispo;
                if ($field->sifat=="Rahasia") {
                  $row[] = "<a class='btn btn-sm btn-danger'><i class='fa fa-ban'></i></a>";
                }else{
                   $row[] = $field->akses_arsip==0?$at :$ay; 
                }
                $row[] = $btn2;
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

    public function delete()
    {
        $id = $this->input->post('id');
        $data['surat'] = $this->sm->getSM($id);
        $this->db->delete('surat_masuk', ['id' => $id]);
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Data Berhasil Dihapus !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
        redirect('surat_masuk');

    }

    public function akses_open()
    {
        $id = $this->input->post('id');
        $data['surat'] = $this->sm->getSM($id);
        $a = 1;
        $this->db->set('akses_arsip', $a);
        $this->db->where('id', $id);
        $this->db->update('surat_masuk');
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Akses Arsip Digital Di Tampilkan !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
        redirect('surat_masuk');

    }

    public function akses_tutup()
    {
        $id = $this->input->post('id');
        $data['surat'] = $this->sm->getSM($id);
        $a = 0;
        $this->db->set('akses_arsip', $a);
        $this->db->where('id', $id);
        $this->db->update('surat_masuk');
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Akses Arsip Digital Di Tutup !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
        redirect('surat_masuk');

    }

    public function tambah_dispo($id){
        $data['parent'] = 'Disposisi';
        $data['title'] = 'Tambah Dispo';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->m->edit($where,'surat_masuk')->row_array();
        $this->template->render_page('surat_masuk/tambah_dispo', $data);  
    }
    public function tambah_dispo_kp($id){
        $data['parent'] = 'Disposisi';
        $data['title'] = 'Tambah Dispo';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->m->edit($where,'surat_masuk')->row_array();
        $this->template->render_page('surat_masuk/tambah_dispo_kp', $data);  
    }
    public function proses_dispo(){
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        if ($this->form_validation->run() == false) {
            $this->template->render_page('surat_masuk/tambah_dispo', $data);
        } else {
            $this->db->insert('disposisi', [
                'id_surat_masuk' => $this->input->post('id_surat_masuk'),
                'tujuan' => $this->input->post('tujuan'),
                'dikembalikan' => $this->input->post('dikembalikan'),
                'isi' => $this->input->post('isi'),
                'tanggal_disposisi' => $this->input->post('tanggal_disposisi'),
                'tindakan' => $this->input->post('tindakan'),
                'status' => 1
        ]);

            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Disposisi Telah Berhasil Ditambahkan!\',
                \'\',
                \'success\')</script>');
            redirect('inbox/disposisi');
        }
    }
    public function proses_dispo_kp(){
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        if ($this->form_validation->run() == false) {
            $this->template->render_page('surat_masuk/tambah_dispo', $data);
        } else {
            $this->db->insert('disposisi', [
                'id_surat_masuk' => $this->input->post('id_surat_masuk'),
                'tujuan' => $this->input->post('tujuan'),
                'dikembalikan' => $this->input->post('dikembalikan'),
                'isi' => $this->input->post('isi'),
                'tanggal_disposisi' => $this->input->post('tanggal_disposisi'),
                'tindakan' => $this->input->post('tindakan'),
                'status' => 0
        ]);

            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Disposisi Telah Berhasil Ditambahkan!\',
                \'\',
                \'success\')</script>');
            redirect('surat_masuk');
        }
    }
    public function lihat_dispo($id){
        $data['parent'] = 'Disposisi';
        $data['title'] = 'Detail Dispo';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->m->edit($where,'surat_masuk')->row_array();
        $this->template->render_page('surat_masuk/lihat_dispo', $data);  
    }

    
    
}
