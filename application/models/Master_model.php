<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{

    public function page_getSubMenu($limit,$start,$keyword = null)
    {
        if ($keyword) {
          $this->db->like('title',$keyword);
           $this->db->or_like('sort',$keyword);
        }
        
        return  $this->db->get('user_sub_menu',$limit,$start)->result_array();
    }
    
    function edit($where,$table){      
        return $this->db->get_where($table,$where);
    }
    function update($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function delete($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    function riwayat($where,$table){
        $this->db->select('pinjam.*,
            buku.nama as nama_buku, anggota.nama as nama_anggota,anggota.nis as nis

            ');
        $this->db->join('buku','pinjam.id_buku = buku.id');
        $this->db->join('anggota','pinjam.id_anggota = anggota.id');
        return $this->db->get_where($table,$where);
    }
    function riwayat_kembali($where,$table){
        $this->db->select('kembali.*,
            buku.nama as nama_buku, anggota.nama as nama_anggota,anggota.nis as nis,pinjam.tanggal_pinjam as tanggal_pinjam, pinjam.batas_pinjam as batas_pinjam

            ');
        $this->db->join('buku','kembali.id_buku = buku.id');
        $this->db->join('anggota','kembali.id_anggota = anggota.id');
        $this->db->join('pinjam','kembali.id_pinjam = pinjam.id');
        return $this->db->get_where($table,$where);
    }

}
