<?php
 class Cms extends CI_Controller
 {

 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('Common_model','Common');
 		if($this->session->userdata('email'))
		   { }else {
		       	redirect('Login','refresh');
		   }
		
 	}

 	function index()
 	{
 		$this->load->view('template/header');
		$select="*";
		$where =array();
		$table="cms";
		$data['Cms'] =$this->Common->get_where_select_multiple($select,$where,$table);
		$this->load->view('Cms/list',$data);
		$this->load->view('template/footer');
 	}
 	
 	function Edit()
 	{
 	    $this->load->view('template/header');
 	    $cmsid=$this->uri->segment(3);
 	    $data['cms']=$this->db->get_where('cms',array('id'=>$cmsid))->row_array();
 	    $this->load->view('Cms/edit',$data);
		$this->load->view('template/footer');
 	}
 	
 	function update_cms()
 	{
 	    
 	    $cmsid=$this->input->post('id');
 	    $description=$this->input->post('description');
 	    $data=array('description'=>$description);
 	    $this->db->update('cms',$data,array('id'=>$cmsid));
 	    redirect('Cms');
 	}
 }

 ?>
