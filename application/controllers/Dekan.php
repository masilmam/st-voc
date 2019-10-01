<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dekan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('M_basic','M_surat'));
		$this->load->helper(array('url','form'));
		$this->load->library(array('form_validation','upload','session'));

		if($this->session->userdata('status') != 'login') {
			redirect(base_url('Main/login'));
		}

		$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();
		if($data_user->level != 'dekan') {
			redirect(base_url('Main/login'));
		}
	}

	public function dashboard() {
		$data = array(
			'suratList' => $this->M_surat->read_surat_where(array('status' => 1))->result(),
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'active' => 'Dashboard',
			'judul' => 'Dashboard',
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('header/dekan', $data);
		$this->load->view('dekan/dashboard',$data);
		$this->load->view('footer/dekan');
	}

	public function suratList() {
		$data = array(
			'suratList' => $this->M_surat->read_surat()->result(),
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'active' => 'Data Surat Tugas',
			'judul' => 'Data Surat Tugas',
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('header/dekan', $data);
		$this->load->view('dekan/suratList',$data);
		$this->load->view('footer/dekan', $data);
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
		$this->load->view('header/dekan',$data);
		$this->load->view('dekan/suratDetail',$data);
		$this->load->view('footer/dekan');
	}

	public function valid_date($str) {
		$d = DateTime::createFromFormat('Y-m-d', $str);

		if($d && $d->format('Y-m-d') === $str) {
			return TRUE;
		} else {
			$this->form_validation->set_message('valid_date', 'Silahkan masukkan format tanggal dengan benar (Y-m-d)');
			return FALSE;
		}
	}

	public function doAddDisposisi() {
		$this->form_validation->set_rules('disposisi', 'Tujuan Disposisi', 'required');
		$this->form_validation->set_rules('isi', 'Isi Disposisi', 'required');
		$this->form_validation->set_rules('sifat', 'Sifat', 'required');
		$this->form_validation->set_rules('batas_waktu', 'Batas Waktu', 'required|callback_valid_date');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			//kembali ke hal suratDetail
			$data = array(
				'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
				'suratDetail' => $this->M_surat->read_surat_where(array('id_surat' => $this->input->post('id_surat')))->row(),
				'disposisi' => $this->M_basic->read_where('st_disposisi',array('id_surat' => $this->input->post('id_surat')))->result(),
				'msg' => $this->session->flashdata('msg')
			);
			$this->load->view('dekan/suratDetail',$data);
		} else {
			//proses
			$data_disposisi = array(
				'id_surat' => $this->input->post('id_surat'),
				'disposisi' => $this->input->post('disposisi'),
				'isi' => $this->input->post('isi'),
				'sifat' => $this->input->post('sifat'),
				'batas_waktu' => $this->input->post('batas_waktu')
			);

			if ($this->input->post('disposisi') == 'Dari Dekan ke Wakil Dekan I') {
				$newStatus = 2;
			} else if ($this->input->post('disposisi') == 'Dari Dekan ke Wakil Dekan II') {
				$newStatus = 3;
			}

			$data_update_surat = array('status' => $newStatus);

			$this->M_basic->create($data_disposisi,'st_disposisi');
			$this->M_basic->update('st_surat',$data_update_surat,array('id_surat' => $this->input->post('id_surat')));

			$this->session->set_flashdata('msg', 'Disposisi berhasil');
			redirect(base_url('Dekan/suratDetail/').$this->input->post('id_surat'));
		} //end form validation
	} //end doAddDisposisi

	public function dokumen($dokumen) {
		$file1 = base_url('dokumen/').$dokumen;
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $file1 . '"');
		header('Conten-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		@readfile($file1);
	}
}