<?php

namespace App\Controllers;
use App\Models\LokasiModel;

class Lokasi extends BaseController
{
    public function index() {        
        
        $data = [
            'themes' => $this->siteConfig->themes,
            'title_page' => 'Data Lokasi'
        ];
        return view('lokasi/tampildata', $data);
    }

    public function ambildata(){
        if($this->request->isAJAX()){
            $mlokasi = new LokasiModel; 
            $data = [
                'tampildata' => $mlokasi -> findAll(), 
            ]; 
            $msg = [
                'data' => view('lokasi/tabeldata', $data)                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formtambah(){
        if($this->request->isAJAX()){
            $msg = [
                'data' => view('lokasi/formtambah')                
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
                'nama_lokasi' => [
                    'label' => 'Nama Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'kota_lokasi' => [
                    'label' => 'Kota Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nama_lokasi' => $validation->getError('nama_lokasi'),
                        'kota_lokasi' => $validation->getError('kota_lokasi'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nama_lokasi' => $this->request->getVar('nama_lokasi'),
                        'alamat' => $this->request->getVar('alamat'),
                        'kota_lokasi' => $this->request->getVar('kota_lokasi'),
                    ];
                
                $mlokasi = new LokasiModel;
            
                $mlokasi->insert($simpandata);

                $msg = [
                    'sukses' => 'Data Lokasi telah ditambahkan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formedit(){
        if($this->request->isAJAX()){
            $id_lokasi = $this->request->getVar('id_lokasi');
            
            $mlokasi = new LokasiModel;
            $row = $mlokasi->find($id_lokasi);

            $data = [
                'id_lokasi' => $row['id_lokasi'],
                'nama_lokasi' => $row['nama_lokasi'],
                'alamat' => $row['alamat'],
                'kota_lokasi' => $row['kota_lokasi'],
            ];

            $msg = [
                'sukses' => view('lokasi/formedit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function updatedata($id_lokasi){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama_lokasi' => [
                    'label' => 'Nama Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'kota_lokasi' => [
                    'label' => 'Kota Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nama_lokasi' => $validation->getError('nama_lokasi'),
                        'kota_lokasi' => $validation->getError('kota_lokasi'),
                    ]
                ];
                
            }else{
                $simpandata = [
                        'nama_lokasi' => $this->request->getVar('nama_lokasi'),
                        'alamat' => $this->request->getVar('alamat'),
                        'kota_lokasi' => $this->request->getVar('kota_lokasi'),
                    ];
                
                $mlokasi = new LokasiModel;                
                $mlokasi->update($id_lokasi, $simpandata);

                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function hapusdata($id_lokasi){
        if($this->request->isAJAX()){
            $mLokasi = new LokasiModel;

            $mLokasi->delete($id_lokasi);

            $msg = [
                'sukses' => '[$id_lokasi] Data berhasil dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
}