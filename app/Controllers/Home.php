<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        
        $data['$title_page'] = "Dashboard";
        return view('dashboard', $data);
    }



}