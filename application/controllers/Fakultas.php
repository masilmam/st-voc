<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fakultas extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('M_basic','M_surat'));
		$this->load->helper(array('url','form'));
		$this->load->library(array('form_validation','upload','session'));

		if($this->session->userdata('status') != 'login') {
			redirect(base_url('Main/login'));
		}

		$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();
		if($data_user->level != 'fakultas') {
			redirect(base_url('Main/login'));
		}
	}

	public function dashboard() {
		$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();

		$data = array(
			'suratRequest' => $this->M_surat->jml_surat(array(1,2,3,4,5)),
			'suratAccept' => $this->M_surat->jml_surat(array(6,7)),
			'suratDeclined' => $this->M_surat->jml_surat(array(8)),
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('fakultas/dashboard.php',$data);
	}

	public function prodiList() {
		$data = array(
			'departemenList' => $this->M_basic->read_where('st_departemen',array('deleted' => 'no'))->result(),
			'prodiList' => $this->M_basic->prodi_joinDepartemen(array('p.deleted' => 'no'))->result(), 
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('fakultas/prodiList',$data);
	}

	public function doAddProdi() {
		$this->form_validation->set_rules('id_departemen','Nama Departemen','required');
		$this->form_validation->set_rules('nama_prodi','Nama Program Studi','required');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			//kembali ke hal prodiList
			$data = array(
				'departemenList' => $this->M_basic->read_where('st_departemen',array('deleted' => 'no'))->result(),
				'prodiList' => $this->M_basic->prodi_joinDepartemen(array('p.deleted' => 'no'))->result(), 
				'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
				'msg' => $this->session->flashdata('msg')
			);
			$this->load->view('fakultas/prodiList',$data);
		} else {
			//proses
			$data = array(
				'id_departemen' => $this->input->post('id_departemen'),
				'nama_prodi' => $this->input->post('nama_prodi')
			);

			$this->M_basic->create($data,'st_prodi');
			$this->session->set_flashdata('msg', 'Tambah Program Studi berhasil');
			redirect(base_url('Fakultas/prodiList'));
		} //end form validation
	} //end doAddProdi

	public function editProdi($id) {
		$data = array(
			'prodiDetail' => $this->M_basic->prodi_joinDepartemen(array('id_prodi' => $id, 'p.deleted' => 'no'))->row(), 
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('fakultas/editProdi',$data);
	}

	public function doEditProdi() {
		$this->form_validation->set_rules('id_departemen','Nama Departemen','required');
		$this->form_validation->set_rules('nama_prodi','Nama Program Studi','required');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			//kembali ke hal editProdi
			$data = array(
				'prodiDetail' => $this->M_basic->prodi_joinDepartemen(array('id_prodi' => $this->input->post('id_prodi'), 'p.deleted' => 'no'))->row(), 
				'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
				'msg' => $this->session->flashdata('msg')
			);
			$this->load->view('fakultas/editProdi',$data);
		} else {
			//proses
			$data = array('nama_prodi' => $this->input->post('nama_prodi'));
			$where = array('id_prodi' => $this->input->post('id_prodi'));

			$this->M_basic->update('st_prodi',$data,$where);
			$this->session->set_flashdata('msg', 'Edit data Program Studi berhasil');
			redirect(base_url('Fakultas/prodiList'));
		} //end form validation
	} //end doEditProdi

	public function deleteProdi($id) {
		$data = array('deleted' => 'yes');
		$where = array('id_prodi' => $id);
		$this->M_basic->update('st_prodi',$data,$where);

		$this->session->set_flashdata('msg', 'Hapus data Program Studi berhasil');
		redirect(base_url('fakultas/prodiList'));
	}

	public function suratList() {
		$data = array(
			'suratList' => $this->M_surat->read_surat()->result(),
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'msg' => $this->session->flashdata('msg')
		);

		$this->load->view('fakultas/suratList',$data);	
	}

	public function userProdiList() {
		$data = array(
			'prodiList' => $this->M_basic->prodi_joinDepartemen(array('p.deleted' => 'no'))->result(),
			'userList' => $this->M_basic->user_joinProdiDepartemen(array('u.deleted' => 'no'))->result(),
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'msg' => $this->session->flashdata('msg')
		);

		$this->load->view('fakultas/userProdiList',$data);
	}

	public function doAddUserProdi() {
		$cek = $this->M_basic->cek('st_user',array('username' => $this->input->post('username')));
		if($cek > 0) {
			$this->session->set_flashdata('msg', 'Username sudah digunakan');
			redirect(base_url('Fakultas/userProdiList'));
		}

		$data = array(
			'id_prodi' => $this->input->post('id_prodi'),
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'),PASSWORD_BCRYPT),
			'level' => 'prodi'
		);

		$this->M_basic->create($data,'st_user');
		$this->session->set_flashdata('msg', 'Tambah user program studi berhasil');
		redirect(base_url('Fakultas/userProdiList'));
	}

	public function deleteUser($id) {
		$where = array('id_user' => $id);
		$this->M_basic->delete('st_user',$where);

		$this->session->set_flashdata('msg', 'Hapus user program studi berhasil');
		redirect(base_url('Fakultas/userProdiList'));
	}

	public function resetPassword($id) {
		$data = array('password' => password_hash('qwerty1234',PASSWORD_BCRYPT));
		$where = array('id_user' => $id);
		$this->M_basic->update('st_user',$data,$where);

		$this->session->set_flashdata('msg', 'Password berhasil direset menjadi: '.'qwerty1234');
		redirect(base_url('Fakultas/userProdiList'));
	}
}

?>