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
                'data' => view('users/list', $data)                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
    
    public function add(){
        if($this->request->isAJAX()){
            
            $data = [
                    'group' => $this->mUsers->selectGroup(),
            ];
            $msg = [
                'data' => view('users/add', $data),             
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function store(){
        if($this->request->isAJAX()){
           
            
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'username' => 'required|is_unique[users.username]',
                'email' => 'required|is_unique[users.email]',
                'password' => 'required',
                'pass_confirm' => 'required|matches[password]',
            ]);
            
            if(!$valid){
                $msg =[
                    'error' => [
                        'username' => $validation->getError('username'),
                        'email' => $validation->getError('email'),
                        'password' => $validation->getError('password'),
                        'pass_confirm' => $validation->getError('pass_confirm'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'username' => $this->request->getVar('username'),
                        'email' => $this->request->getVar('email'),
                        'password_hash' => Password::hash($this->request->getVar('password')),
                        'active' => 1,
                    ];
                
                $this->mUser->insert($simpandata);

                //add on group
                $lastUser = $this->mUser->orderBy('id', 'DESC')->limit(1)->first();
                
                $this->db->table('auth_groups_users')->insert([
                    'group_id' => $this->request->getVar('group_level'),
                    'user_id' => $lastUser['id'],
                ]);

                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    
    public function viewDetil(){
        if($this->request->isAJAX()){            
            $id_user = $this->request->getVar('id_user');
            $row = $this->mUsers->selectId($id_user);
            
            $data = [
                'user_id' => $row['user_id'],
                'username' => $row['username'],
                'email' => $row['email'],
                'active' => $row['active'],
                'group_description' => $row['group_description'],
                'group_name' => $row['group_name'],
            ];
           
            $msg = [
                'sukses' => view('users/detail', $data)                
            ];
            
            echo json_encode($msg);   
        }
    }
    
    public function edit(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar('id_user');            
            $row = $this->mUsers->selectId($id);
            
            $data = [
                'user_id' => $row['user_id'],
                'email' => $row['email'],
                'username' => $row['username'],
                'active' => $row['active'],
                'group' => $this->mUsers->selectGroup(),
                'group_name' => $row['group_name'],
            ];

            $msg = [
                'sukses' => view('users/edit', $data)                
            ];
            
            echo json_encode($msg);   
        }
    }

    public function update(){
        if($this->request->isAJAX()){
            $user_id = $this->request->getVar('user_id'); 
            $group_id = $this->request->getVar('group_level');

            $data = [                        
                'active' => $this->request->getVar('active'),
            ];            
            $this->mUsers->update($user_id, $data);
          
            //update group user
            $this->mUsers->updateLevel($group_id, $user_id);
            
            $msg = [
                'sukses' => 'Data berhasil diupdate',
            ];
            
            echo json_encode($msg);
        }
    }

    public function password(){
        if($this->request->isAJAX()){
            $data = [                        
                    'password_hash' => $this->request->getVar('password'),
            ];
            $this->mUsers->update($id, $data);
            
            $msg = [
                'sukses' => 'Password telah di update',
            ];
            
            echo json_encode($msg);
        }
    }

    public function delete($id_user){
        if($this->request->isAJAX()){
            
            $this->mUsers->delete($id_user);

            $msg = [
                'sukses' => '[$id_user] Data telah dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
    
}