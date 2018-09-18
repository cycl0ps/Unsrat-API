<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Akademika_sia','Akademika_sdm','Akademika_portal'));
	
	}
	
	public function index() {
	
		$this->load->view("welcome");
	
	}

    public function kode_fakultas() {
	
		$data = $this->Akademika_sia->get_table('fakultas', 'fakNamaResmi AS fakultas, fakKode AS kode');

		foreach ($data as &$fakultas) {
			$fakultas['jurusan'] =  $this->Akademika_sia->get_table('jurusan', 'jurNamaResmi AS jurusan, jurKode AS kode', 'jurFakKode ='.$fakultas['kode']);

			foreach ($fakultas['jurusan'] as &$jurusan) {
				$jurusan['prodi'] =  $this->Akademika_sia->get_table('program_studi', 'prodiNamaResmi AS prodi, prodiNamaJenjang AS jenjang, prodiKode AS kode', 'prodiJurKode ='.$jurusan['kode']);
			}
		}
   		
        header('Content-type: application/json');
        echo json_encode($data);
	}

    public function kode_satker() {
	
		$data = $this->Akademika_sdm->get_table('pub_satuan_kerja', 'satkerNama AS namaSatker, satkerId AS kode');

        header('Content-type: application/json');
        echo json_encode($data);
   		
	}

	public function group() {

		$mhs = array('jalurmasuk','status','angkatan','sumberdana','gender','jurusan','prodi');
		$alu = array('tahun','wisudaprd','angkatan','jurusan','prodi');
		$dsn = array('ikatankerja','aktifitas','status','jenis','jurusan','prodi');
		$pgw = array('pangkat','fungsional','status','kategori','jenis','gender','nikah');
	
		$data['parameter groupby untuk jumlah/mahasiswa'] = $mhs;
		$data['parameter groupby untuk jumlah/alumni'] = $alu;
		$data['parameter groupby untuk jumlah/dosen'] = $dsn;
		$data['parameter groupby untuk jumlah/pegawai'] = $pgw;

        header('Content-type: application/json');
        echo json_encode($data);
   		
	}

	public function filter() {

		$mhsStatus 	= $this->Akademika_sia->get_table('status_aktif_mahasiswa_ref', 'stakmhsrKode AS id, stakmhsrNama AS keterangan');
		$mhsJalur 	= $this->Akademika_sia->get_table('s_jalur_ref', 'jllrKode AS id, jllrNama AS keterangan');
		$mhsSumber	= $this->Akademika_sia->get_table('s_sumber_dana_ref', 'sbdnrId AS id, sbdnNama AS keterangan');
		$mhsGender 	= array(array('id' => 'L', 'keterangan' => 'Laki-laki'), array('id' => 'P', 'keterangan' => 'Perempuan'));
		$filterMhs	= array('status' => $mhsStatus, 'jalurmasuk' => $mhsJalur, 'angkatan' => 'id = angkatan mahasiswa', 'sumber' => $mhsSumber, 'gender' => $mhsGender);

		$dsnStatus 	= $this->Akademika_sdm->get_table('sdm_ref_status_pegawai', 'statrId AS id, statrPegawai AS keterangan');
		$dsnFung 	= $this->Akademika_sdm->get_table('pub_ref_jabatan_fungsional', 'jabfungrId AS id, jabfungrNama AS keterangan');
		$dsnPkt		= $this->Akademika_sdm->get_table('sdm_ref_pangkat_golongan', 'pktgolrId AS id, pktgolrNama AS keterangan');
		$filterPgw	= array('status' => $dsnStatus, 'fungsional' => $dsnFung, 'pangkat' => $dsnPkt);		
	
		$data['parameter kategori filter mahasiswa'] = $filterMhs;
		$data['parameter kategori filter alumni'] = "Not available yet";
		$data['parameter kategori filter dosen'] = "Not available yet";
		$data['parameter kategori filter pegawai'] = $filterPgw;

        header('Content-type: application/json');
        echo json_encode($data);
   		
	}
}