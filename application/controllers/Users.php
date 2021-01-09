<?php
 class Users extends CI_Controller
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
 		$this->load->view('template/header');
		$select="*";
		$where = array('display'=>'Y');
		$table="tbl_users";
		$data['users'] = $this->Common->get_where_select_multiple($select,$where,$table);
		$this->load->view('users/list_users',$data);
		$this->load->view('template/footer');
 	}
 	
 	function edit($user_id=NULL)
 	{
 	    $this->load->view('template/header');
 	        $data['title']="Edit User";
 	        $table="tbl_users";
 	        $where=array('user_id'=>$user_id);
 	        $data['user']=$this->Common->single_where_data($where,$table);
 	    $this->load->view('users/create',$data);
		$this->load->view('template/footer');
 	}
 	
 	function edit_user()
 	{
 	    $user_id=$this->input->post('id');
 	    $dataArr=array('user_name'=>$this->input->post('name'),
 	                   'user_email'=>$this->input->post('email'),
 	                   'latitude'=>$this->input->post('latitude'),
 	                   'longitude'=>$this->input->post('longitude'),
 	                   'password'=>$this->input->post('password'),
 	                   'country'=>$this->input->post('country'),
 	                   'city'=>$this->input->post('city'),
 	                   'phone'=>$this->input->post('phone')
 	                   );
 	    if(!empty($_FILES['img']['name'])){
                    $config['upload_path']          = './uploads/profile_image';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['max_size']             = 10000;
                    $config['max_width']            = 102400;
                    $config['max_height']           = 76800;
     
                    $this->load->library('upload', $config);
                    
                    if ( ! $this->upload->do_upload('img'))
                    {
                            $error = array('error' => $this->upload->display_errors());
                            print_r($error);
                            die;
                    }
                    else
                    {
                            $data = array('upload_data' => $this->upload->data());
                            $dataArr['profile_image']=base_url().'uploads/profile_image/'.$data['upload_data']['file_name'];
                    }
                 }
 	   $table="tbl_users";
 	   $where=array('user_id'=>$user_id);
 	   $data=$dataArr;
 	   $this->Common->update_data($table,$data,$where);
 	   
 	   	redirect('Users','refresh');
 	}
 
 
 	function delete_users($user_id)
 	{
 		
		$data = array("display" => "N");
		$where=array('user_id'=>$user_id);
		$table="tbl_users";
		$this->Common->update_data($table,$data,$where);
		redirect('Users','refresh');
 	}
 	
    
    
	
}

 ?>