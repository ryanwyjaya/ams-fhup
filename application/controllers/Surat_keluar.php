<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Suratkeluar_model','sk');
        $this->load->model('Master_model','m');
    }
    public function index()
    {
        $data['parent'] = 'Surat Keluar';
        $data['title'] = 'Data Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('surat_keluar/index', $data);
        $this->load->view('surat_keluar/js/index_js');
    }

    public function tambah()
    {
        $data['parent'] = 'Surat Keluar';
        $data['title'] = 'Tambah Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('no_surat', 'No_surat', 'required');

        if ($this->form_validation->run() == false) {
            $this->template->render_page('surat_keluar/tambah', $data);
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
                redirect('surat_keluar/tambah');
            }
        }
          $data = [
                'id_surat_masuk' =>0,
                'sifat' => $this->input->post('sifat'),
                'no_surat' => $this->input->post('no_surat'),
                'perihal' => $this->input->post('perihal'),
                'tanggal_surat' => $this->input->post('tanggal_surat'),
                'tujuan_surat' => $this->input->post('tujuan_surat'),
                'asal_surat' => $this->input->post('asal_surat'),
                'isi' => $this->input->post('isi'),
                'tanggal_dibuat' => $this->input->post('tanggal_dibuat'),
                'no_agenda' => $this->input->post('no_agenda'),
                'pemohon' => $this->input->post('pemohon'),
                'alamat' => $this->input->post('alamat'),
                'jenis_surat' => $this->input->post('jenis_surat'),
                'file' =>$file,
                'pengelola' => "Kasi Pelayanan"
            ];
        $this->db->insert('surat_keluar',$data);

            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Data Surat Keluar Telah Berhasil Ditambahkan!\',
                \'\',
                \'success\')</script>');
            redirect('surat_keluar');
        }
    }
    public function balasan($id)
    {
        $data['parent'] = 'Surat Keluar';
        $data['title'] = 'Balas Surat';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->m->edit($where,'surat_masuk')->row_array();
        $this->form_validation->set_rules('no_surat', 'No_surat', 'required');

        if ($this->form_validation->run() == false) {
            $this->template->render_page('surat_keluar/balasan', $data);
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
                redirect('surat_keluar/balasan');
            }
        }
          $data = [
                'id_surat_masuk' =>$this->input->post('id_surat_masuk'),
                'no_surat' => $this->input->post('no_surat'),
                'sifat' => $this->input->post('sifat'),
                'perihal' => $this->input->post('perihal'),
                'tanggal_surat' => $this->input->post('tanggal_surat'),
                'tujuan_surat' => $this->input->post('tujuan_surat'),
                'asal_surat' => $this->input->post('asal_surat'),
                'isi' => $this->input->post('isi'),
                'tanggal_dibuat' => $this->input->post('tanggal_dibuat'),
                'no_agenda' => $this->input->post('no_agenda'),
                'pemohon' => $this->input->post('pemohon'),
                'alamat' => $this->input->post('alamat'),
                'jenis_surat' => $this->input->post('jenis_surat'),
                'file' =>$file,
                'pengelola' => "Kasi Pelayanan"
            ];
        $this->db->insert('surat_keluar',$data);

            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Data Surat Keluar Telah Berhasil Ditambahkan!\',
                \'\',
                \'success\')</script>');
            redirect('surat_keluar');
        }
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
                $btn= "<div class=\"btn-group\">
                  <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
                    <span class=\"caret\"></span>
                    <span class=\"sr-only\">Toggle Dropdown</span>
                  </button>
                  <ul class=\"dropdown-menu\" role=\"menu\">
                    <li> <a href='surat_keluar/edit/$field->id'><i class=\"fa fa-edit text-warning\"> Edit</i></a></li>
                    <li><a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" id='hapus-sm' data-id='$field->id'><i class=\"fa fa-trash text-danger\"> Hapus</i></a></li>
                  </ul>
                </div>";
                
                $btn2= "<div class=\"btn-group\">
                  <button type=\"button\" class=\"btn btn-primary dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
                    <span class=\"caret\"></span>
                    <span class=\"sr-only\">Toggle Dropdown</span>
                  </button>
                  <ul class=\"dropdown-menu\" role=\"menu\">
                    <li><a target='_blank' href='./assets/upload/$field->file'><i class=\"fa fa-file text-info\"> Lihat File</i></a></li>
                    <li> <a href='surat_keluar/edit/$field->id'><i class=\"fa fa-edit text-warning\"> Edit</i></a></li>
                    <li><a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" id='hapus-sm' data-id='$field->id'><i class=\"fa fa-trash text-danger\"> Hapus</i></a></li>
                  </ul>
                </div>";
                
                // Memanggil data dari tabel submenu
                $row[] = '<font class="text-primary font-weight-bold">'.$field->no_agenda.'</font>';
                $row[] = $field->no_surat;
                if ($field->sifat=="Rahasia") {
                     $row[] = '<font class="text-danger font-weight-bold">'.$field->sifat.'</font>';
                }else{
                     $row[] = '<font class="text-primary font-weight-bold">'.$field->sifat.'</font>';
                }
               
                $row[] = $field->perihal;
                $row[] = $field->tanggal_surat;
                $row[] = $field->tujuan_surat;
                $row[] = $field->asal_surat;
                $row[] = $field->isi;
                if ($field->jenis_surat=="Baru") {
                    $row[] = '<font class="text-primary font-weight-bold">'.$field->jenis_surat.'</font>';
                }else{
                    $row[] = '<font class="text-danger font-weight-bold">'.$field->jenis_surat.'</font>';
                }
                
                $row[] = $field->tanggal_dibuat;
                if (empty($field->file)) {
                  $row[] = $btn;
                }else{
                  $row[] = $btn2;  
                }
                
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

    public function delete()
    {
        $id = $this->input->post('id');
        $data['crud'] = $this->sk->getSK($id);
        $this->db->delete('surat_keluar', ['id' => $id]);
        $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire({
        position: \'top-end\',
        icon: \'success\',
        title: \'<font class="text-danger">Data Berhasil Dihapus !!</font>\',
        showConfirmButton: false,
        timer: 1500
        })
        </script>');
        redirect('surat_keluar');
    }

    public function edit($id){
        $data['parent'] = 'Surat Keluar';
        $data['title'] = 'Edit Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->m->edit($where,'surat_keluar')->row_array();
        $this->template->render_page('surat_keluar/edit', $data);
        
    }
    public function update(){
            $id = $this->input->post('id');
            $no_surat = $this->input->post('no_surat');
            $perihal = $this->input->post('perihal');
            $jenis_surat = $this->input->post('jenis_surat');
            $tanggal_surat = $this->input->post('tanggal_surat');
            $tujuan_surat = $this->input->post('tujuan_surat');
            $asal_surat = $this->input->post('asal_surat');
            $isi = $this->input->post('isi');
            $sifat = $this->input->post('sifat');
            $no_agenda = $this->input->post('no_agenda');
            $tanggal_dibuat = $this->input->post('tanggal_dibuat');
            $pemohon = $this->input->post('pemohon');
            $alamat = $this->input->post('alamat');
           
            $data['surat'] = $this->db->get_where('surat_keluar', ['id' => $id])->row_array();

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
                redirect('surat_keluar/edit/' . $id);
            }
        }

            $this->db->set('no_surat', $no_surat);
            $this->db->set('perihal', $perihal);
            $this->db->set('jenis_surat', $jenis_surat);
            $this->db->set('tanggal_surat', $tanggal_surat);
            $this->db->set('tujuan_surat', $tujuan_surat);
            $this->db->set('asal_surat', $asal_surat);
            $this->db->set('isi', $isi);
            $this->db->set('sifat', $sifat);
            $this->db->set('no_agenda', $no_agenda);
            $this->db->set('tanggal_dibuat', $tanggal_dibuat);
            $this->db->set('pemohon', $pemohon);
            $this->db->set('alamat', $alamat);
            $this->db->where('id', $id);
            $this->db->update('surat_keluar');
            $this->session->set_flashdata('message', '<script type="text/javascript">
                Swal.fire(
                \'Data Surat Keluar Telah Berhasil Diubah!\',
                \'\',
                \'success\')</script>');
            redirect('surat_keluar');
    }
    public function ad()
    {
        $data['parent'] = 'Arsip Digital';
        $data['title'] = 'Surat Keluar';
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
        $this->db->or_like('tujuan_surat',$data['keyword']);
        $where = "Rahasia";
        $this->db->where('sifat !=',$where);
        $this->db->from('surat_keluar');
        $url = (isset($_SERVER['HTTPS']) ? "https://" : "http://"); 
        $url .= $_SERVER['HTTP_HOST']. str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
        $config['base_url'] = $url.'surat_keluar/ad';
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
        $data['sm'] = $this->sk->ad($config['per_page'],$data['start'],$data['keyword']);
        $this->template->render_page('surat_keluar/ad', $data);
    }
    
}
