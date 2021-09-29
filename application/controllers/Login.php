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
		$data = $this->Usuario_model->verificar_usuario(
			$this->input->post('user'), 
			$this->input->post('pass')
		);
		if($data){
			echo json_encode(array(
				'id' => $data->usu_id,
				'status' => $data->usu_status,
				'nombre' => $data->nombre
			));
		}else{
			echo json_encode(array("error" => true));
		}
	}
}
