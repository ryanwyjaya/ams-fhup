<?php
class Agendasm_model extends CI_Model
{
    var $column_order = ['surat_masuk.id', 'surat_masuk.no_surat', 'perihal', 'tanggal_surat', '','user_role.role']; // Field yang bisa orderable
    var $column_search = ['surat_masuk.id', 'surat_masuk.no_surat','user_role.role','tanggal_surat','surat_masuk.nama_pengirim']; // field yang diizin utk pencarian 
    var $order = ['surat_masuk.no_agenda' => 'asc']; // default order 

    private function _get_datatables_query()
    {
        $this->db->select('surat_masuk.*,user_role.role

            ');
        $this->db->join('user_role','surat_masuk.tujuan_surat = user_role.id');
        $this->db->from('surat_masuk'); // surat_masuk adalah table

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('surat_masuk');
        return $this->db->count_all_results();
    }

    public function getSM($id = false)
    {
        if ($id == false) {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('surat_masuk')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('surat_masuk')->row_array();
        }
    }
     ///cetak periode

    function gettahun(){

        $query = $this->db->query("SELECT YEAR(tanggal_surat) AS tahun FROM surat_masuk GROUP BY YEAR(tanggal_surat) ORDER BY YEAR(tanggal_surat) ASC");

        return $query->result_array();

    }

    function filterbytanggal($tanggalawal,$tanggalakhir){

        $query = $this->db->query("SELECT * from surat_masuk  where tanggal_surat BETWEEN '$tanggalawal' and '$tanggalakhir' ORDER BY tanggal_surat ASC ");

        return $query->result_array();
    }

    function filterbybulan($tahun1,$bulanawal,$bulanakhir){

        $query = $this->db->query("SELECT * from surat_masuk where YEAR(tanggal_surat) = '$tahun1' and MONTH(tanggal_surat) BETWEEN '$bulanawal' and '$bulanakhir' ORDER BY tanggal_surat ASC ");

        return $query->result_array();
    }

    function filterbytahun($tahun2){

        $query = $this->db->query("SELECT * from surat_masuk  where YEAR(tanggal_surat) = '$tahun2'  ORDER BY tanggal_surat ASC ");

        return $query->result_array();
    }

    
    
}
