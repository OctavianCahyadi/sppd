
<?php
include(app_path().'/FPDF/fpdf.php');

///DATE FORMAT
$bln = array(
       '01' => 'Januari',
       '02' => 'Februari',
       '03' => 'Maret',
       '04' => 'April',
       '05' => 'Mei',
       '06' => 'Juni',
       '07' => 'Juli',
       '08' => 'Agustus',
       '09' => 'September',
       '10' => 'Oktober',
       '11' => 'November',
       '12' => 'Desember'
     );

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
        $temp = penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
    }
    return $temp;
}

function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}

$path = public_path() . '/image/logo.png';
function myCell($w,$h,$x,$t)
  {
    $height =$h/3;
    $first =  $height+2;
    $second = $height+$height+$height+5;
    $len = strlen($t);
    if ($len>75){
      $txt = str_split($t,75);
      $this->SetX($x);
      $this->Cell($w,$first,$txt[0],0,'','');
      $this->SetX($x);
      $this->Cell($w,$second,$txt[1],0,'','');
      $this->SetX($x);
      $this->Cell($w,$h,'','',0,'L',0);
    }else {
      $this->SetX($x);
      $this->Cell($w,$h,$t,'',0,'L',0);
    }
  }
  if($sppd->daerah=='1'){
    if ($sppd->anggaran=='1') {
      $tunjangan1=50000;
      $tunjangan2=75000;
        }else {
        $tunjangan1=50000;
        $tunjangan2=50000;
        }
    }else {
    $tunjangan1=75000;
    $tunjangan2=100000;
    }

  $totaluang=0;
  foreach ($tugas as $key) {
    foreach ($pegawai as $item) {
         if ($item->id == $key->id_pegawai) {
            if($key->golongan > 3){
                 $gaji=$tunjangan2;
            }else {
                 $gaji=$tunjangan1;
            };
            $temp=$sppd->lama*$gaji;
            $totaluang=$totaluang+$temp;
        }
    }    
  }
//   while ($hasil2=mysqli_fetch_array($result2)) {
//     if($hasil2['Golongan']>3){
//       $gaji=$tunjangan2;
//     }else {
//       $gaji=$tunjangan1;
//     };
//     $temp=(int)$row5['lama_perjalanan']*$gaji;
//     $totaluang=$totaluang+$temp;

//   }


//--------------------SETTING---------------------//
foreach ($setting as $item) {
    foreach ($pegawai as $key) {
        if ($item->id_kadis == $key->id) {
            $kadis=$key->nama;
            $nipkadis =$key->nip;            
        }
        if ($item->id_bendahara == $key->id) {
            $namabendahara = $key->nama;
            $nipbendahara = $key->nip;
        }
    }
    $anggaran=$item->mata_anggaran;
    $tahun_anggaran=$item->tahun_anggaran;
}


//------------------------------------------------//

//------------------------SPPD--------------------//
$acara = $sppd->acara;
$nosurat =$sppd->no_surat;
$kendaraan = $sppd->angkutan;
$tempat_berangkat=$sppd->tempat_berangkat;
$tempat_tujuan=$sppd->tujuan;
$lama=$sppd->lama;
$dasar=$sppd->dasar;
foreach ($pegawai as $key) {
    if ($key->id == $sppd->pptk) {
        $namapptk=$key->nama;
        $nippptk=$key->nip;
    }
}
$sppd->nama_petugas;
$sppd->nip_petuhas;
$sppd->jabatan_petugas;

$berangkat=date('d',strtotime($sppd->tgl_pergi)).' '.$bln[date('m',strtotime($sppd->tgl_pergi))].' '.date('Y',strtotime($sppd->tgl_pergi)).'';
$kembali=date('d',strtotime($sppd->tgl_kembali)).' '.$bln[date('m',strtotime($sppd->tgl_kembali))].' '.date('Y',strtotime($sppd->tgl_kembali)).'';
$buat=date('d',strtotime($sppd->tgl_surat)).' '.$bln[date('m',strtotime($sppd->tgl_surat))].' '.date('Y',strtotime($sppd->tgl_surat)).'';
//------------------------------------------------//
$pdf = new FPDF();
$pdf->SetTitle('Cetak SPPD Belakang');
//----------------------SURAT TUGAS--------------------------//
$pdf->AddPage('P','');
//$pdf->SetMargins(0,0,0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(75,5,'',0,0);
$pdf->Cell(5,5,'I.',0,0);
$pdf->Cell(40,5,'SPPD Nomor',0,0,'L');
$pdf->Cell(70,5,': '.$nosurat,0,1,'L');

$pdf->Cell(80,5,'',0,0);
$pdf->Cell(40,5,'Berangkat dari',0,0,'L');
$pdf->Cell(70,5,': Bantul ',0,1,'L');


$pdf->Cell(80,5,'',0,0);
$pdf->Cell(40,5,'(Tempat Kedudukan)',0,0,'L');

$pdf->Cell(70,5,'',0,1,'L');
$pdf->Cell(80,5,'',0,0);
$pdf->Cell(40,5,'Pada Tanggal',0,0,'L');
$pdf->Cell(70,5,': '.$berangkat,0,1,'L');

$pdf->Cell(80,5,'',0,0);
$pdf->Cell(40,5,'Ke',0,0,'L');
$pdf->Cell(2,5,':',0,0);
$pdf->MultiCell(70,5,$tempat_tujuan,0,'L',false);
$bawah=27;
$atas=41;
$counter=strlen($tempat_tujuan);
$counter2=strlen($sppd->jabatan_petugas);



$pdf->Cell(0,2,'',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,6,'',0,0);
$pdf->Cell(80,6,'Pejabat Pelaksana Teknis Kegiatan',0,1,'C');
$pdf->Cell(200,6,'',0,1);
$pdf->Cell(200,6,'',0,1);
$pdf->Cell(200,6,'',0,1);
$pdf->Cell(120,6,'',0,0);
$pdf->SetFont('Arial','U',12);
$pdf->Cell(80,6,$namapptk,0,1,'C');
$pdf->SetFont('Arial','',12);


$pdf->Cell(133,6,'',0,0);
$pdf->Cell(10,6,'NIP. ',0,0,'L');
$pdf->Cell(50,6,$nippptk,0,1,'L');
$Y=$pdf->GetY()+5;
$pdf->SetLineWidth(0.5);
$pdf->Line (30,$Y-2,209,$Y-2);
$pdf->SetLineWidth(0.2);
$pdf->Cell(200,6,'',0,1);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(5,5,'II.',0,0);
$pdf->Cell(27,5,'Tiba di',0,0);
$pdf->Cell(2,5,':',0,0);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->MultiCell(58,5,$tempat_tujuan,0,1);
$pdf->SetXY($x + 58, $y);
$pdf->Cell(30,5,'Berangkat dari',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->MultiCell(55,5,$tempat_tujuan,0,1);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x, $y);
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(27,5,'Pada Tanggal',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(58,5, $berangkat,0,0);
$pdf->Cell(30,5,'Ke',0,0);
$pdf->Cell(60,5,': Bantul',0,1);
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(27,5,'Kepala',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(58,5, '',0,0);
$pdf->Cell(30,5,'Pada Tanggal',0,0);
$pdf->Cell(60,5,': '. $kembali,0,1);
//--------------------------------------------

$pdf->Cell(20,5,'',0,0);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->MultiCell(80,5,$sppd->jabatan_petugas,0,1,);
$pdf->SetXY($x + 80, $y);

$pdf->Cell(12,5,'',0,0);
$pdf->MultiCell(90,5,$sppd->jabatan_petugas,0,1);

$pdf->Cell(0,5,'',0,1);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(80,5,$sppd->nama_petugas,0,0);
$pdf->Cell(12,5,'',0,0);
$pdf->Cell(90,5,$sppd->nama_petugas,0,1);
$pdf->Cell(20,5,'',0,0);

if ($sppd->ip_petugas=='') {
  $pdf->Cell(80,5,$sppd->nip_petugas,0,0);
  $pdf->Cell(12,5,'',0,0);
  $pdf->Cell(90,5,$sppd->nip_petugas,0,1);
}else {
  $pdf->Cell(80,5,'Nip. '.$sppd->nip_petugas,0,0);
  $pdf->Cell(12,5,'',0,0);
  $pdf->Cell(90,5,'Nip. '.$sppd->nip_petugas,0,1);
}

$Y=$pdf->GetY()+5;
$pdf->SetLineWidth(0.5);
$pdf->Line (30,$Y-2,209,$Y-2);
$pdf->SetLineWidth(0.2);
$pdf->Cell(0,5,'',0,1);
$pdf->Cell(20,5,'',0,0);

$pdf->Cell(5,5,'III.',0,0,'C');
$pdf->Cell(27,5,'Tiba di',0,0);
$pdf->Cell(60,5,': ',0,0);
$pdf->Cell(28,5,'Berangkat dari',0,0);
$pdf->Cell(60,5,': ',0,1);
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(27,5,'Pada Tanggal',0,0);
$pdf->Cell(60,5,': ',0,0);
$pdf->Cell(28,5,'Ke',0,0);
$pdf->Cell(60,5,': ',0,1);
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(27,5,'Kepala',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(58,5, '',0,0);
$pdf->Cell(28,5,'Pada Tanggal',0,0);
$pdf->Cell(60,5,': ',0,1);
$pdf->Cell(112,5,'',0,0);
$pdf->Cell(28,5,'Kepala',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(58,5, '',0,1);

$Y=$pdf->GetY()+5;
$pdf->SetLineWidth(0.5);
$pdf->Line (30,$Y-2,209,$Y-2);
$pdf->SetLineWidth(0.2);
$pdf->Cell(0,5,'',0,1);
$pdf->Cell(20,5,'',0,0);

$pdf->Cell(5,5,'IV.',0,0,'C');
$pdf->Cell(27,5,'Tiba di',0,0);
$pdf->Cell(60,5,': ',0,0);
$pdf->Cell(28,5,'Berangkat dari',0,0);
$pdf->Cell(60,5,': ',0,1);
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(27,5,'Pada Tanggal',0,0);
$pdf->Cell(60,5,': ',0,0);
$pdf->Cell(28,5,'Ke',0,0);
$pdf->Cell(60,5,': ',0,1);
$pdf->Cell(25,5,'',0,0);
$pdf->Cell(27,5,'Kepala',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(58,5, '',0,0);
$pdf->Cell(28,5,'Pada Tanggal',0,0);
$pdf->Cell(60,5,': ',0,1);
$pdf->Cell(112,5,'',0,0);
$pdf->Cell(28,5,'Kepala',0,0);
$pdf->Cell(2,5,':',0,0);
$pdf->Cell(58,5, '',0,1);

$Y=$pdf->GetY()+5;
$pdf->SetLineWidth(0.5);
$pdf->Line (30,$Y-2,209,$Y-2);
$pdf->SetLineWidth(0.2);

$pdf->Cell(0,5,'',0,1);
$pdf->Cell(200,8,'',0,1,'');
$pdf->Cell(90,6,'V.',0,0,'R');
$pdf->Cell(40,6,'Tiba Kembali di',0,0,'L');
$pdf->Cell(70,6,': Bantul',0,1,'L');
$pdf->Cell(90,6,'',0,0);
$pdf->Cell(40,6,'Pada Tanggal',0,0,'L');
$pdf->Cell(70,6,': '.$kembali,0,1,'L');


$pdf->Cell(90,6,'',0,0,'R');
$pdf->Cell(110,6,'Telah diperiksa dengan keterangan bahwa',0,1,'L');
$pdf->Cell(90,6,'',0,0,'R');
$pdf->Cell(110,6,'perjalanan tersebut diatas benar-benar dilakukan',0,1,'L');
$pdf->Cell(90,6,'',0,0,'R');
$pdf->Cell(110,6,'atas perhatiannya dan semata-mata untuk',0,1,'L');
$pdf->Cell(90,6,'',0,0,'R');
$pdf->Cell(110,6,'kepentingan jabatan dalam waktu yang sesingkat',0,1,'L');
$pdf->Cell(90,6,'',0,0,'R');
$pdf->Cell(110,6,'singkatnya.',0,1,'L');
$pdf->Cell(90,6,'',0,0,'R');
$pdf->Cell(110,6,'Pejabat yang berwenang memberi perintah',0,1,'C');
$pdf->Cell(90,6,'',0,0,'R');
$pdf->Cell(110,6,'Kepala Dinas Pariwisata',0,1,'C');
$pdf->Cell(90,6,'',0,0,'R');
$pdf->Cell(110,6,'Kabupaten Bantul',0,1,'C');
$pdf->Cell(200,8,'',0,1,'');
$pdf->Cell(200,8,'',0,1,'');
$pdf->Cell(90,6,'',0,0,'R');
$pdf->SetFont('Arial','U',12);
$pdf->Cell(110,6,$kadis,0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(90,6,'',0,0,'R');
$pdf->Cell(110,6,'NIP. '.$nipkadis,0,1,'C');
$Y=$pdf->GetY()+3;
$pdf->Line (30,$Y-2,209,$Y-2);
$pdf->Cell(20,8,'V.  ',0,0,'R');
$pdf->Cell(30,8,'Catatan Lain-lain      :',0,1,'L');
$Y=$pdf->GetY()+3;
$pdf->Line (30,$Y-2,209,$Y-2);
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,8,'VI.  ',0,0,'R');
$pdf->Cell(30,8,'Perhatian  :',0,1,'L');
$pdf->Cell(20,8,'',0,0,'R');
$pdf->MultiCell(180,4,'Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggla berakt/tiba serta Bendaharawan bertanggung jawab berdasarkan peraturan-peraturan keuangan Negara apabila Negara mendapat rugi akibat kesalahan, kelalaian, kealpaannya. (angka 8 lampiran Surat Menteri Keuangan tanggal 3 April 1974 No. B.296 MK/I/4/1974).',0,1,);

$pdf->Output();
exit;
?>
