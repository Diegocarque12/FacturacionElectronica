<?php

namespace App\Controllers;

class Inicio extends BaseController
{
	public function inicio()
	{
		if( is_login() ){
			return view('inicio/dash');
		}else{
			return redirect()->to(base_url("login/login"));
		}

	}

	
}