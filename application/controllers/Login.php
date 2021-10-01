<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("Administracion_model");
		$this->load->library('session');
	}
	function index()
	{

			$this->load->view('login/login');
	}

	public function verificar_usuario(){
		$data = $this->Administracion_model->verificar_usuario(
			$this->input->post('user'), 
			$this->input->post('pass')
		);
		if($data){
			echo json_encode(array(
				'id' => $data->usu_id,
				'status' => $data->usu_status,
				'nombre' => $data->nombre
			));
			$this->session->set_userdata('user_session', $data->usu_id);
		}else{
			echo json_encode(array("error" => true));
		}
	}
}
