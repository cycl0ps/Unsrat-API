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
class Mahasiswa extends REST_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model(array('Akademika_sia'));

    }
	
	public function fakultas_get() {
	
        $id 		= $this->get('kode');
        $groupby	= $this->get('groupby');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('fakKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having = FALSE;
        	switch ($groupby) {
                case 'jalurmasuk' : $select  = "jllrNama AS jalurMasuk, COUNT(*) AS jumlah";
                                    $groupby = "mhsJlrrKode";
                                    $having  = "jalurMasuk != 'Lain-Lain'";
                                    break;
                case 'status'     : $select  = "stakmhsrNama AS status, COUNT(*) AS jumlah";
                                    $groupby = "mhsStakmhsrKode";
                                    break;
                case 'angkatan'   : $select  = "mhsAngkatan AS angkatan, COUNT(*) AS jumlah";
                                    $groupby = "mhsAngkatan";
                                    $having  = "angkatan >= 2000";
                                    break;
                case 'sumberdana' : $select  = "sbdnNama AS sumberDana, COUNT(*) AS jumlah";
                                    $groupby = "mhsSbdnrId";
                                    $having  = "sumberDana != ". NULL;
                                    break;
                case 'gender'     : $select  = "mhsJenisKelamin AS gender, COUNT(*) AS jumlah";
                                    $groupby = "mhsJenisKelamin";
                                    $having  = "gender != ". NULL;
                                    break;                    
                case 'jurusan'    : $select  = "jurNamaResmi AS jurusan, COUNT(*) AS jumlah";
                                    $groupby = "jurKode";
                                    break;
                case 'prodi'      : $select  = "CONCAT(prodiNamaResmi, ' ', prodiNamaJenjang) AS prodi, COUNT(*) AS jumlah";
                                    $groupby = "prodiKode";
                                    break;                                                                  
                default           : $select  = "COUNT(*) AS jumlah";
                                    $groupby = "fakKode";
                                    break;
        	}

        	$data = $this->Akademika_sia->get_mahasiswa($select, $where, $groupby, $having); 

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
        $groupby    = $this->get('groupby');
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
                case 'jalurmasuk' : $select  = "jllrNama AS jalurMasuk, COUNT(*) AS jumlah";
                                    $groupby = "mhsJlrrKode";
                                    $having  = "jalurMasuk != 'Lain-Lain'";
                                    break;
                case 'status'     : $select  = "stakmhsrNama AS status, COUNT(*) AS jumlah";
                                    $groupby = "mhsStakmhsrKode";
                                    break;
                case 'angkatan'   : $select  = "mhsAngkatan AS angkatan, COUNT(*) AS jumlah";
                                    $groupby = "mhsAngkatan";
                                    $having  = "angkatan >= 2000";
                                    break;
                case 'sumberdana' : $select  = "sbdnNama AS sumberDana, COUNT(*) AS jumlah";
                                    $groupby = "mhsSbdnrId";
                                    $having  = "sumberDana != ". NULL;
                                    break;
                case 'gender'     : $select  = "mhsJenisKelamin AS gender, COUNT(*) AS jumlah";
                                    $groupby = "mhsJenisKelamin";
                                    $having  = "gender != ". NULL;
                                    break;                                  
                case 'prodi'      : $select  = "CONCAT(prodiNamaResmi, ' ', prodiNamaJenjang) AS prodi, COUNT(*) AS jumlah";
                                    $groupby = "prodiKode";
                                    break;                                                                  
                default           : $select  = "COUNT(*) AS jumlah";
                                    $groupby = "jurKode";
                                    break;  
        	}

        	$data = $this->Akademika_sia->get_mahasiswa($select, $where, $groupby, $having); 

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
                case 'jalurmasuk' : $select  = "jllrNama AS jalurMasuk, COUNT(*) AS jumlah";
                                    $groupby = "mhsJlrrKode";
                                    $having  = "jalurMasuk != 'Lain-Lain'";
                                    break;
                case 'status'     : $select  = "stakmhsrNama AS status, COUNT(*) AS jumlah";
                                    $groupby = "mhsStakmhsrKode";
                                    break;
                case 'angkatan'   : $select  = "mhsAngkatan AS angkatan, COUNT(*) AS jumlah";
                                    $groupby = "mhsAngkatan";
                                    $having  = "angkatan >= 2000";
                                    break;
                case 'sumberdana' : $select  = "sbdnNama AS sumberDana, COUNT(*) AS jumlah";
                                    $groupby = "mhsSbdnrId";
                                    $having  = "sumberDana != ". NULL;
                                    break;
                case 'gender'     : $select  = "mhsJenisKelamin AS gender, COUNT(*) AS jumlah";
                                    $groupby = "mhsJenisKelamin";
                                    $having  = "gender != ". NULL;
                                    break;                                                                                                   
                default           : $select  = "COUNT(*) AS jumlah";
                                    $groupby = "prodiKode";
                                    break;  
            }

            $data = $this->Akademika_sia->get_mahasiswa($select, $where, $groupby, $having); 

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
        switch ($kategori) {
            case 'jalurmasuk' : return array('mhsJlrrKode' => $kode);
            case 'status'     : return array('mhsStakmhsrKode' => $kode);
            case 'angkatan'   : return array('mhsAngkatan' => $kode);
            case 'sumberdana' : return array('mhsSbdnrId' => $kode);
            case 'gender'     : return array('mhsJenisKelamin' => $kode);                  
            default           : $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }        
    }   
}
