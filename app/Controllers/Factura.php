<?php

namespace App\Controllers;

use \DomDocument;
use \App\Libraries\Firmador;
use \App\Libraries\Pdf;
use \App\Libraries\Myqr;
use \App\Libraries\Mailer;


use App\Models\ClientesModel;
use App\Models\ConsecutivosModel;
use App\Models\EmpresasModel;
use App\Models\DocumentosModel;
use App\Models\DocumentosDetallesModel;

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
        $documentosModel= new DocumentosModel();

        $data= array(
            'documentos' => $documentosModel->selectDocumentos(),
        );

		return view('factura/listado', $data);
	}

    public function generarFactura(){
        if( is_login() ){

        $id_cliente= $_POST['id_cliente'];
        $moneda= $_POST['moneda'];
        $tipo_cambio= $_POST['tipo_cambio'];
        $medio_pago= $_POST['medio_pago'];
        $condicion_venta= $_POST['condicion_venta'];
        $notas= $_POST['notas'];
        $dias=0;
        if ( $condicion_venta=="02") {
            $dias=30;
        }

        $id_tipo_documento="01";

        $ConsecutivosModel = new ConsecutivosModel();
        $ConsecutivosModel->setAmbiente(getenv('factura.ambiente'));
        $ConsecutivosModel->setTipoDocumento($id_tipo_documento);
        //
        $selectConsecutivo= $ConsecutivosModel->selectConsecutivo();
        //incrementa en 1
        $ConsecutivosModel->setConsecutivo($selectConsecutivo->consecutivo+1);
        $ConsecutivosModel->actualizarConsecutivo();


        //

        $id_factura= $selectConsecutivo->consecutivo;
        $factura= str_pad($id_factura,10,"0",STR_PAD_LEFT);
        $surcusal= "001";
        $pv="00002";
        $tipoDocumento=$id_tipo_documento;

        $consecutivo=$surcusal.$pv.$tipoDocumento.$factura;

        $EmpresasModel = new EmpresasModel();

        $EmpresasModel->setIdEmpresa(session()->get('id_empresa'));
        $emisor= $EmpresasModel->selectEmpresa();


        $cod= $emisor->codigo_telefono;
        $ced= $emisor->identificacion;
        $cedulaEmisor= str_pad($ced,12,"0",STR_PAD_LEFT);
        $situacion="1";

        $codigoSeguridad= substr(str_shuffle("0123456789"), 0, 8);

        $clave= $cod.date('d').date('m').date('y').$cedulaEmisor.$consecutivo.$situacion.$codigoSeguridad;


        $ClientesModel = new ClientesModel();
        $ClientesModel->setIdCliente($id_cliente);
        $receptor= $ClientesModel->selectCliente();

      

        $stringXML='<?xml version="1.0" encoding="utf-8"?>
        <FacturaElectronica xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/facturaElectronica">
            <Clave>'.$clave.'</Clave>
            <CodigoActividad>721001</CodigoActividad>
            <NumeroConsecutivo>'.$consecutivo.'</NumeroConsecutivo>
            <FechaEmision>'.date("c").'</FechaEmision>
            <Emisor>
                <Nombre>'.$emisor->razon.'</Nombre>
                <Identificacion>
                    <Tipo>'.$emisor->id_tipo_identificacion.'</Tipo>
                    <Numero>'.$emisor->identificacion.'</Numero>
                </Identificacion>
                <NombreComercial>JR</NombreComercial>
                <Ubicacion>
                    <Provincia>'.$emisor->cod_provincia.'</Provincia>
                    <Canton>'.str_pad($emisor->cod_canton,2,"0",STR_PAD_LEFT).'</Canton>
                    <Distrito>'.str_pad($emisor->cod_distrito,2,"0",STR_PAD_LEFT).'</Distrito>
                    <Barrio>'.str_pad($emisor->cod_barrio,2,"0",STR_PAD_LEFT).'</Barrio>
                    <OtrasSenas>'.$emisor->otras_senas.'</OtrasSenas>
                </Ubicacion>
                <Telefono>
                    <CodigoPais>'.$emisor->codigo_telefono.'</CodigoPais>
                    <NumTelefono>'.$emisor->telefono.'</NumTelefono>
                </Telefono>
                <CorreoElectronico>'.$emisor->correo.'</CorreoElectronico>
            </Emisor>
            <Receptor>
                <Nombre>'.$receptor->razon.'</Nombre>
                <Identificacion>
                    <Tipo>'.$receptor->id_tipo_identificacion.'</Tipo>
                    <Numero>'.$receptor->identificacion.'</Numero>
                </Identificacion>
                <NombreComercial/>
                <Ubicacion>
                    <Provincia>'.$receptor->cod_provincia.'</Provincia>
                    <Canton>'.str_pad($receptor->cod_canton,2,"0",STR_PAD_LEFT).'</Canton>
                    <Distrito>'.str_pad($receptor->cod_distrito,2,"0",STR_PAD_LEFT).'</Distrito>
                    <Barrio>'.str_pad($receptor->cod_barrio,2,"0",STR_PAD_LEFT).'</Barrio>
                    <OtrasSenas>'.$receptor->otras_senas.'</OtrasSenas>
                </Ubicacion>
                <Telefono>
                    <CodigoPais>'.$receptor->codigo_telefono.'</CodigoPais>
                    <NumTelefono>'.$receptor->telefono.'</NumTelefono>
                </Telefono>
                <CorreoElectronico>'.$receptor->correo.'</CorreoElectronico>
            </Receptor>
            <CondicionVenta>'.$condicion_venta.'</CondicionVenta>
            <PlazoCredito>'.$dias.'</PlazoCredito>
            <MedioPago>'.$medio_pago.'</MedioPago>
            <DetalleServicio>';



            $totalServGravados=0;
            $totalServExentos=0;
            $totalServExonerado=0;
            $totalMercanciasGravadas=0;
            $totalMercanciasExentas=0;
            $totalMercExonerada=0;
            $totalGravado=0;
            $totalExento=0;
            $totalExonerado=0;
            $totalVenta=0;
            $totalDescuentos=0;
            $totalVentaNeta=0;
            $totalImpuesto=0;
            $totalComprobante=0;


            foreach ($_POST['codigo'] as $key => $linea) {
                $stringXML.='<LineaDetalle>
                    <NumeroLinea>'.($key+1).'</NumeroLinea>
                    <Codigo>'.$_POST['codigo'][$key].'</Codigo>
                    <Cantidad>'.$_POST['cantidad'][$key].'</Cantidad>
                    <UnidadMedida>'.$_POST['unidad'][$key].'</UnidadMedida>
                    <Detalle>'.$_POST['detalle'][$key].'</Detalle>
                    <PrecioUnitario>'.$_POST['precio_unidad'][$key].'</PrecioUnitario>
                    <MontoTotal>'.$_POST['monto_total'][$key].'</MontoTotal>';

                    if ($_POST['monto_descuento'][$key]>0) {
                       $stringXML.='<Descuento>
                            <MontoDescuento>'.$_POST['monto_descuento'][$key].'</MontoDescuento>
                            <NaturalezaDescuento>Descuento cliente</NaturalezaDescuento>
                        </Descuento>';
                    }

                    $stringXML.='<SubTotal>'.$_POST['sub_total'][$key].'</SubTotal>
                    <Impuesto>
                        <Codigo>01</Codigo>
                        <CodigoTarifa>08</CodigoTarifa>
                        <Tarifa>'.$_POST['tarifa'][$key].'</Tarifa>
                        <Monto>'.$_POST['monto_impuesto'][$key].'</Monto>  
                    </Impuesto>
                    
                    <ImpuestoNeto>'.$_POST['monto_impuesto'][$key].'</ImpuestoNeto>
                    <MontoTotalLinea>'.$_POST['total_linea'][$key].'</MontoTotalLinea>
                </LineaDetalle>';

                //acumular

                if ($_POST['unidad'][$key]=="Sp" || $_POST['unidad'][$key]=="Spe") {
                    //todos los servicios son gravados
                    $totalServGravados+= $_POST['monto_total'][$key];
                }else{
                     //todas las mercancias son gravados
                    $totalMercanciasGravadas+=$_POST['monto_total'][$key];
                }
                //todas las mercancias y servicios son gravados
                $totalGravado+= $_POST['monto_total'][$key];
                $totalVenta+= $_POST['monto_total'][$key];
                $totalDescuentos+=$_POST['monto_descuento'][$key];
                $totalVentaNeta+=$_POST['sub_total'][$key];
                $totalImpuesto+=$_POST['monto_impuesto'][$key];
                $totalComprobante+=$_POST['total_linea'][$key];

            }

        ///***
            $DocumentosModel= new DocumentosModel();
            $DocumentosModel->setConsecutivo($consecutivo);
            $DocumentosModel->setTipoDocumento($id_tipo_documento);
            $DocumentosModel->setClave($clave);
            $DocumentosModel->setCodigoSeguridad($codigoSeguridad);
            $DocumentosModel->setFecha(date('c'));
            $DocumentosModel->setEmisorNombre($emisor->razon);
            $DocumentosModel->setEmisorCedula($emisor->identificacion);
            $DocumentosModel->setEmisorTipo($emisor->id_tipo_identificacion);
            $DocumentosModel->setEmisorComercial($emisor->nombre_comercial);
            $DocumentosModel->setEmisorIdProvincia($emisor->cod_provincia);
            $DocumentosModel->setEmisorIdCanton($emisor->cod_canton);
            $DocumentosModel->setEmisorIdDistrito($emisor->cod_distrito);
            $DocumentosModel->setEmisorIdBarrio($emisor->cod_barrio);
            $DocumentosModel->setEmisorOtrasSenas($emisor->otras_senas);
            $DocumentosModel->setEmisorCod($emisor->codigo_telefono);
            $DocumentosModel->setEmisorTelefono($emisor->telefono);
            $DocumentosModel->setEmisorCorreo($emisor->correo);
            $DocumentosModel->setReceptorNombre($receptor->razon);
            $DocumentosModel->setReceptorCedula($receptor->identificacion);
            $DocumentosModel->setReceptorTipo($receptor->id_tipo_identificacion);
            $DocumentosModel->setReceptorComercial($receptor->nombre_comercial);
            $DocumentosModel->setReceptorIdProvincia($receptor->cod_provincia);
            $DocumentosModel->setReceptorIdCanton($receptor->cod_canton);
            $DocumentosModel->setReceptorIdDistrito($receptor->cod_distrito);
            $DocumentosModel->setReceptorIdBarrio($receptor->cod_barrio);
            $DocumentosModel->setReceptorOtrasSenas($receptor->otras_senas);
            $DocumentosModel->setReceptorCod($receptor->codigo_telefono);
            $DocumentosModel->setReceptorTelefono($receptor->telefono);
            $DocumentosModel->setReceptorCorreo($receptor->correo);
            $DocumentosModel->setCondicionVenta($condicion_venta);
            $DocumentosModel->setPlazoCredito($dias);
            $DocumentosModel->setMedioPago($medio_pago);
            $DocumentosModel->setMoneda($moneda);
            $DocumentosModel->setTipoCambio($tipo_cambio);
            $DocumentosModel->setServiciosGravados($totalServGravados);
            $DocumentosModel->setServiciosExentos($totalServExentos);
            $DocumentosModel->setServiciosExonerados($totalServExonerado);
            $DocumentosModel->setMercanciasGravadas($totalMercanciasGravadas);
            $DocumentosModel->setMercanciasExentas($totalMercanciasExentas);
            $DocumentosModel->setMercanciasExoneradas($totalMercExonerada);
            $DocumentosModel->setTotalGravado($totalGravado);
            $DocumentosModel->setTotalExento($totalExento);
            $DocumentosModel->setTotalExonerado($totalExonerado);
            $DocumentosModel->setTotalVenta($totalVenta);
            $DocumentosModel->setTotalDescuentos($totalDescuentos);
            $DocumentosModel->setTotalVentaNeta($totalVentaNeta);
            $DocumentosModel->setTotalImpuestos($totalImpuesto);
            $DocumentosModel->setTotalComprobante($totalComprobante);
            $DocumentosModel->setNotas($notas);
            $DocumentosModel->setIdUsuario(session()->get('id_usuario'));
            $DocumentosModel->setEnvioAtv(0);
            $DocumentosModel->setValidoAtv(0);
            $id_documento= $DocumentosModel->insertarDocumento();
        ///*** 

            //solo para insertar
        foreach ($_POST['codigo'] as $key => $linea) {
                //insertar cada detalle
                $DocumentosDetallesModel= new DocumentosDetallesModel();
                $DocumentosDetallesModel->setIdDocumento($id_documento);
                $DocumentosDetallesModel->setLinea($key+1);
                $DocumentosDetallesModel->setCodigo($_POST['codigo'][$key]);
                $DocumentosDetallesModel->setDetalle($_POST['detalle'][$key]);
                $DocumentosDetallesModel->setUnidadMedida($_POST['unidad'][$key]);
                $DocumentosDetallesModel->setCantidad($_POST['cantidad'][$key]);
                $DocumentosDetallesModel->setPrecioUnidad($_POST['precio_unidad'][$key]);
                $DocumentosDetallesModel->setMontoTotal($_POST['monto_total'][$key]);
                $DocumentosDetallesModel->setMontoDescuento($_POST['monto_descuento'][$key]);
                $DocumentosDetallesModel->setMotivoDescuento("Descuento cliente");
                $DocumentosDetallesModel->setSubTotal($_POST['sub_total'][$key]);
                $DocumentosDetallesModel->setCodigoImpuesto("01");
                $DocumentosDetallesModel->setCodigoTarifa("08");
                $DocumentosDetallesModel->setTarifa($_POST['tarifa'][$key]);
                $DocumentosDetallesModel->setMontoImpuesto($_POST['monto_impuesto'][$key]);
                $DocumentosDetallesModel->setImpuestoNeto($_POST['monto_impuesto'][$key]);
                $DocumentosDetallesModel->setTotalLinea($_POST['total_linea'][$key]);
                $DocumentosDetallesModel->insertarDocumentoDetalle();

        }
             
            $stringXML.='</DetalleServicio>
            <ResumenFactura>
                <CodigoTipoMoneda>
                    <CodigoMoneda>CRC</CodigoMoneda>
                    <TipoCambio>1</TipoCambio>
                </CodigoTipoMoneda>
                <TotalServGravados>'.$totalServGravados.'</TotalServGravados>
                <TotalServExentos>'.$totalServExentos.'</TotalServExentos>
                <TotalServExonerado>'.$totalServExonerado.'</TotalServExonerado>
                <TotalMercanciasGravadas>'.$totalMercanciasGravadas.'</TotalMercanciasGravadas>
                <TotalMercanciasExentas>'.$totalMercanciasExentas.'</TotalMercanciasExentas>
                <TotalMercExonerada>'.$totalMercExonerada.'</TotalMercExonerada>
                <TotalGravado>'.$totalGravado.'</TotalGravado>
                <TotalExento>'.$totalExento.'</TotalExento>
                <TotalExonerado>'.$totalExonerado.'</TotalExonerado>
                <TotalVenta>'.$totalVenta.'</TotalVenta>
                <TotalDescuentos>'.$totalDescuentos.'</TotalDescuentos>
                <TotalVentaNeta>'.$totalVentaNeta.'</TotalVentaNeta>
                <TotalImpuesto>'.$totalImpuesto.'</TotalImpuesto>
                <TotalComprobante>'.$totalComprobante.'</TotalComprobante>
            </ResumenFactura>
            <Otros>
                <OtroTexto></OtroTexto>
            </Otros>
        </FacturaElectronica>
        ';

        $salida= "archivos/xml/p_firmar/$clave.xml";
        $doc = new DomDocument();
        $doc->preseveWhiteSpace = false;
        $doc->loadXml($stringXML);
        $doc->save($salida);
        $doc->saveXML();
        //generar PDF
        $this->generarPDF($clave);

      
        //xml64 ->fimar()
        $xml64 =$this->firmarXml($clave);
        //this->enviar(xml64 )
        $enviar=  json_decode($this->enviarXml($xml64));
        if ($enviar->status>=200 && $enviar->status<300) {
            //actualizar enviado-----
            sleep(4);
            $validar=  json_decode($this->validarXml($xml64), true);
            if (isset($validar['xml']['ind-estado'])) {
                if($validar['xml']['ind-estado']!="procesando"){

                    //actualizar validado-----

                    $json= json_decode(json_encode(simplexml_load_string(base64_decode($validar['xml']['respuesta-xml']))));
                    if($json->Mensaje<3){
                        //enviar el correo
                        $cuerpo= '<h1>Factura generada</h1>';
                        $cuerpo.="<p>Señores ".$receptor->razon. " se les adjunta la factura electronica.</p>";
                        $cuerpo.="<b>Att ".$emisor->razon. "</b>";
                        //correo del cliente
                        $correos= array($receptor->correo);
                    }else{
                        $cuerpo= '<h1>Error al generar factura</h1>';
                        $cuerpo.="Error hacienda: ".$json->DetalleMensaje;
                        $correos= array("soporte@jrtec.cl");
                    }
                    //siempre adjunta
                    $adjuntos= array(
                        "archivos/pdf/".$clave.".pdf", 
                        "archivos/xml/firmados/".$clave."_f.xml",
                        "archivos/xml/respuesta/".$clave.".xml",
                    );

                     //siempre envia correo
                    $data= array(
                        "from" => "miramar@jrtec.cl",
                        "name" => $consecutivo,
                        "correo" => $correos,
                        "asunto" => "Documento creado ". $consecutivo,
                        "cuerpo" => $cuerpo, 
                        "adjunto" =>$adjuntos,
                        //"CC" => $copias,
                        //"BCC" => $copiasOcultas,
                    );
                    $mail = new Mailer();
                    $correo_enviado = $mail->enviarCorreo($data);

                    return json_encode(array(
                        'clave' => $clave, 
                        "enviar"=> $enviar->status,
                        "validar_estado" => $validar['xml']['ind-estado'],
                        "mensaje" => $json->Mensaje,
                        "validar_mensaje" => $json->DetalleMensaje,
                        "correo_enviado" => $correo_enviado,
                    ));
                }else{
                    return json_encode(array(
                        'clave' => $clave, 
                        "enviar"=> $enviar->status,
                        "validar_estado" => $validar['xml']['ind-estado'],
                        "mensaje" => "procesando",
                        "validar_mensaje" => "procesando",
                        "correo_enviado" => false,
                    ));
                }

            }else{
                return json_encode(array(
                    'clave' => $clave, 
                    "enviar"=> $enviar->status,
                    "validar_estado" => $validar->status,
                    "mensaje" => "Error",
                    "validar_mensaje" => "Error",
                    "correo_enviado" => false,
                ));
            }


        }else{
            return json_encode(array(
                'clave' => $clave, 
                "enviar"=> $enviar->status,
                "validar_estado" => "",
                "mensaje" => "",
                "validar_mensaje" => "",
                "correo_enviado" => false,
            ));
        }


            //token curl enviar
            //202
            //actualizaEnviado
        //sleep
        //this->enviar(xml64 )
            //mensaje 1 0 2
            //actualizaValidado

        //
        }else{
            return view('login/login');
        }
    }

    //Ver un documento en PDF
    public function facturaPDF(){
        //is Login
        $clave= $this->request->uri->getSegment(3);

        $pdf= new Pdf();
        $qr = new Myqr();
        

       $DocumentosModel= new DocumentosModel();
       $DocumentosModel->setClave($clave);
       $documento=  $DocumentosModel->selectDocumentoClave();
       if ($documento) {
           $DocumentosDetallesModel= new DocumentosDetallesModel();
           $DocumentosDetallesModel->setIdDocumento($documento->id_documento);
           $detalles=  $DocumentosDetallesModel->selectDocumentosDetalles();


            $dataQR=array(
                'url' => base_url()."/factura/verificar/". $documento->clave, 
            );

            $logoImg= file_get_contents(base_url('plantilla/dist/img/logo.jpg'));

            
            $dataPdf=array(
                'nombre_archivo' => "/pdf/Documento ".$documento->clave.".pdf", 
                'documento' => $documento,
                'detalles' => $detalles,
                "qrCodigo" => $qr->codigoQR($dataQR),
                "logo" => base64_encode($logoImg),
            );

            
            $this->response->setContentType('application/pdf');
            $pdf->load_view("pdfs/facturaPDF", $dataPdf );
       }else{
        echo "Documento no existe";
       }//Fin del else
    }//Fin de facturaPDF

    //Generar un documento en PDF por clave
    private function generarPDF($clave){
        $pdf= new Pdf();
        $qr = new Myqr();
        
       $DocumentosModel= new DocumentosModel();
       $DocumentosModel->setClave($clave);
       $documento=  $DocumentosModel->selectDocumentoClave();
       if ($documento) {
           $DocumentosDetallesModel= new DocumentosDetallesModel();
           $DocumentosDetallesModel->setIdDocumento($documento->id_documento);
           $detalles=  $DocumentosDetallesModel->selectDocumentosDetalles();


            $dataQR=array(
                'url' => base_url()."/factura/verificar/". $documento->clave, 
            );

            $logoImg= file_get_contents(base_url('plantilla/dist/img/logo.jpg'));

            
            $dataPdf=array(
                'nombre_archivo' => "/pdf/".$documento->clave.".pdf", 
                'documento' => $documento,
                'detalles' => $detalles,
                "qrCodigo" => $qr->codigoQR($dataQR),
                "logo" => base64_encode($logoImg),
            );
            $pdf->save_view("pdfs/facturaPDF", $dataPdf);
       }else{
        echo "Documento no existe";
       }
    }//Fin de generarPDF

    //Validar archivo XML
    private function validarXml($xml64){
        $leer= json_encode(simplexml_load_string(base64_decode($xml64)));
        $json= json_decode($leer);
        //token
        $header= array(
            "Authorization: bearer ".$this->token(),
            "Content-Type: application/json",
        );

        $curl = curl_init(getenv('factura.urlRecepcion')."/".$json->Clave);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


        //ejecutar el curl
        $response= curl_exec($curl);
        $status= curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);
        //obtener respuesta
        $xml= json_decode($response, true);

        if (isset($xml['respuesta-xml'])) {
            $respuesta_xml= $xml['respuesta-xml'];
            $stringXML= base64_decode($respuesta_xml);

            $salida="archivos/xml/respuesta/".$json->Clave.".xml";
            $doc = new DomDocument();
            $doc->preseveWhiteSpace = false;
            $doc->loadXml($stringXML);
            $doc->save($salida);
        }

        return json_encode( array('response'=> $response , 'xml'=>$xml ));

    }//Fin de validarXML

    //Validar documento por clave
    public function validarClave(){
        $clave= $_POST['clave'];

        $header= array(
            "Authorization: bearer ".$this->token(),
            "Content-Type: application/json",
        );


        $curl = curl_init(getenv('factura.urlRecepcion')."/".$clave);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


        //ejecutar el curl
        $response= curl_exec($curl);
        $status= curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);
        //obtener respuesta

        $xml= json_decode($response, true);
        var_dump($xml);

        if (isset($xml['respuesta-xml'])) {
            $respuesta_xml= $xml['respuesta-xml'];
            $stringXML= base64_decode($respuesta_xml);

            $salida="archivos/xml/respuesta/".$clave.".xml";
            $doc = new DomDocument();
            $doc->preseveWhiteSpace = false;
            $doc->loadXml($stringXML);
            $doc->save($salida);
        }
    }//Fin de validarClave

    //Generae un TOKEN para la sesion del envío
    public function token(){
        $data = array(
            'client_id' => getenv('factura.clientID'),
            'client_secret' => '',
            'grant_type' => 'password',
            'username' => getenv('factura.userToken'),
            'password' => getenv('factura.userPass')
        );

        $curl= curl_init(getenv('factura.tokenURL'));
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, 'Content-Type: application/x-www-form-urlencoded');
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

        $response= curl_exec($curl);
        $respuesta= json_decode($response);
        $status= curl_getinfo($curl);
        curl_close($curl);
        return $respuesta->access_token;
    }//Fin de token

    //Firmar un archivo XML
    private function firmarXml($clave){
        $p12= getenv('factura.p12');
        $pin=getenv('factura.pin');

        $input= "archivos/xml/p_firmar/".$clave.".xml";
        $ruta= "archivos/xml/firmados/".$clave."_f.xml";

        $Firmador = new Firmador();
        //firma y devuelve el base64_encode();
        $xml64=  $Firmador->firmarXml($p12,$pin,$input,$Firmador::TO_XML_FILE,$ruta);
        return  $xml64;
    }//Fin de firmarXML

    //Enviar XML al ministerio de hacienda
    private function enviarXml($xml64){

        $leer= json_encode(simplexml_load_string(base64_decode($xml64)));
        $json= json_decode($leer);

        $data= json_encode(array(
            "clave"=> $json->Clave,
            "fecha" => date('c'),
            "emisor"=>array(
                "tipoIdentificacion" => $json->Emisor->Identificacion->Tipo,
                "numeroIdentificacion" => $json->Emisor->Identificacion->Numero,
            ),
            "receptor" =>array(
                "tipoIdentificacion" => $json->Receptor->Identificacion->Tipo,
                "numeroIdentificacion" => $json->Receptor->Identificacion->Numero,
            ),
            "comprobanteXml"=> $xml64
        ));
        //token
        $header= array(
            "Authorization: bearer ".$this->token(),
            "Content-Type: application/json",
        );

        $curl = curl_init(getenv('factura.urlRecepcion'));
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        //ejecutar el curl
        $respuesta= curl_exec($curl);
        $status= curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);
        //obtener respuesta
        return json_encode(array('respuesta' =>$respuesta, 'status'=>$status ));      //echo $status;

    }//Fin de enviarXML
}//Fin de la clase