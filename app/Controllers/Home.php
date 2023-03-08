<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // $mpdf = new \Mpdf\Mpdf();
		// $html = view('welcome_message');
		// $mpdf->WriteHTML($html);
		// $this->response->setHeader('Content-Type', 'application/pdf');
		// $mpdf->Output('arjun.pdf','I'); // opens in browser
		// //$mpdf->Output('arjun.pdf','D'); // it downloads the file into the user system, with give name
		// //return view('welcome_message');
        
        // // $data['$title_page'] = "Dashboard";
        return view('datatable');
    }

    public function get()
    {
        var_dump(count($this->request->getPost('personil')) );
            exit;
    }


}