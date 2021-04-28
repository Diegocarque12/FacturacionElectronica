<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Login extends BaseController
{
	public function login()
	{
		/*if( is_login() ){
			return redirect()->to(base_url("inicio/inicio"));
		}else{*/
			return view('login/login');
		//}
	}

	public function verificar()
	{
		$respuesta=0;

		$UsuariosModel= new UsuariosModel();
		$UsuariosModel->setUsuario($_POST['usuario']);
		$usuario = $UsuariosModel->selectUsuarioUsuario();
		
		if ($usuario) {
			if ($usuario->pass==$_POST['pass']) {
				
				$dataSesion = array(
                    'id_usuario' => $usuario->id_usuario,
                    'id_rol' => $usuario->id_rol,
                    'nombre' => $usuario->nombre,
                    'usuario' => $usuario->usuario,
                    'correo' => $usuario->correo,
                );
                $session = \Config\Services::session();
                $session->set($dataSesion);

				$respuesta=1;
			}
		}
		return json_encode(array("respuesta"=>$respuesta));
	}

    public function salir(){
		$session= $this->session = \Config\Services::session();
		$session->destroy();
		return redirect()->to(base_url("login/login"));
	}

}