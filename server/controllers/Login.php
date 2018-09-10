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
class Login extends REST_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model(array('Akademika_portal'));

    }	

	public function dosen_get() {
        $username = $this->get('user');
        $password = $this->get('pass');


        if ($username === NULL OR $password === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_portal->get_login_dosen($username,$password);
            if (!empty($data))
            {
                $this->set_response([
                    'status' => TRUE,
                    'message' => 'Authentication success!'
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Authentication failed!'
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
		}
	}

	public function mahasiswa_get() {
        $username = $this->get('user');
        $password = $this->get('pass');


        if ($username === NULL OR $password === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
        	$data = $this->Akademika_portal->get_login_mahasiswa($username,$password);
            if (!empty($data))
            {
                $this->set_response([
                    'status' => TRUE,
                    'message' => 'Authentication success!'
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Authentication failed!'
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
		}
	}	


}
