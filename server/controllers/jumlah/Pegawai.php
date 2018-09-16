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

    public function satker_get() {
    
        $id         = $this->get('id');
        $groupby    = $this->get('by');
        $where      = array('satkerpegId' => $id);

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'status'	  : $select  = "statrPegawai AS statusPegawai, COUNT(*) AS jumlah";
                					$groupby = "pegStatrId";
                					break;
                case 'kategori'   : $select  = "pegdtKategori AS kategoriPegawai, COUNT(*) AS jumlah";
                        			$groupby = "pegdtKategori";
                     				break;                                            
                case 'jenis'      : $select  = "jnspegrNama AS jenisPegawai, COUNT(*) AS jumlah";
              						$groupby = "pegJnspegrId";
                            		break;
                case 'gender'     : $select  = "pegKelamin AS gender, COUNT(*) AS jumlah";
              						$groupby = "pegKelamin";
                            		break;
                case 'nikah'      : $select  = "statnkhNama AS statusNikah, COUNT(*) AS jumlah";
              						$groupby = "statnkhNama";
                            		break;
                case 'pangkat'    : $select  = "CONCAT(pktgolrId,' - ',pktgolrNama) AS pangkatGolongan, COUNT(*) AS jumlah";
              						$groupby = "pktgolrId";
                            		break;
                case 'fungsional' : $select  = "jabfungrNama AS jabatanFungsional, COUNT(*) AS jumlah";
              						$groupby = "jabfungrId";
                            		break;                         		
                default      	  : $select  = "COUNT(*) AS jumlahPegawai";
                    				$groupby = "satkerpegSatkerId";
                           			break;  
            }

            $data = $this->Akademika_sdm->list_pegawai($select, $where, $groupby, $having); 

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

	public function academic_get() {
	
        $id         = $this->get('satker');
        $groupby    = $this->get('by');
        $where      = array('pegdtKategori' => 'Academic', 'satkerpegSatkerId' => $id);

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'status'	  : $select  = "statrPegawai AS statusPegawai, COUNT(*) AS jumlah";
                					$groupby = "pub_pegawai.pegStatrId";
                					break;
                case 'kategori'   : $select  = "pegdtKategori AS kategoriPegawai, COUNT(*) AS jumlah";
                        			$groupby = "pegdtKategori";
                     				break;                                            
                case 'jenis'      : $select  = "jnspegrNama AS jenisPegawai, COUNT(*) AS jumlah";
              						$groupby = "pub_pegawai.pegJnspegrId";
                            		break;
                case 'gender'     : $select  = "pegKelamin AS gender, COUNT(*) AS jumlah";
              						$groupby = "pegKelamin";
                            		break;
                case 'nikah'      : $select  = "statnkhNama AS statusNikah, COUNT(*) AS jumlah";
              						$groupby = "statnkhNama";
                            		break;
                case 'pangkat'    : $select  = "CONCAT(pktgolrId,' - ',pktgolrNama) AS pangkatGolongan, COUNT(*) AS jumlah";
              						$groupby = "pktgolrId";
                            		break;
                case 'fungsional' : $select  = "jabfungrNama AS jabatanFungsional, COUNT(*) AS jumlah";
              						$groupby = "jabfungrId";
                            		break;                         		
                default      	  : $select  = "COUNT(*) AS jumlahPegawaiAcademic";
                    				$groupby = "satkerpegSatkerId";
                           			break;  
            }

            $data = $this->Akademika_sdm->list_pegawai($select, $where, $groupby, $having); 

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

	public function non_academic_get() {
	
        $id         = $this->get('satker');
        $groupby    = $this->get('by');
        $where      = array('pegdtKategori' => 'Non-Academic', 'satkerpegSatkerId' => $id);

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'status'	  : $select  = "statrPegawai AS statusPegawai, COUNT(*) AS jumlah";
                					$groupby = "pub_pegawai.pegStatrId";
                					break;
                case 'kategori'   : $select  = "pegdtKategori AS kategoriPegawai, COUNT(*) AS jumlah";
                        			$groupby = "pegdtKategori";
                     				break;                                            
                case 'jenis'      : $select  = "jnspegrNama AS jenisPegawai, COUNT(*) AS jumlah";
              						$groupby = "pub_pegawai.pegJnspegrId";
                            		break;
                case 'gender'     : $select  = "pegKelamin AS gender, COUNT(*) AS jumlah";
              						$groupby = "pegKelamin";
                            		break;
                case 'nikah'      : $select  = "statnkhNama AS statusNikah, COUNT(*) AS jumlah";
              						$groupby = "statnkhNama";
                            		break;
                case 'pangkat'    : $select  = "CONCAT(pktgolrId,' - ',pktgolrNama) AS pangkatGolongan, COUNT(*) AS jumlah";
              						$groupby = "pktgolrId";
                            		break;
                case 'fungsional' : $select  = "jabfungrNama AS jabatanFungsional, COUNT(*) AS jumlah";
              						$groupby = "jabfungrId";
                            		break;                         		
                default      	  : $select  = "COUNT(*) AS jumlahPegawaiAcademic";
                    				$groupby = "satkerpegSatkerId";
                           			break;  
            }

            $data = $this->Akademika_sdm->list_pegawai($select, $where, $groupby, $having);

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


}
