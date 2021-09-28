<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listar_estudiantes extends CI_Controller {

	function __construct(){
		parent::__construct();
		
	}
	function index()
	{

			$this->load->view('admin/estudiantes/vista_estudiante_listar');
	}


}