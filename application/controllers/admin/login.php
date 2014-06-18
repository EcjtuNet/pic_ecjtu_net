<?php
	class Login extends CI_Controller 
	{
		private $data = array();
		function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this->load->model('options_m');
			$info = $this->options_m->get_options();
			$this->data['website'] = $info['0']['options_value'];
		}
		
		function index()
		{
			$this->load->view('admin/login',$this->data);
		}
		
		function check()
		{
			$this->load->model('User_m');
			$user = $this->input->post('username',true);
			$pass = $this->input->post('password',true);
			$bool = $this->User_m->check($user,$pass);
			if($bool > 0)
			{
				$this->session->set_userdata(array('userid'=>$user));
      			Header("Location:".site_url('admin/home'));
			}
			else
			{
				$this->data['err']='错误：用户名或密码不正确!';
      			$this->load->view('admin/login',$this->data);
			}
		}
		
		function logout()
		{
			$this->session->sess_destroy();
    		Header("Location:".site_url('admin/login'));
		}
	}
?>