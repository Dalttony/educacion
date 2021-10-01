<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("Administracion_model");
		$this->load->model("Usuario_model");
		if(!$this->session->userdata('user_session')){
			redirect(base_url().'login');
		}else{
			$this->datos_admin = $this->Administracion_model->obtener_datos_admin($this->session->userdata('user_session'));
		}
	}
	function index()
	{
		
			$datos_enviar = array(
				'admin' => 	$this->datos_admin
			);
			$this->load->view('admin/administrador', $datos_enviar);
	}

	public function listar_usuario(){
		$data = $this->Administracion_model->listar_usuario();
		if($data){
			echo json_encode($data);
		}else{
			echo json_encode(array());
		}
	}
}
