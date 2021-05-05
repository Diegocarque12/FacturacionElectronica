<?php 
namespace App\Models;

use CodeIgniter\Model;

class ConsecutivosModel extends Model{
    private $id_consecutivo;
    private $ambiente;
    private $tipo_documento;
    private $consecutivo;

    private $tabla= "consecutivos";
    private $tabla_view= "consecutivos_view";
///***   
    /**
     * @param mixed $id_consecutivo
     *
     * @return self
     */
    public function setIdConsecutivo($id_consecutivo)
    {
        $this->id_consecutivo = $id_consecutivo;

        return $this;
    }

    /**
     * @param mixed $ambiente
     *
     * @return self
     */
    public function setAmbiente($ambiente)
    {
        $this->ambiente = $ambiente;

        return $this;
    }

    /**
     * @param mixed $tipo_documento
     *
     * @return self
     */
    public function setTipoDocumento($tipo_documento)
    {
        $this->tipo_documento = $tipo_documento;

        return $this;
    }

    /**
     * @param mixed $consecutivo
     *
     * @return self
     */
    public function setConsecutivo($consecutivo)
    {
        $this->consecutivo = $consecutivo;

        return $this;
    }

  

    public function __construct()
    {
        $this->db=db_connect();
    }

///***

    

    public function selectConsecutivo(){
        $query = $this->db->table($this->tabla);
        $query->where('ambiente', $this->ambiente);
        $query->where('tipo_documento', $this->tipo_documento);
        return $query->get()->getRow();
    }

    public function actualizarConsecutivo() {
        $query = $this->db->table($this->tabla);
        $data = array(
            "consecutivo" => $this->consecutivo,
        );
        $query->where('ambiente', $this->ambiente);
        $query->where('tipo_documento', $this->tipo_documento);
        $query->update($data);
        return $this->db->affectedRows();
    }


}