<?php 
namespace App\Models;

use CodeIgniter\Model;

class DocumentosDetallesModel extends Model{
    private $id_detalle;  
    private $id_documento;    
    private $linea;      
    private $codigo;  
    private $cantidad;    
    private $unidad_medida;   
    private $detalle; 
    private $precio_unidad;   
    private $monto_total; 
    private $monto_descuento; 
    private $motivo_descuento;    
    private $sub_total;   
    private $codigo_impuesto; 
    private $codigo_tarifa;   
    private $tarifa;  
    private $monto_impuesto;  
    private $tipo_exoneracion;    
    private $numero_exoneracion;  
    private $institucion_exoneracion; 
    private $fecha_exoneracion;   
    private $porcentaje_exoneracion; 
    private $monto_exoneracion;   
    private $impuesto_neto;   
    private $total_linea;

    private $tabla= "documentos_detalles";
    private $tabla_view= "documentos_detalles_view";

///***
    /**
     * @param mixed $id_detalle
     *
     * @return self
     */
    public function setIdDetalle($id_detalle)
    {
        $this->id_detalle = $id_detalle;

        return $this;
    }

    /**
     * @param mixed $id_documento
     *
     * @return self
     */
    public function setIdDocumento($id_documento)
    {
        $this->id_documento = $id_documento;

        return $this;
    }

    /**
     * @param mixed $linea
     *
     * @return self
     */
    public function setLinea($linea)
    {
        $this->linea = $linea;

        return $this;
    }


    /**
     * @param mixed $codigo
     *
     * @return self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * @param mixed $cantidad
     *
     * @return self
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * @param mixed $unidad_medida
     *
     * @return self
     */
    public function setUnidadMedida($unidad_medida)
    {
        $this->unidad_medida = $unidad_medida;

        return $this;
    }

    /**
     * @param mixed $detalle
     *
     * @return self
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * @param mixed $precio_unidad
     *
     * @return self
     */
    public function setPrecioUnidad($precio_unidad)
    {
        $this->precio_unidad = $precio_unidad;

        return $this;
    }

    /**
     * @param mixed $monto_total
     *
     * @return self
     */
    public function setMontoTotal($monto_total)
    {
        $this->monto_total = $monto_total;

        return $this;
    }

    /**
     * @param mixed $monto_descuento
     *
     * @return self
     */
    public function setMontoDescuento($monto_descuento)
    {
        $this->monto_descuento = $monto_descuento;

        return $this;
    }

    /**
     * @param mixed $motivo_descuento
     *
     * @return self
     */
    public function setMotivoDescuento($motivo_descuento)
    {
        $this->motivo_descuento = $motivo_descuento;

        return $this;
    }

    /**
     * @param mixed $sub_total
     *
     * @return self
     */
    public function setSubTotal($sub_total)
    {
        $this->sub_total = $sub_total;

        return $this;
    }

    /**
     * @param mixed $codigo_impuesto
     *
     * @return self
     */
    public function setCodigoImpuesto($codigo_impuesto)
    {
        $this->codigo_impuesto = $codigo_impuesto;

        return $this;
    }

    /**
     * @param mixed $codigo_tarifa
     *
     * @return self
     */
    public function setCodigoTarifa($codigo_tarifa)
    {
        $this->codigo_tarifa = $codigo_tarifa;

        return $this;
    }

    /**
     * @param mixed $tarifa
     *
     * @return self
     */
    public function setTarifa($tarifa)
    {
        $this->tarifa = $tarifa;

        return $this;
    }

    /**
     * @param mixed $monto_impuesto
     *
     * @return self
     */
    public function setMontoImpuesto($monto_impuesto)
    {
        $this->monto_impuesto = $monto_impuesto;

        return $this;
    }

    /**
     * @param mixed $tipo_exoneracion
     *
     * @return self
     */
    public function setTipoExoneracion($tipo_exoneracion)
    {
        $this->tipo_exoneracion = $tipo_exoneracion;

        return $this;
    }

    /**
     * @param mixed $numero_exoneracion
     *
     * @return self
     */
    public function setNumeroExoneracion($numero_exoneracion)
    {
        $this->numero_exoneracion = $numero_exoneracion;

        return $this;
    }

    /**
     * @param mixed $institucion_exoneracion
     *
     * @return self
     */
    public function setInstitucionExoneracion($institucion_exoneracion)
    {
        $this->institucion_exoneracion = $institucion_exoneracion;

        return $this;
    }

    /**
     * @param mixed $fecha_exoneracion
     *
     * @return self
     */
    public function setFechaExoneracion($fecha_exoneracion)
    {
        $this->fecha_exoneracion = $fecha_exoneracion;

        return $this;
    }

    /**
     * @param mixed $porcentaje_exoneracion
     *
     * @return self
     */
    public function setPorcentajeExoneracion($porcentaje_exoneracion)
    {
        $this->porcentaje_exoneracion = $porcentaje_exoneracion;

        return $this;
    }

    /**
     * @param mixed $monto_exoneracion
     *
     * @return self
     */
    public function setMontoExoneracion($monto_exoneracion)
    {
        $this->monto_exoneracion = $monto_exoneracion;

        return $this;
    }

    /**
     * @param mixed $impuesto_neto
     *
     * @return self
     */
    public function setImpuestoNeto($impuesto_neto)
    {
        $this->impuesto_neto = $impuesto_neto;

        return $this;
    }

    /**
     * @param mixed $total_linea
     *
     * @return self
     */
    public function setTotalLinea($total_linea)
    {
        $this->total_linea = $total_linea;

        return $this;
    }

    public function __construct()
    {
        $this->db=db_connect();
    }
///***

    public function selectDocumentosDetalles(){
        $query = $this->db->table($this->tabla);
        $query->where('id_documento', $this->id_documento);
        return $query->get()->getResult();
    }
    
    public function insertarDocumentoDetalle() {
        $query = $this->db->table($this->tabla);
        $data = array(
            "id_documento"  => $this->id_documento,  
            "linea"   => $this->linea,
            "codigo"  => $this->codigo,
            "cantidad"    => $this->cantidad,
            "unidad_medida"   => $this->unidad_medida,
            "detalle" => $this->detalle,
            "precio_unidad"  => $this->precio_unidad, 
            "monto_total" => $this->monto_total,
            "monto_descuento" => $this->monto_descuento,
            "motivo_descuento"   => $this->motivo_descuento, 
            "sub_total" => $this->sub_total,  
            "codigo_impuesto" => $this->codigo_impuesto,
            "codigo_tarifa"  => $this->codigo_tarifa, 
            "tarifa"  => $this->tarifa,
            "monto_impuesto"  => $this->monto_impuesto,
            "tipo_exoneracion"   => $this->tipo_exoneracion, 
            "numero_exoneracion"  => $this->numero_exoneracion,
            "institucion_exoneracion" => $this->institucion_exoneracion,
            "fecha_exoneracion"   => $this->fecha_exoneracion,
            "porcentaje_exoneracion" => $this->porcentaje_exoneracion,
            "monto_exoneracion"   => $this->monto_exoneracion,
            "impuesto_neto"   => $this->impuesto_neto,
            "total_linea"=> $this->total_linea,
        );
        $query->insert($data);
        return $this->db->insertID();
    } 
}//Fin de la clase