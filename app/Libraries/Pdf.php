<?php

namespace App\Libraries;
use Dompdf\Dompdf;

class Pdf extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function load_view($view, $data = array()) {
        $dompdf = new Dompdf(array('isPhpEnabled' => true, 'isRemoteEnabled' => true));
        $dompdf->setPaper("letter");
        $html = view($view,$data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream($data["nombre_archivo"], array("Attachment"=>0));// en navegador
    }
    
    public function temp_view($view, $data = array()) {
        $dompdf = new Dompdf(array('isPhpEnabled' => true, 'isRemoteEnabled' => true));
        $html = view($view,$data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();
        return $output;
    }
    
    public function preview($view, $data = array()) {
        $dompdf = new DOMPDF(array('isPhpEnabled' => true));
        $html = view($view,$data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        return base64_encode($dompdf->output());
    }

    public function save_view($view, $data = array()) {
        $dompdf = new Dompdf(array('isPhpEnabled' => true));
        $html = view($view,$data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $folder = "archivos";
        if(!is_dir($folder)) {
            mkdir($folder);
        }
        $file = $folder."/".$data['nombre_archivo'];
        $output = $dompdf->output();
        file_put_contents($file, $output);
    }
}

?>