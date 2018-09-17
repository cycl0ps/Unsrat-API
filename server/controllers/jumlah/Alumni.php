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
class Alumni extends REST_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model(array('Akademika_sia'));

    }

	public function fakultas_get() {
	
        $id 		= $this->get('kode');
        $groupby	= $this->get('groupby');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('fakKode' => $id,'mhsStakmhsrKode' => 'L');

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
        	switch ($groupby) {
        		case 'tahun'     :	$select  = "year(mhsTanggalLulus) AS alumniTahun, COUNT(*) AS jumlah";
        							$groupby = "year(mhsTanggalLulus)";
                                    $having  = "alumniTahun >= 2000";
        							break;
        		case 'wisudaprd'  :	$select  = "CONCAT(wsdTahun, '-', wsdPwsdrId) AS alumniTahunPeriod, COUNT(*) AS jumlah";
                                    $groupby = "wsdTahun, wsdPwsdrId";
                                    $having  = "alumniTahunPeriod != ". NULL;
                                    break;;
        		case 'angkatan'   :	$select  = "mhsAngkatan AS alumniAngkatan, COUNT(*) AS jumlah";
        							$groupby = "mhsAngkatan";
                                    $having  = "alumniAngkatan >= 2000";
        							break;
        		case 'jurusan'    :	$select  = "jurKode AS kode, jurNamaResmi AS alumniJurusan, COUNT(*) AS jumlah";
        							$groupby = "jurKode";
        							break;
        		case 'prodi'      :	$select  = "prodiKode as Kode, CONCAT(prodiNamaResmi, ' ', prodiNamaJenjang) AS alumniProdi, COUNT(*) AS jumlah";
        							$groupby = "prodiKode";
        							break;																	
        		default 		  : $select  = "fakKode AS kode, COUNT(*) AS jumlahAlumni";
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
        $groupby	= $this->get('groupby');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('jurKode' => $id,'mhsStakmhsrKode' => 'L');

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
        	switch ($groupby) {
                case 'tahun'     :  $select  = "year(mahasiswa.mhsTanggalLulus) AS alumniTahun, COUNT(*) AS jumlah";
                                    $groupby = "year(mahasiswa.mhsTanggalLulus)";
                                    $having  = "alumniTahun >= 2000";
                                    break;
                case 'wisudaprd'  : $select  = "CONCAT(wsdTahun, '-', wsdPwsdrId) AS alumniTahunPeriod, COUNT(*) AS jumlah";
                                    $groupby = "wsdTahun, wsdPwsdrId";
                                    $having  = "alumniTahunPeriod != ". NULL;
                                    break;;
                case 'angkatan'   : $select  = "mhsAngkatan AS alumniAngkatan, COUNT(*) AS jumlah";
                                    $groupby = "mhsAngkatan";
                                    $having  = "alumniAngkatan >= 2000";
                                    break;
                case 'prodi'      : $select  = "prodiKode AS kode, CONCAT(prodiNamaResmi, ' ', prodiNamaJenjang) AS alumniProdi, COUNT(*) AS jumlah";
                                    $groupby = "prodiKode";
                                    break;                                                                  
                default           : $select  = "jurKode AS kode, COUNT(*) AS jumlahAlumni";
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
        $where      = array('prodiKode' => $id,'mhsStakmhsrKode' => 'L');

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'tahun'     :  $select  = "year(mahasiswa.mhsTanggalLulus) AS alumniTahun, COUNT(*) AS jumlah";
                                    $groupby = "year(mahasiswa.mhsTanggalLulus)";
                                    $having  = "alumniTahun >= 2000";
                                    break;
                case 'wisudaprd'  : $select  = "CONCAT(wsdTahun, '-', wsdPwsdrId) AS alumniTahunPeriod, COUNT(*) AS jumlah";
                                    $groupby = "s_wisuda.wsdTahun,s_wisuda.wsdPwsdrId";
                                    $having  = "alumniTahunPeriod != ". NULL;
                                    break;
                case 'angkatan'   : $select  = "mhsAngkatan AS alumniAngkatan, COUNT(*) AS jumlah";
                                    $groupby = "mhsAngkatan";
                                    $having  = "alumniAngkatan >= 2000";
                                    break;                                                          
                default           : $select  = "prodiKode AS kode, COUNT(*) AS jumlahAlumni";
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

    } 

}
