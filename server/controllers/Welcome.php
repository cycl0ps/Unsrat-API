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
	
		$data = $this->Akademika_sia->get_table('fakultas', 'fakNamaResmi AS namaFakultas, fakKode AS kodeFakultas');

		foreach ($data as &$fakultas) {
			$fakultas['jurusan'] =  $this->Akademika_sia->get_table('jurusan', 'jurNamaResmi AS namaJurusan, jurKode AS kodeJurusan', 'jurFakKode ='.$fakultas['kodeFakultas']);

			foreach ($fakultas['jurusan'] as &$jurusan) {
				$jurusan['prodi'] =  $this->Akademika_sia->get_table('program_studi', 'prodiNamaResmi AS namaProdi, prodiNamaJenjang AS jenjang, prodiKode AS kodeProdi', 'prodiJurKode ='.$jurusan['kodeJurusan']);
			}
		}
   		
        header('Content-type: application/json');
        echo json_encode($data);
	}

    public function kode_satker() {
	
		$data = $this->Akademika_sdm->get_table('pub_satuan_kerja', 'satkerNama AS namaSatker, satkerId AS kodeSatker');

        header('Content-type: application/json');
        echo json_encode($data);
   		
	}	
	
}