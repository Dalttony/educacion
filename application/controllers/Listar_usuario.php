<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listar_usuario extends CI_Controller {

	function __construct(){
		parent::__construct();
		
	}
	function index()
	{

			$this->load->view('admin/usuario/vista_usuario_listar');
	}


}