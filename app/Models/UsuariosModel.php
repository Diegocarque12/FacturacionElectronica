<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model{
    private $id_usuario;
    private $nombre;
    private $correo;
    private $pass;
    private $id_rol;
    private $activo;

    public function __construct()
    {
        $this->db=db_connect();
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
        return $this;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
        return $this;
    }

    public function setIdRol($id_rol)
    {
        $this->id_rol = $id_rol;
        return $this;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
        return $this;
    }
    
    public function selectUsuarioUsuario(){

        $query = $this->db->table($this->usuarios);
        $query->where('usuario', $this->usuario);
        return $query->get()->getRow();
    }


}