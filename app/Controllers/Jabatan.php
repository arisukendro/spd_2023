<?php

namespace App\Controllers;
use App\Models\JabatanModel;
use App\Models\InstansiModel;

class Jabatan extends BaseController
{
    public function index() {        
        $data = [
            'themes'=> $this->siteConfig->themes,
            'title_page' => "Data Jabatan"
        ];
        return view('jabatan/tampildata', $data);
    }

    public function ambildata(){
        if($this->request->isAJAX()){
            $mJabatan = new JabatanModel; 
            
            $data = [
                'tampildata' => $mJabatan->tampilSemua(), 
            ]; 

            $msg = [
                'data' => view('jabatan/tabeldata', $data)                
            ];

            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formtambah(){
        if($this->request->isAJAX()){

            $mInstansi = new InstansiModel;
            
            $data = [
               'dataInstansi' => $mInstansi->findAll(),
            ];
                        
            $msg = [
                'data' => view('jabatan/formtambah', $data)                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function simpandata(){
        if($this->request->isAJAX()){
            
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'instansi' => [
                    'label' => 'instansi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih bagian terlebih dahulu',
                    ],
                ],
                'nama_jabatan' => [
                    'label' => 'Nama Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'instansi' => $validation->getError('instansi'),
                        'nama_jabatan' => $validation->getError('nama_jabatan'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'instansi_id' => $this->request->getVar('instansi'),
                        'nama_jabatan' => $this->request->getVar('nama_jabatan'),
                    ];
                
                $mjabatan = new JabatanModel;
            
                $mjabatan->insert($simpandata);

                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formedit(){
        if($this->request->isAJAX()){
            
            $mInstansi = new InstansiModel;
            $mjabatan = new JabatanModel;
            
            $id_jabatan = $this->request->getVar('id_jabatan');
            $row = $mjabatan->tampilId($id_jabatan);

            $data = [
                'id_jabatan' => $row['id_jabatan'],
                'instansi_id' => $row['instansi_id'],
                'nama_jabatan' => $row['nama_jabatan'],
                'dataInstansi' => $mInstansi->findAll(),
            ];

            $msg = [
                'sukses' => view('jabatan/formedit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function updatedata($id_jabatan){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'instansi' => [
                    'label' => 'Bagian Instansi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih {field} terlebih dahulu',
                    ],
                ],
                'nama_jabatan' => [
                    'label' => 'Nama Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'instansi' => $validation->getError('instansi'),
                        'nama_jabatan' => $validation->getError('nama_jabatan'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nama_jabatan' => $this->request->getVar('nama_jabatan'),
                        'instansi_id' => $this->request->getVar('instansi'),
                    ];
                
                $mjabatan = new JabatanModel;                
                $mjabatan->update($id_jabatan, $simpandata);

                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function hapusdata($id_jabatan){
        if($this->request->isAJAX()){
            $mJabatan = new JabatanModel;

            $mJabatan->delete($id_jabatan);

            $msg = [
                'sukses' => '[$id_jabatan] Data berhasil dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
}