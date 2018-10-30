<?php
	/**
	* 
	*/
	class Belajar extends MX_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('ubah');
		}

		public function path()
		{
			$method = $this->uri->segment(1);
			if (method_exists($this,$method)) {
				if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
					if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

						if (!is_null($this->uri->segment(2)) && is_null($this->uri->segment(3))) {
							$this->$method($this->uri->segment(2));
						}
						elseif (!is_null($this->uri->segment(2)) && !is_null($this->uri->segment(3))){
							$this->$method($this->uri->segment(2),$this->uri->segment(3));
						}
						else{
							$this->$method();
						}
					}
				}
				else{
					if (!is_null($this->uri->segment(2)) && is_null($this->uri->segment(3))) {
						// $this->$method($this->uri->segment(2));
						$this->lanjutan($method,$this->uri->segment(2));
					}
					elseif (!is_null($this->uri->segment(2)) && !is_null($this->uri->segment(3))){
						// $this->$method($this->uri->segment(2),$this->uri->segment(3));
						$this->lanjutan($method,$this->uri->segment(2),$this->uri->segment(3));
					}
					else{
						$this->lanjutan($method);
						// $this->$method();
					}
					// if (is_null($this->uri->segment(2))) {
					// 	$this->lanjutan($method,null);
					// }
					// else{
					// 	$this->lanjutan($method,$this->uri->segment(2));
					// }
				}
			}
			else
				echo "Not Found";
		}
		public function lanjutan($param,$realParam,$par3 = null)
		{
			$this->load->view('siswa_template/_head');
			if (is_null($realParam)) {
				$this->$param();
			}
			else{
				$this->$param($realParam,$par3);
			}
			$this->load->view('siswa_template/_foot');
		}

		public function belajar($id)
		{
			$this->load->model('m_belajar');
			$model = $this->m_belajar->get_where('tbl_mapel',['slug' =>$id ])->row();
			if (is_null($model)) {
				echo "Not Found";
			}
			else{
				$this->load->view('materi',['model' => $model ]);
			}
		}

		public function get_belajar()
		{
			$this->load->model('m_server');
			
			$this->m_server->initialize(['a.slug' => $this->input->post('url')], $this->input->post('posisi'));
			
			$model = $this->m_server->get_data();
			$method = $this->input->post('method');
			if ($method == 'next') {
				if ($this->m_server->count() - intval($this->m_server->get_data()->num_rows()) > 10) {
					$show_next = true;
					$show_prev = true;
				}
				else{
					$show_next = false;
					$show_prev = true;
				}
			}
			elseif ($method == 'first') {
				if ($this->m_server->get_data()->num_rows() >= 10) {
					$show_next = true;
					$show_prev = false;
				}
				else{
					$show_next = false;
					$show_prev = false;
				}
			}
			else{
				if ($this->m_server->get_data()->num_rows() > 10) {
					$show_next = true;
					$show_prev = true;
				}
				else{
					$show_next = true;
					$show_prev = false;
				}
			}
			echo json_encode(['respon' => ['model' => $model->result(), 'posisi' => $this->input->post('posisi'), 'show_next' => $show_next, 'show_prev' => $show_prev]]);
		}

		public function materi($id,$d)
		{
			$slug_m = $id.'.html';
			$slug_ = $d;
			$this->load->model('m_belajar');
			$model = $this->m_belajar->join('tbl_mapel a','tbl_materi b','a.id_mapel = b.id_mapel',['a.slug' => $slug_m, 'b.slug' => $slug_])->row();
			$this->load->view('belajar',['model' => $model]);
		}

		public function soal($d,$a)
		{
			if (!$this->session->userdata('siswa_id')) {
				$this->load->view('login');
			}
			else{
				$this->load->view('soal');
			}
		}

		public function get_soal($posisi, $materi)
		{
			$this->load->model('m_belajar');
			$limit = ($posisi * 10) - 10;
			$model = $this->m_belajar->join2('tbl_materi a','tbl_soal b','a.id_materi = b.id_materi',['a.slug' => $materi],$limit);
			$jml = $this->m_belajar->join('tbl_materi a','tbl_soal b','a.id_materi = b.id_materi',['a.slug' => $materi])->num_rows();
			if (is_int($jml / 10)) {
				$jml = $jml / 10;
			}
			else{
				$d = explode('.',$jml / 10);
				$jml = $d[0] + 1;				
			}
			$data = ['execute' => true, 'model' => $model->result(), 'jml' => $jml, 'current' => $posisi];
			echo json_encode(['respon' =>$data ]);
		}

		public function kirim_jawaban($slug)
		{
			$this->load->model('m_belajar');
			$model = $this->m_belajar->join('tbl_materi a','tbl_soal b','a.id_materi = b.id_materi',['a.slug' => $slug])->result();
			if (is_null($model)) {
				$data = ['execute' => false, 'message' => 'terjadi kesalahan'];
			}
			else{
				$jawaban = $this->input->post('jawaban');
				$benar = 0;
				$found = [];
				$id_soal = '';
				foreach ($model as $key) {
					for ($i=0; $i < count($jawaban); $i++) { 
						if ($jawaban[$i]['id_soal'] == $key->id_soal) {
							$id_soal = $key->id_soal;
							if ($jawaban[$i]['jawaban'] == $key->benar) {
								$benar++;	
							} 	
							break;
						}
					}
				}
				$value = ['id_soal' => $id_soal, 'id_siswa' => $this->session->userdata('siswa_id'), 'nilai' => $benar];
				if ($this->m_belajar->insert('tbl_nilai',$value)) {
					$data = ['execute' => true, 'data' => $benar];	
				}
				else{
					$data = ['execute' => false, 'message' => 'terjadi kesalahan'];
				}
			}
			echo json_encode(['respon' => $data]);
		}

		public function nilai()
		{
			$this->load->model('m_belajar');
			$model = $this->m_belajar->join3('tbl_nilai a','tbl_soal b','a.id_soal = b.id_soal','tbl_materi c','b.id_materi = c.id_materi','tbl_mapel d','c.id_mapel = d.id_mapel',['a.id_siswa' => $this->session->userdata('siswa_id')])->result();
			$this->load->view('nilai',['model' => $model]);
		}
	}
?>