<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hello extends CI_Controller {

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
	// public function __construct() { 
	// 	parent::__construct(); 
	// 	$this->load->helper(array('form', 'url')); 
	//  }
	public function index()
	{
		$this->load->view('apiimage');
	}
    public function fetch()
	{
		$this->load->database();
		// // $data['fetch']=$this->db->get('insert');
		// // $data['ftc']=	$data['fetch']->result_array();
		// $query = $this->db->query("SELECT * FROM tbl_insert;");
		$data['fetch']=$this->db->query("select * from tbl_insert");
		$data['ftc']=$data['fetch']->result_array();
        // print_r("<pre>");
		// print_r($data);
		$this->load->view("fetch",$data);
	}
	
	public function insertdata()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("fname","fname","required|trim|is_unique[tbl_insert.fname]");
		$this->form_validation->set_rules("email","email","required|valid_email");
		$this->form_validation->set_rules("pno","pno","required|numeric|max_length[10]|min_length[10]");
		$this->form_validation->set_rules("lname","lname","required");
		if($this->form_validation->run()==false)
		{
			$this->load->view("insert");
		}
		else
		{
		
			      $config['upload_path'] = './public/uploads/';
			      $config['allowed_types'] = 'gif|jpg|png|exe|xls|doc|docx|xlsx|rar|zip';
				  $config['max_width']      = 7000;
				  $config['max_height']      = 7000;
			      $config['max_size']      = 7000; 
			      $this->load->library('upload', $config);
					if (!$this->upload->do_upload('filename'))
					{
					  echo 'error!';
					}
					else
					{
					 $uploaddata=$this->upload->data();
					 $data=array(
						'fname'=>$this->input->post('fname'),
						'lname'=>$this->input->post('lname'),
						'email'=>$this->input->post('email'),
						'pno'=>$this->input->post('pno'),
						'image'=>$uploaddata['file_name'],
					);
					// print_r("<pre>");
					// print_r($data);
					// exit();
					$this->db->insert("tbl_insert",$data);
					$this->session->set_flashdata('msg', 'Insert Successfully Data');
					redirect("hello/fetch");
					}
		
	    }
	}
	public function view()
	{
		$this->load->view("insert");
	}
	public function delete($id=null)
	{
		//  $this->load->database();
		$this->db->where('id',$id);
		$this->db->delete("tbl_insert");
		redirect("hello/fetch");
	}
	public function edit($id=null)
	{
		$this->db->where('id',$id);
		$data['edit']=$this->db->get("tbl_insert")->row();
		$this->load->view("edit",$data);

	}
	public function editGeneral1($id=null){

		if($this->input->post('submit')){
			$this->load->library("form_validation");
			$this->form_validation->set_rules("fname","fname","required|trim|is_unique[tbl_insert.fname]");
		$this->form_validation->set_rules("email","email","required|valid_email");
		$this->form_validation->set_rules("pno","pno","required|numeric|max_length[10]|min_length[10]");
		$this->form_validation->set_rules("lname","lname","required");
			$id=$_POST['id'];
			if ($this->form_validation->run() == FALSE) {
				$this->db->where('id',$id);
		$data['edit']=$this->db->get("tbl_insert")->row();
				$this->load->view('edit',$data);
				// redirect('hello/edit/2');
				// $data['view'] = 'admin/GeneralScanning/GeneralScanning_edit';
				// $this->load->view('admin/layout', $data);
			}
			else{
				
			// print_r($data);
			// exit();
			$this->load->library('upload');
		$config['upload_path']   = 'public/uploads/'; 
		$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx'; 
		$config['max_size']      = 6000; 
		$config['max_width']     = 7000; 
		$config['max_height']    = 7000;  
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('filename')) {
				$data = array('error'=>$this->upload->display_errors());
				// $this->load->view('edit');
				// $this->session->set_flashdata('error', $error);
			// $data['view'] = 'admin/GeneralScanning/GeneralScanning_edit';
			// $this->load->view('admin/layout', $data);
			$data=array(
				'fname'=>$this->input->post('fname'),
				'lname'=>$this->input->post('lname'),
				'email'=>$this->input->post('email'),
				'pno'=>$this->input->post('pno'),
				
			);
			$this->db->where('id',$_POST['id']);
			$this->db->update("tbl_insert",$data);
			redirect(base_url('hello/fetch'));
			// redirect(base_url('hello/fetch'));

		}
		else{
			
			// print_r($data);
			// exit();
			$data=array(
				'fname'=>$this->input->post('fname'),
				'lname'=>$this->input->post('lname'),
				'email'=>$this->input->post('email'),
				'pno'=>$this->input->post('pno'),
				
			);
			$data1 = array('filename'=>$this->upload->data());
			$cl_img = $data1['filename']['file_name'];
			$this->db->set('image',$cl_img);
			$this->db->where('id',$_POST['id']);
			$this->db->update("tbl_insert",$data);
			redirect(base_url('hello/fetch'));
		}
			
			// redirect(base_url('hello/fetch'));
			//$this->load->view('myfirstpage/edit');
		}	

		
		// $this->load->library('upload');
		// $config['upload_path']   = 'public/uploads/'; 
		// $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx'; 
		// $config['max_size']      = 6000; 
		// $config['max_width']     = 7000; 
		// $config['max_height']    = 7000;  
		// $this->upload->initialize($config);
		// if (!$this->upload->do_upload('filename')) {
		// 	$data = array('error'=>$this->upload->display_errors());
		// 		// $this->session->set_flashdata('error', $error);
		// 	// $data['view'] = 'admin/GeneralScanning/GeneralScanning_edit';
		// 	// $this->load->view('admin/layout', $data);
		// 	redirect(base_url('hello/fetch'));

		// }
		// else{
		// 	$data = array(
		// 		'success' => 'Successfully Upload Logo...');
		// 	$data1 = array('filename'=>$this->upload->data());
		// 	$cl_img = $data1['filename']['file_name'];
		// 	$this->db->set('image',$cl_img);
		// 	$this->db->where('id',$_POST['id']);
		// 	$result = $this->db->update("tbl_insert");
		// 	if($result){
		// 		$this->session->set_flashdata('msg', 'Updated Successfully!');
		// 		redirect(base_url('hello/fetch'));
		// 	}
		// }
	}
	}
	public function loginview()
	{
		$this->load->view("login");
	}
	public function logincode()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("fname","fname","required");
		$this->form_validation->set_rules("lname","lname","required");
		if($this->form_validation->run() == false)
		{
			$this->load->view("login");
		}
		else{
		$uname=$this->input->post("fname");
		$pass=$this->input->post("lname");
		$query=$this->db->query("select * from tbl_insert where fname='$uname'and lname='$pass'");
		// print_r($query);
		if($query->num_rows() > 0)
		{
			redirect("hello/fetch");
		}
		else
		{
			echo "<script>alert('Not Login');</script>";
		}
	}
	}
	public function mpdf()
	{
		$this->load->view("mpdf");
	}
	public function email()
	{
		$this->load->view("email");
	}
	public function emailsend()
	{
		$config["protocol"]='smtp';
		$config["smtp_host"]='ssl://smtp.gmail.com';
		$config["smtp_port"]='465';
		$config["smtp_timeout"]='60';
		$config["smtp_user"]='jigsmistry1991@gmail.com';
		$config["smtp_pass"]='jigsmistry786';
		$config["mailtype"]='html';
		$config["validation"]=true;
		$this->email->initialize($config);
		$this->load->library("email");
		$from="jigsmistry1991@gmail.com";
		$to=$this->input->post('email');
		$this->email->from($from,"jignesh");
		$this->email->to($to);
		$this->email->subject("jignesh");
		$this->email->message("Hello I Am jignesh");
		$this->email->send();
	}
	public function insert21view()
	{
		$this->load->view("insert21");
	}
	public function insert21viewadd()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("fname","fname","required|alpha");
		$this->form_validation->set_rules("lname","lname","required");
		$this->form_validation->set_rules("email","email","required|valid_email");
		$this->form_validation->set_rules("pno","pno","required|max_length[10]|min_length[10]|numeric");
		if($this->form_validation->run() == false)
		{
			$this->load->view("insert21");
		}
		else{

		
		$config['upload_path']='images';
		$config['allowed_types']='jpg|png|gif';
		$config['max_size']=7000;
		$config['max_width']=7000;
		$config['max_height']=7000;
		$this->load->library("upload",$config);
		if(!$this->upload->do_upload("filename"))
		{

		}
		else{
			$images=$this->upload->data();
			$data=array(
				'fname'=>$this->input->post("fname"),
				'lname'=>$this->input->post("lname"),
				'email'=>$this->input->post("email"),
				'pno'=>$this->input->post("pno"),
				'image'=>$images['file_name'],
			);
			$this->db->insert("tbl_insert",$data);
		}
	}
	}
	public function fetch21()
	{
		$data['fetch']=$this->db->get("tbl_insert");
		$data['ftc']=$data['fetch']->result_array();
		$this->load->view("fetch21",$data);
	}
	public function edit21($id=null)
	{
		$this->db->where('id',$id);
		$data['edit']=$this->db->get("tbl_insert")->row();
		$this->load->view("edit21",$data);
		 
	}
	public function edit21add($id=null)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("fname","fname","required|alpha");
		$this->form_validation->set_rules("lname","lname","required");
		$this->form_validation->set_rules("email","email","required|valid_email");
		$this->form_validation->set_rules("pno","pno","required|max_length[10]|min_length[10]|numeric");
		if($this->form_validation->run() == false)
		{
			$this->db->where('id',$id);
		$data['edit']=$this->db->get("tbl_insert")->row();
				$this->load->view('edit21',$data);
		}
		else{

		$config['upload_path']="images";
		$config['allowed_types']="jpg|png|gif";
		$config['max_size']=7000;
		$config['max_width']=7000;
		$config['max_height']=7000;
		$this->load->library("upload",$config);
		if(!$this->upload->do_upload("filename"))
		{
			$data=array(
				'fname'=>$this->input->post('fname'),
				'lname'=>$this->input->post('lname'),
				'email'=>$this->input->post('email'),
				'pno'=>$this->input->post('pno'),
				
			);
			$this->db->where('id',$_POST['id']);
			$this->db->update("tbl_insert",$data);
			redirect(base_url('hello/fetch21'));
		}
		else{

			
		$data=array(
			'fname'=>$this->input->post("fname"),
			'lname'=>$this->input->post("lname"),
			'email'=>$this->input->post("email"),
			'pno'=>$this->input->post("pno"),
		);
		$data1=array('filename'=>$this->upload->data());
		$img=$data1['filename']['file_name'];
		
		$this->db->where('id',$_POST['id']);
		$this->db->set('image',$img);
		$this->db->update("tbl_insert",$data);
		redirect(base_url('hello/fetch21'));
	}
}
	}
	public function ajaxinsertview()
	{
		$this->load->view("ajaxinsert");
	}
	public function ajaxinsertviewadd()
	{
		$config['upload_path']='images';
		$config['allowed_types']='jpg|png|gif';
		$config['max_size']=7000;
		$config['max_width']=7000;
		$config['max_height']=7000;
		$this->load->library("upload",$config);
		if(!$this->upload->do_upload("filename"))
		{

		}
		else{
			$images=$this->upload->data();
			$data=array(
				'fname'=>$this->input->post("fname"),
				'lname'=>$this->input->post("lname"),
				'email'=>$this->input->post("email"),
				'pno'=>$this->input->post("pno"),
				'image'=>$images['file_name'],
			);
			$this->db->insert("tbl_insert",$data);
		}
	}
	public function ajaxfetchdata()
	{
		$select=$this->db->get('tbl_insert');
		foreach($select->result_array() as $row)
		{
			echo "<tr>";
			echo "<td>".$row['fname']."</td>";
			echo "<td>".$row['lname']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['pno']."</td>";
			// echo "<td>".$row['image']."</td>";
			echo "<td><img src='http://localhost:8080/coder/images/".$row['image']."' style='width:100px;height:100px;'></td>";
			echo "<td><button type='button' class='btn btn-success btn-sm edit' data-toggle='modal' data-target='#myModal' data-id='".$row['id']."'>Edit</button></td>";
			echo "<td><button type='button' class='btn btn-danger btn-sm delete' data-id='".$row['id']."'>Delete</button></td>";
			
			echo "<tr>";
		}
		// print_r($select);
		// exit();
	}
}
