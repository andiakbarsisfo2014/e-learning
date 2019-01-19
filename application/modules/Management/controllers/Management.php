<?php
	/**
	* 
	*/
	class Management extends MX_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
			if (!$this->session->userdata('data_id')) {
				redirect(base_url('user/login'));
			}
			else{
				if ($this->session->userdata('level') != 'admin') {
					$this->load->view('error404');
				}
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
							// if (!$this->session->userdata('data_id')) {
							// 	redirect(base_url('administrator/login'));
							// }
							// else {
							// 	if ($this->session->userdata('as') != 'Admin') {
							// 		$this->my_error();
							// 	}
							// 	else{
									$this->$realPath($param);
							// 	}
							// }
						}
					}
					else{
						// if (!$this->session->userdata('data_id')) {
						// 	redirect(base_url('administrator/login'));
						// }
						// else{
						// 	if ($this->session->userdata('as') != 'Admin') {
						// 		$this->lanjutan('my_error',null);
						// 	}
						// 	else{
								$this->lanjutan($realPath,$param);
						// 	}
						// }
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
							// if (!$this->session->userdata('data_id')) {
							// 	redirect(base_url('administrator/login'));
							// }
							// else{
							// 	if ($this->session->userdata('as') != 'Admin') {
							// 		$this->my_error();
							// 	}
							// 	else{
									$this->$_path($pa);								
							// 	}
							// }
						}
					}
					else{
						// if (!$this->session->userdata('data_id')) {
						// 	redirect(base_url('administrator/login'));
						// }
						// else{
						// 	if ($this->session->userdata('as') != 'Admin') {
						// 		$this->lanjutan('my_error',null);
						// 	}
							// else{
								$this->lanjutan($_path,$pa);								
						// 	}
						// }
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
							// if (!$this->session->userdata('data_id')) {
							// 	redirect(base_url('administrator/login'));
							// }
							// else{
							// 	if ($this->session->userdata('as') != 'Admin') {
							// 		$this->my_error();
							// 	}
							// 	else{
									$this->$method();
							// 	}
							// }
						}
					}
					else{
						// if (!$this->session->userdata('data_id')) {
						// 	redirect(base_url('administrator/login'));
						// }
						// else{
						// 	if ($this->session->userdata('as') != 'Admin') {
						// 		$this->lanjutan('my_error',null);
						// 	}
							// else{
								$this->lanjutan($method,null);								
						// 	}
						// }
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

		public function my_error()
		{
			$this->load->view('error404');
		}

		public function index()
		{
			$this->load->view('admin/index');
		}
		public function get_ajax()
		{
			$this->load->model('m_datatables');
			$model = $this->m_datatables->get_datatables('tbl_user',array('id_user','nama','level'),array('id_user','nama','level'),['id_user'=>'ASC']);
			$data = array();
			$row = array();
			foreach ($model as $key) {
				$row['id_user'] = $key->id_user;
				$row['nama'] = $key->nama;
				$row['level'] = $key->level;
				$row['url']['reset'] = base_url('administrator/management/').$this->ubah->encode('forReset/'.$key->id_user);
				$row['url']['edit'] = base_url('administrator/management/').$this->ubah->encode('forUpdate/'.$key->id_user);
				$row['url']['delete'] = base_url('administrator/management/').$this->ubah->encode('forDelete/'.$key->id_user);
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

		public function forReset($id)
		{
			$this->load->model('m_manage');
			$data = [ 'password' => $this->ubah->encode($id) ];
			if ($this->m_manage->update('tbl_user',$data,['id_user'=>$id])) {
				$res = ['execute'=>true,'message'=>'Sandi Baru '.$id];
			}
			else{
				$res = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}
			echo json_encode(array('respon'=>$res));
		}

		public function _form()
		{
			$this->load->view('admin/_form',['model'=>null]);
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
			$id_user = $this->input->post('id_user');
			$nama = $this->input->post('nama');
			$level = $this->input->post('level');
			$kata_sandi = $this->input->post('kata_sandi');
			$konfirm = $this->input->post('konfirm');

			if (trim($id_user) == '' || trim($nama) == '' || trim($level) == '') {
				$data = ['execute'=>false,'message'=>'Lengkapi data'];
			}
			else{
				$this->load->model('m_manage');
				if ($action == 'save') {
					if (trim($kata_sandi) == '') {
						$data = ['execute' => false, 'message' => 'Masukkan Sandi'];
					}
					elseif ($kata_sandi != $konfirm) {
						$data = ['execute' => false, 'message' => 'Kata sandi tidak cocok'];
					}
					else{
						if ($this->m_manage->get_where('tbl_user',['id_user'=>$id_user])->num_rows() > 0) {
							$data = ['execute'=>false,'message'=>'ID Telah digunakan'];
						}
						else{
							$value = ['id_user'=>$id_user,'nama'=>$nama, 'level' => $level, 'password' => $this->ubah->encode($kata_sandi)];
							if ($this->m_manage->save('tbl_user',$value)) {
								$data = ['execute'=>true];
							}
							else{
								$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
							}
						}
					}

				}
				else{
					$value = ['nama'=>$nama, 'level' => $level];
					if ($this->m_manage->update('tbl_user',$value,['id_user'=>$this->input->post('kode')])) {
						$data = ['execute'=>true];
					}
					else{
						$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
					}
				}
			}
			echo json_encode(array('respon'=>$data));
		}

		public function forUpdate($id)
		{
			$this->load->model('m_manage');
			$model = $this->m_manage->get_where('tbl_user',['id_user'=>$id])->row();
			$this->load->view('admin/_form',['model'=>$model]);
		}

		public function forDelete($id)
		{
			$this->load->model('m_manage');
			if ($this->m_manage->delete('tbl_user',['id_user'=>$id])) {
				$data = ['execute'=>true];
			}
			else{
				$data = ['execute'=>false,'message'=>'terjadi kesalahan'];
			}

			echo json_encode(array('respon'=>$data));
		}
	}
?>