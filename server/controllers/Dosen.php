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
		$this->load->model(array('Akademika_sia','Akademika_sdm'));

    }	

    public function index_get() {
        $id 	= $this->get('nip');
        $where  = array('dsnPegNip' => $id);
        
        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sia->detail_dosen(SELECT_DETAIL_DSN, $where);

        	
       		if (!empty($data))
	        {
	        	$data['edu'] = $this->Akademika_sdm->get_pendidikan($id);
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan data dosen dengan nip tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}	
		
    public function prodi_get() {
	
        $id 		= $this->get('kode');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where  	= array('prodiKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sia->get_dosen(SELECT_LIST_DSN, $where);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list dosen dengan kode prodi tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

	public function jurusan_get() {
	
        $id 		= $this->get('kode');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where		= array('jurKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sia->get_dosen(SELECT_LIST_DSN, $where);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list dosen dengan kode jurusan tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

	public function fakultas_get() {
	
        $id 		= $this->get('kode');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where		= array('fakKode' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sia->get_dosen(SELECT_LIST_DSN, $where);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list dosen dengan kode fakultas tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}
	}

    private function set_where($kategori,$kode) {

    } 	

}
