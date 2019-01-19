<?php

	/**
	* 
	*/
	class Home extends MX_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
			// if (!$this->session->userdata('data_id')) {
			// 	redirect(base_url('user/login'));
			// }
			// else{
			// 	if ($this->session->userdata('level') != 'admin') {
			// 		$this->load->view('error404');
			// 	}
			// }
		}

		public function path()
		{
			$method = $this->uri->segment(2);
			if (method_exists($this,$method)) {
				if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
					if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
						$this->$method();
					}
				}
				else{
					$this->lanjutan($method,null);								
				}
			}
			else
				echo " Tidak ada else";
		}

		public function lanjutan($param,$realParam)
		{
			$this->load->view('front/_head');
			if (is_null($realParam)) {
				$this->$param();
			}
			else{
				$this->$param($realParam);
			}
			$this->load->view('front/_foot');
		}

		public function index()
		{
			$this->load->model('m_umum');
			$model = $this->m_umum->get('tbl_pelayanan')->result();
			$this->load->view('front/_head');
			$this->load->view('index',['model' => $model]);
			$this->load->view('front/_foot');
		}

		public function antrian()
		{
			$this->load->view('antrian');
		}

		public function terbit()
		{
			$this->load->view('terbit');
		}

		public function get_ajax()
		{
			$this->load->model('m_datatables');
			$model = $this->m_datatables->get_datatables();
			$data = array();
			$row = array();
			foreach ($model as $key) {
				$row['no_kk'] = $key->no_kk;
				$row['no_ktp'] = $key->no_ktp;
				$row['nama'] = $key->nama;
				$row['berkas'] = $key->nama_berkas;
				$row['tgl'] = $key->tgl_stor;
				if ($key->status == 'true') {
					$row['status'] = '<span class="label label-success">Send</span>';
				}
				else{
					$row['status'] = '<span class="label label-warning">Pending</span>';
				}

				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_datatables->count_all(),
				"recordsFiltered" => $this->m_datatables->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		}

		public function panggil()
		{
			$this->load->model('antrian');
			echo json_encode($this->antrian->panggil());
		}

		public function getNumber()
		{
			$this->load->model('antrian');
			$r = $this->antrian->setNumber();
			if (!is_null($r)) {
				echo json_encode(['id' => $r->id]);
			}
			else{
				echo json_encode(['id' => 1]);
			}
		}
	}
?>