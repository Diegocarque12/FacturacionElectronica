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

    public function salir(){
		$session= $this->session = \Config\Services::session();
		$session->destroy();
		return redirect()->to(base_url("login/login"));
	}

}