
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
            if($item->eselon > 2){
                 $gaji=$tunjangan2;
                 $temp=$sppd->lama*$gaji;
            }else {
                 $gaji=$tunjangan1;
                 $temp=$sppd->lama*$gaji;
            };            
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


$berangkat=date('d',strtotime($sppd->tgl_pergi)).' '.$bln[date('m',strtotime($sppd->tgl_pergi))].' '.date('Y',strtotime($sppd->tgl_pergi)).'';
$kembali=date('d',strtotime($sppd->tgl_kembali)).' '.$bln[date('m',strtotime($sppd->tgl_kembali))].' '.date('Y',strtotime($sppd->tgl_kembali)).'';
$buat=date('d',strtotime($sppd->tgl_surat)).' '.$bln[date('m',strtotime($sppd->tgl_surat))].' '.date('Y',strtotime($sppd->tgl_surat)).'';
//------------------------------------------------//
$pdf = new FPDF();
$pdf->SetTitle('Cetak SPPD');
//----------------------SURAT TUGAS--------------------------//
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    // Move to the right
    $pdf->image($path,40,7,14);
    $pdf->Cell(0,5,'',0,1);
    $pdf->Cell(0,6,'PEMERINTAH KABUPATEN BANTUL',0,1,'C');
    $pdf->SetFont('Arial','B',15);
    $pdf->Cell(0,6,'DINAS PARIWISATA',0,1,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(0,5,'Alamat : Jalan Lingkar Manding Bakulan Bantul Telp. (0274) 6460222, Fax (0274) 6460183',0,1,'C');
    $pdf->Cell(0,5,'E-mail : dinas.pariwisata@bantulkab.go.id Web-side : www.pariwisata.bantulkab.go.id',0,1,'C');
    $Y=$pdf->GetY();
    $pdf->SetLineWidth(0.5);
    $pdf->Line (20,$Y+2,190,$Y+2);
    $pdf->SetLineWidth(0.2);
    $pdf->Cell(0,4,'',0,1);
    
    $pdf->Cell(0,1,'',0,1);
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0,6,'SURAT PERINTAH TUGAS',0,1,'C');
    $pdf->Cell(100,6,'NOMOR :',0,0,'R');
    $pdf->Cell(95,6,$nosurat ?? '',0,1,'L');
    $pdf->cell(0,7,'',0,1);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(16,6,'',0,0);
    $pdf->Cell(13,6,'Dasar',0,0,'L');
    $pdf->Cell(6,6,':',0,0);
    $pdf->MultiCell(0,6,$dasar ?? '',0,1);
    $pdf->cell(0,5,'',0,1);
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0,6,'MEMERINTAHKAN',0,1,'C');
    $pdf->Cell(16,6,'',0,0);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(13,6,'Kepada',0,0,'L');
    $pdf->Cell(6,6,':',0,0);
    $pdf->Cell(0,6,'',0,1);
    $i=1;
    foreach ($tugas as $key) {
     foreach ($pegawai as $item) {
         if ($item->id == $key->id_pegawai) {
            $pdf->Cell(30,5,'',0,0);
            $pdf->Cell(6,5,$i,0,0);            
            $pdf->Cell(30,5,'Nama',0,0);
            $pdf->Cell(3,5,':',0,0);  
            $pdf->Cell(0,5,$item->nama,0,1);

            $pdf->Cell(30,5,'',0,0);
            $pdf->Cell(6,5,'',0,0);            
            $pdf->Cell(30,5,'Pangkat/Gol',0,0);
            $pdf->Cell(3,5,':',0,0);  
            $pdf->Cell(0,5,$item->pangkat,0,1);
            
            $pdf->Cell(30,5,'',0,0);
            $pdf->Cell(6,5,'',0,0);            
            $pdf->Cell(30,5,'NIP',0,0);
            $pdf->Cell(3,5,':',0,0);  
            $pdf->Cell(0,5,$item->nip,0,1);

            $pdf->Cell(30,5,'',0,0);
            $pdf->Cell(6,5,'',0,0);            
            $pdf->Cell(30,5,'Jabatan',0,0);
            $pdf->Cell(3,5,':',0,0);  
            $pdf->MultiCell(0,5,$item->jabatan,0,1);
            $pdf->Cell(0,4,'',0,1);
            if ($i==7 || $i==17) {
                $pdf->AddPage();
            }
            $i++;
         }
        }
    }
    $pdf->Cell(30,6,'Untuk',0,0,'R');
    $pdf->Cell(2,6,':',0,0);
    $pdf->MultiCell(0,6,$acara.' di '.$tempat_tujuan.' yang dilaksanakan pada tanggal '.$berangkat,0,1);
    $pdf->Cell(0,7,'',0,1);
    $pdf->Cell(100,5,'',0,0);
    $pdf->Cell(40,5,'Ditetapkan di',0,0);
    $pdf->Cell(50,5,': Bantul',0,1);
    $pdf->Cell(100,5,'',0,0);
    $pdf->Cell(40,5,'Pada Tanggal',0,0);
    $pdf->Cell(50,5,': '.$buat,0,1);
    $pdf->Cell(0,2,'',0,1);
    $pdf->Cell(90,5,'',0,0);
    $pdf->Cell(90,5,'Kepala Dinas Pariwisata',0,1,'C');
    $pdf->Cell(90,5,'',0,0);
    $pdf->Cell(90,5,'Kabupaten Bantul',0,1,'C');
    $pdf->Cell(0,22,'',0,1);
    $pdf->Cell(90,5,'',0,0);
    $pdf->Cell(90,5,$kadis,0,1,'C');
    $pdf->Cell(90,5,'',0,0);
    $pdf->Cell(90,5,'NIP. '.$nipkadis,0,1,'C');
    $pdf->SetAutoPageBreak(true);

//----------------------BUKTI KAS----------------------------//

    $pdf->AddPage('P','');
    $pdf->SetFont('Arial','UB',12);
    $pdf->Cell(200,4,'BUKTI PENGELUARAN KAS',0,1,'C');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(200,4,'Model : Bend 26 a',0,1,'R');
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(32,4,'Terima Dari',0,0);$pdf->Cell(2,4,':',0,0);
    $pdf->Cell(140,4,'Bendahara Pengeluaran Dinas Pariwisata Kabupaten Bantul',0,1);
    //new line

    $pdf->Cell(32,4,'Uang Sebesar',0,0);;$pdf->Cell(2,4,':',0,0);
    $pdf->Cell(170,4,'Rp '.number_format($totaluang).' -, ('.terbilang($totaluang).' Rupiah)',0,1);
    //new line
    $pdf->Cell(32,4,'Untuk Pembayaran',0,0);;$pdf->Cell(2,4,':',0,0);
    $pdf->MultiCell(0,4,$acara.' di '.$tempat_tujuan.' yang dilaksanakan pada tanggal '.$berangkat,0,1);


    if ($sppd->anggaran=='1') {
    $pdf->Cell(200,6,'',0,1,'C');
    }else {
    $pdf->Cell(34,4,'',0,0);
    $pdf->Cell(100,6,'DANA ALOKASI KHUSUS (DAK) FISIK TAHUN '.$tahun_anggaran,0,1,'L');
    }


    //Table
    $pdf->SetFont('Arial','',11);
    $pdf->Cell(3,6,'',0,0);
    $pdf->Cell(7,8,'No',1,0);
    $pdf->Cell(65,8,'Nama',1,0,'C');
    $pdf->Cell(10,8,'Gol',1,0,'C');
    $pdf->Cell(54,8,'Uraian Penerimaan',1,0,'C');
    $pdf->Cell(28,8,'Terima Bersih',1,0,'C');
    $pdf->Cell(26,8,'Tanda Tangan',1,1,'C');
    $pdf->SetFont('Arial','',11);
    $no=1;
    $namapenerima='';
    $nippenerima='';
    
    $hx1=8;
    
    foreach ($tugas as $key) {
        foreach ($pegawai as $item) {
            if ($item->id == $key->id_pegawai) {
            $pdf->Cell(3,$hx1,'',0,0);
            $pdf->SetFillColor(255,255,255);
            $pdf->Cell(7,$hx1,$no,'LR',0,'C');
            $pdf->Cell(65,$hx1,$item->nama,'LR',0);
            if($item->golongan ==0){
                $pdf->Cell(10,$hx1,'-','LR',0,'C');
            }if($item->golongan ==1){
                $pdf->Cell(10,$hx1,'I','LR',0,'C');
            }if($item->golongan ==2){
                $pdf->Cell(10,$hx1,'II','LR',0,'C');
            }if($item->golongan ==3){
                $pdf->Cell(10,$hx1,'III','LR',0,'C');
            }if($item->golongan ==4){
                $pdf->Cell(10,$hx1,'IV','LR',0,'C');
            }if($item->golongan ==5){
                $pdf->Cell(10,$hx1,'V','LR',0,'C');
            }
            if($item->eselon >2){
                $gaji=$tunjangan2;
            }else {
                $gaji=$tunjangan1;
            }

            $pdf->Cell(54,$hx1,' '.$sppd->lama.' hari    x    '.number_format($gaji).' = '.number_format($sppd->lama*$gaji),'LR',0);
            $temp=$sppd->lama*$gaji;
            $pdf->Cell(28,$hx1,'Rp '.number_format($temp).' -,','LR',0);
            $pdf->Cell(26,$hx1,$no.' ...........','LR',1);
            $namapenerima=$item->nama;
            $nippenerima=$item->nip;
            $no++;
          }
        }
    }
    $pdf->Cell(3,$hx1,'',0,0);
    $pdf->Cell(136  ,$hx1,'Total',1,0,'R');
    $pdf->Cell(28,$hx1,'Rp '.number_format($totaluang).' -,',1,0);
    $pdf->Cell(26,$hx1,'',1,1);
    //End Table
    $pdf->cell('',3,'',0,1);
    $pdf->Cell(145,5,'',0,0);
    $pdf->SetFont('Arial','',10);
    //$pdf->Cell(40,5,'Bantul, '.$datenow,0,1,'C');
    $pdf->Cell(40,5, 'Bantul,                        '.$tahun_anggaran, 0, 1,'C');
    $pdf->Cell(5,6,'',0,0);
    $pdf->Cell(50,6,'Mengetahui/menyetujui',0,0,'C');
    $pdf->Cell(45,6,'PPTK',0,0,'C');
    $pdf->Cell(45,6,'Bendahara Pengeluaran',0,0,'C');
    $pdf->Cell(45,6,'Yang menerimakan',0,1,'C');
    $pdf->Cell(5,4,'',0,0);
    $pdf->Cell(50,0,'Pengguna Anggaran',0,0,'C');
    $pdf->Cell(135,6,'',0,1);

    //$pdf->Cell(200,6,'',0,1,'C');
    $pdf->Cell(200,6,'',0,1,'C');
    $pdf->SetFont('Arial','U',9);
    $pdf->Cell(5,5,'',0,0);
    $pdf->Cell(50,5,$kadis,0,0,'C');
    $pdf->Cell(45,5,$namapptk,0,0,'C');
    $pdf->Cell(45,5,$namabendahara,0,0,'C');
    $pdf->Cell(45,5,$namapenerima,0,1,'C');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(5,4,'',0,0);
    $pdf->Cell(50,4,'NIP. '.$nipkadis,0,0,'C');
    $pdf->Cell(45,4,'NIP. '.$nippptk,0,0,'C');
    $pdf->Cell(45,4,'NIP. '.$nipbendahara,0,0,'C');

    $pdf->Cell(45,4,'NIP. '.$nippenerima,0,1,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(200,6,'',0,1,'C');
    $Y=$pdf->GetY();
    $pdf->SetLineWidth(1);
    $pdf->Line (14,$Y-2,205,$Y-2);
    $pdf->Line (75,$Y-2,75,$Y+35);
    $pdf->Line (140,$Y-2,140,$Y+35);
    $pdf->SetLineWidth(0.2);

    $pdf->Cell(10,4,'',0,0);
    $pdf->Cell(60,4,'Barang tersebut telah',0,0,'L');
    $pdf->Cell(65,4,'Telah Dipungut',0,0,'L');
    $pdf->Cell(90,4,'Telah dibukukan :',0,1,'L');
    $pdf->Cell(10,4,'',0,0);
    $pdf->Cell(60,4,'diterima cukup dan baik',0,0,'L');
    $pdf->Cell(65,4,'PPN Rp.',0,0,'L');
    $pdf->Cell(90,4,'BK tgl ............................... No ..............',0,1,'L');

    $pdf->Cell(10,4,'',0,0);
    $pdf->Cell(60,4,'',0,0,'L');
    $pdf->Cell(65,4,'PPH Rp.',0,0,'L');
    $pdf->Cell(90,4,'BPK Kode rekening :',0,1,'L');

    $pdf->Cell(10,4,'',0,0);
    $pdf->Cell(58,4,'',0,0,'L');
    $pdf->Cell(67,4,'  Rp. ..............',0,0,'L');
    $pdf->Cell(90,4,'Tahun Anggaran : '.$tahun_anggaran,0,1,'L');

    $pdf->Cell(200,6,'',0,1,'C');


    $pdf->Cell(1,4,'',0,0);
    $pdf->Cell(65,4,'Paraf',0,0,'C');
    $pdf->Cell(55,4,'Paraf',0,0,'C');
    $pdf->Cell(90,4,'Paraf',0,1,'C');

    $pdf->Cell(1,4,'',0,0);
    $pdf->Cell(65,4,'(                                 )',0,0,'C');
    $pdf->Cell(55,4,'(                                 )',0,0,'C');
    $pdf->Cell(90,4,'(                                 )',0,1,'C');

    $pdf->Cell(10,4,'',0,0);
    $pdf->Cell(55,4,'      NIP.',0,0,'L');
    $pdf->Cell(45,4,'            NIP.',0,0,'L');
    $pdf->Cell(90,4,'                                     NIP.',0,1,'L');

//------------------------------------------------//


//--------------------------SPPD-----------------------//
 foreach ($tugas as $key) {
     foreach ($pegawai as $item) {
         if ($item->id == $key->id_pegawai) {
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',16);
            // Move to the right
            $pdf->image($path,40,7,14);
            $pdf->Cell(0,5,'',0,1);
            $pdf->Cell(0,6,'PEMERINTAH KABUPATEN BANTUL',0,1,'C');
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(0,6,'DINAS PARIWISATA',0,1,'C');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0,5,'Alamat : Jalan Lingkar Manding Bakulan Bantul Telp. (0274) 6460222, Fax (0274) 6460183',0,1,'C');
            $pdf->Cell(0,5,'E-mail : dinas.pariwisata@bantulkab.go.id Web-side : www.pariwisata.bantulkab.go.id',0,1,'C');
            $Y=$pdf->GetY();
            $pdf->SetLineWidth(0.5);
            $pdf->Line (20,$Y+2,190,$Y+2);
            $pdf->SetLineWidth(0.2);
            $pdf->Cell(0,4,'',0,1);
            $pdf->SetFont('Arial','B',12);
            $pdf->Cell(60,6,'',0,0);$pdf->Cell(30,6,'Lembar ke',0,0);$pdf->Cell(50,6,':',0,1);
            $pdf->Cell(60,6,'',0,0);$pdf->Cell(30,6,'Kode No',0,0);$pdf->Cell(50,6,':',0,1);
            $pdf->Cell(60,6,'',0,0);$pdf->Cell(30,6,'Nomor',0,0);$pdf->Cell(50,6,':',0,1);
            $pdf->Cell(0,1,'',0,1);
            $pdf->SetFont('Arial','UB',15);
            $pdf->Cell(0,6,'SURAT PERINTAH PERJALANAN DINAS',0,1,'C');
            $pdf->SetFont('Arial','B',15);
            $pdf->Cell(0,6,'( SPPD )',0,1,'C');
            $pdf->Cell(0,4,'',0,1);
            $Y=$pdf->GetY();
            $pdf->SetFont('Arial','',12);
            $pdf->Line (50,$Y,190,$Y);
            $pdf->Cell(6,8,'1','TB',0,'C');
            $pdf->Cell(90,8,'Pejabat yang memberi perintah','RT',0,'L');
            $pdf->Cell(0,8,$kadis,'LTB',1,'L');
            $pdf->Cell(6,8,'2','TB',0,'C');
            $pdf->Cell(90,8,'Nama Pegawai yang diperintahkan','TBR',0,'L');
            $pdf->Cell(0,8,$item->nama,"TBL",1,'L');
            $pdf->Cell(6,8,'3','',0,'C');
            $pdf->Cell(90,8,'a. Pangkat / Golongan','TR',0,'L');
            $pdf->MultiCell(0,8,$item->pangkat,'',1);
            $pdf->Cell(6,8,'','','C');
            $pdf->Cell(90,8,'b. NIP','R',0,'L');
            $pdf->Cell(0,8,$item->nip,'',1,'L');
            $pdf->Cell(6,8,'','',0,'C');
            $pdf->Cell(90,8,'c. Jabatan','',0,'L');
            $pdf->MultiCell(0,8,$item->jabatan,'L',1,);
            $pdf->Cell(6,8,'4','T',0,'C');
            $pdf->Cell(90,8,'Maksud perjalanan Dinas','TR',0,'L');
            $pdf->MultiCell(0,8,$acara,"TL",1);
            $pdf->Cell(6,8,'5','TB',0,'C');
            $pdf->Cell(90,8,'Kendaraan yang dipergunakan','TBR',0,'L');
            $pdf->Cell(0,8,$kendaraan,'TBL',1,'L');
            $pdf->Cell(6,8,'6','T',0,'C');
            $pdf->Cell(90,8,'a. Tempat berangkat','TR',0,'L');
            $pdf->Cell(0,8,$tempat_berangkat,'T',1,'L');
            $pdf->Cell(6,8,'','B',0,'C');
            $pdf->Cell(90,8,'b. Tempat tujuan','B',0,'L');
            $pdf->MultiCell(0,8,$tempat_tujuan,'LB',1);
            $pdf->Cell(6,8,'7','T',0,'C');
            $pdf->Cell(90,8,'a. Lamanya perjalanan Dinas','TR',0,'L');
            $pdf->Cell(0,8,$lama.' (hari)','TL',1,'L');
            $pdf->Cell(6,8,'','',0,'C');
            $pdf->Cell(90,8,'b. Tanggal berangkat','R',0,'L');
            $pdf->Cell(0,8,$berangkat,'0',1,'L');
            $pdf->Cell(6,8,'','0',0,'C');
            $pdf->Cell(90,8,'c. Tanggal kembali','R',0,'L');
            $pdf->Cell(0,8,$kembali,'',1,'L');
            $pdf->Cell(6,8,'8','T',0,'C');
            $pdf->Cell(90,8,'Pemberi anggaran','T','L');
            $pdf->Cell(0,8,$anggaran.' '.$tahun_anggaran,'TL',1,'L');
            $pdf->Cell(6,8,'','0',0,'C');
            $pdf->Cell(90,8,'a. Instansi','R',0,'L');
            $pdf->Cell(0,8,'a. Dinas Pariwisata Kab. Bantul','0',1,'L');
            $pdf->Cell(6,8,'','0',0,'C');
            $pdf->Cell(90,8,'b. Mata Anggaran','R',0,'L');
            $pdf->Cell(0,8,'b. -','0',1,'L');
            $pdf->Cell(6,8,'9','TB',0,'C');
            $pdf->Cell(90,8,'Keterangan lain-lain','TB',0,'L');
            $pdf->Cell(0,8,'','LTB',1,'L');
            $pdf->Cell('',5,'',0,1,'C');
            $pdf->Cell(100,5,'',0,0);
            $pdf->Cell(40,5,'Dikeluarkan di',0,0);
            $pdf->Cell(50,5,': Bantul',0,1);
            $pdf->Cell(100,5,'',0,0);
            $pdf->Cell(40,5,'Pada Tanggal',0,0);
            $pdf->Cell(50,5,': '.$buat,0,1);
            $pdf->Cell(0,5,'',0,1);
            $pdf->Cell(90,5,'',0,0);
            $pdf->Cell(90,5,'Kepala Dinas Pariwisata',0,1,'C');
            $pdf->Cell(90,5,'',0,0);
            $pdf->Cell(90,5,'Kabupaten Bantul',0,1,'C');
            $pdf->Cell(0,22,'',0,1);
            $pdf->Cell(90,5,'',0,0);
            $pdf->Cell(90,5,$kadis,0,1,'C');
            $pdf->Cell(90,5,'',0,0);
            $pdf->Cell(90,5,'NIP. '.$nipkadis,0,1,'C');
         }
     }
 }


$pdf->Output();
exit;
?>
