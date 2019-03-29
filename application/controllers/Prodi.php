<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model(array('M_basic','M_surat'));
		$this->load->helper(array('url','form'));
		$this->load->library(array('form_validation','upload','session'));

		if($this->session->userdata('status') != 'login') {
			redirect(base_url('Main/login'));
		}

		$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();
		if($data_user->level != 'prodi') {
			redirect(base_url('Main/login'));
		}
	}

	public function suratList() {
		$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();
		
		$where_dosen = array(
			'deleted' => 'no',
			'id_prodi' => $data_user->id_prodi
		);

		$where_surat = array(
			's.deleted' => 'no',
			'p.id_prodi' => $data_user->id_prodi
		);

		$data = array(
			'dosenList' => $this->M_basic->read_where('st_dosen',$where_dosen)->result(),
			'suratList' => $this->M_surat->read_surat_where($where_surat)->result(),
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('prodi/suratList',$data);
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

	public function doAddSurat() {
		$this->form_validation->set_rules('peserta1', 'Peserta 1', 'required');
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
		$this->form_validation->set_rules('judul_kegiatan', 'Judul Kegiatan', 'required');
		$this->form_validation->set_rules('tempat_kegiatan', 'Institusi / Tempat', 'required');
		$this->form_validation->set_rules('nama_kegiatan', 'Nama Kegiatan', 'required');
		$this->form_validation->set_rules('tgl_berangkat', 'Tanggal Mulai Menjalankan Tugas', 'required|callback_valid_date');
		$this->form_validation->set_rules('tgl_kembali', 'Tanggal Selesai Menjalankan Tugas', 'required|callback_valid_date');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			//kembali ke hal suratList
			$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();
			
			$where_dosen = array(
				'deleted' => 'no',
				'id_prodi' => $data_user->id_prodi
			);

			$data = array(
				'dosenList' => $this->M_basic->read_where('st_dosen',$where_dosen)->result(),
				'suratList' => $this->M_surat->read_surat()->result(),
				'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
				'msg' => $this->session->flashdata('msg')
			);
			$this->load->view('prodi/suratList',$data);
		} else {
			//proses
			$config['upload_path'] = './dokumen/';
			$config['allowed_types'] = '*';
			$config['max_size'] = 2048;
			$config['overwrite'] = FALSE;
			$this->upload->initialize($config, FALSE);

			if($this->upload->do_upload('dokumen')) {
				if($this->upload->data('file_ext') != '.pdf') {
					//ekstensi bukan PDF
					$this->session->set_flashdata('msg', 'Harap upload file dengan ekstensi .pdf');
					redirect(base_url('Prodi/suratList'));
				} // end if cek ekstensi
				//upload berhasil & proses input database
				$namaPeserta1 = $this->M_basic->read_where('st_dosen',array('id_dosen' => $this->input->post('peserta1')))->row();
				$peserta1 = $namaPeserta1->nama_dosen;
				$nip1 = $namaPeserta1->nip;
				$pangkat1 = $namaPeserta1->pangkat;
				$jabatan1 = $namaPeserta1->jabatan;

				if(empty($this->input->post('peserta2'))) {
					$peserta2 = '';
					$nip2 = '';
					$pangkat2 = '';
					$jabatan2 = '';
				} else {
					$namaPeserta2 = $this->M_basic->read_where('st_dosen',array('id_dosen' => $this->input->post('peserta2')))->row();
					$peserta2 = $namaPeserta2->nama_dosen;
					$nip2 = $namaPeserta2->nip;
					$pangkat2 = $namaPeserta2->pangkat;
					$jabatan2 = $namaPeserta2->jabatan;
				}

				if(empty($this->input->post('peserta3'))) {
					$peserta3 = '';
					$nip3 = '';
					$pangkat3 = '';
					$jabatan3 = '';
				} else {
					$namaPeserta3 = $this->M_basic->read_where('st_dosen',array('id_dosen' => $this->input->post('peserta3')))->row();
					$peserta3 = $namaPeserta3->nama_dosen;
					$nip3 = $namaPeserta3->nip;
					$pangkat3 = $namaPeserta3->pangkat;
					$jabatan3 = $namaPeserta3->jabatan;
				}

				if(empty($this->input->post('peserta4'))) {
					$peserta4 = '';
					$nip4 = '';
					$pangkat4 = '';
					$jabatan4 = '';
				} else {
					$namaPeserta4 = $this->M_basic->read_where('st_dosen',array('id_dosen' => $this->input->post('peserta4')))->row();
					$peserta4 = $namaPeserta4->nama_dosen;
					$nip4 = $namaPeserta4->nip;
					$pangkat4 = $namaPeserta4->pangkat;
					$jabatan4 = $namaPeserta4->jabatan;
				}
				$data = array(
					'id_prodi' => $this->input->post('id_prodi'),
					'peserta1' => $peserta1,
					'peserta2' => $peserta2,
					'peserta3' => $peserta3,
					'peserta4' => $peserta4,
					'nip1' => $nip1,
					'nip2' => $nip2,
					'nip3' => $nip3,
					'nip4' => $nip4,
					'pangkat1' => $pangkat1,
					'pangkat2' => $pangkat2,
					'pangkat3' => $pangkat3,
					'pangkat4' => $pangkat4,
					'jabatan1' => $jabatan1,
					'jabatan2' => $jabatan2,
					'jabatan3' => $jabatan3,
					'jabatan4' => $jabatan4,
					'nama_kegiatan' => $this->input->post('nama_kegiatan'),
					'judul_kegiatan' => $this->input->post('judul_kegiatan'),
					'tempat_kegiatan' => $this->input->post('tempat_kegiatan'),
					'tgl_berangkat' => $this->input->post('tgl_berangkat'),
					'tgl_kembali' => $this->input->post('tgl_kembali'),
					'tgl_permohonan' => date('Y-m-d'),
					'dokumen' => $this->upload->data('file_name'),
					'status' => 1
				);

				//input DB
				$this->M_basic->create($data,'st_surat');
				$this->session->set_flashdata('msg', 'Permohonan berhasil');
				redirect(base_url('Prodi/suratList'));
			} else {
				//upload gagal
				$this->session->set_flashdata('msg', 'Upload file gagal, silahkan ulangi');
				redirect(base_url('Prodi/suratList'));
				/*print_r($this->upload->data());
				echo $this->upload->display_errors();*/
			} //end if upload file
		} // end if form validation

		
	} // end doAddSurat

	public function suratDetail($id) {
		$data = array(
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'suratDetail' => $this->M_surat->read_surat_where(array('id_surat' => $id))->row(),
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('prodi/suratDetail',$data);
	}

	public function dokumen($dokumen) {
		$file1 = base_url('dokumen/').$dokumen;
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $file1 . '"');
		header('Conten-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		@readfile($file1);
	}

	public function dosenList() {
		$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();
		
		$where_dosen = array(
			'deleted' => 'no',
			'id_prodi' => $data_user->id_prodi
		);

		$data = array(
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'dosenList' => $this->M_basic->read_where('st_dosen',$where_dosen)->result(),
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('prodi/dosenList',$data);
	}

	public function doAddDosen() {
		$this->form_validation->set_rules('nama_dosen', 'Nama Dosen', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required|is_natural');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'required');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('is_natural', '{field} hanya boleh diisi dengan angka');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			//kembali ke hal dosenList
			$data_user = $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row();
		
			$where_dosen = array(
				'deleted' => 'no',
				'id_prodi' => $data_user->id_prodi
			);

			$data = array(
				'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
				'dosenList' => $this->M_basic->read_where('st_dosen',$where_dosen)->result(),
				'msg' => $this->session->flashdata('msg')
			);
			$this->load->view('prodi/dosenList',$data);
		} else {
			//proses
			$data = array(
				'id_prodi' => $this->input->post('id_prodi'),
				'nip' => $this->input->post('nip'),
				'nama_dosen' => $this->input->post('nama_dosen'),
				'pangkat' => $this->input->post('pangkat'),
				'jabatan' => $this->input->post('jabatan')
			);
			$this->M_basic->create($data,'st_dosen');
			$this->session->set_flashdata('msg','Tambah data dosen berhasil');
			redirect(base_url('Prodi/dosenList'));
		}
	} //end doAddDosen

	public function editDosen($id) {
		$data = array(
			'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
			'dosen' => $this->M_basic->read_where('st_dosen',array('id_dosen' => $id))->row(),
			'msg' => $this->session->flashdata('msg')
		);
		$this->load->view('prodi/editDosen',$data);	
	}

	public function doEditDosen() {
		$this->form_validation->set_rules('nama_dosen', 'Nama Dosen', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required|is_natural');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('pangkat', 'Pangkat', 'required');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('is_natural', '{field} hanya boleh diisi dengan angka');
		$this->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			//kembali ke hal editDosen
			$data = array(
				'userDetail' => $this->M_basic->read_where('st_user',array('username' => $this->session->userdata('username')))->row(),
				'dosen' => $this->M_basic->read_where('st_dosen',array('id_dosen' => $this->input->post('id_dosen')))->row(),
				'msg' => $this->session->flashdata('msg')
			);
		$this->load->view('prodi/editDosen',$data);	
		} else {
			//proses
			$data = array(
				'nip' => $this->input->post('nip'),
				'nama_dosen' => $this->input->post('nama_dosen'),
				'pangkat' => $this->input->post('pangkat'),
				'jabatan' => $this->input->post('jabatan')
			);
			
			$this->M_basic->update('st_dosen',$data,array('id_dosen' => $this->input->post('id_dosen')));
			$this->session->set_flashdata('msg', 'Edit data dosen berhasil');
			redirect(base_url('Prodi/editDosen/').$this->input->post('id_dosen'));
		}
	} //end doEditDosen

	public function deleteDosen($id) {
		$this->M_basic->delete('st_dosen',array('id_dosen' => $id));
		$this->session->set_flashdata('msg','Hapus data dosen berhasil');
		redirect(base_url('Prodi/dosenList'));
	}
}