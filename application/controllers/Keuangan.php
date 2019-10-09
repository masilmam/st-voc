<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuangan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('M_basic','M_surat'));
		$this->load->helper(array('url','form'));
		$this->load->library(array('form_validation','upload','session'));

		if($this->session->userdata('status') != 'login') {
			redirect(base_url('Main/login'));
		}

		$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();
		if($data_user->level != 'keuangan') {
			redirect(base_url('Main/login'));
		}
	}

	public function dashboard() {
		$data = array(
			'suratList' => $this->M_surat->read_surat_where(array('status' => 6))->result(),
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'active' => 'Dashboard',
			'judul' => 'Dashboard',
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('header/keuangan',$data);
		$this->load->view('keuangan/dashboard',$data);
		$this->load->view('v_footer');
	}

	public function suratList() {
		$data = array(
			'suratList' => $this->M_surat->read_surat()->result(),
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'active' => 'Data Surat Tugas',
			'judul' => 'Data Surat Tugas',
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('header/keuangan',$data);
		$this->load->view('keuangan/suratList',$data);
		$this->load->view('v_footer');
	}

	public function suratDetail($id) {
		$data = array(
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'suratDetail' => $this->M_surat->read_surat_where(array('id_surat' => $id))->row(),
			'disposisi' => $this->M_basic->read_where('st_disposisi',array('id_surat' => $id))->result(),
			'active' => 'Data Surat Tugas',
			'judul' => 'Detail Surat Tugas',
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('header/keuangan',$data);
		$this->load->view('keuangan/suratDetail',$data);
		$this->load->view('v_footer');
	}

	public function dokumen($dokumen) {
		$file1 = base_url('dokumen/').$dokumen;
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $file1 . '"');
		header('Conten-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		@readfile($file1);
	}
}