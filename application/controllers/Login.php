<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("Usuario_model");
	}
	function index()
	{

			$this->load->view('login/login');
	}

	public function verificar_usuario(){
		//login
		return array('error' => true);
		return $this->Usuario_model->verificar_usuario(
			$this->input->post('user'), 
			$this->input->post('pass')

		);
	}
}
