<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('M_basic'));
		$this->load->helper(array('url','form'));
		$this->load->library(array('form_validation','session'));
	}

	public function index() {
		$this->load->view('main/front');
	}

	public function login() {
		$data = array(
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('main/login',$data);
	}

	public function doLogin() {
		$username = $this->input->post('username');

		$where = array('username' => $username);

		$dataUser = $this->M_basic->read_where('st_user',$where)->row();
		if (password_verify($this->input->post('password'), $dataUser->password) && $dataUser->deleted == 'no') {
			$data_session = array(
				'username' => $username,
				'status' => 'login',
				'user' => $this->M_basic->read_where('st_user',$where)->row()
			);

			$this->session->set_userdata($data_session);
			$data_user = $this->M_basic->read_where('st_user',$where)->row();
			
			if($data_user->level == 'fakultas') {
				redirect(base_url('Fakultas/dashboard'));
			} elseif ($data_user->level == 'prodi') {
				redirect(base_url('Prodi/suratList'));
			} elseif ($data_user->level == 'dekan') {
				redirect(base_url('Dekan/dashboard'));
			} elseif ($data_user->level == 'wadek1') {
				redirect(base_url('Wadek1/dashboard'));
			} elseif ($data_user->level == 'wadek2') {
				redirect(base_url('Wadek2/dashboard'));
			} elseif ($data_user->level == 'katu') {
				redirect(base_url('Katu/dashboard'));
			} elseif ($data_user->level == 'keuangan') {
				redirect(base_url('Keuangan/dashboard'));
			}
			//print_r($data_session);
		} else {
			$this->session->set_flashdata('msg', 'Username atau Password Salah');
			redirect(base_url('Main/login'));
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url('Main/login'));
	}

	public function addUser() {
		$data = array(
			'username' => 'keuangan',
			'password' => password_hash('keuangan',PASSWORD_BCRYPT),
			'level' => 'keuangan'
		);

		$this->M_basic->create($data,'st_user');
	}

	public function testPDF() {
		$file1 = base_url('dokumen/doc.pdf');
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $file1 . '"');
		header('Conten-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		@readfile($file1);
	}
}