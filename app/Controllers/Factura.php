<?php

namespace App\Controllers;
use \DomDocument;

use \App\Libraries\Firmador;

use App\Models\ClientesModel;
use App\Models\ConsecutivosModel;
use App\Models\EmpresasModel;
use App\Models\DocumentosModel;

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

    private function totales($detalles){
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

        foreach ($detalles as $key => $linea) {
            //es un servicio
            if ($linea->unidad=="Sp" || $linea->unidad=="Spe") {
                //todos los servicios son gravados
                $totalServGravados+= ($linea->precio*$linea->cantidad);
            }else{
                 //todas las mercancias son gravados
                $totalMercanciasGravadas+=($linea->precio*$linea->cantidad);
            }
            //todas las mercancias y servicios son gravados
            $totalGravado+= ($linea->precio*$linea->cantidad);
            $totalVenta+=($linea->precio*$linea->cantidad);
            $totalVentaNeta+=($linea->precio*$linea->cantidad);
            $totalImpuesto+=((($linea->precio*$linea->cantidad) * $linea->tarifa)/100);
            $totalComprobante+=((($linea->precio*$linea->cantidad) * $linea->tarifa)/100) +($linea->precio*$linea->cantidad);
        }

        return json_encode(array(
            'totalServGravados' => $totalServGravados, 
            'totalServExentos' => $totalServExentos, 
            'totalServExonerado' => $totalServExonerado, 
            'totalMercanciasGravadas' => $totalMercanciasGravadas, 
            'totalMercanciasExentas' => $totalMercanciasExentas, 
            'totalMercExonerada' => $totalMercExonerada, 
            'totalGravado' => $totalGravado, 
            'totalExento' => $totalExento, 
            'totalExonerado' => $totalExonerado, 
            'totalVenta' => $totalVenta, 
            'totalDescuentos' => $totalDescuentos, 
            'totalVentaNeta' => $totalVentaNeta, 
            'totalImpuesto' => $totalImpuesto, 
            'totalComprobante' => $totalComprobante, 
        ));

    }
    
	public function generarXml() {
        $id_factura="116";
        $factura= str_pad($id_factura,10,"0",STR_PAD_LEFT);
        $surcusal= "001";
        $pv="00001";
        $tipoDocumento="01";

        //cosecutivo autogenerado
        $consecutivo=$surcusal.$pv.$tipoDocumento.$factura;

        $cod="506";
        $ced="402160653";
        $cedulaEmisor= str_pad($ced,12,"0",STR_PAD_LEFT);
        $situacion="1";

        $codSeguridad= substr(str_shuffle("0123456789"), 0, 8);

        $clave= $cod.date('d').date('m').date('y').$cedulaEmisor.$consecutivo.$situacion.$codSeguridad;

        $json= '{
                  "detalles": [
                    {
                      "detalle": "Piña",
                      "codigo": "8344900000000",
                      "unidad": "Unid",
                      "precio": 1000,
                      "cantidad": 2,
                      "tarifa": 13
                    }
                  ]
                }';
        $jsonListo= json_decode($json);
        $totales= json_decode($this->totales($jsonListo->detalles));

        $stringXML='<?xml version="1.0" encoding="utf-8"?>
        <FacturaElectronica xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="https://cdn.comprobanteselectronicos.go.cr/xml-schemas/v4.3/facturaElectronica">
            <Clave>'.$clave.'</Clave>
            <CodigoActividad>721001</CodigoActividad>
            <NumeroConsecutivo>'.$consecutivo.'</NumeroConsecutivo>
            <FechaEmision>'.date("c").'</FechaEmision>
            <Emisor>
                <Nombre>Joseph Gabriel Rodriguez Roman</Nombre>
                <Identificacion>
                    <Tipo>01</Tipo>
                    <Numero>402160653</Numero>
                </Identificacion>
                <NombreComercial>JR</NombreComercial>
                <Ubicacion>
                    <Provincia>4</Provincia>
                    <Canton>02</Canton>
                    <Distrito>02</Distrito>
                    <Barrio>05</Barrio>
                    <OtrasSenas>La maquina</OtrasSenas>
                </Ubicacion>
                <Telefono>
                    <CodigoPais>506</CodigoPais>
                    <NumTelefono>88888888</NumTelefono>
                </Telefono>
                <CorreoElectronico>jrodriguez081192@gmail.com</CorreoElectronico>
            </Emisor>
            <Receptor>
                <Nombre>Taller Gonzáles S.A</Nombre>
                <Identificacion>
                    <Tipo>02</Tipo>
                    <Numero>3101143237</Numero>
                </Identificacion>
                <NombreComercial/>
                <Ubicacion>
                    <Provincia>2</Provincia>
                    <Canton>01</Canton>
                    <Distrito>13</Distrito>
                    <Barrio>05</Barrio>
                    <OtrasSenas>500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ</OtrasSenas>
                </Ubicacion>
                <Telefono>
                    <CodigoPais>506</CodigoPais>
                    <NumTelefono>24874310</NumTelefono>
                </Telefono>
                <CorreoElectronico>FACTURAELECTRONICA@TAGOSA.COM</CorreoElectronico>
            </Receptor>
            <CondicionVenta>01</CondicionVenta>
            <PlazoCredito>0</PlazoCredito>
            <MedioPago>04</MedioPago>
            <DetalleServicio>';

            
            
            foreach ($jsonListo->detalles as $key => $linea) {
                $montoTotal=($linea->cantidad * $linea->precio);
                $descuentos=0;
                $subTotal=(($linea->cantidad*$linea->precio)-$descuentos);
                $impuesto=(($subTotal*$linea->tarifa)/100);
                $montoTotalLinea= ($subTotal+$impuesto);

                $stringXML.='<LineaDetalle>
                    <NumeroLinea>'.($key+1).'</NumeroLinea>
                    <Codigo>'.$linea->codigo.'</Codigo>
                    <Cantidad>'.$linea->cantidad.'</Cantidad>
                    <UnidadMedida>'.$linea->unidad.'</UnidadMedida>
                    <Detalle>'.$linea->detalle.'</Detalle>
                    <PrecioUnitario>'.$linea->precio.'</PrecioUnitario>
                    <MontoTotal>'.$montoTotal.'</MontoTotal>
                    <SubTotal>'.$subTotal.'</SubTotal>
                    <Impuesto>
                        <Codigo>01</Codigo>
                        <CodigoTarifa>08</CodigoTarifa>
                        <Tarifa>'.$linea->tarifa.'</Tarifa>
                        <Monto>'.$impuesto.'</Monto>  
                    </Impuesto>
                    
                    <ImpuestoNeto>'.$impuesto.'</ImpuestoNeto>
                    <MontoTotalLinea>'.$montoTotalLinea.'</MontoTotalLinea>
                </LineaDetalle>';
            }
             
            $stringXML.='</DetalleServicio>

            <ResumenFactura>
                <CodigoTipoMoneda>
                    <CodigoMoneda>CRC</CodigoMoneda>
                    <TipoCambio>1</TipoCambio>
                </CodigoTipoMoneda>
                <TotalServGravados>'.$totales->totalServGravados.'</TotalServGravados>
                <TotalServExentos>'.$totales->totalServExentos.'</TotalServExentos>
                <TotalServExonerado>'.$totales->totalServExonerado.'</TotalServExonerado>
                <TotalMercanciasGravadas>'.$totales->totalMercanciasGravadas.'</TotalMercanciasGravadas>
                <TotalMercanciasExentas>'.$totales->totalMercanciasExentas.'</TotalMercanciasExentas>
                <TotalMercExonerada>'.$totales->totalMercExonerada.'</TotalMercExonerada>
                <TotalGravado>'.$totales->totalGravado.'</TotalGravado>
                <TotalExento>'.$totales->totalExento.'</TotalExento>
                <TotalExonerado>'.$totales->totalExonerado.'</TotalExonerado>
                <TotalVenta>'.$totales->totalVenta.'</TotalVenta>
                <TotalDescuentos>'.$totales->totalDescuentos.'</TotalDescuentos>
                <TotalVentaNeta>'.$totales->totalVentaNeta.'</TotalVentaNeta>
                <TotalImpuesto>'.$totales->totalImpuesto.'</TotalImpuesto>
                <TotalComprobante>'.$totales->totalComprobante.'</TotalComprobante>
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
       return $doc->saveXML();
        /*  if ($doc->saveXML()) {
           $firmar = $this->firmarXml($clave);
           }*/
        
    }
    //Fin de generarXML


    //token 
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
    }
    
    //enviar xml 
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
       return json_encode(array('respuesta' =>$respuesta, 'status'=>$status ));      

    }

    private function validarXml($xml64){
        print_r($xml64);
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

   

   


	

	

	
}