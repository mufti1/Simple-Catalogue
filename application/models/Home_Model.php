<?php 
	/**
	* 
	*/
	class Home_Model extends CI_Model
	{
		
		public function view_all($config){
			$this->db->order_by('id_content', 'DESC');
			$hasilquery=$this->db->get('content', $config['per_page'], $this->uri->segment(3));

			if ($hasilquery->num_rows() > 0) {
				foreach($hasilquery->result() as $value){
					$data[]=$value;
				}
				return $data;
			}
		}

		public function search($judul){
			$this->db->like('judul', $judul);
			return $this->db->get('content')->result();
		}

		public function kategori($kategori){
			$this->db->where('kategori', $kategori);
			return $this->db->get('content')->result();
		}

		public function lab($lab){
			$this->db->where('laboratorium', $lab);
			return $this->db->get('content')->result();
		}

		public function detail($id_content){
			$this->db->where('id_content', $id_content);
			return $this->db->get('content')->row();
		}

		public function comment($id_content){
			$this->db->where('id_content', $id_content);
			return $this->db->get('comment')->result();
		}

		public function add_comment(){
			$data = array(
				"username" => $this->input->post('username'),
				"komentar" => $this->input->post('komentar'),
				"id_content" => $this->input->post('id_content'),
				"img_path" => $this->input->post('img_path')
			);
			$this->db->insert('comment', $data);
		}
	}
	?>