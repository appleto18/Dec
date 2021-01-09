<?php
 class Product extends CI_Controller
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
 	    $user_id=$this->uri->segment(3);
 		$this->load->view('template/header');
		$select="tbl_users.user_name,product_id,product_name,product_description,product_image,tbl_products.user_id";
		$where = array('tbl_products.user_id='=>$user_id);
		$table1="tbl_users";
		$table2="tbl_products";
		$data['product'] = $this->Common->get_inner_join($select,$where,$table1,$table2);
		$this->load->view('Product/list',$data);
		$this->load->view('template/footer');
 	}
 	
 	
    function delete_product($product_id)
    {
 			
		$data = array("display" => "N");
		$where=array('product_id'=>$product_id);
		$table="tbl_products";
		$this->Common->update_data($table,$data,$where);
		redirect('Product','refresh');
 	}
 	
 	function add_product()
 	{
 	    if(empty($_POST)){
 	        
 	        $this->load->view('template/header');
 	        $this->load->view('Product/add_product');
		    $this->load->view('template/footer');
		    
 	    }else{
     	    $dataArr=array('product_name'=>$this->input->post('name'),
     	                   'product_description'=>$this->input->post('description')
     	                   );
     	    if(!empty($_FILES['image']['name'])){
                        $config['upload_path']          = './uploads/profile_image';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 10000;
                        $config['max_width']            = 102400;
                        $config['max_height']           = 76800;
         
                        $this->load->library('upload', $config);
                        
                        if ( ! $this->upload->do_upload('image'))
                        {
                                $error = array('error' => $this->upload->display_errors());
                                print_r($error);
                                die;
                        }
                        else
                        {
                                $data = array('upload_data' => $this->upload->data());
                                $dataArr['product_image']=base_url().'uploads/profile_image/'.$data['upload_data']['file_name'];
                        }
                     }
     	   $table="tbl_products";
     	   $this->Common->batch_insert($table,$dataArr);
     	   
     	   	redirect('Product','refresh');  
 	    }
 	}
 	
 	
 	function edit_product()
 	{
 	    if(empty($_POST)){
 	        
 	        $this->load->view('template/header');
 	        $id=$this->uri->segment(3);
 	        $where=array('product_id'=>$id);
 	        $select="*";
 	        $table="tbl_products";
 	        $data['product']=$this->Common->get_where_select_single($select,$where,$table);
 	        $this->load->view('Product/edit_product',$data);
		    $this->load->view('template/footer');
		    
 	    }else{
     	    $dataArr=array('product_name'=>$this->input->post('name'),
     	                   'product_description'=>$this->input->post('description')
     	                   );
     	    
     	    if(!empty($_FILES['image']['name'])){
                        $config['upload_path']          = './uploads/profile_image';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 10000;
                        $config['max_width']            = 102400;
                        $config['max_height']           = 76800;
         
                        $this->load->library('upload', $config);
                        
                        if ( ! $this->upload->do_upload('image'))
                        {
                                $error = array('error' => $this->upload->display_errors());
                                print_r($error);
                                die;
                        }
                        else
                        {
                                $data = array('upload_data' => $this->upload->data());
                                $dataArr['product_image']=base_url().'uploads/profile_image/'.$data['upload_data']['file_name'];
                        }
                     }
           $where=array('product_id'=>$this->input->post('id'));
     	   $table="tbl_products";
     	   $this->Common->update_data($table,$dataArr,$where);
     	   
     	   	redirect('Product','refresh');  
 	    }
 	}
	
}

 ?>