<?php
namespace App\Models;

use CodeIgniter\Model;

class DocumentosModel extends Model
{
    private $id_documento;
    private $consecutivo;
    private $tipo_documento;
    private $clave;
    private $codigo_seguridad;
    private $fecha;
    private $emisor_cedula;
    private $emisor_nombre;
    private $emisor_tipo;
    private $emisor_comercial;
    private $emisor_id_provincia;
    private $emisor_id_canton;
    private $emisor_id_distrito;
    private $emisor_id_barrio;
    private $emisor_otras_senas;
    private $emisor_cod;
    private $emisor_telefono;
    private $emisor_correo;
    private $receptor_nombre;
    private $receptor_cedula;
    private $receptor_tipo;
    private $receptor_comercial;
    private $receptor_id_provincia;
    private $receptor_id_canton;
    private $receptor_id_distrito;
    private $receptor_id_barrio;
    private $receptor_otras_senas;
    private $receptor_cod ;
    private $receptor_telefono;
    private $receptor_correo;
    private $condicion_venta;
    private $plazo_credito;
    private $medio_pago;
    private $moneda;
    private $tipo_cambio;
    private $servicios_gravados;
    private $servicios_exentos;
    private $servicios_exonerados;
    private $mercancias_gravadas;
    private $mercancias_exentas;
    private $mercancias_exoneradas;
    private $total_gravado;
    private $total_exento;
    private $total_exonerado;
    private $total_venta;
    private $total_descuentos;
    private $total_venta_neta;
    private $total_impuestos;
    private $total_comprobante;
    private $notas;
    private $id_usuario;
    private $envio_atv;
    private $valido_atv;
    private $fecha_envio;
    private $fecha_valido;

    private $tabla= "documentos";
    private $tabla_view= "documentos_view";
///***


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
     * @param mixed $consecutivo
     *
     * @return self
     */
    public function setConsecutivo($consecutivo)
    {
        $this->consecutivo = $consecutivo;

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
     * @param mixed $clave
     *
     * @return self
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * @param mixed $codigo_seguridad
     *
     * @return self
     */
    public function setCodigoSeguridad($codigo_seguridad)
    {
        $this->codigo_seguridad = $codigo_seguridad;

        return $this;
    }

    /**
     * @param mixed $fecha
     *
     * @return self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * @param mixed $emisor_cedula
     *
     * @return self
     */
    public function setEmisorCedula($emisor_cedula)
    {
        $this->emisor_cedula = $emisor_cedula;

        return $this;
    }

    /**
     * @param mixed $emisor_nombre
     *
     * @return self
     */
    public function setEmisorNombre($emisor_nombre)
    {
        $this->emisor_nombre = $emisor_nombre;

        return $this;
    }

    /**
     * @param mixed $emisor_tipo
     *
     * @return self
     */
    public function setEmisorTipo($emisor_tipo)
    {
        $this->emisor_tipo = $emisor_tipo;

        return $this;
    }

    /**
     * @param mixed $emisor_comercial
     *
     * @return self
     */
    public function setEmisorComercial($emisor_comercial)
    {
        $this->emisor_comercial = $emisor_comercial;

        return $this;
    }

    /**
     * @param mixed $emisor_id_provicia
     *
     * @return self
     */
    public function setEmisorIdProvincia($emisor_id_provincia)
    {
        $this->emisor_id_provincia = $emisor_id_provincia;

        return $this;
    }

    /**
     * @param mixed $emisor_id_canton
     *
     * @return self
     */
    public function setEmisorIdCanton($emisor_id_canton)
    {
        $this->emisor_id_canton = $emisor_id_canton;

        return $this;
    }

    /**
     * @param mixed $emisor_id_distrito
     *
     * @return self
     */
    public function setEmisorIdDistrito($emisor_id_distrito)
    {
        $this->emisor_id_distrito = $emisor_id_distrito;

        return $this;
    }

    /**
     * @param mixed $emisor_id_barrio
     *
     * @return self
     */
    public function setEmisorIdBarrio($emisor_id_barrio)
    {
        $this->emisor_id_barrio = $emisor_id_barrio;

        return $this;
    }

    /**
     * @param mixed $emisor_otras_senas
     *
     * @return self
     */
    public function setEmisorOtrasSenas($emisor_otras_senas)
    {
        $this->emisor_otras_senas = $emisor_otras_senas;

        return $this;
    }

    /**
     * @param mixed $emisor_cod
     *
     * @return self
     */
    public function setEmisorCod($emisor_cod)
    {
        $this->emisor_cod = $emisor_cod;

        return $this;
    }

    /**
     * @param mixed $emisor_telefono
     *
     * @return self
     */
    public function setEmisorTelefono($emisor_telefono)
    {
        $this->emisor_telefono = $emisor_telefono;

        return $this;
    }

    /**
     * @param mixed $emisor_correo
     *
     * @return self
     */
    public function setEmisorCorreo($emisor_correo)
    {
        $this->emisor_correo = $emisor_correo;

        return $this;
    }

    /**
     * @param mixed $receptor_nombre
     *
     * @return self
     */
    public function setReceptorNombre($receptor_nombre)
    {
        $this->receptor_nombre = $receptor_nombre;

        return $this;
    }

    /**
     * @param mixed $receptor_cedula
     *
     * @return self
     */
    public function setReceptorCedula($receptor_cedula)
    {
        $this->receptor_cedula = $receptor_cedula;

        return $this;
    }

    /**
     * @param mixed $receptor_tipo
     *
     * @return self
     */
    public function setReceptorTipo($receptor_tipo)
    {
        $this->receptor_tipo = $receptor_tipo;

        return $this;
    }

    /**
     * @param mixed $receptor_comercial
     *
     * @return self
     */
    public function setReceptorComercial($receptor_comercial)
    {
        $this->receptor_comercial = $receptor_comercial;

        return $this;
    }

    /**
     * @param mixed $receptor_id_provincia
     *
     * @return self
     */
    public function setReceptorIdProvincia($receptor_id_provincia)
    {
        $this->receptor_id_provincia = $receptor_id_provincia;

        return $this;
    }

    /**
     * @param mixed $receptor_id_canton
     *
     * @return self
     */
    public function setReceptorIdCanton($receptor_id_canton)
    {
        $this->receptor_id_canton = $receptor_id_canton;

        return $this;
    }

    /**
     * @param mixed $receptor_id_distrito
     *
     * @return self
     */
    public function setReceptorIdDistrito($receptor_id_distrito)
    {
        $this->receptor_id_distrito = $receptor_id_distrito;

        return $this;
    }

    /**
     * @param mixed $receptor_id_barrio
     *
     * @return self
     */
    public function setReceptorIdBarrio($receptor_id_barrio)
    {
        $this->receptor_id_barrio = $receptor_id_barrio;

        return $this;
    }

    /**
     * @param mixed $receptor_otras_senas
     *
     * @return self
     */
    public function setReceptorOtrasSenas($receptor_otras_senas)
    {
        $this->receptor_otras_senas = $receptor_otras_senas;

        return $this;
    }

    /**
     * @param mixed $receptor_cod
     *
     * @return self
     */
    public function setReceptorCod($receptor_cod)
    {
        $this->receptor_cod = $receptor_cod;

        return $this;
    }

    /**
     * @param mixed $receptor_telefono
     *
     * @return self
     */
    public function setReceptorTelefono($receptor_telefono)
    {
        $this->receptor_telefono = $receptor_telefono;

        return $this;
    }

    /**
     * @param mixed $receptor_correo
     *
     * @return self
     */
    public function setReceptorCorreo($receptor_correo)
    {
        $this->receptor_correo = $receptor_correo;

        return $this;
    }

    /**
     * @param mixed $condicion_venta
     *
     * @return self
     */
    public function setCondicionVenta($condicion_venta)
    {
        $this->condicion_venta = $condicion_venta;

        return $this;
    }

    /**
     * @param mixed $plazo_credito
     *
     * @return self
     */
    public function setPlazoCredito($plazo_credito)
    {
        $this->plazo_credito = $plazo_credito;

        return $this;
    }

    /**
     * @param mixed $medio_pago
     *
     * @return self
     */
    public function setMedioPago($medio_pago)
    {
        $this->medio_pago = $medio_pago;

        return $this;
    }

    /**
     * @param mixed $moneda
     *
     * @return self
     */
    public function setMoneda($moneda)
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * @param mixed $tipo_cambio
     *
     * @return self
     */
    public function setTipoCambio($tipo_cambio)
    {
        $this->tipo_cambio = $tipo_cambio;

        return $this;
    }

    /**
     * @param mixed $servicios_gravados
     *
     * @return self
     */
    public function setServiciosGravados($servicios_gravados)
    {
        $this->servicios_gravados = $servicios_gravados;

        return $this;
    }

    /**
     * @param mixed $servicios_exentos
     *
     * @return self
     */
    public function setServiciosExentos($servicios_exentos)
    {
        $this->servicios_exentos = $servicios_exentos;

        return $this;
    }

    /**
     * @param mixed $servicios_exonerados
     *
     * @return self
     */
    public function setServiciosExonerados($servicios_exonerados)
    {
        $this->servicios_exonerados = $servicios_exonerados;

        return $this;
    }

    /**
     * @param mixed $mercancias_gravadas
     *
     * @return self
     */
    public function setMercanciasGravadas($mercancias_gravadas)
    {
        $this->mercancias_gravadas = $mercancias_gravadas;

        return $this;
    }

    /**
     * @param mixed $mercancias_exentas
     *
     * @return self
     */
    public function setMercanciasExentas($mercancias_exentas)
    {
        $this->mercancias_exentas = $mercancias_exentas;

        return $this;
    }

    /**
     * @param mixed $mercancias_exoneradas
     *
     * @return self
     */
    public function setMercanciasExoneradas($mercancias_exoneradas)
    {
        $this->mercancias_exoneradas = $mercancias_exoneradas;

        return $this;
    }

    /**
     * @param mixed $total_gravado
     *
     * @return self
     */
    public function setTotalGravado($total_gravado)
    {
        $this->total_gravado = $total_gravado;

        return $this;
    }

    /**
     * @param mixed $total_exento
     *
     * @return self
     */
    public function setTotalExento($total_exento)
    {
        $this->total_exento = $total_exento;

        return $this;
    }

    /**
     * @param mixed $total_exonerado
     *
     * @return self
     */
    public function setTotalExonerado($total_exonerado)
    {
        $this->total_exonerado = $total_exonerado;

        return $this;
    }

    /**
     * @param mixed $total_venta
     *
     * @return self
     */
    public function setTotalVenta($total_venta)
    {
        $this->total_venta = $total_venta;

        return $this;
    }

    /**
     * @param mixed $total_descuentos
     *
     * @return self
     */
    public function setTotalDescuentos($total_descuentos)
    {
        $this->total_descuentos = $total_descuentos;

        return $this;
    }

    /**
     * @param mixed $total_venta_neta
     *
     * @return self
     */
    public function setTotalVentaNeta($total_venta_neta)
    {
        $this->total_venta_neta = $total_venta_neta;

        return $this;
    }

    /**
     * @param mixed $total_impuestos
     *
     * @return self
     */
    public function setTotalImpuestos($total_impuestos)
    {
        $this->total_impuestos = $total_impuestos;

        return $this;
    }

    /**
     * @param mixed $total_comprobante
     *
     * @return self
     */
    public function setTotalComprobante($total_comprobante)
    {
        $this->total_comprobante = $total_comprobante;

        return $this;
    }

    /**
     * @param mixed $notas
     *
     * @return self
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * @param mixed $id_usuario
     *
     * @return self
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    /**
     * @param mixed $envio_atv
     *
     * @return self
     */
    public function setEnvioAtv($envio_atv)
    {
        $this->envio_atv = $envio_atv;

        return $this;
    }

    /**
     * @param mixed $valido_atv
     *
     * @return self
     */
    public function setValidoAtv($valido_atv)
    {
        $this->valido_atv = $valido_atv;

        return $this;
    }

    /**
     * @param mixed $fecha_envio
     *
     * @return self
     */
    public function setFechaEnvio($fecha_envio)
    {
        $this->fecha_envio = $fecha_envio;

        return $this;
    }

    /**
     * @param mixed $fecha_valido
     *
     * @return self
     */
    public function setFechaValido($fecha_valido)
    {
        $this->fecha_valido = $fecha_valido;

        return $this;
    }

    public function __construct()
    {
        $this->db=db_connect();
    }//Fin del constructor

///***

    //Obtener todos los documentos
    public function selectDocumentos()
    {
        $query = $this->db->table($this->tabla);
        return $query->get()->getResult();
    }//Fin de selectDocumentos

    //Obtener documento por id
    public function selectDocumento(){
        $query = $this->db->table($this->tabla);
        $query->where('id_documento', $this->id_documento);
        return $query->get()->getRow();
    }//Fin de selectDocumento

    //Obtener documento por clave
    public function selectDocumentoClave()
    {
        $query = $this->db->table($this->tabla);
        $query->where('clave', $this->clave);
        return $query->get()->getRow();
    }//Fin de selectDocumentoClave

<<<<<<< HEAD
<<<<<<< HEAD
    //Insertar documento
    public function insertarDocumento() {
        $query = $this->db->table($this->tabla);
    
        $data = array(
            "id_documento" => $this->id_documento,    
            "consecutivo" => $this->consecutivo,
            "tipo_documento" => $this->tipo_documento,  
            "clave" => $this->clave,   
            "codigo_seguridad" => $this->codigo_seguridad,  
            "fecha" => $this->fecha,  
            "emisor_cedula" => $this->emisor_cedula, 
            "emisor_nombre" => $this->emisor_nombre,  
            "emisor_tipo" => $this->emisor_tipo,
            "emisor_comercial" => $this->emisor_comercial,  
            "emisor_id_provincia" => $this->emisor_id_provincia,  
            "emisor_id_canton" => $this->emisor_id_canton,
            "emisor_id_distrito" => $this->emisor_id_distrito,
            "emisor_id_barrio" => $this->emisor_id_barrio, 
            "emisor_otras_senas" => $this->emisor_otras_senas,
            "emisor_cod" => $this->emisor_cod,
            "emisor_telefono" => $this->emisor_telefono,
            "emisor_correo" => $this->emisor_correo,
            "receptor_nombre" => $this->receptor_nombre,
            "receptor_cedula" => $this->receptor_cedula,
            "receptor_tipo" => $this->receptor_tipo,  
            "receptor_comercial" => $this->receptor_comercial,
            "receptor_id_provincia" => $this->receptor_id_provincia, 
            "receptor_id_canton" => $this->receptor_id_canton,
            "receptor_id_distrito" => $this->receptor_id_distrito,   
            "receptor_id_barrio" => $this->receptor_id_barrio,
            "receptor_otras_senas" => $this->receptor_otras_senas,   
            "receptor_cod" => $this->receptor_cod,  
            "receptor_telefono" => $this->receptor_telefono, 
            "receptor_correo" => $this->receptor_correo,
            "condicion_venta" => $this->condicion_venta,
            "plazo_credito" => $this->plazo_credito,  
            "medio_pago" => $this->medio_pago,
            "moneda" => $this->moneda,
            "tipo_cambio" => $this->tipo_cambio,
            "servicios_gravados" => $this->servicios_gravados,
            "servicios_exentos" => $this->servicios_exentos, 
            "servicios_exonerados" => $this->servicios_exonerados, 
            "mercancias_gravadas" => $this->mercancias_gravadas,
            "mercancias_exentas" => $this->mercancias_exentas,
            "mercancias_exoneradas" => $this->mercancias_exoneradas, 
            "total_gravado" => $this->total_gravado, 
            "total_exento" => $this->total_exento,  
            "total_exonerado" => $this->total_exonerado,
            "total_venta" => $this->total_venta,
            "total_descuentos" => $this->total_descuentos,  
            "total_venta_neta" => $this->total_venta_neta,   
            "total_impuestos" => $this->total_impuestos,
            "total_comprobante" => $this->total_comprobante, 
            "notas" => $this->notas,
            "id_usuario" => $this->id_usuario,
            "envio_atv" => $this->envio_atv,
            "valido_atv" => $this->valido_atv,
            "fecha_envio" => $this->fecha_envio,
            "fecha_valido" => $this->fecha_valido,
        );
        return $query->insert($data);
    }//Fin de insertarDocumento

=======
>>>>>>> parent of 9c601c1 (Merge pull request #11 from Diegocarque12/validarXML)
=======
>>>>>>> parent of 9c601c1 (Merge pull request #11 from Diegocarque12/validarXML)
    //Actualizar el envio del documento
    public function actualizarEnvio()
    {
        $query = $this->db->table($this->tabla);
        $data = array(
            "envio_atv" => $this->envio_atv,
            "fecha_envio" => $this->fecha_envio,
        );
        $query->where('id_documento', $this->id_documento);
        return $query->update($data);
    }//Fin de actualizarEnvio

    //Actualizar el estado de validacion de un documento
    public function actualizarEstado()
    {
        $query = $this->db->table($this->tabla);
        $data = array(
            "valido_atv" => $this->valido_atv,
            "fecha_valido" => $this->fecha_valido,
        );
        $query->where('id_documento', $this->id_documento);
        return $query->update($data);
    }//Fin de actualizarEstado
}//Fin del modelo de documentos