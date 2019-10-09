<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Katu extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('M_basic','M_surat'));
		$this->load->helper(array('url','form'));
		$this->load->library(array('form_validation','upload','session'));

		if($this->session->userdata('status') != 'login') {
			redirect(base_url('Main/login'));
		}

		$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();
		if($data_user->level != 'katu') {
			redirect(base_url('Main/login'));
		}
	}

	public function dashboard() {
		$data = array(
			'suratList' => $this->M_surat->read_surat_where_in(array(4,5))->result(),
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'active' => 'Dashboard',
			'judul' => 'Dashboard',
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('header/katu',$data);
		$this->load->view('katu/dashboard',$data);
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
		$this->load->view('header/katu',$data);
		$this->load->view('katu/suratList',$data);
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
		$this->load->view('header/katu',$data);
		$this->load->view('katu/suratDetail',$data);
		$this->load->view('v_footer');
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
				'active' => 'Data Surat Tugas',
				'judul' => 'Detail Surat Tugas',
				'msg' => $this->session->flashdata('msg')
			);
			$this->load->view('header/katu',$data);
			$this->load->view('katu/suratDetail',$data);
			$this->load->view('v_footer');
		} else {
			//proses
			$data_disposisi = array(
				'id_surat' => $this->input->post('id_surat'),
				'disposisi' => $this->input->post('disposisi'),
				'isi' => $this->input->post('isi'),
				'sifat' => $this->input->post('sifat'),
				'batas_waktu' => $this->input->post('batas_waktu')
			);

			$data_update_surat = array('status' => 6);

			$this->M_basic->create($data_disposisi,'st_disposisi');
			$this->M_basic->update('st_surat',$data_update_surat,array('id_surat' => $this->input->post('id_surat')));

			$this->session->set_flashdata('msg', 'Disposisi berhasil');
			redirect(base_url('Katu/suratDetail/').$this->input->post('id_surat'));
		} //end form validation
	} //end doAddDisposisi

	public function doEditSurat() {
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
		$this->form_validation->set_rules('judul_kegiatan', 'Judul Kegiatan', 'required');
		$this->form_validation->set_rules('tempat_kegiatan', 'Institusi / Tempat', 'required');
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
		$this->form_validation->set_rules('tgl_berangkat', 'Tanggal Mulai Menjalankan Tugas', 'required|callback_valid_date');
		$this->form_validation->set_rules('tgl_kembali', 'Tanggal Selesai Menjalankan Tugas', 'required|callback_valid_date');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			//kembali ke hal suratDetail
			$data = array(
				'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
				'suratDetail' => $this->M_surat->read_surat_where(array('id_surat' => $this->input->post('id_surat')))->row(),
				'disposisi' => $this->M_basic->read_where('st_disposisi',array('id_surat' => $this->input->post('id_surat')))->result(),
				'active' => 'Data Surat Tugas',
				'judul' => 'Detail Surat Tugas',
				'msg' => $this->session->flashdata('msg')
			);
			$this->load->view('header/katu',$data);
			$this->load->view('katu/suratDetail',$data);
			$this->load->view('v_footer');
		} else {
			//proses
			$data = array(
				'nama_kegiatan' => $this->input->post('nama_kegiatan'),
				'judul_kegiatan' => $this->input->post('judul_kegiatan'),
				'tempat_kegiatan' => $this->input->post('tempat_kegiatan'),
				'tgl_berangkat' => $this->input->post('tgl_berangkat'),
				'tgl_kembali' => $this->input->post('tgl_kembali')
			);
			$where = array('id_surat' => $this->input->post('id_surat'));

			$this->M_basic->update('st_surat',$data,$where);
			$this->session->set_flashdata('msg', 'Edit data surat tugas berhasil');
			redirect(base_url('Katu/suratDetail/').$this->input->post('id_surat'));
		} //end form validation
	} //end doEditSurat

	public function dokumen($dokumen) {
		$file1 = base_url('dokumen/').$dokumen;
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $file1 . '"');
		header('Conten-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		@readfile($file1);
	}

	public function approve() {
		$this->form_validation->set_rules('kode_surat', 'Kode Surat', 'required');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			//kembali ke hal suratDetail
			$data = array(
				'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
				'suratDetail' => $this->M_surat->read_surat_where(array('id_surat' => $this->input->post('id_surat')))->row(),
				'disposisi' => $this->M_basic->read_where('st_disposisi',array('id_surat' => $this->input->post('id_surat')))->result(),
				'active' => 'Data Surat Tugas',
				'judul' => 'Detail Surat Tugas',
				'msg' => $this->session->flashdata('msg')
			);
			$this->load->view('header/katu',$data);
			$this->load->view('katu/suratDetail',$data);
			$this->load->view('v_footer');
		} else {
			//proses
			//cek no surat terakhir
			$noSuratTerakhir = $this->M_surat->cek_no_surat()->row();
			$noSurat = str_pad($noSuratTerakhir->no_surat+1, 3, '0', STR_PAD_LEFT);

			//update no surat
			$data = array(
				'no_surat' => $noSurat,
				'kode_surat' => $this->input->post('kode_surat'),
				'tgl_surat' => date('Y-m-d'),
				'status' => 7
			);
			$where = array('id_surat' => $this->input->post('id_surat'));
			$this->M_basic->update('st_surat',$data,$where);

			$this->session->set_flashdata('msg', 'Nomor Surat Berhasil dibuat');
			redirect(base_url('Katu/suratDetail/').$this->input->post('id_surat'));
		} //end form validation	
	} //end approve

	public function cetak($id) {
		$data = array(
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'suratDetail' => $this->M_surat->read_surat_where(array('id_surat' => $id))->row()
		);
		$this->load->view('katu/cetak',$data);
	}
}