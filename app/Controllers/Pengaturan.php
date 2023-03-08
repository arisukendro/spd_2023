<?php

namespace App\Controllers;

class Pengaturan extends BaseController
{
    public function index() {        
        $config = new \Config\Site();
        
        $data = [
            'themes' => $this->siteConfig->themes,
            'title_page' => 'Pejabat Penandatangan Dokumen'
        ];
        return view('pengaturan/penandatangan', $data);
    }
}