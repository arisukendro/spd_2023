<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    .table1 {
        font-family: times;
        font-size: 11pt;
        color: #232323;
        border-collapse: collapse;
    }

    .table1,
    th,
    td {
        border: 0.8px solid #232323;
        padding: 4px 5px 5px 5px;
    }
    </style>
</head>

<body>
    <table class="table1" width="100%">
        <thead>
            <tr>
                <th colspan="3" rowspan="2" width="5cm"><?=strtoupper($instansi)?></th>
                <th rowspan="4" width="5cm">SURAT PERJALANAN DINAS</th>
                <th>Lembar ke</th>
                <th>:</th>
                <th></th>
            </tr>
            <tr>
                <th>Kode no</th>
                <th>:</th>
                <th></th>
            </tr>
            <tr>
                <th colspan="3" rowspan="2"><?=strtoupper($kabkota)?></th>
                <th>Nomor</th>
                <th>:</th>
                <th></th>
            </tr>
            <tr>
                <th colspan="3" style><?=$nomor_spd?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="5pt">1</td>
                <td colspan="2">Pejabat Pembuat Komitmen</td>
                <td colspan="4"><?=$nama_ttd.' / '.$nip_ttd?></td>
            </tr>
            <tr>
                <td>2</td>
                <td colspan="2">Pegawai yang melaksanakan perjalanan dinas</td>
                <td colspan="4"><?=$nama.'<br>'.$nip?></td>
            </tr>
            <tr>
                <td rowspan="3">3</td>
                <td style="border-right:0px solid;" width="10pt">a.<br></td>
                <td style="border-left:0px solid;">Pangkat dan Golongan</td>
                <td colspan="4"><?=(!empty($pangkat) ? $pangkat.' / '.$golongan : '-/-')  ; ?></td>
            </tr>
            <tr>
                <td style="border-right:0px solid;">b.</td>
                <td style="border-left:0px solid;">Jabatan / instansi</td>
                <td colspan="4"><?=$jabatan.' / '.$klompeg?></td>
            </tr>
            <tr>
                <td style="border-right:0px solid;">c.</td>
                <td style="border-left:0px solid;">Tingkat biaya perjalanan dinas</td>
                <td colspan="4"><?=$tingkat_spd?></td>
            </tr>
            <tr>
                <td>4</td>
                <td colspan="2">Maksud perjalanan dinas</td>
                <td colspan="4"><?=$perihal?></td>
            </tr>
            <tr>
                <td>5</td>
                <td colspan="2">Alat angkutan yang digunakan</td>
                <td colspan="4"><?=$kendaraan?></td>
            </tr>
            <tr>
                <td rowspan="2">6</td>
                <td>a.</td>
                <td>Tempat berangkat</td>
                <td colspan="4"><?=$ibukota?></td>
            </tr>
            <tr>
                <td>b.</td>
                <td>Tempat tujuan</td>
                <td colspan="4">
                    <?php
                    if ($jml_lokasi == 1)
                        foreach ($st_lokasi as $lokasi): 
                            echo $lokasi['nama_lokasi'].' - '.($lokasi['alamat_lokasi'] <> NULL? $lokasi['alamat_lokasi'] .' - ': NULL).$lokasi['kota_lokasi'];
                        endforeach;
                    else {
                        $no=1;
                        foreach ($st_lokasi as $lokasi): 
                            echo '['.$no++.'] '.$lokasi['nama_lokasi'].' - '.($lokasi['alamat_lokasi'] <> NULL? $lokasi['alamat_lokasi'] .' - ': NULL).$lokasi['kota_lokasi'].' ';
                        endforeach;
                    };
                    ?>
                </td>
            </tr>
            <tr>
                <td rowspan="3">7</td>
                <td>a.</td>
                <td>Lamanya perjalanan dinas</td>
                <td colspan="4"><?=$masa_tugas.' ('.terbilang($masa_tugas).' ) hari ' ?></td>
            </tr>
            <tr>
                <td>b.</td>
                <td>Tanggal berangkat</td>
                <td colspan="4"><?=tgl_id($tgl_berangkat)?></td>
            </tr>
            <tr>
                <td>c.</td>
                <td>Tanggal harus kembali</td>
                <td colspan="4"><?=tgl_id($tgl_kembali)?></td>
            </tr>
            <tr>
                <td rowspan="3">8</td>
                <td colspan="6">Pengikut</td>
            </tr>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Tanggal Lahir</td>
                <td colspan="3">Keterangan</td>
            </tr>
            <tr>
                <td>-</td>
                <td></td>
                <td></td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td rowspan="3">9</td>
                <td colspan="6">Pembebanan Anggaran&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td>a.</td>
                <td>Instansi</td>
                <td colspan="4"><?=$instansi_singkat.' '.$kabkota?></td>
            </tr>
            <tr>
                <td>b.</td>
                <td>Akun</td>
                <td colspan="4"><?=$akun?></td>
            </tr>
            <tr>
                <td rowspan="2">10</td>
                <td colspan="2" rowspan="2">Keterangan lain-lain<br> </td>
                <td>Nomor ST</td>
                <td colspan="3"><?=$nomor_st?></td>
            </tr>
            <tr>
                <td>Sumber Dana</td>
                <td colspan="3"><?=$sumber_dana?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>