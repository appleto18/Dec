<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model','Common');
        date_default_timezone_set('Asia/Kolkata');
    }


    
    function register()
	{
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_name', 'user_name', 'required');
		    $this->form_validation->set_rules('user_email', 'user_email', 'required');
		    $this->form_validation->set_rules('password', 'password', 'required');
		    $this->form_validation->set_rules('country', 'country', 'required');
		    $this->form_validation->set_rules('city', 'city', 'required');
		    $this->form_validation->set_rules('longitude', 'longitude', 'required');
		    $this->form_validation->set_rules('latitude', 'latitude', 'required');
		    
		   
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
				$table="tbl_users";
				$where=array('user_email'=>$this->input->post('user_email'));
				$numrows=$this->Common->get_num_rows($table,$where);
				if($numrows>0)
				{
				    $json = array("status" =>0,"message" =>"Account Already Exists");
				}else
				{
				    $dataArr=array('user_name'=>$this->input->post('user_name'),
				                   'user_email'=>$this->input->post('user_email'),
				                   'phone'=>$this->input->post('phone'),
				                   'password'=>$this->input->post('password'),
				                   'country'=>$this->input->post('country'),
				                   'city'=>$this->input->post('city'),
				                   'latitude'=>$this->input->post('latitude'),
				                   'longitude'=>$this->input->post('longitude'));
				                   
				   
				   
				    if(isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name']))
				    {
				        $config['upload_path']          = './uploads/profile_image/';
                        $config['allowed_types']        = 'jpeg|jpg|png|JPG';
                        $config['max_size']             = 100000;
                        $config['max_width']            = 102004;
                        $config['max_height']           = 76800;

                        $this->load->library('upload', $config);
        
                        if (!$this->upload->do_upload('profile_image'))
                        {
                            $error = array('error' => $this->upload->display_errors());
                            echo json_encode($error);die();
                        }
                        else
                        {
                            $data = array('upload_data' => $this->upload->data());
                            $dataArr['profile_image']=base_url().'uploads/profile_image/'.$data['upload_data']['file_name'];
        
                        }
				    }
				    
				    $insertid=$this->Common->batch_insert($table,$dataArr);
				    if($insertid)
				    {
				        $json = array("status" =>1,"message" =>"Account Created Successfully");
				    }else
				    {
				        $json = array("status" =>0,"message" =>"Account Creation Failed");
				    }
				}
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    
    function login()
	{
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('email', 'email', 'required');
		    $this->form_validation->set_rules('password', 'password', 'required');
		    $this->form_validation->set_rules('fcm_token', 'fcm_token', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$fcm_token = $this->input->post('fcm_token');
				
			    $where = array("user_email" => $email,"password" => $password,"in_use" => "Y","display"=>"Y");
			    $select = "*";
			    $table="tbl_users";
			    $result = $this->Common->get_where_select_single($select,$where,$table);      
			    if(!empty($result))
			    {
    			    $data = array("fcm_token" => $fcm_token);
    			    $this->Common->update_data($table,$data,$where);
    			    $result['fcm_token']= $fcm_token;
    			    $json =  array("status" => 1,"message"=>"Login successfully","data" => $result);
			    }else
			    {
			        $json =  array("status" => 0,"message"=>"Please eneter correct email and password");
			    }
			    
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
    
    function forget_password()
	{
	    $method = $_SERVER['REQUEST_METHOD']; 
	    if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_email', 'user_email', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}else
			{
			    $email = $this->input->post('user_email');
			    $where = array(
			            'user_email'=>$email,
			            'in_use'=>'Y',
			            'display'=>'Y'
			        );
			    $this->db->select('password');
			    $this->db->from('tbl_users');
			    $this->db->where($where);
			    $res = $this->db->get();
			    if($res->num_rows()>0)
			    {
			    foreach($res->result() as $row){
			       $password=  $row->password;
			    }
			        $to =$email;
                    $subject = "Your Password";
                    $message = "<b>Welcome To Declutter.</b>";
                    $message .= "Your Password is ".$password;
                    $header = "From:test@kptechs.in \r\n";
                    $header .= "MIME-Version: 1.0\r\n";
                    $header .= "Content-type: text/html\r\n";
                    $retval = mail ($to,$subject,$message,$header);
                    if( $retval == true ) {
                        $json =  array("status" =>1,"message"=>"Password Successfully Send On Mail");
                    }else {
                       $json =  array("status" =>0,"message"=>"User does not exist");
                    }
			    }else
			    {
			        $json =  array("status" =>0,"message"=>"User does not exist");
			    }
			}
		}
		echo json_encode($json);
	}
    
    function get_nearest_user_product()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('latitude', 'latitude', 'required');
		    $this->form_validation->set_rules('longitude', 'longitude', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{	
			    $latitude = $this->input->post('latitude');
			    $longitude = $this->input->post('longitude');
			
			                   
			   $result = $this->db->query("
			    	    SELECT tbl_products.user_id,product_id,product_name,product_description,product_image,
			    	    ( 3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( Latitude ) ) ) ) AS distance 
			    	    FROM tbl_products INNER JOIN tbl_users ON (tbl_products.user_id = tbl_users.user_id) 
			    	    WHERE tbl_products.in_use = 'Y' AND tbl_products.display='Y'
			    	    ORDER BY distance")->result();
			    
			    $main=array();
			    foreach($result as $row):
			        $dataArr=array(
    			        'user_id'=> $row->user_id,
                        'product_id'=> $row->product_id,
                        'product_name'=> $row->product_name,
                        'product_description'=> $row->product_description,
                        'product_image'=>(explode(',',$row->product_image)),
                        'distance'=>$row->distance
                    );
                    array_push($main,$dataArr);
			    endforeach;
    			$json =  array("status" => 1,"message"=>"Product List","data" => $main);
		    } 
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
    
    function product_search()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('latitude', 'latitude', 'required');
		    $this->form_validation->set_rules('longitude', 'longitude', 'required');
		    $this->form_validation->set_rules('search', 'search', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{	
			    $latitude = $this->input->post('latitude');
			    $longitude = $this->input->post('longitude');
			    $search = $this->input->post('search');
			                   
			   $result = $this->db->query("
			    	    SELECT product_name,product_description,product_image,
			    	    ( 3959 * acos( cos( radians($latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin( radians( Latitude ) ) ) ) AS distance 
			    	    FROM tbl_products INNER JOIN tbl_users ON (tbl_products.user_id = tbl_users.user_id) 
			    	    WHERE product_name like '%$search%' AND tbl_products.in_use = 'Y' AND tbl_products.display='Y'
			    	    ORDER BY distance")->result();
    			$json =  array("status" => 1,"message"=>"Product List","data" => $result);
		    } 
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
    
    function add_product()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('product_description', 'product_description', 'required');
		    $this->form_validation->set_rules('product_name', 'product_name', 'required');
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{	
			    $product_description = $this->input->post('product_description');
			    $product_name = $this->input->post('product_name');
			    $user_id = $this->input->post('user_id');
			    
			    $dataArr=array('product_name'=>$product_name,
			                   'product_description'=>$product_description,
			                   'user_id'=>$user_id);
			                   
                        		$imgarray=array();
                            	$files=$_FILES;
                            	
                            	if(!empty($_FILES['image']['name'][0]))
                            	{
                                	$imagecount=count($_FILES['image']['name']);
                                	for($i=0;$i<$imagecount;$i++)
                                	{
                                		$_FILES["image"]["name"] =$files["image"]["name"][$i];
                                		$_FILES["image"]["type"] =$files["image"]["type"][$i];
                                		$_FILES["image"]["tmp_name"] =$files["image"]["tmp_name"][$i];
                                		$_FILES["image"]["error"] =$files["image"]["error"][$i];
                                		$_FILES["image"]["size"] =$files["image"]["size"][$i];
                                
                                		$config["upload_path"] = './uploads/Product/';
                                		$config["allowed_types"] = 'jpg|png|jpeg|gif';
                                		$this->load->library('upload', $config);
                                		$this->upload->initialize($config);
                                				
                                		if($this->upload->do_upload('image'))
                            			{
                                		    $upload_data = $this->upload->data();
                                            $filename =base_url().'uploads/Product/'.$upload_data['file_name'];
                                            array_push($imgarray,$filename);
                                		}else
                                		{
                                		    $error = array('error' => $this->upload->display_errors());
                                		}
                                			$productimg=implode(",",$imgarray);
                                			$dataArr['product_image']=$productimg;
                                	}
                                }
                        		#End Product Img	    
			    
			    $table="tbl_products";
			    $insertid=$this->Common->batch_insert($table,$dataArr);
			    if(!empty($insertid)){
			        
			                # Send Notification when user adds product
			                $userdata=$this->db->get_where('tbl_users',array('user_id'=>$user_id))->row_array();
            			    $token=$userdata['fcm_token']; 
            			    $title="New Product Added";
            			    $body="You Have Added One New Product";
            			    $this->send_notification($token,$title,$body);
            			    #
            			    
			        $where=array('user_id'=>$user_id);
			        $table="tbl_users";
			        $select="*";
			        $data=$this->Common->get_where_select_single($select,$where,$table);
			        if(!empty($data)){
			            
			            $rewards=$data['reward']+1;
			            $data=array('reward'=>$rewards);
			            $this->Common->update_data($table,$data,$where);
			                
			                $table="notification";
			                $data=array('user_id'=>$user_id,
			                            'title'=>"You have been rewarded with one point.",
			                            'date'=>date('Y-m-d h:i:s'));
			                $this->Common->batch_insert($table,$data);
			                
    			                # Send Notification when user receive reward
    			                $userdata=$this->db->get_where('tbl_users',array('user_id'=>$user_id))->row_array();
                			    $token=$userdata['fcm_token']; 
                			    $title="Reward Receiver";
                			    $body="You Have Received One New Reward";
                			    $this->send_notification($token,$title,$body);
                			    #
            			    
			            $json =  array("status" => 1,"message"=>"Product Added Successfully.");    
			        }
			    }else{
			        $json =  array("status" => 0,"message"=>"Something went wrong. Please try again.");
			    }
    			
		    } 
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
/*    
    function send_chat_request()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('sender_id', 'sender_id', 'required');
		    $this->form_validation->set_rules('receiver_id', 'receiver_id', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{	
			    $sender_id = $this->input->post('sender_id');
			    $receiver_id = $this->input->post('receiver_id');
			    $table="chat_room";
			    $where=array('user1'=>$sender_id,
			                  'user2'=>$receiver_id,
			                  'status'=>'Pending');
			    $num_rows=$this->Common->get_num_rows($table,$where);
			    if($num_rows >0){
			        $json =  array("status" => 0,"message"=>"Already Request Sent."); 
			    }else{
			        $dataArr=array('user1'=>$sender_id,
			                   'user2'=>$receiver_id,
			                   'status'=>'Pending');
    			    $insertid=$this->Common->batch_insert($table,$dataArr);
    			    if(!empty($insertid)){
    			        $where=array('user_id'=>$sender_id);
    			        $table="tbl_users";
    			        $select="user_name";
    			        $data=$this->Common->get_where_select_single($select,$where,$table);
    			        if(!empty($data)){
    			            $json =  array("status" => 1,"message"=>"Request Sent Successfully",'data'=>$data);    
    			        }else{
    			            $json =  array("status" => 0,"message"=>"No user found");    
    			        }
    			    }else{
    			        $json =  array("status" => 0,"message"=>"Something went wrong. Please try again.");
    			    }   
			    }
		    } 
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
    
    function get_pending_chat_request()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{	
			    $sender_id = $this->input->post('user_id');
			    $table1="chat_room";
			    $table2="tbl_users";
			    $where=array('user2'=>$sender_id,
			                  'status'=>'Pending');
			    $select="id,user_id,user_name,profile_image";
			    $data=$this->Common->get_pending_request($select,$where,$table1,$table2);
			    if(!empty($data)){
			        $json =  array("status" => 1,"message"=>"Pending Request List.",'data'=>$data); 
			    }else{
			        $json =  array("status" => 0,"message"=>"No Pending Request.");
			    }
		    } 
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
    
    function accept_request()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('request_id', 'request_id', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{	
			    $request_id = $this->input->post('request_id');
			    $table="chat_room";
			    $where=array('id'=>$request_id);
			    $data=array('status'=>'Approve');
			    $data=$this->Common->update_data($table,$data,$where);
			        $json =  array("status" => 1,"message"=>"Request Accepted Successfully."); 
		    } 
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
    
    function reject_request()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('request_id', 'request_id', 'required');
			
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{	
			    $request_id = $this->input->post('request_id');
			    $table="chat_room";
			    $where=array('id'=>$request_id);
			    $data=array('status'=>'Rejected');
			    $data=$this->Common->update_data($table,$data,$where);
			    $json =  array("status" => 1,"message"=>"Request Rejected Successfully."); 
			} 
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
*/
    
    function send_message()
	{
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('sender_id', 'sender_id', 'required');
		    $this->form_validation->set_rules('receiver_id', 'receiver_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
				$dataArr=array('sender_id'=>$this->input->post('sender_id'),
				               'receiver_id'=>$this->input->post('receiver_id'),
				               'message'=>$this->input->post('message'),
				               'create_on'=>date('d M Y H:i:s'));
				if(isset($_FILES['attachment']['name']))
				{
				    $attachment=$_FILES['attachment']['name'];
				}else{
				    $attachment="";
				}
			    	if(!empty($attachment))
			    {
    			    $config['upload_path']          = './uploads/profile_image/';
                    $config['allowed_types']        = 'jpeg|jpg|png';
                    $config['max_size']             = 100060;
                    $config['max_width']            = 106624;
                    $config['max_height']           = 766558;
    
                    $this->load->library('upload', $config);
    
                    if ( ! $this->upload->do_upload('attachment'))
                    {
                            $userdata=$this->db->get_where('tbl_users',array('user_id'=>$this->input->post('receiver_id')))->row_array();
            			    $token=$userdata['fcm_token']; 
            			    $title="New Message Received";
            			    $body="You Have One New Message Received";
            			    $this->send_notification($token,$title,$body);
            			    
                            $error = array('error' => $this->upload->display_errors());
                            $this->load->view('upload_form', $error);
                    }
                    else
                    {
                            $data = array('upload_data' => $this->upload->data());
                            $dataArr['attachment']=base_url().'uploads/profile_image/'.$data['upload_data']['file_name'];
                    }
			    }  
				$table="chat";
				$insertid=$this->Common->batch_insert($table,$dataArr);
				if($insertid)
			    {
		        $json = array("status" =>1,"message" =>"Message Send Successfully");
	    	    }else
			    {
		            $json = array("status" =>0,"message" =>"Message Sending Failed");
			    }
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    
    function get_chat()
	{
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
		    $this->form_validation->set_rules('receiver_id', 'receiver_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
				$user_id=$this->input->post('user_id');
				$receiver_id=$this->input->post('receiver_id');
				
				$where="sender_id=$user_id AND  receiver_id=$receiver_id OR sender_id=$receiver_id AND receiver_id=$user_id";
			    $this->db->select('*');
                $this->db->from('chat');
                $this->db->where($where);
                $this->db->order_by('chat_id');
                $query=$this->db->get();
                $result=$query->result();
                
                $chatArr=array();
                foreach($result as $row):
                    $sender_id=$row->sender_id;
                    $receiver_id=$row->receiver_id;
                    
                    
                   $sender_data=$this->db->get_where('tbl_users',array('user_id'=>$sender_id))->row_array();
                   $sender=$sender_data['user_name'];
                   $sender_id=$sender_data['user_id'];
                   $sender_profile=$sender_data['profile_image'];
                   
                   $receiver_data=$this->db->get_where('tbl_users',array('user_id'=>$receiver_id))->row_array();
                   $receiver=$receiver_data['user_name'];
                   $receiver_profile=$receiver_data['profile_image'];
                   $receiver_id=$receiver_data['user_id'];
                   
                    $dataArr=array('sender'=>$sender,
                                   'receiver'=>$receiver,
                                   'sender_id'=>$sender_id,
                                   'sender_profile'=>$sender_profile,
                                   'receiver_profile'=>$receiver_profile,
                                   'receiver_id'=>$receiver_id,
                                   'message'=>$row->message,
                                   'attachment'=>$row->attachment,
                                   'create_on'=>$row->create_on);
                        array_push($chatArr,$dataArr);
                endforeach;
                $json = array("status" =>1,"message" => "Chat","data"=>$chatArr);
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function change_password()
	{
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
		    $this->form_validation->set_rules('new_password', 'new_password', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
				$where=array('user_id'=>$this->input->post('user_id'));
				$data=array('password'=>$this->input->post('new_password'));
				$table="tbl_users";
				$this->Common->update_data($table,$data,$where);
				$json = array("status" => 1,"message" => "Password Change Successfully");
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function update_profile()
	{
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
		    $this->form_validation->set_rules('user_name', 'user_name', 'required');
		    $this->form_validation->set_rules('user_email', 'user_email', 'required');
		    $this->form_validation->set_rules('phone', 'phone', 'required');
		    $this->form_validation->set_rules('country', 'country', 'required');
		    $this->form_validation->set_rules('city', 'city', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
				$where=array('user_id'=>$this->input->post('user_id'));
				 $dataArr=array('user_name'=>$this->input->post('user_name'),
				                   'user_email'=>$this->input->post('user_email'),
				                   'phone'=>$this->input->post('phone'),
				                   'country'=>$this->input->post('country'),
				                   'city'=>$this->input->post('city'));
				                   
					if(isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name']))
				    {
				        $config['upload_path']          = './uploads/profile_image/';
                        $config['allowed_types']        = 'jpeg|jpg|png|JPG';
                        $config['max_size']             = 100000;
                        $config['max_width']            = 102004;
                        $config['max_height']           = 76800;

                        $this->load->library('upload', $config);
        
                        if (!$this->upload->do_upload('profile_image'))
                        {
                            $error = array('error' => $this->upload->display_errors());
                            echo json_encode($error);die();
                        }
                        else
                        {
                            $data = array('upload_data' => $this->upload->data());
                            $dataArr['profile_image']=base_url().'uploads/profile_image/'.$data['upload_data']['file_name'];
        
                        }
				    }   
				$table="tbl_users";
				$this->Common->update_data($table,$dataArr,$where);
				$dataArr['user_id']=$this->input->post('user_id');
				$json = array("status" => 1,"message" => "Profile Updated Successfully.",'data'=>$dataArr);
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function update_profile_image()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
				$where=array('user_id'=>$this->input->post('user_id'));
					if(isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name']))
				    {
				        $config['upload_path']          = './uploads/profile_image/';
                        $config['allowed_types']        = 'jpeg|jpg|png|JPG';
                        $config['max_size']             = 100000;
                        $config['max_width']            = 102004;
                        $config['max_height']           = 76800;

                        $this->load->library('upload', $config);
        
                        if (!$this->upload->do_upload('profile_image'))
                        {
                            $error = array('error' => $this->upload->display_errors());
                            echo json_encode($error);die();
                        }
                        else
                        {
                            $data = array('upload_data' => $this->upload->data());
                            $dataArr['profile_image']=base_url().'uploads/profile_image/'.$data['upload_data']['file_name'];
        
                        }
				    }   
				$table="tbl_users";
				$this->Common->update_data($table,$dataArr,$where);
				$dataArr['user_id']=$this->input->post('user_id');
				$json = array("status" => 1,"message" => "Profile Image Updated Successfully.",'data'=>$dataArr);
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function add_cart()
	{
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('product_id', 'product_id', 'required');
		    $this->form_validation->set_rules('product_name', 'product_name', 'required');
		    $this->form_validation->set_rules('quantity', 'quantity', 'required');
		    $this->form_validation->set_rules('price', 'price', 'required');
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
			    $product_id=$this->input->post('product_id');
			    $product_name=$this->input->post('product_name');
			    $quantity=$this->input->post('quantity');
			    $price=$this->input->post('price');
			    $user_id=$this->input->post('user_id');
			    $data=array('product_id'=>$product_id,
			                'product_name'=>$product_name,
			                'quantity'=>$quantity,
			                'price'=>$price,
			                'user_id'=>$user_id,
			                'status'=>'Pending');
			    $table="cart";
			    $last_inserted_id=$this->Common->batch_insert($table,$data);
			    if(!empty($last_inserted_id)){
			        $dataArr['cart_id']=$last_inserted_id;
			        $json = array("status" => 1,"message" => "Product Successfully added to cart.",'data'=>$dataArr);
			    }else{
			        $json = array("status" => 0,"message" => "Something went wrong. Please try again.");
			    }
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function payment_success()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('cart_id', 'cart_id', 'required');
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
			    $cart_id=$this->input->post('cart_id');
			    $user_id=$this->input->post('user_id');
			    $data=array('status'=>'Completed');
			    $where=array('id'=>$cart_id,
			                'user_id'=>$cart_id);
			    $table="cart";
			    $last_inserted_id=$this->Common->update_data($table,$data,$where);
			    $json = array("status" => 1,"message" => "Product Buyed Successfully.");
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function my_chats()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{	
			    $user_id=$this->input->post('user_id');
			    $where="sender_id='$user_id' OR receiver_id='$user_id'";
			    $this->db->select('sender_id,receiver_id');
			    $this->db->where($where);
			    $this->db->from('chat');
			    $this->db->group_by(array("sender_id", "receiver_id")); 
			    $query=$this->db->get();
                $result=$query->result(); 
               
                $myfriends=array();
                foreach($result as $row):
                    $sender_id=$row->sender_id;
                    $receiver_id=$row->receiver_id;
                    if(!in_array ($sender_id, $myfriends) && $receiver_id!=$user_id)
                    {
                        array_push($myfriends,$sender_id);
                    }
                    
                    if(!in_array ($receiver_id, $myfriends) && $receiver_id!=$user_id)
                    {
                        array_push($myfriends,$receiver_id);
                    }
                    
                endforeach;
              
                $pos=array_search($user_id,$myfriends);  
                unset($myfriends[$pos]);
                $myfriends=array_values($myfriends);
                
                $temp=array();
                for($i=0;$i<count($myfriends);$i++)
                {
                    $userid=$myfriends[$i];
                    $this->db->select('tbl_users.user_id,tbl_users.user_name,tbl_users.profile_image'); 
                    $where=array('user_id'=>$userid);
                    $this->db->where($where);
                    $this->db->from('tbl_users');
                    $query=$this->db->get();
                    $result1=$query->row_array(); 
                    
                    $data=array('user_id'=>$result1['user_id'],
                                "user_name"=>$result1['user_name'],
                                "profile_image"=>$result1['profile_image']);
                                
                    $this->db->select('message');
                    $where="receiver_id=$userid OR sender_id=$userid";
                    $this->db->order_by('chat_id','desc');
                    $this->db->limit(1);
                    $this->db->where($where);
                    $this->db->from('chat');
                    $query=$this->db->get();
                    $message_data=$query->row_array();
                    $data['message']=$message_data['message'];
                    array_push($temp,$data);
                }
                
               
                    
                    $data=$temp;
                    $json = array("status" => 1,"message" => "Chat History",'data'=>$data);

		    } 
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
    
    function get_cart_products()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
			    $user_id=$this->input->post('user_id');
			    $where=array('user_id'=>$user_id,
			                 'status'=>'Pending');
			    $table="cart";
			    $select="id,product_id,product_name,quantity,price,user_id,";
			    $data=$this->Common->get_where_select_multiple($select,$where,$table);
			    if(!empty($data)){
			        $json = array("status" => 1,"message" => "Cart List.",'data'=>$data);
			    }else{
			        $json = array("status" => 0,"message" => "Cart is empty.");
			    }
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function reset_cart()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
			    $user_id=$this->input->post('user_id');
			    $where=array('user_id'=>$user_id);
			    $table="cart";
			    $this->db->where($where);
			    $this->db->delete($table);
			    $json = array("status" => 1,"message" => "Reset Successfull.");
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function remove_product_fromcart()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
		    $this->form_validation->set_rules('cart_id', 'cart_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
			    $user_id=$this->input->post('user_id');
			    $cart_id=$this->input->post('cart_id');
			    $where=array('user_id'=>$user_id,
			                 'id'=>$cart_id);
			    $table="cart";
			    $this->db->where($where);
			    $this->db->delete($table);
			    $json = array("status" => 1,"message" => "Product Removed Successfully.");
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function place_order_user()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
		    $this->form_validation->set_rules('items', 'items', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{	
			    $user_id=$this->input->post('user_id');
			    $items= json_decode($this->input->post("items"));
			    $date=date('Y-m-d');
			    
			    $where=array('user_id'=>$user_id);
			    $data=array('status'=>'Completed');
			    $table="cart";
			    $this->Common->update_data($table,$data,$where);
			    
			    $dataArr=array('user_id'=>$this->input->post('user_id'),
			                   'order_date'=>$date);
			    $this->db->insert('orders',$dataArr);
			    $order_id=$this->db->insert_id();
			    $ordertamount=0;
			    foreach($items as $key => $value)
                {
                    $order_details = array(
    			        "order_id" => $order_id,
    			        "product_id" => $value->product_id,
    			        "quantity" => $value->quantity,
    			        "price" =>$value->price,
    			        "sub_total"=>$value->quantity*$value->price,
    			        );
    			    $ordertamount=$ordertamount+(($value->price)*($value->quantity));
                    $this->db->insert('order_detalis',$order_details);
                    
                    # Disable Product
                    $data=array('in_use'=>'N','display'=>'N');
                    $where=array('product_id'=>$value->product_id);
                    $table="tbl_products";
                    $this->Common->update_data($table,$data,$where);
                }
                $amt=array('total_amount'=>$ordertamount);
                $this->db->update('orders',$amt,array('order_id'=>$order_id));
			    
			    # Send FCM Notification
			    $userdata=$this->db->get_where('tbl_users',array('user_id'=>$this->input->post('user_id')))->row_array();
			    $token=$userdata['fcm_token']; 
			    $title="New Order Received";
			    $body="You Have One New Order Received";
			    $this->send_notification($token,$title,$body);
			    
    			$json =  array("status" => 1,"message"=>"Order Placed Successfully");
		    } 
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
    
    function get_rewards()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'GET')
		{   
		    $select="user_id,user_name,profile_image,reward";
		    $this->db->select($select);
            $this->db->from('tbl_users');
            $this->db->Order_By('reward','desc');
            $query=$this->db->get();
            $data= $query->result();
            if(!empty($data))
            {
                $json = array("status" => 1,"message" => "Users Reward List.","data"=>$data);
            }else{
                $json = array("status" => 0,"message" => "No Record Found.");
            }
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Cannot Be Accepted");
	    }
	    echo json_encode($json);
    }
    
    
    function order_history()
    {
         $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
			    $user_id=$this->input->post('user_id');
			    $select="orders.order_id,orders.user_id,order_detalis.product_id,tbl_products.user_id as seller_id,product_name,product_image,price,quantity";
			    $where=array('orders.user_id'=>$user_id);
			    $table1="orders";
			    $table2="order_detalis";
			    $table3="tbl_products";
			    $data=$this->Common->get_inner_join_orderdetails($select,$where,$table1,$table2,$table3);
			    for($i=0;$i<count($data);$i++){
			        $image_string=$data[$i]->product_image;
			        $data[$i]->product_image= explode(',', $image_string);
			    }
			    
			    if(!empty($data))
			    {
			         $json = array("status" => 1,"message" => "Order History.",'data'=>$data);   
			    }else{
			        $json = array("status" => 0,"message" => "No Order History Available.");
			    }
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function order_details()
    {
         $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('order_id', 'order_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
			    $order_id=$this->input->post('order_id');
			    $select="tbl_products.product_id,order_id,tbl_products.user_id as seller_id,price,quantity,product_name,product_image";
			    $where=array('order_id'=>$order_id);
			    $table1="order_detalis";
			    $table2="tbl_products";
			    $data=$this->Common->order_details($select,$where,$table1,$table2);
			    for($i=0;$i<count($data);$i++){
			        $image_string=$data[$i]->product_image;
			        $data[$i]->product_image= explode(',', $image_string);
			    }
			    if(!empty($data))
			    {
			         $json = array("status" => 1,"message" => "Order Details.",'data'=>$data);   
			    }else{
			        $json = array("status" => 0,"message" => "No Order Details Available.");
			    }
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
     function feedback()
    {
         $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
		    $this->form_validation->set_rules('title', 'title', 'required');
		    $this->form_validation->set_rules('description', 'description', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
			    $user_id=$this->input->post('user_id');
			    $title=$this->input->post('title');
			    $description=$this->input->post('description');
			    $table="feedback";
			    $data=array('user_id'=>$user_id,
			                'title'=>$title,
			                'description'=>$description);
			    $last_inserted_id=$this->Common->batch_insert($table,$data);
			    if(!empty($data))
			    {
			         $json = array("status" => 1,"message" => "Thankyou For your Feedback.",'data'=>$data);   
			    }else{
			        $json = array("status" => 0,"message" => "Something went wrong please try again.");
			    }
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function get_notification()
    {
        $method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'POST')
		{   
		    $this->form_validation->set_rules('user_id', 'user_id', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$error = implode(",", $this->form_validation->error_array());
				$error = explode(",", $error);
				$json = array("status" => 0,"message" =>  $error[0]);
			}
			else
			{  
			    $user_id=$this->input->post('user_id');
			    $table="notification";
			    $where=array('user_id'=>$user_id);
			    $select="user_id,title,date";
			    $data=$this->Common->get_where_select_multiple($select,$where,$table);
			    if(!empty($data))
			    {
			         $json = array("status" => 1,"message" => "Notifications.",'data'=>$data);   
			    }else{
			        $json = array("status" => 0,"message" => "No Notification Available.");
			    }
			}
	    }
	    else
	    { 
		    $json = array("status" => 0,"message" => "Signup Failed");
	    }
	    echo json_encode($json);
    }
    
    function about_us()
    {
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'GET')
		{   
		    $select="*";
		    $where=array('page_type'=>'About us');
		    $table="cms";
		    $result=$this->Common->get_where_select_single($select,$where,$table);
		    $json = array("status" =>1,"message" =>"About Us","data"=>$result);
		}else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Not Accepted");
	    }
	    echo json_encode($json);
    }
    
    function privacy_policy()
    {
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'GET')
		{   
		    $select="*";
		    $where=array('page_type'=>'Privacy Policy');
		    $table="cms";
		    $result=$this->Common->get_where_select_single($select,$where,$table);
		    $json = array("status" =>1,"message" =>"Privacy & Policy","data"=>$result);
		}else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Not Accepted");
	    }
	    echo json_encode($json);
    }
    
    function terms_condition()
    {
		$method = $_SERVER['REQUEST_METHOD']; 
		if($method == 'GET')
		{   
		    $select="*";
		    $where=array('page_type'=>'Terms & Conditions');
		    $table="cms";
		    $result=$this->Common->get_where_select_single($select,$where,$table);
		    $json = array("status" =>1,"message" =>"Terms & Conditions","data"=>$result);
		}else
	    { 
		    $json = array("status" => 0,"message" => "Request Method Not Accepted");
	    }
	    echo json_encode($json);
    }
    
    function hello()
    {
			    $token="ecVsp-doh8Y:APA91bE0NoXaBMMerFNuXPRG0MgFNH1dxwrMMoIdKm2Sl_B8g7zuDK4SUYXUlqCofLnSmT2cd5tZLT8RLZMeNfpua03Ol-339U8VWdLQVDO_xw-oFciS-5N6JEQOKOp2VehG5nl9B8IP"; 
			    $title="New Order Received";
			    $body="You Have One New Order Received";
			    $this->send_notification($token,$title,$body);
    }
    
    function send_notification($token,$title,$body)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = 'AAAAKjoQw3I:APA91bEGk2toH25FnWKbzDEt_Fz7jfj2GKhh180j7PcIbvAd_h91sKqPiw37kQvnYqmfLXqs1tRoacjbVQo-XxkX8-YdRkvxzGvl9nRK_ZqGnOFM52MYDqFpu3iQJ-mFPKwOAqsSRgyh';
        $notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
        $arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        //Send the request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        //Close request
        if ($response === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
    }
    
}
