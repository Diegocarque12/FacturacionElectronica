<?php 
namespace App\Models;

use CodeIgniter\Model;

class EmpresasModel extends Model{
    private $id_empresa;
    private $identificacion;
    private $id_tipo_identificacion;
    private $razon;
    private $nombre_comercial;
    private $cod_actividad; 
    private $id_ubicacion;
    private $otras_senas;
    private $telefono;
    private $cod_pais;
    private $correo;
    private $activo;
    
                          
    private $tabla= "empresas";
    private $tabla_view= "empresas_view";
///***
    public function setIdEmpresa($id_empresa)
    {
        $this->id_empresa = $id_empresa;
        return $this;
    }


    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;
        return $this;
    }


    public function setIdTipoIdentificacion($id_tipo_identificacion)
    {
        $this->id_tipo_identificacion = $id_tipo_identificacion;
        return $this;
    }


    public function setRazon($razon)
    {
        $this->razon = $razon;
        return $this;
    }


    public function setNombreComercial($nombre_comercial)
    {
        $this->nombre_comercial = $nombre_comercial;
        return $this;
    }

    public function setCodActividad($cod_actividad)
    {
        $this->cod_actividad = $cod_actividad;
        return $this;
    }   


    public function setIdUbicacion($id_ubicacion)
    {
        $this->id_ubicacion = $id_ubicacion;
        return $this;
    }


    public function setOtrasSenas($otras_senas)
    {
        $this->otras_senas = $otras_senas;
        return $this;
    }


    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
        return $this;
    }


    public function setCodPais($cod_pais)
    {
        $this->cod_pais = $cod_pais;
        return $this;
    }


    public function setCorreo($correo)
    {
        $this->correo = $correo;
        return $this;
    }


    public function setActivo($activo)
    {
        $this->activo = $activo;
        return $this;
    }

                                      

    public function __construct()
    {
        $this->db=db_connect();
    }

///***   

    public function selectEmpresas(){
        $query = $this->db->table($this->tabla);
        return $query->get()->getResult();
    }
    
    public function selectEmpresa(){
        $query = $this->db->table($this->tabla_view);
        $query->where('id_empresa', $this->id_empresa);
        return $query->get()->getRow();
    }
    
}