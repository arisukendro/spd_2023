<?php

namespace App\Controllers;
use App\Models\PegawaiModel;
use App\Models\KlompegModel;
use App\Models\SubbagModel;
use App\Models\JabatanModel;

class Pegawai extends BaseController
{
    public function index() {        
        
        $data = [
            'themes' =>  $this->siteConfig->themes,
            'title_page' => 'Data Pegawai'
        ];
        
        return view('pegawai/tampildata', $data);
    }

    public function ambildata(){
        if($this->request->isAJAX()){
            $mPegawai = new PegawaiModel; 
            $data = [
                'tampildata' => $mPegawai->tampilSemua(), 
            ]; 
            $msg = [
                'data' => view('pegawai/tabeldata', $data)                
            ];
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formtambah(){
        if($this->request->isAJAX()){
            $mKlompeg = new KlompegModel;
            $mJabatan = new JabatanModel;
            $mSubbag = new SubbagModel;
            
            $data = [
                'data_klompeg' => $mKlompeg->findAll(),
                'data_jabatan' => $mJabatan->findAll(),
                'data_subbag' => $mSubbag->findAll(),
            ];
            $msg = [
                'data' => view('pegawai/formtambah', $data),             
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
                'klompeg' => [
                    'label' => 'Kelompok Pegawai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'setkom' => [
                    'label' => 'Pejabat Pemberi Tugas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'subbag' => [
                    'label' => 'Subbag',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'jabatan' => [
                    'label' => 'Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],

                'nama' => [
                    'label' => 'Nama Pegawai',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'klompeg' => $validation->getError('klompeg'),
                        'setkom' => $validation->getError('setkom'),
                        'subbag' => $validation->getError('subbag'),
                        'jabatan' => $validation->getError('jabatan'),
                    ]
                ];
                
            }else{
                if (!empty($this->request->getVar('pangkat')))
                {
                    $expl_golongan= explode('/', $this->request->getVar('pangkat'));
                    $golongan = $expl_golongan[0];
                    $pangkat = $expl_golongan[1];
                } else {
                    $golongan =NULL;
                    $pangkat = NULL;
                }

                $simpandata = [
                        'klompeg_id' => $this->request->getVar('klompeg'),
                        'nama' => $this->request->getVar('nama'),
                        'setkom' => $this->request->getVar('setkom'),
                        'nip' => $this->request->getVar('nip'),
                        'pangkat' => $pangkat,
                        'golongan' => $golongan,
                        'jabatan_id' => $this->request->getVar('jabatan'),
                        'subbag_id' => $this->request->getVar('subbag'),
                        'setkom' => $this->request->getVar('setkom'),
                        'aktif' => 1,
                    ];
                
                $mPegawai = new PegawaiModel;
            
                $mPegawai->insert($simpandata);

                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function viewdetil(){
        if($this->request->isAJAX()){
            $mPegawai = new PegawaiModel;
            
            $idPegawai = $this->request->getVar('id_pegawai');
            $row = $mPegawai->tampilId($idPegawai);

            $data = [
                'id_pegawai' => $row['id_pegawai'],
                'nama_klompeg' => $row['nama_klompeg'],
                'nama' => $row['nama'],
                'nip' => $row['nip'],
                'pangkat' => $row['pangkat'],
                'golongan' => $row['golongan'],
                'nama_jabatan' => $row['nama_jabatan'],
                'nama_subbag' => $row['nama_subbag'],
                'aktif' => $row['aktif'],
            ];

            $msg = [
                'sukses' => view('pegawai/view', $data)                
            ];
            
            echo json_encode($msg);   
        }
    }
    
    public function formedit(){
        if($this->request->isAJAX()){
            $mPegawai = new PegawaiModel;
            $mKlompeg = new KlompegModel;
            $mSubbag = new SubbagModel;
            $mJabatan = new JabatanModel;
            
            $idPegawai = $this->request->getVar('id_pegawai');
            $row = $mPegawai->find($idPegawai);

            $data = [
                'id_pegawai' => $row['id_pegawai'],
                'klompeg_id' => $row['klompeg_id'],
                'setkom' => $row['setkom'],
                'nama' => $row['nama'],
                'nip' => $row['nip'],
                'pangkat' => $row['pangkat'],
                'golongan' => $row['golongan'],
                'jabatan_id' => $row['jabatan_id'],
                'subbag_id' => $row['subbag_id'],
                'aktif' => $row['aktif'],
                'dataKlompeg' => $mKlompeg->findAll(),
                'dataSubbag' => $mSubbag->tampilKriteria($row['klompeg_id']),
                'dataJabatan' => $mJabatan->tampilKriteria($row['klompeg_id']),
            ];

            $msg = [
                'sukses' => view('pegawai/formedit', $data)                
            ];
            
            echo json_encode($msg);   
        }
    }

    public function updateData($id_pegawai){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'klompeg' => [
                    'label' => 'Bagian Klompeg',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pilih bagian terlebih dahulu',
                    ],
                ],
                'nama' => [
                    'label' => 'Nama Pegawai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'klompeg' => $validation->getError('klompeg'),
                        'nama' => $validation->getError('nama'),
                    ]
                ];
                
            }else{
                if (!empty($this->request->getVar('pangkat')))
                {
                    $expl_golongan= explode('/', $this->request->getVar('pangkat'));
                    $golongan = $expl_golongan[0];
                    $pangkat = $expl_golongan[1];
                } else {
                    $golongan = NULL;
                    $pangkat = NULL;
                }
                
                // var_dump($id_pegawai);
                // exit;
                
                $simpandata = [                        
                        'klompeg_id' => $this->request->getVar('klompeg'),
                        'setkom' => $this->request->getVar('setkom'),
                        'nama' =>$this->request->getVar('nama'),
                        'nip' => $this->request->getVar('nip'),
                        'pangkat' => $pangkat,
                        'golongan' => $golongan,
                        'jabatan_id' => $this->request->getVar('jabatan'),
                        'subbag_id' => $this->request->getVar('subbag'),
                        'aktif' => $this->request->getVar('aktif'),
                    ];
                
                $mPegawai = new PegawaiModel;                
                $mPegawai->update($id_pegawai, $simpandata);

                $msg = [
                    'sukses' => 'Data berhasil diupdate',
                ];
            }
            echo json_encode($msg);
        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function hapusdata($id_pegawai){
        if($this->request->isAJAX()){
            $mPegawai = new PegawaiModel;

            $mPegawai->delete($id_pegawai);

            $msg = [
                'sukses' => '[$id_pegawai] Data berhasil dihapus',
            ];
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
}