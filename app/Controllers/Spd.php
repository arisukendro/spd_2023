<?php

namespace App\Controllers;
use App\Models\SpdModel;
use App\Models\SuratTugasModel;
use App\Models\TemplateModel;
use App\Models\SuratTugasPersonilModel;
use App\Models\SuratTugasLokasiModel;
use App\Models\LokasiModel;
use App\Models\PegawaiModel;
use App\Models\PenandatanganModel;

class Spd extends BaseController
{
    public function __construct()
    {
        $this->mSpd = new SpdModel;
        $this->mSuratTugas = new SuratTugasModel;
        $this->mTemplate= new TemplateModel;
        $this->mSTPersonil = new SuratTugasPersonilModel;
        $this->mSTLokasi = new SuratTugasLokasiModel;
        $this->mLokasi = new LokasiModel;
        $this->mPegawai = new PegawaiModel;
        $this->mPenandatangan = new PenandatanganModel;
    }   
        
    public function index() {        
        $data = [
            'title_page' => 'SPD'
        ];
        
        return view('spd/listData', $data);
    }

    public function listData(){
        if($this->request->isAJAX()){
            
            $data_spd = $this->mSpd->like('tanggal_spd', date('Y'))
                                ->orderBy('tanggal_spd', 'DESC')
                                ->orderBy('id_spd', 'DESC')
                                ->findAll();  
                                ;
            
            $buka_tabel = "
                <table id=\"tabeldata\" class=\"table table-condensed table-bordered table-striped\">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Perihal</th>
                            <th>Tujuan</th>
                            <th>Personil</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                
            $tutup_tabel = "</tbody></table>";

            $isi_tabel = "";
            
            foreach ($data_spd as $row):                
                $nomor_st = $row['nomor_spd']; 
                $ambil_angka = explode("/",$nomor_spd) [0];
                $bersihkan_dot  = explode(".",$ambil_angka);	
                $no_agenda	= $bersihkan_dot [0];

                $isiTabel .= "
                        <tr>
                            <td class=\"\">".$no_agenda."</td>                           
                            <td>".$row['perihal_st']."<br>
                                <span class=\"badge badge-success\">ST ".ucfirst($row['jabatan_ttd'])." Nomor: ".$row['nomor_st']."</span> 
                                <span class=\"badge badge-warning\">Tanggal ST: ".$row['tanggal_st']."</span>
                                <span class=\"badge badge-secondary\">Masa Tugas: ".$row['tanggal_berangkat']." s.d. ".$row['tanggal_berangkat'].
                                "</span>
                            </td>
                            <td>";                            
                                //dapetin lokasi
                                $st_lokasi = $this->mSTLokasi->like('surat_tugas_id' , $row['id_st'])->findAll();
                                
                                foreach ($st_lokasi as $lok) :
                                    $isiTabel .= "<span class=\"badge badge-info\">". $lok['nama_lokasi']. "</span> ";
                                endforeach;
                            
                $isiTabel .="</td>
                            <td>";
                                //ambil personil
                                $st_personil = $this->mSTPersonil->like('surat_tugas_id' , $row['id_st'])->findAll();
                                foreach ($st_personil as $personil) :
                                        $isiTabel .= "<span class=\"badge badge-dark\">". $personil['nama']. "</span> ";                                    
                                endforeach;
                                
                $isiTabel .="</td>       
                            <td align=\"center\">
                                <div class=\"btn-group\">
                                <button type=\"button\" class=\"btn btn-default dropdown-toggle\" data-toggle=\"dropdown\">
                                    Aksi
                                </button>
                                <div class=\"dropdown-menu\">
                                    <a class=\"dropdown-item\"  href=\"".site_url('surattugas/cetak/').$row['id_st'] . "\" target=\"blank\">Cetak ST</a>
                                    <a type=\"button\" class=\"dropdown-item\" onclick=\"spd(". $row['id_st'].")\">Buat SPD</a>
                                    <div class=\"dropdown-divider\"></div>
                                    <a class=\"dropdown-item\" href=\"".site_url('surattugas/ubah/').base64_encode($row['id_st']). "\">Ubah Data</a>
                                    <a type=\"button\" class=\"dropdown-item\"  onclick=\"hapus(". $row['id_st'].")\">Hapus Data</a>
                                </div>
                                </div>                                
                            </td>";

                $isiTabel .="
                        </tr>";
                             
            endforeach;
            
            $msg = [
                'buka_tabel' => $buka_tabel,                
                'isi_tabel' => $isi_tabel,                
                'tutup_tabel' => $tutup_tabel,                
            ];
            
            echo json_encode($msg);   

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function formTambah(){
        if($this->request->isAJAX()){
            $id_st_personil = $this->request->getVar('id_st_personil');
            $row = $this->mSTPersonil->find($id_st_personil);
            
            $id_st = $this->request->getVar('id_st');
            $row_st = $this->mSuratTugas->find($id_st);
            
            $data = [
                'id' => $id_st_personil,
                'perihal' =>  $row_st['perihal_st'],
                'nama' => $row['nama'],
                'kota_ttd' => $row_st['kota_ttd'],
                'tgl_ttd' => $row_st['tanggal_st'],
            ];

            $msg = [
                'sukses' => view('spd/form_tambah', $data)                
            ];
            
            echo json_encode($msg);   
        }
    }
    
    public function nomorSpd(){

        $row_spd = $this->mSpd->dataTerakhir();

        if( !empty($row_spd['id_spd']) )
        {
            $no_terakhir        = $row_spd['nomor_spd']; 
            $expl_no_terakhir 	= explode("/",$no_terakhir);	
            $ambil_agenda 			= $expl_no_terakhir [0];
            $bersihkan_dot			= explode(".",$ambil_agenda);	
            $no_agenda_terakhir		= $bersihkan_dot [0];
            $agenda_skg				= $no_agenda_terakhir + 1;
            
        }else {
            $no_agenda_terakhir = '-';
            $agenda_skg 	= 1;
        }

        $data = [
            'no_agenda_lalu' =>  $no_agenda_terakhir,
            'no_agenda' => $agenda_skg.'/'.config('site')->kodeSpd.'/'.date('Y'),
        ];

        echo json_encode($data);
            
    } 
    
    public function simpan(){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nomor_spd' => [
                    'rules' => 'required|is_unique[spd.nomor_spd]',
                    'errors' => [
                        'required' => '* harus diisi ',
                        'is_unique' => 'Nomor ini sudah terdaftar. Klik reload untuk mendapatkan saran nomor baru',
                    ],
                ],
                'tgl_ttd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'kota_ttd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],
                
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nomor_spd' => $validation->getError('nomor_spd'),
                        'tgl_ttd' => $validation->getError('tgl_ttd'),
                        'kota_ttd' => $validation->getError('kota_ttd'),
                    ]
                ];
                
            }else{
                $penandatangan = $this->mPenandatangan-> orderBy('id_penandatangan','desc') -> find(1); 

                $simpandata = [
                    'nomor_spd' => $this->request->getVar('nomor_spd'),
                    'st_personil_id' => $this->request->getVar('id_personil'),
                    'kendaraan' => $this->request->getVar('kendaraan'),
                    'tingkat_spd' => $this->request->getVar('tingkat_spd'),
                    'sumber_dana' => $this->request->getVar('sumber_dana'),
                    'jenis_formulir' => $this->request->getVar('formulir'),
                    'akun_anggaran' => $this->request->getVar('akun'),
                    'kota_ttd_spd' => $this->request->getVar('kota_ttd'),
                    'tanggal_ttd_spd' => $this->request->getVar('tgl_ttd'),
                    'jabatan_ttd_spd' => 'Pejabat Pembuat Komitmen',
                    'nama_ttd_spd' => $penandatangan['ppkom'],    
                    'nip_ttd_spd' => $penandatangan['nip_ppkom'],     
                    'created_by' => 1 //ganti dengan session                    
                ];
                    
                // var_dump($simpandata);
                $this->mSpd->insert($simpandata);

                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }

    public function hapus($id){
        if($this->request->isAJAX()){
            $this->mSpd->delete($id);
            $msg = [
                'sukses' => 'Data telah dihapus',
            ];
            
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
    
    public function formEdit(){
        if($this->request->isAJAX()){
            $id_spd = $this->request->getVar('id');
            $row_spd = $this->mSpd->find($id_spd);

            $row_person = $this->mSTPersonil->find($row_spd['st_personil_id']);
            
            $row_st = $this->mSuratTugas->find($row_person['surat_tugas_id']);

            $data = [
                'perihal' => $row_st['perihal_st'],
                'nama' => $row_person['nama'],
                'id_spd' => $id_spd,
                'nomor_spd' => $row_spd['nomor_spd'],
                'tingkat_spd' => $row_spd['tingkat_spd'],
                'sumber_dana' => $row_spd['sumber_dana'],
                'akun' => $row_spd['akun_anggaran'],
                'kendaraan' => $row_spd['kendaraan'],
                'jenis_formulir' => $row_spd['jenis_formulir'],
                'kota_ttd' => $row_spd['kota_ttd_spd'],
                'tgl_ttd' => $row_spd['tanggal_ttd_spd'],
            ];

            $msg = [
                'sukses' => view('spd/form_edit', $data)                
            ];
            
            echo json_encode($msg);   

        }
    }

    public function update($id){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'tgl_ttd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],

                'kota_ttd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* harus diisi',
                    ],
                ],
                
            ]);

            if(!$valid){
                $msg =[
                    'error' => [
                        'nomor_spd' => $validation->getError('nomor_spd'),
                        'tgl_ttd' => $validation->getError('tgl_ttd'),
                        'kota_ttd' => $validation->getError('kota_ttd'),
                    ]
                ];
                
            }else{
                $penandatangan = $this->mPenandatangan-> orderBy('id_penandatangan','desc') -> find(1); 

                $simpandata = [
                    'nomor_spd' => $this->request->getVar('nomor_spd'),
                    'kendaraan' => $this->request->getVar('kendaraan'),
                    'tingkat_spd' => $this->request->getVar('tingkat_spd'),
                    'sumber_dana' => $this->request->getVar('sumber_dana'),
                    'jenis_formulir' => $this->request->getVar('formulir'),
                    'akun_anggaran' => $this->request->getVar('akun'),
                    'kota_ttd_spd' => $this->request->getVar('kota_ttd'),
                    'tanggal_ttd_spd' => $this->request->getVar('tgl_ttd'),
                    'nama_ttd_spd' => $penandatangan['ppkom'],    
                    'nip_ttd_spd' => $penandatangan['nip_ppkom'],     
                    'updated_by' => 2 //ganti dengan session                    
                ];
                    
                // var_dump($simpandata);
                $this->mSpd->update($id, $simpandata);

                $msg = [
                    'sukses' => 'Data berhasil disimpan',
                ];
            }
            echo json_encode($msg);

        }else{
            exit('Maaf halaman tidak bisa diproses');
        }
    }
    
    public function cetak($id)
    {
        $row_spd = $this->mSpd->find(base64_decode($id));
        $row_person = $this->mSTPersonil->find($row_spd['st_personil_id']);
        $row_st = $this->mSuratTugas->find($row_person['surat_tugas_id']);
        $row_penandatangan = $this->mPenandatangan->first();
 
        $date1=date_create($row_st['tanggal_berangkat']);
        $date2=date_create($row_st['tanggal_kembali']);        
        $diff=date_diff($date1,$date2)->format('%d') ;

        $data = [
            'instansi' => config('site')->instansi,
            'instansi_singkat' => config('site')->instansi_singkat,
            'kabkota' => config('site')->kabkota,
            'kabkota_singkat' => config('site')->kabkota_singkat,
            'ibukota' => config('site')->ibukota,
            
            'nomor_st' => $row_st['nomor_st'],
            'perihal' => $row_st['perihal_st'],
            'masa_tugas' => $diff+1,  
            'tgl_berangkat' => $row_st['tanggal_berangkat'],  
            'tgl_kembali' => $row_st['tanggal_kembali'],  
            
            'nama' => $row_person['nama'],
            'nip' => $row_person['nip'],
            'pangkat' => $row_person['pangkat'],
            'golongan' => $row_person['golongan'],
            'klompeg' => $row_person['klompeg'],
            'jabatan' => $row_person['jabatan'],
            
            'nomor_spd' => $row_spd['nomor_spd'],
            'tingkat_spd' => $row_spd['tingkat_spd'],
            'sumber_dana' => $row_spd['sumber_dana'],
            'akun' => $row_spd['akun_anggaran'],
            'kendaraan' => $row_spd['kendaraan'],
            'kota_ttd' => $row_spd['kota_ttd_spd'],
            'tgl_ttd' => $row_spd['tanggal_ttd_spd'],

            'tgl_ttd' => $row_spd['tanggal_ttd_spd'],  
            'jabatan_ttd' => $row_spd['jabatan_ttd_spd'],  
            'nama_ttd' => $row_spd['nama_ttd_spd'],  
            'nip_ttd' => $row_spd['nip_ttd_spd'],  
            
            'st_lokasi' => $this->mSTLokasi->like('surat_tugas_id' , $row_st['id_st'])->findAll(),
            'lokasi_pertama' => $this->mSTLokasi->like('surat_tugas_id' , $row_st['id_st'])->orderBy('id_st_lokasi',"ASC")->first(),
            'jml_lokasi' => $this->mSTLokasi->like('surat_tugas_id' , $row_st['id_st'])->countAllResults(),
            'kepala' => $row_penandatangan['sekretaris'],
            'nip_kepala' => $row_penandatangan['nip_sekretaris'],
            
        ];
        
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-P']);		//Folio-L;
        $mpdf->defaultfooterline = 0.2;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='I';
        $mpdf->setFooter("<small>".$row_spd['nomor_spd'].'</small>||'.'#{PAGENO}');
		
        if($row_spd['jenis_formulir'] == 'SPD') {
            $formulir = 'spd/cetak_spd';
        }else{
            $formulir = 'spd/cetak_lk';
        };
        
        $html = view($formulir, $data);
        // return $html;
        
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('SPD-'.time(),'I'); // I=opens in browser; D=downloads
		
    }
    
    
    
}