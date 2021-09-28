<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {


	public function verificar_usuario($usuario, $contrasena){
		$sql = "call SP_VERIFICAR_USUARIO('$usuario')";

		$query = $this->db->query($sql);
		$usuario = $query->first_row();
		if (password_verify($contrasena, $usuario->usu_contraseña)){
			return array('hola');
		}else{
			return array('error' => true);
		}
			/*$arregl$o = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {
				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					if(password_verify($contra, $consulta_VU["usu_contraseña"]))
                    {
                        $arreglo[] = $consulta_VU;
                    }
				}
				return $arreglo;
				$this->conexion->cerrar();
			}*/
	}
}