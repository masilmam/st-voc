<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_basic extends CI_Model {
	public function create($data,$table) {
		$this->db->insert($table,$data);
	}

	public function read() {

	}

	public function read_where($table,$where) {
		$this->db->where($where);
		return $this->db->get($table);
	}

	public function update($table,$data,$where) {
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function delete($table,$where) {
		$this->db->delete($table,$where);
	}

	public function cek($table,$where) {
		$this->db->where($where);
		$query = $this->db->get($table);
		return $query->num_rows();
	}

	public function prodi_joinDepartemen($where) {
		$this->db->select('*');
		$this->db->from('st_prodi p');
		$this->db->join('st_departemen d', 'd.id_departemen = p.id_departemen');
		$this->db->where($where);
		return $this->db->get();
	}

	public function user_joinProdiDepartemen($where) {
		$this->db->select('*');
		$this->db->from('st_prodi p');
		$this->db->join('st_user u', 'u.id_prodi = p.id_prodi');
		$this->db->join('st_departemen d', 'd.id_departemen = p.id_departemen');
		$this->db->where($where);
		return $this->db->get();
	}
}