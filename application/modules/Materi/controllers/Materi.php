<?php

	/**
	* 
	*/
	class Materi extends MX_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
			if (!$this->session->userdata('data_id')) {
				redirect(base_url('administrator/login'));
			}
			else{
				if ($this->session->userdata('as') == 'Admin') {
					$this->load->view('error404');
				}
			}
			$tbl = 'tbl_'.strtolower($this->session->userdata('as'));
			$field = 'id_'.strtolower($this->session->userdata('as'));
			$data = $this->m_umum->get_where($tbl,[$field => $this->session->userdata('data_id')])->row();
			if (!is_null($data->img)) {
				$this->session->set_userdata('img',$data->img);
			}
		}

		public function path()
		{
			$method = $this->ubah->decode($this->uri->segment(3));
			$path = explode('/',$method);
			if (count($path) == 2) {
				$realPath = $path[0];
				$param = $path[1];
				if (method_exists($this,$realPath)) {
					if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
						if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
							$this->$realPath($param);
						}
					}
					else{
						$this->lanjutan($realPath,$param);
					}
				}
				else
					echo " Tidak ada 2";
			}
			elseif (count($path) > 1) {
				$pa = array();
				$_path = $path[0];
				for ($i=1; $i < count($path) ; $i++) {
					$pa[] =$path[$i];
				}
				if (method_exists($this,$_path)) {
					if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
						if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
							$this->$_path($pa);
						}
					}
					else{
						$this->lanjutan($_path,$pa);
					}
				}
				else{
					echo "tidak ada > 1";
				}
			}
			else{
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

		}
		public function lanjutan($param,$realParam)
		{
			$this->load->view('_head');
			if (is_null($realParam)) {
				$this->$param();
			}
			else{
				$this->$param($realParam);
			}
			$this->load->view('_foot');
		}

		public function index()
		{
			$this->load->view('index');
		}

		public function get_ajax()
		{
			$this->load->model('m_datatables');
			$model = $this->m_datatables->get_datatables();
			$data = array();
			$row = array();
			foreach ($model as $key) {
				$row['id_materi'] = $key->id_materi;
				$row['nama_mapel'] = $key->nama_mapel;
				$row['judul'] = $key->judul;
				$row['materi'] = $key->materi;
				$row['video'] = $key->video;

				$row['url']['edit'] = base_url('administrator/materi/').$this->ubah->encode('forUpdate/'.$key->id_materi);
				$row['url']['delete'] = base_url('administrator/materi/').$this->ubah->encode('forDelete/'.$key->id_materi);
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

		public function _form(){
			$this->load->model('m_data');
			$mapel = $this->m_data->get_where('tbl_mapel',['id_guru' => $this->session->userdata('data_id')])->row();
			$this->load->view('_form',['model'=>null,'mapel' => $mapel]);
		}


		public function save()
		{
			$this->action('save');
		}

		public function update()
		{
			$this->action('update');
		}

		public function action($action)
		{
			$kode = $this->input->post('kode');
			$judul = $this->input->post('judul');
			$slug = url_title(strtolower($judul)).'.html';
			$this->load->model('m_data');
			if (trim($kode) == '' || trim($judul) == '') {
				$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
			}
			else{
				if ($action == 'save') {
					$upload_pdf = $this->uploadFile($_FILES['pdf']['name'],'pdf');
					if ($upload_pdf['execute']) {
						$pdf_name = $upload_pdf['file_name'];
						$upload_video = $this->uploadFile($_FILES['video']['name'],'video');
						if ($upload_video['execute']) {
							$video_name = $upload_video['file_name'];
							$value = ['judul' => $judul, 'materi' => $pdf_name, 'video' => $video_name, 'id_mapel' => $kode, 'slug' => $slug];
							if ($this->m_data->insert('tbl_materi',$value)) {
								$respon = ['execute' => true];
							}
							else{
								$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
							}
						}
						else{
							$respon = ['execute' => false, 'message' => $upload_video['message']];
						}
					}
					else{
						$respon = ['execute' => false, 'message' => $upload_pdf['message']];
					}
				}
				elseif ($action == 'update') {
					if (trim($_FILES['pdf']['name']) == '' && trim($_FILES['video']['name']) == '') {
						$value = ['judul' => $judul,'slug' => $slug];
						if ($this->m_data->update('tbl_materi',$value,['id_materi' => $this->input->post('id_materi')])) {
							$respon = ['execute' => true];
						}
						else{
							$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
						}
					}
					elseif (trim($_FILES['pdf']['name']) != '' && trim($_FILES['video']['name']) == '') {
						$upload_pdf = $this->uploadFile($_FILES['pdf']['name'],'pdf');
						if ($upload_pdf['execute']) {
							$value = ['judul' => $judul,'materi' => $upload_pdf['file_name'], 'slug' => $slug];
							if ($this->m_data->update('tbl_materi',$value,['id_materi' => $this->input->post('id_materi')])) {
								$respon = ['execute' => true];
							}
							else{
								$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
							}
						}
						else{
							$respon = ['execute' => false, 'message' => $upload_pdf['message']];
						}
					}
					elseif (trim($_FILES['pdf']['name']) == '' && trim($_FILES['video']['name']) != '') {
						$upload_video = $this->uploadFile($_FILES['video']['name'],'video');
						if ($upload_video['execute']) {
							$value = ['judul' => $judul,'video' => $upload_video['file_name'], 'slug' => $slug];
							if ($this->m_data->update('tbl_materi',$value,['id_materi' => $this->input->post('id_materi')])) {
								$respon = ['execute' => true];
							}
							else{
								$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
							}
						}
						else{
							$respon = ['execute' => false, 'message' => $upload_video['message']];
						}
					}
					else{
						$upload_pdf = $this->uploadFile($_FILES['pdf']['name'],'pdf');
						if ($upload_pdf['execute']) {
							$upload_video = $this->uploadFile($_FILES['video']['name'],'video');
							if ($upload_video['execute']) {
								$value = ['judul' => $judul,'materi' => $upload_pdf['file_name'] ,'video' => $upload_video['file_name'], 'slug' => $slug];
								if ($this->m_data->update('tbl_materi',$value,['id_materi' => $this->input->post('id_materi')])) {
									$respon = ['execute' => true];
								}
								else{
									$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
								}
							}
							else{
								$respon = ['execute' => false, 'message' => $upload_video['message']];
							}
						}
						else{
							$respon = ['execute' => false, 'message' => $upload_pdf['message']];
						}
					}
				}
			}
			echo json_encode(array('respon' => $respon));
		}

		public function uploadFile($name,$type)
		{
			$judul = str_replace(' ','-',$this->input->post('judul'));
			$config['allowed_types']  = 'pdf|docx|mp4';		
			if ($type == 'pdf') {
				$config['upload_path'] 	  = './materi/pdf/';	
				$config['file_name']	  = $this->input->post('kode').'_'.$judul.'.'.pathinfo($name,PATHINFO_EXTENSION);
			}
			elseif ($type == 'video'){
				$config['upload_path'] 	  = './materi/video/';	
				$config['file_name']	  = $this->input->post('kode').'_'.$judul.'.'.pathinfo($name,PATHINFO_EXTENSION);
			}
			if (file_exists($config['upload_path'].$config['file_name'])) {
				unlink($config['upload_path'].$config['file_name']);
			}
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload($type)) {
				$respon = ['execute' => false,'message' => $this->upload->display_errors()];
			}
			else{
				$respon = ['execute' => true, 'file_name' => $this->upload->data('file_name')];
			}

			return $respon;

		}

		public function forUpdate($id)
		{
			$this->load->model('m_data');
			$mapel = $this->m_data->get_where('tbl_mapel',['id_guru' => $this->session->userdata('data_id')])->row();
			$model = $this->m_data->get_where('tbl_materi',['id_materi' => $id])->row();
			$this->load->view('_form',['model'=>$model,'mapel' => $mapel]);
		}

		public function forDelete($id)
		{
			$this->load->model('m_data');
			$data = $this->m_data->get_where('tbl_materi',['id_materi' => $id])->row();
			if (file_exists('./materi/pdf/'.$data->materi)) {
				unlink('./materi/pdf/'.$data->materi);
			}

			if (file_exists('./materi/video/'.$data->video)) {
				unlink('./materi/video/'.$data->video);
			}

			if ($this->m_data->delete('tbl_materi',['id_materi' => $id])) {
				$respon = ['execute' => true];
			}
			else{
				$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
			}

			echo json_encode(array('respon' => $respon));
		}
	}

?>