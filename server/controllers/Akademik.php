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
class Akademik extends REST_Controller {

    function __construct() {
        parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model(array('Model_akademik'));

    }	

    public function index_get() {
    	echo "this resources will return general academic data";
	}

	public function mk_tugas_akhir_get() {
        $id = $this->get('nim');

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Model_akademik->cek_mk_ta($id);
       		if (!empty($data))
	        {
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Tidak kontrak MK Tugas Akhir pada semester aktif'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}
	}

	public function total_sks_get() {
        $id = $this->get('nim');

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Model_akademik->total_sks($id);
       		if (!empty($data))
	        {
	        	$data += $this->Model_akademik->total_sks_lulus($id);
	            $this->set_response($data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
	        }
	        else
	        {
	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'Data could not be found'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
	        }
		}
	}

}
