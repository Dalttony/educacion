<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracion_model extends CI_Model {


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

    public function obtener_datos_admin($admin_session){
        $this->db->select("usu_nombre, usu_nombre_completo");
        $this->db->from("usuario");
        $this->db->where('usu_id', $admin_session);
        $resultado = $this->db->get();
       
        return $resultado->first_row();
    }

    function listar_usuario(){
        $sql = "call SP_LISTAR_USUARIO()";
        $query = $this->db->query($sql);
        return $query->result();
    }
}