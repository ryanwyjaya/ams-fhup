<?php
class Inbox_model extends CI_Model
{
    var $column_order = ['surat_masuk.id', 'surat_masuk.no_surat', 'perihal', 'tanggal_surat', '','user_role.role']; // Field yang bisa orderable
    var $column_search = ['surat_masuk.id', 'surat_masuk.no_surat','user_role.role','tanggal_surat']; // field yang diizin utk pencarian 
    var $order = ['surat_masuk.id' => 'desc']; // default order 

    private function _get_datatables_query()
    {
        $user = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = $user['role_id'];
        $this->db->select('surat_masuk.*,user_role.role

            ');
        $this->db->where('surat_masuk.tujuan_surat',$where);
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

    
    public function getdispo($id = false)
    {
        if ($id == false) {
            $this->db->order_by('id', 'ASC');
            return $this->db->get('disposisi')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('disposisi')->row_array();
        }
    }

    var $column_order_d = ['surat_masuk.id', 'surat_masuk.no_surat','surat_masuk.asal_surat','disposisi.tanggal_disposisi','disposisi.isi','disposisi.dikembalikan','disposisi.tindakan','disposisi.status','']; // Field yang bisa orderable
    var $column_search_d = ['surat_masuk.no_surat','surat_masuk.asal_surat','disposisi.tanggal_disposisi']; // field yang diizin utk pencarian 
    var $order_d = ['surat_masuk.id' => 'desc']; // default order 

    private function _get_datatables_query_d()
    {
        $user = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = $user['role_id'];
        $this->db->select('surat_masuk.*,user_role.role,disposisi.tanggal_disposisi,disposisi.dikembalikan,disposisi.status as ds,disposisi.tindakan,disposisi.isi,disposisi.id as param

            ');
        $this->db->where('disposisi.tujuan',$where);
        $this->db->join('surat_masuk','disposisi.id_surat_masuk = surat_masuk.id');
        $this->db->join('user_role','surat_masuk.tujuan_surat = user_role.id');
        $this->db->from('disposisi'); // disposisi adalah table

        $i = 0;

        foreach ($this->column_search_d as $item) // looping awal
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

                if (count($this->column_search_d) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order_d[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_d)) {
            $order_d = $this->order_d;
            $this->db->order_by(key($order_d), $order_d[key($order_d)]);
        }
    }

    function get_datatables_d()
    {
        $this->_get_datatables_query_d();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_d()
    {
        $this->_get_datatables_query_d();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_d()
    {
        $this->db->from('disposisi');
        return $this->db->count_all_results();
    }
    

    
    
}
