<?php
 class Orders extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('Common_model','Common');
 		$this->load->library('Ciqrcode');
 		if(!$this->session->userdata('logged_in'))
		{
		    redirect('Login','refresh');
		}	
 	}

 	function index()
 	{
 	    $user_id=$this->uri->segment(3);
 		$this->load->view('template/header');
		$select="user_name,order_id,order_date,total_amount";
		$where = array('orders.user_id'=>$user_id);
		$table1="orders";
		$table2="tbl_users";
		$data['orders'] = $this->Common->get_inner_join($select,$where,$table1,$table2);
		$this->load->view('Orders/list',$data);
		$this->load->view('template/footer');
 	}
 	
 	public function details()
 	{
 	    $order_id=$this->uri->segment(3);
 	    $this->load->view('template/header');
		$select="*";
		$where = array('order_detalis.order_id'=>$order_id);
		$table1="order_detalis";
		$table2="orders";
		$table3="tbl_products";
		$data['orders_details'] = $this->Common->get_inner_join_orderdetails($select,$where,$table1,$table2,$table3);
		$this->load->view('Orders/details_list',$data);
		$this->load->view('template/footer');
 	}

}

 ?>