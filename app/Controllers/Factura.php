<?php

namespace App\Controllers;


use App\Models\ClientesModel;
use App\Models\ConsecutivosModel;
use App\Models\EmpresasModel;

class Factura extends BaseController
{
	public function crear()
	{
        $ClientesModel= new ClientesModel();

        $data= array(
            'clientes' => $ClientesModel->selectClientes(), 
        );

		return view('factura/crear', $data);
	}

    public function listado()
	{
        $ClientesModel= new ClientesModel();

        $data= array(
            'clientes' => $ClientesModel->selectClientes(), 
        );

		return view('factura/listado', $data);
	}

	



	

	

	
}