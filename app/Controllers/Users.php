<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

define('_web_title', 'Users');

class Users extends BaseController
{
    public function __construct(){
          $this->mUsers = new UsersModel;       
    }
    
    public function index()
    {
        
        $data = [
            'title_page' => _web_title,
            'result' => $this->mUsers->selectAll(),
        ];
        return view('users/index', $data);
    }

     public function listData(){
        if($this->request->isAJAX()){
            $data = [
                'result' => $this->mUsers->selectAll(), 
            ]; 
            
            $msg = [
                'data' => view('users/listData', $data)                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

}