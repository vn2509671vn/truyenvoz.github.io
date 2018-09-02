<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$this->load->library('pagination');
		$this->load->model("admin_management_model");
		$this->load->model("common_model");
		
		$offset = $this->uri->segment(2);
		$litmit = 15;
		
        /*Pagination*/
        $config['base_url'] = base_url() . 'trang-chu/';
        $config['total_rows'] = $this->admin_management_model->getListProductNumrow();
        $config['uri_segment'] = 2;
        $config['per_page'] = $litmit;
        $config['prev_link'] = '&lt;';
        $config['next_link'] = '&gt;';
        $config['last_link'] = 'Cuối';
        $config['first_link'] = 'Đầu';
        $this->pagination->initialize($config);
        /*Pagination*/
        $data['parinator'] = $this->pagination->create_links();
        $data['listProduct'] = $this->admin_management_model->getListProductParameters($litmit, $offset);
        $data['lstTopProduct'] = $this->common_model->getTopStory();
    	$this->load->view('common/homepage', $data);
	}
	
	public function getDetail($name, $id){
		$this->load->model("common_model");
		
		$this->common_model->updateView($id);
        $data['productDetail'] = $this->common_model->getDetail($id);
        $data['lstTopProduct'] = $this->common_model->getTopStory();
    	$this->load->view('common/postdetail', $data);
	}
	
	public function getSearchDetail($txtSearch){
		$this->load->model("common_model");
		$keyword = urldecode($txtSearch);
		
        $data['lstProduct'] = $this->common_model->getSearchDetail($keyword);
        $data['keyword'] = $keyword;
        $data['lstTopProduct'] = $this->common_model->getTopStory();
    	$this->load->view('common/searchdetail', $data);
	}
	
	public function getFullStory(){
		$this->load->library('pagination');
		$this->load->model("common_model");
		
		$offset = $this->uri->segment(2);
		$litmit = 15;
		
        /*Pagination*/
        $config['base_url'] = base_url() . 'fullstory/';
        $config['total_rows'] = $this->common_model->getFullStoryNumrow();
        $config['uri_segment'] = 2;
        $config['per_page'] = $litmit;
        $config['prev_link'] = '&lt;';
        $config['next_link'] = '&gt;';
        $config['last_link'] = 'Cuối';
        $config['first_link'] = 'Đầu';
        $this->pagination->initialize($config);
        /*Pagination*/
		$data['parinator'] = $this->pagination->create_links();
        $data['lstProduct'] = $this->common_model->getFullStory($litmit, $offset);
        $data['lstTopProduct'] = $this->common_model->getTopStory();
    	$this->load->view('common/fullstory', $data);
	}
	
	public function getFullStoryDetail($name, $cat_id){
		$this->load->model("common_model");
		
        $data['lstProduct'] = $this->common_model->getFullStoryDetail($cat_id);
        $data['catName'] = $this->common_model->getCategory($cat_id);
        $data['lstTopProduct'] = $this->common_model->getTopStory();
    	$this->load->view('common/fullstorydetail', $data);
	}
	
	public function getPartStory(){
		$this->load->library('pagination');
		$this->load->model("common_model");
		
		$offset = $this->uri->segment(2);
		$litmit = 15;
		
        /*Pagination*/
        $config['base_url'] = base_url() . 'fullstory/';
        $config['total_rows'] = $this->common_model->getPartStoryDetailNumrow();
        $config['uri_segment'] = 2;
        $config['per_page'] = $litmit;
        $config['prev_link'] = '&lt;';
        $config['next_link'] = '&gt;';
        $config['last_link'] = 'Cuối';
        $config['first_link'] = 'Đầu';
        $this->pagination->initialize($config);
        /*Pagination*/
        
		$data['parinator'] = $this->pagination->create_links();
        $data['lstProduct'] = $this->common_model->getPartStoryDetail($litmit, $offset);
        $data['catName'] = "Những Mẫu Truyện Ngắn Ý Nghĩa";
        $data['lstTopProduct'] = $this->common_model->getTopStory();
    	$this->load->view('common/partstorydetail', $data);
	}
}
