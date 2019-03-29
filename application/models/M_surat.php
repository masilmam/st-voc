<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_surat extends CI_Model {
	public function read_surat() {
		$this->db->select('*');
		$this->db->from('st_surat s');
		$this->db->join('st_prodi p', 'p.id_prodi = s.id_prodi');
		$this->db->join('st_departemen d', 'd.id_departemen = p.id_departemen');
		return $this->db->get();
	}

	public function read_surat_where($where) {
		$this->db->select('*');
		$this->db->from('st_surat s');
		$this->db->join('st_prodi p', 'p.id_prodi = s.id_prodi');
		$this->db->join('st_departemen d', 'd.id_departemen = p.id_departemen');
		$this->db->where($where);
		return $this->db->get();
	}

	public function read_surat_where_in($where) {
		$this->db->select('*');
		$this->db->from('st_surat s');
		$this->db->join('st_prodi p', 'p.id_prodi = s.id_prodi');
		$this->db->join('st_departemen d', 'd.id_departemen = p.id_departemen');
		$this->db->where_in('status',$where);
		return $this->db->get();
	}

	public function cek_no_surat() {
		$this->db->select('*');
		$this->db->from('st_surat');
		$this->db->order_by('no_surat', 'DESC');
		$this->db->limit(1);
		return $this->db->get();
	}

	public function jml_surat($where) {
		$this->db->where_in('status',$where);
		$query = $this->db->get('st_surat');
		return $query->num_rows();
	}
}