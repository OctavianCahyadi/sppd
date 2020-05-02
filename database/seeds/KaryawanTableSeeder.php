<?php

use Illuminate\Database\Seeder;

class KaryawanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_karyawan')->insert([
            [
                'nama' => 'Kwintarto Heru Prabowo, S.Sos',
                'nip' => '197204131998031008',
                'jabatan' => 'Kepala Dinas Pariwisata Kab. Bantul',
                'pangkat' => 'Pembina Utama Muda IV/c',
                'golongan' => '4',
            ],
            [
                'nama' => 'Dra. Annihayah, M.Eng',
                'nip' => '196902041993032004',
                'jabatan' => 'Sekretaris Dinas Pariwisata Kab. Bantul',
                'pangkat' => 'Pembina Tingkat 1 IV/b',
                'golongan' => '4',
            ],
            [
                'nama' => 'Endri Astuti, SIP',
                'nip' => '197304021992032002',
                'jabatan' => 'Kepala Sub Bag. Umum dan Kepegawaian',
                'pangkat' => 'Penata III/c',
                'golongan' => '3',
            ],
            [
                'nama' => 'Darochim Muharomah, S.M.',
                'nip' => '199008222011012002',
                'jabatan' => 'Bendahara Pada Sub Bag. PKA Sekretariat Dinas Pariwisata',
                'pangkat' => 'Pengatur II/c',
                'golongan' => '2',
            ],
            [
                'nama' => 'Setya Ardhana Tarigan Sibero, ST',
                'nip' => '198204022010011021',
                'jabatan' => 'Ka.Si. Sarpras dan Usaha Jasa Pariwisata',
                'pangkat' => 'Penata III /c',
                'golongan' => '3',
            ],
            [
                'nama' => 'Agus Yuli Herwanta, ST, MT',
                'nip' => '196807201996031003',
                'jabatan' => 'Ka. Bid. Pengembangan Destinasi',
                'pangkat' => 'Pembina IV /a',
                'golongan' => '4',
            ],
            [
                'nama' => 'Alexander Joko Wintolo, SH',
                'nip' => '196904151994031006',
                'jabatan' => 'Kepala Seksi ODTW Bidang Pengembangan Destinasi',
                'pangkat' => 'Penata TK I III/d',
                'golongan' => '3',
            ],
            [
                'nama' => 'Rr. Warih Ardia RD, A.Md',
                'nip' => '197209091997032003',
                'jabatan' => 'Staf Seksi ODTW',
                'pangkat' => 'Penata  III/c',
                'golongan' => '3',
            ],
            [
                'nama' => 'Ahmad Setiawan',
                'nip' => '196806071992031008',
                'jabatan' => 'Staf Seksi Sarana Prasarana dan Usaha Jasa Pariwisata',
                'pangkat' => 'Penata Muda Tk I III/b',
                'golongan' => '3',
            ],
            [
                'nama' => 'Intan Delima Nur B, SE',
                'nip' => '198404122010012045',
                'jabatan' => 'Staf Seksi Sarana Prasarana dan Usaha Jasa Pariwisata',
                'pangkat' => 'Penata III/c',
                'golongan' => '3',
            ],
            [
                'nama' => 'Muhammad Wijdan',
                'nip' => '197310162007011007',
                'jabatan' => 'Staf Seksi ODTW',
                'pangkat' => 'Pengatur Muda Tingakt 1 II/b',
                'golongan' => '2',
            ],
            [
                'nama' => 'Syarani Apriana Sukma Jati',
                'nip' => '-',
                'jabatan' => 'Staf Seksi ODTW',
                'pangkat' => '-',
                'golongan' => '0',
            ],
            [
                'nama' => 'Hannik Hedayati, S.Pd',
                'nip' => '-',
                'jabatan' => 'Staf Seksi Sarana Prasarana dan Usaha Jasa Pariwisata',
                'pangkat' => '-',
                'golongan' => '0',
            ],
            [
                'nama' => 'Dicky Fathur Rohman',
                'nip' => '-',
                'jabatan' => 'Staf Seksi Sarana Prasarana dan Usaha Jasa Pariwisata',
                'pangkat' => '-',
                'golongan' => '0',
            ],

        ]);    
    }
}
