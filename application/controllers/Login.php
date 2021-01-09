<?php

class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model','Common');	
	}

	public function index()
	{
      if(!empty($_POST))
        {            
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $result = $this->Common->login($email,$password);
            if($result -> num_rows() > 0)
            {
                foreach ($result->result() as $row)
                {
                    $this->session->userid = $row->id;
                    $this->session->email =  $row->email;
                    $this->session->logged_in ="yes";
                    $this->session->is_admin =  $row->is_admin;
                    redirect('Users');
                }
            }
            else
            {
                $data['email'] = $email;
                $data['password'] = $password;
                $this->session->set_flashdata('SUCCESSMSG','Email and Password is Wrong');
                $this->load->view('login',$data);
            }
        }
		else
		{
			$this->load->view('login');
		}
	}
	

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		redirect('Login','refresh');
	}
	
}




 ?>