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
class Gabung extends REST_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model(array('Akademika_sia'));

    }

    public function mhs_alumni_get() {

        $fakKode    = $this->get('fakultas');
        $jurKode    = $this->get('jurusan');
        $prodiKode  = $this->get('prodi');

        if (isset($fakKode)) {
            $where  = array('fakKode' => $fakKode);
        } else if (isset($jurKode)) {
            $where  = array('jurKode' => $jurKode);

        } else if (isset($prodiKode)) {
            $where  = array('prodiKode' => $prodiKode);
        } else {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        $select1    = "mhsAngkatan AS tahun, COUNT(*) AS mahasiswa";
        $where1     = $where + array('mhsAngkatan >=' => 2000);
        $groupby1   = "mhsAngkatan";

        $data1 = $this->Akademika_sia->get_mahasiswa($select1, $where1, $groupby1);
        $data = [];

        foreach ($data1 AS $key => $value) {
            $select2            = "year(mhsTanggalLulus) AS tahun, COUNT(*) AS alumni";
            $where2             = $where + array('year(mhsTanggalLulus)' => $value['tahun']);
            $value['alumni']    = $this->Akademika_sia->get_mahasiswa($select2, $where2)[0]['alumni'];
            $data[$key]         = $value;
        }

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
