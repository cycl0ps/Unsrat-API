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
class Pegawai extends REST_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model(array('Akademika_sdm'));

    }	

    public function index_get() {
        $id 	= $this->get('nip');
        $where  = array('dsnPegNip' => $id);
        
        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sdm->detail_pegawai(SELECT_DETAIL_PGW, $where);
       		if (!empty($data))
	        {
	        	$data['edu'] = $this->Akademika_sdm->get_pendidikan($id);
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan data pegawai dengan nip tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}	
		
    public function satker_get() {
	
        $id 	= $this->get('id');
        $where  = array('satkerpegId' => $id);

        if ($id === NULL)
        {
			//To be List satker

        } else {
        	$data = $this->Akademika_sdm->list_pegawai(SELECT_LIST_PGW, $where);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list pegawai dengan satker id tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

	public function academic_get() {
	
        $id = $this->get('satker');
        $where  = array('pegdtKategori' => 'Academic', 'satkerpegSatkerId' => $id);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sdm->list_pegawai(SELECT_LIST_PGW, $where);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list pegawai academic dengan satker id tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

	public function non_academic_get() {
	
        $id = $this->get('satker');
        $where  = array('pegdtKategori' => 'Non-Academic', 'satkerpegSatkerId' => $id);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sdm->list_pegawai(SELECT_LIST_PGW, $where);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list pegawai non-academic dengan satker id tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}	


}
