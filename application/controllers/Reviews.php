<?php
 class Reviews extends CI_Controller
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 		$this->load->model('Common_model','Common');	
 	}

 	function index()
 	{
 		if($this->session->userdata('logged_in'))
		{		
			$this->load->view('template/header');
			$this->db->select('rating,reviews.gst_no,review,reviews.id,first_name,last_name');    
            $this->db->from('reviews');
            $this->db->join('users', 'reviews.user_id = users.user_id');
            $this->db->where('reviews.isActive','0');
            $query = $this->db->get();
            $data['Reviews']=$query->result();
			$this->load->view('Reviews/list',$data); 
			$this->load->view('template/footer');
		}
		else
		{
			redirect('Login','refresh');
		}
 	}
 	
 	function delete_review($id)
 	{
 		if($this->session->userdata('logged_in'))
		{		
			$data = array("isActive" => "1");
			$where=array('id'=>$id);
			$table="reviews";
			$this->db->delete($table,$where);
			redirect('Reviews','refresh');
		}
		else
		{
			redirect('Login','refresh');
		}
 	}
 	
 	function Edit()
 	{
 	    
 		if($this->session->userdata('logged_in'))
		{		
		    $reviewid=$this->uri->segment(3);
		    $this->load->view('template/header');
		    $this->db->select('rating,reviews.gst_no,review,reviews.id,first_name,last_name');    
            $this->db->from('reviews');
            $this->db->join('users', 'reviews.user_id = users.user_id');
            $this->db->where('reviews.id',$reviewid);
            $query = $this->db->get();
            $data['Reviews']=$query->row_array();
    		$this->load->view('Reviews/edit',$data);
    		$this->load->view('template/footer');   
		  
		}
		else
		{
			redirect('Login','refresh');
		}
 	}
 	
 	function UpdateReviews()
	{ 
		if($this->session->userdata('logged_in'))
		{   
		    $this->form_validation->set_rules('id', 'id', 'required');
		    $this->form_validation->set_rules('rating', 'rating', 'required');
		    $this->form_validation->set_rules('review', 'review', 'required');
			$user_id=$this->input->post('id');
			if ($this->form_validation->run() == FALSE) 
			{
			    redirect('Edit-User/'.$user_id);
			}
			else
			{  
			    $id=$this->input->post('id');
			    $data=array('rating'=>$this->input->post('rating'),
			                'review'=>$this->input->post('review')
			    );
			    $table="reviews";
			    $where=array('id'=>$id);
			    $this->Common->update_data($table,$data,$where);
			    redirect("Reviews");
			    
    				
		    }
		}else
		{
		   redirect('Login','refresh');
	    }
    }
    
    
	
}

 ?>