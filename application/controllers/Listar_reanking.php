<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listar_reanking extends CI_Controller {

	function __construct(){
		parent::__construct();
		
	}
	function index()
	{

			$this->load->view('admin/tabla_de_clasificacion/vista_tabla_de_clasificacion');
	}


}