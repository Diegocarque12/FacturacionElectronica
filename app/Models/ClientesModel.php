<?php 
namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model{
    private $id_cliente;
    private $identificacion;
    private $id_tipo_identificacion;
    private $razon;
    private $nombre_comercial;
    private $id_ubicacion;
    private $otras_senas;
    private $telefono;
    private $cod_pais;
    private $correo;
    private $activo;

    private $tabla= "clientes";
    private $tabla_view= "clientes_view";
///***
    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
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

    public function selectClientes(){
        $query = $this->db->table($this->tabla);
        return $query->get()->getResult();
    }
    
    public function selectCliente(){
        $query = $this->db->table($this->tabla_view);
        $query->where('id_cliente', $this->id_cliente);
        return $query->get()->getRow();
    }

    public function insertarCliente() {
        $query = $this->db->table($this->tabla);
        $data = array(
            "identificacion" => $this->identificacion,
            "id_tipo_identificacion" => $this->id_tipo_identificacion,
            "razon" => $this->razon,
            "nombre_comercial" => $this->nombre_comercial,
            "id_ubicacion" => $this->id_ubicacion,
            "otras_senas" => $this->otras_senas,
            "telefono" => $this->telefono,
            "cod_pais" => $this->cod_pais,
            "correo" => $this->correo,
            "activo" => $this->activo,
        );
        $query->insert($data);
        return $this->db->insertID();
    }
    public function editarCliente() {
        $query = $this->db->table($this->tabla);
        $data = array(
            "identificacion" => $this->identificacion,
            "id_tipo_identificacion" => $this->id_tipo_identificacion,
            "razon" => $this->razon,
            "nombre_comercial" => $this->nombre_comercial,
            "id_ubicacion" => $this->id_ubicacion,
            "otras_senas" => $this->otras_senas,
            "telefono" => $this->telefono,
            "cod_pais" => $this->cod_pais,
            "correo" => $this->correo,
            "activo" => $this->activo,
        );
        $query->where('id_cliente', $this->id_cliente);
        $query->update($data);
        return $this->db->affectedRows();
    }

    public function activarCliente() {
        $query = $this->db->table($this->tabla);
        $data = array(
            "activo" => $this->activo,
        );
        $query->where('id_cliente', $this->id_cliente);
        $query->update($data);
        return $this->db->affectedRows();
    }




    
}