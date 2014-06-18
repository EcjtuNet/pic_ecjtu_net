<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller 
{
	private $data = array();
	function __construct()
	{
		
	}
	function index(){
	$this->load->view('index1');
	}
}