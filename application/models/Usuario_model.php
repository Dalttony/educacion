<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {


	public function verificar_usuario($usuario, $contrasena){
		$sql = "call SP_VERIFICAR_USUARIO('$usuario')";
		$query = $this->db->query($sql);
		$usuario = $query->first_row();
		if (password_verify($contrasena, $usuario->usu_contraseña)){
			return $usuario;
		}else{
			return NULL;
		}
	}
}