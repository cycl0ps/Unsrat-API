<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Dosen extends REST_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model(array('Akademika_sia'));

    }

    public function fakultas_get() {
    
        $id         = $this->get('kode');
        $groupby    = $this->get('groupby');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('fakKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'ikatankerja': $select  = "dsnSikjKode AS id, sikjNama AS statusIkatanKerja, COUNT(*) AS jumlah";
                                    $groupby = "dsnSikjKode";
                                    break;
                case 'aktifitas'  : $select  = "dsnSadrKode AS id, sadrNama AS statusAktifitas, COUNT(*) AS jumlah";
                                    $groupby = "dsnSadrKode";
                                    break;
                case 'status'     : $select  = "pegStpegrId AS id, stpegrNama AS statusDosen, COUNT(*) AS jumlah";
                                    $groupby = "pegStpegrId";
                                    break;
                case 'jenis'      : $select  = "pegJnpegrId AS id, jnpegrNama AS jenis_pegawai, COUNT(*) AS jumlah";
                                    $groupby = "pegJnpegrId";
                                    break;                                      
                case 'jurusan'    : $select  = "jurKode AS kode, jurNamaResmi AS dosenJurusan, COUNT(*) AS jumlah";
                                    $groupby = "jurKode";
                                    break;
                case 'prodi'      : $select  = "prodiKode AS kode, CONCAT(prodiNamaResmi, ' ', prodiNamaJenjang) AS dosenProdi, COUNT(*) AS jumlah";
                                    $groupby = "prodiKode";
                                    break;                                                                  
                default           : $select  = "fakKode AS kode, COUNT(*) AS jumlahDosen";
                                    $groupby = "fakKode";
                                    break;  
            }

            $data = $this->Akademika_sia->get_dosen($select, $where, $groupby, $having); 

            if (!empty($data))
            {
                $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Not found!'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

    }    

	public function jurusan_get() {
	
        $id 		= $this->get('kode');
        $groupby	= $this->get('groupby');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('jurKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
        	switch ($groupby) {
                case 'ikatankerja': $select  = "dsnSikjKode AS id, sikjNama AS statusIkatanKerja, COUNT(*) AS jumlah";
                                    $groupby = "dsnSikjKode";
                                    break;
                case 'aktifitas'  : $select  = "dsnSadrKode AS id, sadrNama AS statusAktifitas, COUNT(*) AS jumlah";
                                    $groupby = "dsnSadrKode";
                                    break;
                case 'status'     : $select  = "pegStpegrId AS id, stpegrNama AS statusDosen, COUNT(*) AS jumlah";
                                    $groupby = "pegStpegrId";
                                    break;
                case 'jenis'      : $select  = "pegJnpegrId AS id, jnpegrNama AS jenis_pegawai, COUNT(*) AS jumlah";
                                    $groupby = "pegJnpegrId";
                                    break;     
                case 'prodi'      : $select  = "prodiKode AS kode, CONCAT(prodiNamaResmi, ' ', prodiNamaJenjang) AS dosenProdi, COUNT(*) AS jumlah";
                                    $groupby = "prodiKode";
                                    break;                                                                  
                default           : $select  = "jurKode AS kode, COUNT(*) AS jumlahDosen";
                                    $groupby = "jurKode";
                                    break; 
        	}

        	$data = $this->Akademika_sia->get_dosen($select, $where, $groupby, $having);

        	if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Not found!'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

    public function prodi_get() {
    
        $id         = $this->get('kode');
        $groupby    = $this->get('groupby');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('prodiKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'ikatankerja': $select  = "dsnSikjKode AS id, sikjNama AS statusIkatanKerja, COUNT(*) AS jumlah";
                                    $groupby = "dsnSikjKode";
                                    break;
                case 'aktifitas'  : $select  = "dsnSadrKode AS id, sadrNama AS statusAktifitas, COUNT(*) AS jumlah";
                                    $groupby = "dsnSadrKode";
                                    break;
                case 'status'     : $select  = "pegStpegrId AS id, stpegrNama AS statusDosen, COUNT(*) AS jumlah";
                                    $groupby = "pegStpegrId";
                                    break;
                case 'jenis'      : $select  = "pegJnpegrId AS id, jnpegrNama AS jenis_pegawai, COUNT(*) AS jumlah";
                                    $groupby = "pegJnpegrId";
                                    break;                                                              
                default           : $select  = "prodiKode AS kode, COUNT(*) AS jumlahDosen";
                                    $groupby = "prodiKode";
                                    break; 
            }

            $data = $this->Akademika_sia->get_dosen($select, $where, $groupby, $having); 

            if (!empty($data))
            {
                $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Not found!'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }

        }

    }    

    private function set_where($kategori,$kode) {

    } 
}
