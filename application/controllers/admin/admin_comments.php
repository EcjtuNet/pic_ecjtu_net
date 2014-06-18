<?php 
class Admin_comments extends CI_Controller 
	{
		private $data;
		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			if($this->session->userdata('userid')=='')
			{
				Header("Location:".site_url('admin/login'));
	     		exit();
			}
			$this->load->model('Posts_m');
			$this->load->model('Options_m');
			$this->data['options'] = $this->Options_m->get_options();
			$this->load->model('Category_m');
			$this->data['category'] = $this->Category_m->get_category();
			$this->load->model('m_test');
		}
	public function index(){
		$this->load->library('pagination');
		    $config['base_url'] = site_url('admin/admin_comments/index');
		    $config['total_rows'] = $this->m_test->select_num_rows();
		    $config['per_page'] = '2';
		    $config['uri_segment'] = 4;
		    $config['num_links'] = 10;
		    $config['first_link'] = '第一页';
		    $config['next_link'] = '下一页';
		    $config['prev_link'] = '上一页';
		    $config['last_link'] = '最后一页';
		    $this->pagination->initialize($config);
		    $data['page'] = $this->pagination->create_links();
		    $data['options'] = $this->data['options'];
			$data['website'] = $this->data['options']['0']['options_value'];
			$data['copyright'] = $this->data['options']['3']['options_value'];
		    $data['comments_list'] = $this->m_test->get_page($this->uri->segment(4,0),$config['per_page']);
		    $data['category'] = $this->data['category'];
		$this->load->view('admin/admin_comments',$data);
		}
	public function insertMessage(){
		$submit = $this->input->post('submit');
		if (isset($submit)) {
			$this->load->model('m_test');
			$admin_name = $this->input->post('admin_name');
			$admin_content = $this->input->post('admin_content');
			$this->m_test->insertMssage($admin_name,$admin_content);
			echo '<script>location = "'.site_url('admin/admin_comments').'";'.'</script>';
		}
	
	}
	}
?>