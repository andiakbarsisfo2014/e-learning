<?php

	/**
	* 
	*/
	class Soal extends MX_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
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
							if (!$this->session->userdata('data_id')) {
								redirect(base_url('administrator/login'));
							}
							else {
								// if ($this->session->userdata('as') != 'Admin') {
								// 	$this->my_error();
								// }
								// else{
									$this->$realPath($param);
								// }
							}
						}
					}
					else{
						if (!$this->session->userdata('data_id')) {
							redirect(base_url('administrator/login'));
						}
						else{
							// if ($this->session->userdata('as') != 'Admin') {
							// 	$this->lanjutan('my_error',null);
							// }
							// else{
								$this->lanjutan($realPath,$param);
							// }
						}
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
							if (!$this->session->userdata('data_id')) {
								redirect(base_url('administrator/login'));
							}
							else{
								// if ($this->session->userdata('as') != 'Admin') {
								// 	$this->my_error();
								// }
								// else{
									$this->$_path($pa);								
								// }
							}
						}
					}
					else{
						if (!$this->session->userdata('data_id')) {
							redirect(base_url('administrator/login'));
						}
						else{
							// if ($this->session->userdata('as') != 'Admin') {
							// 	$this->lanjutan('my_error',null);
							// }
							// else{
								$this->lanjutan($_path,$pa);								
							// }
						}
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
							if (!$this->session->userdata('data_id')) {
								redirect(base_url('administrator/login'));
							}
							else{
								// if ($this->session->userdata('as') != 'Admin') {
								// 	$this->my_error();
								// }
								// else{
									$this->$method();
								// }
							}
						}
					}
					else{
						if (!$this->session->userdata('data_id')) {
							redirect(base_url('administrator/login'));
						}
						else{
							// if ($this->session->userdata('as') != 'Admin') {
							// 	$this->lanjutan('my_error',null);
							// }
							// else{
								$this->lanjutan($method,null);								
							// }
						}
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
			$this->load->model('m_data');
			$model = $this->m_data->get_where('tbl_mapel',['id_guru' => $this->session->userdata('data_id')])->row();
			$this->load->view('soal/index',['model'=>$model]);
		}

		public function my_error()
		{
			$this->load->view('error404');
		}

		public function get_ajax()
		{
			$this->load->model('m_soal');
			$model = $this->m_soal->get_datatables();
			$data = array();
			$row = array();
			foreach ($model as $key) {
				$row['judul'] = $key->judul;
				$row['soal'] = $key->soal;
				if (strtolower($key->benar) == 'a') {
					$row['a'] = '<span class="label label-success">'.$key->a.'</span>';
					$row['b'] = $key->b; $row['c'] = $key->c; $row['d'] = $key->d;
				}
				elseif (strtolower($key->benar) == 'b') {
					$row['a'] = $key->a;
					$row['b'] = '<span class="label label-success">'.$key->b.'</span>';
					 $row['c'] = $key->c; $row['d'] = $key->d;
				}
				elseif (strtolower($key->benar) == 'c') {
					$row['a'] = $key->a;
					$row['b'] = $key->b; 
					$row['c'] = '<span class="label label-success">'.$key->c.'</span>';
					$row['d'] = $key->d;
				}
				else {
					$row['a'] = $key->a; $row['b'] = $key->b;
					$row['c'] = $key->c; $row['d'] = '<span class="label label-success">'.$key->d.'</span>';
				}
				$row['url']['edit'] = base_url('administrator/soal/'.$this->ubah->encode('forUpdate/'.$key->id_soal));
				$row['url']['delete'] = base_url('administrator/soal/'.$this->ubah->encode('forDelete/'.$key->id_soal));
				$row['url']['detail'] = base_url('administrator/soal/'.$this->ubah->encode('detail/'.$key->id_soal));
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_soal->count_all(),
				"recordsFiltered" => $this->m_soal->count_filtered(),
				"data" => $data,
			);
			echo json_encode($output);
		}

		public function get_materi()
		{
			$this->load->model('m_data');
			$model = $this->m_data->get_materi($this->input->post('kode'),['a.id_guru' => $this->session->userdata('data_id')]);
			echo json_encode($model);
		}

		public function _form()
		{
			$this->load->view('soal/_form',['model'=>NULL]);
		}

		public function table()
		{
			$this->load->view('soal/table');
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
			$kode_materi = $this->input->post('materi');
			$soal = $this->input->post('soal');
			$a = $this->input->post('a');
			$b = $this->input->post('b');
			$c = $this->input->post('c');
			$d = $this->input->post('d');
			$img_soal = $_FILES['img_soal']['name'];
			$img_a = $_FILES['img_a']['name'];
			$img_b = $_FILES['img_b']['name'];
			$img_c = $_FILES['img_c']['name'];
			$img_d = $_FILES['img_d']['name'];
			if (trim($kode_materi) == '') {
				$respon = ['execute' => false, 'message' => 'Pilih materi'];
			}
			else{
				$this->load->model('m_data');
				if ($action == 'save') {
					if ((trim($soal) == '' && trim($img_soal) == '') || (trim($a) == '' && trim($img_a) == '') || (trim($b) == '' && trim($img_b) == '') || (trim($c) == '' && trim($img_c) == '') || (trim($d) == '' && trim($img_d) == '')) {
						$respon = ['execute' => false, 'message' => 'Lengkapi pilihan Tesk atau Gambar'];
					}
					else{
						$s_ = $this->img_exist($img_soal, 'img_soal','soal');
						$a_ = $this->img_exist($img_a, 'img_a','a');
						$b_ = $this->img_exist($img_b, 'img_b','b');
						$c_ = $this->img_exist($img_c, 'img_c','c');
						$d_ = $this->img_exist($img_d, 'img_d','d');
						$value = ['soal' => $soal, 'a' => $a, 'b' => $b, 'c' => $c, 'd' => $d, 'id_materi' => $kode_materi, 'img_soal' => $s_['file_name'], 'img_a' => $a_['file_name'], 'img_b' => $b_['file_name'], 'img_c' => $c_['file_name'], 'img_d' => $d_['file_name'], 'benar' => $this->input->post('true')];
						if ($this->m_data->insert('tbl_soal',$value)) {
							$respon = ['execute' => true];
						}
						else{

							$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
						}
					}
				}
				else{
					$model = $this->m_data->get_where('tbl_soal',['id_soal' => $this->input->post('kode')])->row();
					$_img_a = $this->input->post('_img_a');
					$_img_b = $this->input->post('_img_b');
					$_img_c = $this->input->post('_img_c');
					$_img_d = $this->input->post('_img_d');
					$_img_soal = $this->input->post('_img_soal');
					if ((trim($soal) == '' && trim($_img_soal) == '') || (trim($a) == '' && trim($_img_a) == '') || (trim($b) == '' && trim($_img_b) == '') || (trim($c) == '' && trim($_img_c) == '') || (trim($d) == '' && trim($_img_d) == '')) {
						$respon = ['execute' => false, 'message' => 'Lengkapi pilihan Teks atau Gambar'];
					}
					else{
						$s_ = $this->img_exist($img_soal, 'img_soal','soal');
						$isValid = true;
						$msg = '';
						if ($s_['execute'] && $s_['ada_gambar']) {
							$model->img_soal = $s_['file_name'];
						}
						elseif (!$s_['execute'] && $s_['ada_gambar']){
							$isValid = false;
							$msg = $s_['message'];
						}
						$a_ = $this->img_exist($img_a, 'img_a','a');
						if ($a_['execute'] && $a_['ada_gambar']) {
							$model->a = $a_['file_name'];
						}
						elseif (!$a_['execute'] && $a_['ada_gambar']){
							$isValid = false;
							$msg = $a_['message'];
						}
						$b_ = $this->img_exist($img_b, 'img_b','b');
						if ($b_['execute'] && $b_['ada_gambar']) {
							$model->b = $b_['file_name'];
						}
						elseif (!$b_['execute'] && $b_['ada_gambar']){
							$isValid = false;
							$msg = $b_['message'];
						}
						$c_ = $this->img_exist($img_c, 'img_c','c');
						if ($c_['execute'] && $c_['ada_gambar']) {
							$model->c = $c_['file_name'];
						}
						elseif (!$c_['execute'] && $c_['ada_gambar']){
							$isValid = false;
							$msg = $c_['message'];
						}
						$d_ = $this->img_exist($img_d, 'img_d','d');
						if ($d_['execute'] && $d_['ada_gambar']) {
							$model->d = $d_['file_name'];
						}
						elseif (!$d_['execute'] && $d_['ada_gambar']){
							$isValid = false;
							$msg = $d_['message'];
						}
						if ($isValid) {
							$model->soal = $soal;
							$model->a = $a;
							$model->b = $b;
							$model->c = $c;
							$model->d = $d;
							$model->id_materi = $kode_materi;
							$model->benar = $this->input->post('true');
							if ($this->m_data->update('tbl_soal',get_object_vars($model),['id_soal' => $this->input->post('kode')])) {
								$respon = ['execute' => true];
							}
							else{
								$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
							}
						}
						else{
							$respon = ['execute' => false, 'message' => $msg];
						}

					}
				}
			}
			echo json_encode(array('respon' => $respon));
		}
		public function updaloadFile($img,$post,$pilihan)
		{
			$this->load->model('m_data');
			$model = $this->m_data->get_where('tbl_soal',['id_materi' => $this->input->post('materi')]);
			$m = $model->row();
			$jml = $model->num_rows();
			if (is_null($m)) {
				$file_name = 'soal_1_'.$pilihan.'_'.$this->input->post('materi').'.'.pathinfo($img,PATHINFO_EXTENSION);
			}
			else{
				$file_name = 'soal_'.$jml.'_'.$pilihan.'_'.$this->input->post('materi').'.'.pathinfo($img,PATHINFO_EXTENSION);
			}
			$config['upload_path']          = './soal/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['file_name']			= $file_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload($post)) {
            	return $respon = ['execute' => false, 'ada_gambar' => true, 'message' => $this->upload->display_errors()];
            }
            else{
            	return $respon = ['execute' => true, 'ada_gambar' => true ,'file_name' => $this->upload->data('file_name')];
            }
		}

		public function img_exist($img, $post, $pilihan)
		{
			if (trim($img) == '') {
				$r = ['execute' => false, 'ada_gambar' => false , 'file_name' => NULL];
				return $r;
			}
			else{
				return $this->updaloadFile($img,$post,$pilihan);
			}
		}

		public function detail($id)
		{
			$this->load->model('m_data');
			$model = $this->m_data->get_where('tbl_soal',['id_soal' =>$id])->row();
			$this->load->view('soal/detail',['model' => $model]);
		}

		public function forUpdate($id)
		{
			$this->load->model('m_data');
			$model = $this->m_data->where_join('tbl_soal','tbl_materi','tbl_soal.id_materi = tbl_materi.id_materi',['id_soal' => $id])->row();

			$this->load->view('soal/_form',['model' => $model]);
		}

		public function forDelete($id)
		{
			$this->load->model('m_data');
			if ($this->m_data->delete('tbl_soal',['id_soal' => $id])) {
				$respon = ['execute' => true];
			}
			else{
				$respon = ['execute' => false, 'message' => 'terjadi kesalahan'];
			}

			echo json_encode(['respon' => $respon]);
		}
	}
?>