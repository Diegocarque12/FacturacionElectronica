<?php

namespace App\Controllers;

use \DomDocument;
use \App\Libraries\Firmador;
use \App\Libraries\Pdf;
use \App\Libraries\Myqr;
use \App\Libraries\Mailer;

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
        $documentosModel= new DocumentosModel();

        $data= array(
            'documento' => $documentosModel->selectDocumentos(),
        );

		return view('factura/listado', $data);
	}

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


	private function firmarXml($clave){
        $p12=getenv('factura.p12');
        $pin=getenv('factura.pin');

        $input= "archivos/xml/p_firmar/".$clave.".xml";
        $ruta= "archivos/xml/firmados/".$clave."_f.xml";

        $Firmador = new Firmador();
        //firma y devuelve el base64_encode();
        $xml64 = $Firmador->firmarXml($p12,$pin,$input,$Firmador::TO_XML_FILE,$ruta);

        //enviar
        $enviar = json_decode($this->enviarXml($xml64));
        if ($enviar->status=="200" || $enviar->status=="201" || $enviar->status=="202") {
            sleep(4);
            $validar = $this->validarXml($xml64);
            $estado= json_decode($validar,true);
            echo "$clave"." ->".$estado['xml']['ind-estado'];

        }else{
            echo $enviar->respuesta;
        }
    }

	

	
}
