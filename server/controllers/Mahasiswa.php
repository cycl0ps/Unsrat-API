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

    public function index_get() {
        $id     = $this->get('nim');
        $where  = array('mhsNiu' => $id);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sia->detail_mahasiswa(SELECT_DETAIL_MHS, $where);
       		if (!empty($data))
	        {
                if (!empty($data['foto'])) $data['foto'] = URL_FOTO_MHS.$data['foto'];
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan data mahasiswa dengan nim tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}
	}	
		
    public function prodi_get() {
	
        $id         = $this->get('kode');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('prodiKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sia->get_mahasiswa(SELECT_LIST_MHS, $where);
       		if (!empty($data))
	        {
                foreach ($data as $key => $value) {
                    if (!empty($data[$key]['foto'])) $data[$key]['foto'] = URL_FOTO_MHS.$data[$key]['foto'];
                }             
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list mahasiswa dengan kode prodi tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

	public function jurusan_get() {
	
        $id         = $this->get('kode');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('jurKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);         

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sia->get_mahasiswa(SELECT_LIST_MHS, $where);
       		if (!empty($data))
	        {
                foreach ($data as $key => $value) {
                    if (!empty($data[$key]['foto'])) $data[$key]['foto'] = URL_FOTO_MHS.$data[$key]['foto'];
                } 
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list mahasiswa dengan kode jurusan tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

	public function fakultas_get() {
	
        $id         = $this->get('kode');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('fakKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);       

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sia->get_mahasiswa(SELECT_LIST_MHS, $where);
       		if (!empty($data))
	        {
                foreach ($data as $key => $value) {
                    if (!empty($data[$key]['foto'])) $data[$key]['foto'] = URL_FOTO_MHS.$data[$key]['foto'];
                } 
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list mahasiswa dengan kode fakultas tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}
	}

    private function set_where($kategori,$kode) {
        if ($kategori == "status") return array('mhsStakmhsrKode' => $kode);
        else if ($kategori == "jalurmasuk") return array('mhsJlrrKode' => $kode);
        else if ($kategori == "angkatan") return array('mhsAngkatan' => $kode);
        else if ($kategori == "sumberdana") return array('mhsSbdnrId' => $kode);
        else if ($kategori == "gender") return array('mhsJenisKelamin' => $kode);
        
        else $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
    }     
}
