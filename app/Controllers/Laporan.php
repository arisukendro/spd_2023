<?php

namespace App\Controllers;
use App\Models\SuratTugasModel;
use App\Models\SpdModel;
use App\Models\SuratTugasPersonilModel;
use App\Models\SuratTugasLokasiModel;
use App\Models\LokasiModel;
use App\Models\PegawaiModel;
use App\Models\KlompegModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->mSuratTugas = new SuratTugasModel;
        $this->mSpd = new SpdModel;
        $this->mSTPersonil = new SuratTugasPersonilModel;
        $this->mSTLokasi = new SuratTugasLokasiModel;
        $this->mLokasi = new LokasiModel;
        $this->mPegawai = new PegawaiModel;
        $this->mKlompeg = new KlompegModel;
    }   
        
    public function index() {        
        
        $data = [
            'title_page' => 'Laporan',
            'klompeg' => $this->mKlompeg->findall(),
        ];
        
        return view('laporan/home', $data);
    }

    public function rincianSpdBulanan() {        
        $klompegId = $this->request->getPost('klompeg');
        $bulan = $this->request->getPost('bulan_1');
        
        $pegawai = $this->mPegawai->where('klompeg_id', $klompegId)->findAll();
        
        
        $view = "<p style=\"font-size:10pt; font-weight:bold;\">RINCIAN SPD PEGAWAI PERIODE: ".$bulan." </p>
                <table class=\"main-table \" width=\"100%\">
                    <thead>
                    <tr>
                        <th>No</th> 
                        <th>Nama dan Rincian</th> 
                    </tr>
                    </thead>
                    ";
        
        $no = 1;
        foreach ($pegawai as $rowPegawai):
            $view .="
                    <tr>
                        <td rowspan=\"2\" align=\"center\">".$no++."</td>
                        <td style=\"border-bottom:0px solid\">".$rowPegawai['nama']."</td>
                    </tr>
                    <tr>
                        <td style=\"border-top:0px solid\">
                        <table width=\"100%\" class=\"table-border-0\" >
                            <tr style=\"background-color:#00ff00; \">
                                <td width=\"0.6cm\">No</td>
                                <td>Keperluan</td>
                                <td width=\"4cm\">Masa Dinas</td>
                                <td width=\"3cm\">Formulir</td>
                            </tr>
                        ";
            
                        $stPersonil = $this->mSTPersonil->where('pegawai_id', $rowPegawai['id_pegawai'])->findAll();
                        $i=1;
                        foreach($stPersonil as $rowSTPersonil):
                            $spd =  $this->mSpd->where('st_personil_id', $rowSTPersonil['id_st_personil'])->findAll();
                            $st = $this->mSuratTugas->where('id_st', $rowSTPersonil['surat_tugas_id'])->first();
                            foreach($spd as $spd):
                                if ($i % 2 == 0){ $color = "style=\"background-color:#80ff80\"";}else{$color=NULL;}
                            $view .="<tr ".$color." >
                                        <td>".$i++."</td>
                                        <td>".$st['perihal_st']."</td>
                                        <td>".$st['tanggal_berangkat']." s.d ".$st['tanggal_kembali'] ."</td>
                                        <td>".$spd['jenis_formulir']."</td>
                                    </tr>
                            ";

                            endforeach;
                        endforeach;
                
            $view .="   </table>
                        </td>
                    </tr>
                   ";
            
        endforeach;

        $view .=" </table>
                    ";

        $data = [
            'instansi' => config('site')->instansi,
            'kabkota' => config('site')->kabkota,
            'ibukota' => config('site')->ibukota,
            'email' => config('site')->email,
            'website' => config('site')->website,
            'alamat' => config('site')->alamat,
            'view'=>$view,
            'bulan' => $bulan,
        ];

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-P']);		//Folio-L;
        $mpdf->defaultfooterline = 0.2;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='I';
        $mpdf->setFooter('<small>Laporan SPD Bulanan: '.$bulan.'</small>||'.'#{PAGENO} ');
		$html = view('laporan/rincian_spd_bulanan', $data);
        // return $html;
        
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('ST-'.time(),'I'); // I=opens in browser; D=downloads
        
    }

    public function matriksSpdBulanan() {        
        $klompegId = $this->request->getPost('klompeg');
        $bulan = $this->request->getPost('bulan_2');
        
        $pegawai = $this->mPegawai->where('klompeg_id', $klompegId)->findAll();
        
        $tgl_awal= $bulan.'-01';
        $tgl_akhir= date("Y-m-t", strtotime($tgl_awal));
        
        $tgl_akhir_terakhir = substr($tgl_akhir,-2);
        $wh_st = "tanggal_berangkat between '".$tgl_awal."' and '".$tgl_akhir."' OR tanggal_kembali between '".$tgl_awal."' and '".$tgl_akhir."'";
        $st = $this->mSuratTugas->where($wh_st)->findAll();

        $view = "<p style=\"font-size:10pt; font-weight:bold;\">MATRIKS SPD PERIODE: ".$bulan." </p>
                    
                    <table class=\"main-table\" width=\"100%\">
                    <thead>
                        <tr>
                            <th width=\"3%\" class=\"text-center\" rowspan=\"2\"><b>NO</b></th>
                            <th width=\"15%\" class=\"text-center\" rowspan=\"2\"><b>NAMA</b></th>
                            <th class=\"text-center\" colspan=\"".(int)$tgl_akhir_terakhir ."\"><b>".$bulan."</b></th>
                            <th width=\"5%\" class=\"text-center\" rowspan=\"2\"><b>KET.</b></th>
                        </tr>

                        <tr> ";	
                        $hari_1_smp_akhir = [];
                        $hari_libur = [];
                            for ($a=1;$a <= (int)$tgl_akhir_terakhir ;$a++)
                            {
                                // $sub_tgl=substr($tgl_awal,0,8);
                                if(strlen($a)==1) { $a0="0".$a;} else $a0=$a;
                                
                                //simpan ke array $hari_1_smp_akhir
                                array_push($hari_1_smp_akhir, $a);

                                // tambahkan sabtu minggu ke $hari_libur
                                if(date('l', strtotime($bulan.'-'.$a0) ) == "Saturday"
                                    OR date('l', strtotime($bulan.'-'.$a0) )== "Sunday" )
                                {
                                    array_push($hari_libur, $bulan.'-'.$a0);
                                }
                                
                                $view .="<th class='text-center'><b>".$a ."</b></th>";
                            }
                $view .="
                        </tr>
                    </thead>
                    ";
        $no = 1;
        foreach ($pegawai as $rowPegawai):
            $view .="
                    <tr>
                        <td rowspan=\"2\" align=\"center\">".$no++."</td>
                        <td style=\"border-bottom:0px solid\">".$rowPegawai['nama']."</td>
                    </tr>
                    <tr>
                        <td style=\"border-top:0px solid\">
                        <table width=\"100%\" class=\"table-border-0\" >
                            <tr style=\"background-color:#00ff00; \">
                                <td width=\"0.6cm\">No</td>
                                <td>Keperluan</td>
                                <td width=\"4cm\">Masa Dinas</td>
                                <td width=\"3cm\">Formulir</td>
                            </tr>
                        ";
            
                        $stPersonil = $this->mSTPersonil->where('pegawai_id', $rowPegawai['id_pegawai'])->findAll();
                        $i=1;
                        foreach($stPersonil as $rowSTPersonil):
                            $spd =  $this->mSpd->where('st_personil_id', $rowSTPersonil['id_st_personil'])->findAll();
                            $st = $this->mSuratTugas->where('id_st', $rowSTPersonil['surat_tugas_id'])->first();
                            foreach($spd as $spd):
                                if ($i % 2 == 0){ $color = "style=\"background-color:#80ff80\"";}else{$color=NULL;}
                            $view .="<tr ".$color." >
                                        <td>".$i++."</td>
                                        <td>".$st['perihal_st']."</td>
                                        <td>".$st['tanggal_berangkat']." s.d ".$st['tanggal_kembali'] ."</td>
                                        <td>".$spd['jenis_formulir']."</td>
                                    </tr>
                            ";

                            $id_pegawai = $rowSTPersonil['id_st_personil'];
                            $peg_dl = [];//array kosong buat nampung tgl dl
                            $peg_dl[$id_pegawai] = [];
                            $peg_dl[$id_pegawai]['spd'] = [];
                            $peg_dl[$id_pegawai]['lk'] = [];
                            $peg_dl[$id_pegawai]['libur'] = [];
                            
                            dd(new DatePeriod($st['tanggal_berangkat'], new DateInterval('P1D'), $st['tanggal_kembali']));
                            
                            endforeach;
                        endforeach;
                
            $view .="   </table>
                        </td>
                    </tr>
                   ";
            
        endforeach;

        $view .=" </table>
                    ";

        $data = [
            'instansi' => config('site')->instansi,
            'kabkota' => config('site')->kabkota,
            'ibukota' => config('site')->ibukota,
            'email' => config('site')->email,
            'website' => config('site')->website,
            'alamat' => config('site')->alamat,
            'view'=>$view,
            'bulan' => $bulan,
        ];

        $mpdf = new \Mpdf\Mpdf(['format' => 'Folio-L']);		//Folio-L;
        $mpdf->defaultfooterline = 0.2;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='I';
        $mpdf->setFooter('<small>Laporan SPD Bulanan: '.$bulan.'</small>||'.'#{PAGENO} ');
		$html = view('laporan/matriks_spd_bulanan', $data);
        // return $html;
        
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('ST-'.time(),'I'); // I=opens in browser; D=downloads
        
    }

    public function agendaSpdBulanan() {        
        $bulan = $this->request->getPost('bulan_3');
        
        $view = "<p style=\"font-size:10pt; font-weight:bold;\">AGENDA SPD BULAN: ".$bulan." </p>
                    <table class=\"main-table \" width=\"100%\">
                    <thead>
                        <tr>
                            <th>No</th> 
                            <th>No Agenda</th>
                            <th>Tanggal</th>
                            <th>Formulir</th>
                            <th>Perihal</th>
                            <th>Personil</th>
                        </tr>
                    </thead>
                    <tbody>
                    ";
        $no=1;                
        $spd = $this->mSpd->like('tanggal_ttd_spd', $bulan.'%')
                ->orderBy('tanggal_ttd_spd','ASC')
                ->orderBy('id_spd','ASC')
                ->findAll();
                
        foreach ($spd as $rowSpd):
            $stPersonil = $this->mSTPersonil->where('id_st_personil', $rowSpd['st_personil_id'])->first();
            $st = $this->mSuratTugas->where('id_st', $stPersonil['surat_tugas_id'])->first();

            $view .="
                    <tr>
                        <td align=\"center\">".$no++."</td>
                        <td >".$rowSpd['nomor_spd']."</td>
                        <td align=\"center\">".$rowSpd['tanggal_ttd_spd']."</td>
                        <td >".$rowSpd['jenis_formulir']."</td>
                        <td style=\"border-bottom:0px solid\">".$st['perihal_st']."</td>
                        <td style=\"border-bottom:0px solid\">".$stPersonil['nama']."</td>
                    </tr>
                   ";
            
        endforeach;

        $view .="   </tbody>
                    </table>
                    ";

        $data = [
            'instansi' => config('site')->instansi,
            'kabkota' => config('site')->kabkota,
            'ibukota' => config('site')->ibukota,
            'email' => config('site')->email,
            'website' => config('site')->website,
            'alamat' => config('site')->alamat,
            'view'=>$view,
            'bulan' => $bulan,
        ];

        $mpdf = new \Mpdf\Mpdf(['format' => 'Folio-L']);		//Folio-L;
        $mpdf->defaultfooterline = 0.2;
        $mpdf->defaultfooterfontsize=10;
        $mpdf->defaultfooterfontstyle='I';
        $mpdf->setFooter('<small>Agenda SPD Bulanan: '.$bulan.'</small>||'.'#{PAGENO} ');
		$html = view('laporan/rincian_spd_bulanan', $data);
        // return $html;
        
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('ST-'.time(),'I'); // I=opens in browser; D=downloads
        
    }
    
}