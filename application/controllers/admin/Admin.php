<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	
	/*
	Note: $body contains HTML code
	*/
	public function sendMail($recipient, $title, $body){
		$this->load->library('My_PHPMailer');
		$mail = new PHPMailer();

		$mail->isSMTP();                                   // Set mailer to use SMTP
		$mail->Host = 'dropshipplanner.com';                    // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                            // Enable SMTP authentication
		$mail->Username = 'thang@dropshipplanner.com';          // SMTP username
		$mail->Password = 'khaib12047071'; // SMTP password
		$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                 // TCP port to connect to
		$mail->CharSet = 'UTF-8';

		$mail->setFrom('thang@dropshipplanner.com', 'Admin');
		$mail->addAddress($recipient);   // Add a recipient

		$mail->isHTML(true);  // Set email format to HTML

		$bodyContent = $body;
		$footer = "<h3 style='color:red;text-align: center;'>ThangTGM.<h3>";
		$mail->Subject = $title;
		$mail->Body    = $bodyContent.$footer;
		
		if(!$mail->send()) {
			// $msg_result = 'Message could not be sent. <br>';
			// $msg_result .= 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		} else {
			//$msg_result = 'Message has been sent';
			return true;
		}
	}
	
	public function admin_home(){
		$data['error'] = null;
		$this->load->view('common/login', $data);
	}
	
	public function login(){
		//load model
		$this->load->model("admin_management_model");
		
		$account = $this->input->post('account');
		$pwd = $this->input->post('password');
		
		$logSuccess = $this->admin_management_model->loginUser($account, $pwd);
		if($logSuccess){
			$userData = $this->admin_management_model->getUserDetail($account);
			if(isset($userData)){
				$this->session->set_userdata('userInfo', $userData);
			}
			
			$data['userInfo'] = $this->session->userdata('userInfo');
			$data['title'] = "Admin";
        	$data['template'] = "admin/home";
    		$this->load->view('master_view', $data);
		}
		else {
			$data['error'] = "Login failed!!!";
			$this->load->view('common/login', $data);
		}
	}
    
    public function logout(){
		$this->session->unset_userdata('userInfo');
		redirect(base_url('login'));
	}
	
	public function register()
	{
		// create message
		$data = null;
		
		// load model
		$this->load->model("admin_management_model");
		
		// load validation library
		$this->load->library('My_PHPMailer');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Full name','trim|required');
        $this->form_validation->set_rules('account','Account','trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_emails');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('re_password', 'Password', 'trim|required');
        
	    if($this->form_validation->run() == true){
	    	$name = $this->input->post('name');
			$account = $this->input->post('account');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$re_password = $this->input->post('re_password');
			
			if($password == $re_password){
				$success = $this->admin_management_model->registerUser($name, $account, $email, $password);
				if($success){
					$data['msg'] = "Register successful!!!";
					
					// Send mail
					// $body = "Dear ".$name.",<br>";
					// $body .= "Thanks for creating a account. <br>";
					// $body .= "To continue, please login to your account by clicking this link xxx <br>";
					// $body .= "Hope that you will succeed! <br>";
					// $body .= "Regards, <br>";
					// $this->sendMail($email, 'Welcome to the website', $body);
				}
				else {
					$data['msg'] = "Email is exist!!!";
				}
			}
			else {
				$data['msg'] = "Passwords do not match.";
			}
			
			$data['isRegister'] = true;
	    }
	    $this->load->view("common/login", $data);
	}
	
	public function hasChild($list, $parent_id){
		foreach($list as $item){
			if($item['parent'] == $parent_id){
				return true;
			}
		}
		return false;
	}
	
	public function printCategory($list, $parent_id){
		$result = "";
		foreach($list as $item){
			if($item['parent'] == $parent_id){
				if($this->hasChild($list,  $item['cat_id'])){
					$result .= "<li><span data-id='".$item['cat_id']."' parent-id='".$item['parent']."' descript='".$item['description']."'><i class='node fa fa-minus-square'></i> ". $item['name'] ."</span>";
					$result .= "<ul>";
					$result .= $this->printCategory($list, $item['cat_id']);
					$result .= "</ul>";
				}
				else {
					$result .= "<li><span data-id='".$item['cat_id']."' parent-id='".$item['parent']."' descript='".$item['description']."'>". $item['name'] ."</span>";
				}
				$result .= "</li>";
			}
		}
		return $result;
	}
	
	public function printCategoryCheckbox($list, $parent_id){
		$result = "";
		foreach($list as $item){
			if($item['parent'] == $parent_id){
				if($this->hasChild($list,  $item['cat_id'])){
					$result .= "<li><span data-id='".$item['cat_id']."' parent-id='".$item['parent']."' descript='".$item['description']."'><i class='node fa fa-minus-square'></i> ". $item['name'] ."</span>";
					$result .= "<ul>";
					$result .= $this->printCategoryCheckbox($list, $item['cat_id']);
					$result .= "</ul>";
				}
				else {
					$result .= "<li><span data-id='".$item['cat_id']."' parent-id='".$item['parent']."' descript='".$item['description']."'><input type='checkbox' value='".$item['cat_id']."' name='category[]'/> ". $item['name'] ."</span>";
				}
				$result .= "</li>";
			}
		}
		return $result;
	}
	
	public function category(){
		$this->load->model("admin_management_model");
		$catList = $this->admin_management_model->getListCat();
		
		if(!$this->session->userdata('userInfo')){
			redirect(base_url('login'));
		}
		
		$result = "<div class='tree'>";
		$result .= "<ul>";
		$result .= $this->printCategory($catList, 0);
		$result .= "</ul>";
		$result .= "</div>";
		
		$data['userInfo'] = $this->session->userdata('userInfo');
		$data['title'] = "Admin | Danh mục loại truyện";
        $data['template'] = "admin/category";
        $data['catList'] = $result;
        $data['nodeList'] = $catList;
    	$this->load->view('master_view', $data);	
	}
	
	public function addCat(){
		$this->load->helper('mystr_helper');
		$this->load->model("admin_management_model");
		
		if(!$this->session->userdata('userInfo')){
			redirect(base_url('login'));
		}
		
		$name = $this->input->post('add_name');
		$slug = str_slug($name);
		$mota = $this->input->post('add_mota');
		$parent = $this->input->post('add_parent');
		
		$success = $this->admin_management_model->insertCat($name, $slug, $mota, $parent);
		if($success){
			$msg = "Thêm loại truyện thành công!";
		}
		else {
			$msg = "Thêm loại truyện không thành công!";
		}
		
		$catList = $this->admin_management_model->getListCat();
		$result = "<div class='tree'>";
		$result .= "<ul>";
		$result .= $this->printCategory($catList, 0);
		$result .= "</ul>";
		$result .= "</div>";
		
		$data['userInfo'] = $this->session->userdata('userInfo');
		$data['title'] = "Admin | Danh mục truyện";
        $data['template'] = "admin/category";
        $data['catList'] = $result;
        $data['nodeList'] = $catList;
        $data['msgForAdding'] = $msg;
    	$this->load->view('master_view', $data);
	}
	
	public function editCat(){
		$this->load->helper('mystr_helper');
		$this->load->model("admin_management_model");
		
		if(!$this->session->userdata('userInfo')){
			redirect(base_url('login'));
		}
		
		$submitType = $this->input->post('submit');
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$slug = str_slug($name);
		$mota = $this->input->post('mota');
		$parent = $this->input->post('parent');
		if($submitType == "Edit"){
			$acceptEdit = $this->admin_management_model->acceptEdit($id, $parent);
			if($acceptEdit){
				$success = $this->admin_management_model->editCat($id, $name, $slug, $mota, $parent);
				if($success){
					$msg = "Cập nhật loại truyện thành công!";
				}
				else {
					$msg = "Cập nhật loại truyện không thành công!";
				}
			}
			else {
				$msg = "Không thể chuyển nút cha vào nút con được!!";
			}
		}
		else {
			$success = $this->admin_management_model->deleteCat($id);
			if($success){
				$msg = "Đã xóa thành công loại truyện!";
			}
			else {
				$msg = "Loại truyện này không thể xóa!";
			}
		}
		
		$catList = $this->admin_management_model->getListCat();
		$result = "<div class='tree'>";
		$result .= "<ul>";
		$result .= $this->printCategory($catList, 0);
		$result .= "</ul>";
		$result .= "</div>";
		
		$data['userInfo'] = $this->session->userdata('userInfo');
		$data['title'] = "Admin | Chỉnh sửa danh mục truyện";
        $data['template'] = "admin/category";
        $data['catList'] = $result;
        $data['nodeList'] = $catList;
        $data['msgForEditing'] = $msg;
    	$this->load->view('master_view', $data);
	}
	
	
	public function product(){
		$this->load->model("admin_management_model");
		
		if(!$this->session->userdata('userInfo')){
			redirect(base_url('login'));
		}
		
		$data['userInfo'] = $this->session->userdata('userInfo');
		$data['title'] = "Admin | Danh sách truyện";
        $data['template'] = "admin/product";
        $data['listProduct'] = $this->admin_management_model->getListProduct();
    	$this->load->view('master_view', $data);	
	}
	
	public function addProduct()
	{
		// load helper
		$this->load->helper('mystr_helper');
		
		// create message
		$data = null;
		
		// load model
		$this->load->model("admin_management_model");
		
		// load validation library
        $this->load->library('form_validation');
        $this->load->library('upload');
        
        $this->form_validation->set_rules('name','Title','trim|required');
        $this->form_validation->set_rules('description','Description', 'trim|required');
        $this->form_validation->set_rules('category[]','Category', 'trim|required|greater_than[0]');
		
		if(!$this->session->userdata('userInfo')){
			redirect(base_url('login'));
		}
		
		if($this->form_validation->run() == true){
	    	$name = $this->input->post('name');
			$description = $this->input->post('description', FALSE);
			$active = 1;
			$slug = str_slug($name);
			$lastID = $this->admin_management_model->addProduct($name, $slug, $description, $active, $this->session->userdata('userInfo')['user_id']);
			
			$checkboxes = $this->input->post('category');
		    foreach($checkboxes as $obj)
		    {
		    	$success = $this->admin_management_model->addProductCat($lastID, $obj);
		    }
		    
		    if($success){
				redirect(base_url('product'));
			}
		}
		
		$catList = $this->admin_management_model->getListCat();
		$result = "<div class='tree' style='padding: 0px; margin-bottom: 0px;'>";
		$result .= "<ul style='padding-left:0px'>";
		$result .= $this->printCategoryCheckbox($catList, 0);
		$result .= "</ul>";
		$result .= "</div>";
		
		$data['userInfo'] = $this->session->userdata('userInfo');
		$data['title'] = "Admin | Thêm mới truyện";
        $data['template'] = "admin/addproduct";
        $data['catList'] = $result;
    	$this->load->view('master_view', $data);
	}
	
	function editProduct($id){
		// load helper
		$this->load->helper('mystr_helper');
		
		// create message
		$data = null;
		
		// load model
		$this->load->model("admin_management_model");
		
		// load validation library
        $this->load->library('form_validation');
        $this->load->library('upload');
        
        $this->form_validation->set_rules('name','Title','trim|required');
        $this->form_validation->set_rules('description','Description', 'trim|required');
        $this->form_validation->set_rules('category[]','Category', 'trim|required|greater_than[0]');
		
		if(!$this->session->userdata('userInfo')){
			redirect(base_url('login'));
		}
		
		
    	$sanpham = $this->admin_management_model->getProductDetai($id);
	    if(isset($sanpham['id']))
	    {
	  		if($this->form_validation->run())     
	        {
		    	$name = $this->input->post('name');
				$description = $this->input->post('description', FALSE);
				$slug = str_slug($name);
				$this->admin_management_model->editProduct($id, $name, $slug, $description, $this->session->userdata('userInfo')['user_id']);
					
				$checkboxes = $this->input->post('category');
				$this->admin_management_model->delProductCat($id);
				
				foreach($checkboxes as $obj)
				{
					$success = $this->admin_management_model->addProductCat($id, $obj);
				}
				    
				if($success){
					redirect(base_url('product'));
				}
		    }
		    else
		    {   
		        $catList = $this->admin_management_model->getListCat();
				$result = "<div class='tree' style='padding: 0px; margin-bottom: 0px;'>";
				$result .= "<ul style='padding-left:0px'>";
				$result .= $this->printCategoryCheckbox($catList, 0);
				$result .= "</ul>";
				$result .= "</div>";
				
				$data['userInfo'] = $this->session->userdata('userInfo');
				$data['title'] = "Admin | Sửa truyện";
		        $data['template'] = "admin/editproduct";
		        $data['catList'] = $result;
		        $data['sanpham'] = $sanpham;
		        $data['checkCatList'] = $this->admin_management_model->getProductCat($id);;
		    	$this->load->view('master_view', $data);
		    }
		}
	    else {
	    	show_error('Trang bạn tìm không tồn tại vui lòng quay lại.');
	    }
	}
	
	public function deleteItem($table, $id){
		$this->load->model("admin_management_model");
		$result = $this->admin_management_model->deleteItem($table, $id);
		if($result){
			$results = array("STATUS" => "OK", "MESSAGE" => "Xóa dữ liệu thành công.");
		}
		else {
			$results = array("STATUS" => "FAIL", "MESSAGE" => "Xóa dữ liệu không thành công.");
		}
		header('Content-Type: application/json');
    	echo json_encode($results); // return value of $result
	}
	
	public function contact()
	{
		$this->load->library('form_validation');
		$this->load->model("admin_management_model");
		
		$data = null;
		$msg = null;
		
		$this->form_validation->set_rules('name','Title','trim|required');
        $this->form_validation->set_rules('message','Message', 'trim|required');
        $this->form_validation->set_rules('email','Email', 'trim|valid_email|xss_clean');
        
		if($this->form_validation->run()){
	    	$name = $this->input->post('name');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$message = $this->input->post('message');
			$success = $this->admin_management_model->insertContact($name, $email, $phone, $message);
		    
		    if($success){
					$msg = "Gửi tin nhắn thành công!";
				}
				else {
					$msg = "Gửi tin nhắn không thành công!";
				}
		}
		
		$data['msgForContacting'] = $msg;
    	$this->load->view('common/contact', $data);
	}
}
