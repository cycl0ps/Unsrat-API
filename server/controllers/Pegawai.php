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
        $id 		= $this->get('nip');
        $where  	= array('pegKodeResmi' => $id);

        
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
	
        $id 		= $this->get('kode');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where  	= array('satkerpegSatkerId' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);
        $select     = SELECT_LIST_PGW;

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code

        } else {
        	$data = $this->Akademika_sdm->get_pegawai($select, $where);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list pegawai dengan kode satker tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

	public function academic_get() {
	
        $id 		= $this->get('kode');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where  	= array('pegdtKategori' => 'Academic', 'satkerpegSatkerId' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);
        $select     = SELECT_LIST_PGW;

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sdm->get_pegawai($select, $where);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list pegawai academic kode dengan satker tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

	public function non_academic_get() {
	
        $id 		= $this->get('kode');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where  	= array('pegdtKategori' => 'Non-Academic', 'satkerpegSatkerId' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);
        $select 	= SELECT_LIST_PGW;

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_sdm->get_pegawai($select, $where);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak ditemukan list pegawai non-academic dengan kode satker tersebut'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}

	}

    private function set_where($kategori,$kode) {
		switch ($kategori) {
            case 'status'     : return array('pegStatrId' => $kode);
            case 'pangkat'    : return array('pktgolrId' => $kode);
            case 'fungsional' : return array('jabfungrId' => $kode);
    		default 		  : $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
    	}        
    }

}
