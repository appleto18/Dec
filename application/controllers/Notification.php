<?php
 class Notification extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('Common_model','Common');
 		if(!$this->session->userdata('logged_in'))
 		{
 		    redirect('Login','refresh');
 		}
 	}

 	function index()
 	{
 	    $id=$this->uri->segment(3);
 		$this->load->view('template/header');
		$select="*";
		$where = array('notification_id='=>$id);
		$table="notification";
		$data['notification'] = $this->Common->get_where_select_multiple($select,$where,$table);
		$this->load->view('Notification/list',$data);
		$this->load->view('template/footer');
 	}
 
	
}

 ?>