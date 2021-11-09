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
		$this->load->view('append');
	}
	public function appendcode()
	{
		$name=$this->input->post('name');
		$lname=$this->input->post('lname');
		$name1 = serialize($name);
		$lname1 = serialize($lname);
		$newvar = unserialize($name1); 
		$newvar1 = unserialize($lname1); 
		$data=array(
			'name'=>$name1,
			'lname'=>$lname1,
		);
		$this->db->insert("append",$data);
	}
	public function appendedit($id)
	{
		$data['edit']=$this->db->query("select * from append where id='$id'")->row();
		$this->load->view('appendedit',$data);
	}
	public function appendeditcode()
	{
		// print_r($id);
		// exit();
		$id=$this->input->post('id');
		$name=$this->input->post('name');
		$lname=$this->input->post('lname');
		$name1 = serialize($name);
		$lname1 = serialize($lname);
		$newvar = unserialize($name1); 
		$newvar1 = unserialize($lname1); 
		$data=array(
			'name'=>$name1,
			'lname'=>$lname1,
		);
		$this->db->where('id',$id);
		$this->db->update("append",$data);
		redirect('welcome');
	}
	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete("append");
		redirect('welcome');
	}
	
}
