<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->library('pagination');
		$this->load->database();
		$this->load->model('Home_Model');
	}

	public function index(){
		//konfig pagination
		
		$config['base_url'] = base_url()."Home/index/";
		$config['total_rows'] = $this->db->query("SELECT * FROM content ORDER BY id_content desc")->num_rows();
		$config['per_page']=6;
		$config['num_links'] = 2;
		$config['uri_segment']=3;
		//Tambahan untuk styling
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		$config['first_link']='< Pertama ';
		$config['last_link']='Terakhir > ';
		$config['next_link']='> ';
		$config['prev_link']='< ';
		
		$this->pagination->initialize($config);
		
		$data['content']=$this->Home_Model->view_all($config);

		$this->load->view('template/header');
		$this->load->view('template/navbar-home');
		$this->load->view('home/home', $data);
		$this->load->view('template/footer');		
	}

	public function detail($id_content){
		$data['content']=$this->Home_Model->detail($id_content);
		$data['comment']=$this->Home_Model->comment($id_content);
		if ($this->input->post('submit')) {
			$this->Home_Model->add_comment();
			redirect('Home/detail/'.$id_content,'refresh');
		}
		else if(!$this->input->post('submit')){
			$this->load->view('template/header');
			$this->load->view('template/navbar-home');
			$this->load->view('home/detail', $data);
			$this->load->view('template/footer');
		}
	}

	public function search(){
		$judul = $this->input->get('judul');
		$data['content'] = $this->Home_Model->search($judul);
		$this->load->view('template/header');
		$this->load->view('template/navbar-home');
		$this->load->view('home/home', $data);
		$this->load->view('template/footer');
	}

	public function kategori(){
		$kategori = $this->input->get('kategori');
		$data['content']=$this->Home_Model->kategori($kategori);
		$this->load->view('template/header');
		$this->load->view('template/navbar-home');
		$this->load->view('home/home', $data);
		$this->load->view('template/footer');
	}

	public function lab(){
		$lab = $this->input->get('laboratorium');
		$data['content']=$this->Home_Model->lab($lab);
		$this->load->view('template/header');
		$this->load->view('template/navbar-home');
		$this->load->view('home/home', $data);
		$this->load->view('template/footer');
	}
}
?>