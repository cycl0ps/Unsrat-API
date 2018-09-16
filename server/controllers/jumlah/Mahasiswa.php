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
	
        $id 		= $this->get('id');
        $groupby	= $this->get('by');
        $status     = $this->get('status');
        $where      = array('fakKode' => $id);

        if ($status != NULL) {
            switch ($status) {
                case 'A'    : $status = array('mhsStakmhsrKode' => 'A');break;
                case 'C'    : $status = array('mhsStakmhsrKode' => 'C');break;
                case 'D'    : $status = array('mhsStakmhsrKode' => 'D');break;
                case 'K'    : $status = array('mhsStakmhsrKode' => 'K');break;
                case 'L'    : $status = array('mhsStakmhsrKode' => 'L');break;
                case 'N'    : $status = array('mhsStakmhsrKode' => 'N');break;
                case 'P'    : $status = array('mhsStakmhsrKode' => 'P');break;
                default     : $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
            $where += $status;
        }

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having = FALSE;
        	switch ($groupby) {
        		case 'jalurmasuk' :	$select  = "s_jalur_ref.jllrNama AS mhsJalurMasuk, COUNT(*) AS jumlah";
        							$groupby = "mahasiswa.mhsJlrrKode";
                                    $having  = "mhsJalurMasuk != 'Lain-Lain'";
        							break;
        		case 'status' 	  :	$select  = "status_aktif_mahasiswa_ref.stakmhsrNama AS mhsStatus, COUNT(*) AS jumlah";
        							$groupby = "mahasiswa.mhsStakmhsrKode";
        							break;
        		case 'angkatan'   :	$select  = "mhsAngkatan, COUNT(*) AS jumlah";
        							$groupby = "mahasiswa.mhsAngkatan";
                                    $having  = "mhsAngkatan >= 2000";
        							break;
        		case 'sumberdana' :	$select  = "sbdnNama AS mhsSumberDana, COUNT(*) AS jumlah";
        							$groupby = "mahasiswa.mhsSbdnrId";
                                    $having  = "mhsSumberDana != ". NULL;
        							break;
                case 'gender'     : $select  = "mhsJenisKelamin AS mhsGender, COUNT(*) AS jumlah";
                                    $groupby = "mhsJenisKelamin";
                                    $having  = "mhsGender != ". NULL;
                                    break;                    
        		case 'jurusan'    :	$select  = "jurNamaResmi AS mhsJurusan, COUNT(*) AS jumlah";
        							$groupby = "jurusan.jurKode";
        							break;
        		case 'prodi'      :	$select  = "CONCAT(prodiNamaResmi, ' ', prodiNamaJenjang) AS mhsProdi, COUNT(*) AS jumlah";
        							$groupby = "program_studi.prodiKode";
        							break;																	
        		default 		  : $select  = "COUNT(*) AS jumlahMahasiswa";
        							$groupby = "fakultas.fakKode";
        							break;	
        	}

        	$data = $this->Akademika_sia->list_mahasiswa($select, $where, $groupby, $having); 

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
	
        $id 		= $this->get('id');
        $groupby	= $this->get('by');
        $status     = $this->get('status');
        $where      = array('jurKode' => $id);

        if ($status != NULL) {
            switch ($status) {
                case 'A'    : $status = array('mhsStakmhsrKode' => 'A');break;
                case 'C'    : $status = array('mhsStakmhsrKode' => 'C');break;
                case 'D'    : $status = array('mhsStakmhsrKode' => 'D');break;
                case 'K'    : $status = array('mhsStakmhsrKode' => 'K');break;
                case 'L'    : $status = array('mhsStakmhsrKode' => 'L');break;
                case 'N'    : $status = array('mhsStakmhsrKode' => 'N');break;
                case 'P'    : $status = array('mhsStakmhsrKode' => 'P');break;
                default     : $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
            $where += $status;
        }        

        if ($id === NULL)
        {
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
        	switch ($groupby) {
        		case 'jalurmasuk' :	$select  = "s_jalur_ref.jllrNama AS mhsJalurMasuk, COUNT(*) AS jumlah";
        							$groupby = "mahasiswa.mhsJlrrKode";
        							break;
        		case 'status' 	  :	$select  = "status_aktif_mahasiswa_ref.stakmhsrNama AS mhsStatus, COUNT(*) AS jumlah";
        							$groupby = "mahasiswa.mhsStakmhsrKode";
        							break;
        		case 'angkatan'   :	$select  = "mhsAngkatan, COUNT(*) AS jumlah";
        							$groupby = "mahasiswa.mhsAngkatan";
                                    $having  = "mhsAngkatan >= 2000";
        							break;
        		case 'sumberdana' :	$select  = "sbdnNama AS mhsSumberDana, COUNT(*) AS jumlah";
        							$groupby = "mahasiswa.mhsSbdnrId";
                                    $having  = "mhsSumberDana != ". NULL;
        							break;
                case 'gender'     : $select  = "mhsJenisKelamin AS mhsGender, COUNT(*) AS jumlah";
                                    $groupby = "mhsJenisKelamin";
                                    $having  = "mhsGender != ". NULL;
                                    break;                                     
        		case 'prodi'      :	$select  = "CONCAT(prodiNamaResmi, ' ', prodiNamaJenjang) AS mhsProdi, COUNT(*) AS jumlah";
        							$groupby = "program_studi.prodiKode";
        							break;																	
        		default 		  : $select  = "COUNT(*) AS jumlahMahasiswa";
        							$groupby = "jurusan.jurKode";
        							break;	
        	}

        	$data = $this->Akademika_sia->list_mahasiswa($select, $where, $groupby, $having); 

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
    
        $id         = $this->get('id');
        $groupby    = $this->get('by');
        $status     = $this->get('status');
        $where      = array('prodiKode' => $id);

        if ($status != NULL) {
            switch ($status) {
                case 'A'    : $status = array('mhsStakmhsrKode' => 'A');break;
                case 'C'    : $status = array('mhsStakmhsrKode' => 'C');break;
                case 'D'    : $status = array('mhsStakmhsrKode' => 'D');break;
                case 'K'    : $status = array('mhsStakmhsrKode' => 'K');break;
                case 'L'    : $status = array('mhsStakmhsrKode' => 'L');break;
                case 'N'    : $status = array('mhsStakmhsrKode' => 'N');break;
                case 'P'    : $status = array('mhsStakmhsrKode' => 'P');break;
                default     : $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            
            $where += $status;
        }

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'jalurmasuk' : $select  = "s_jalur_ref.jllrNama AS mhsJalurMasuk, COUNT(*) AS jumlah";
                                    $groupby = "mahasiswa.mhsJlrrKode";
                                    break;
                case 'status'     : $select  = "status_aktif_mahasiswa_ref.stakmhsrNama AS mhsStatus, COUNT(*) AS jumlah";
                                    $groupby = "mahasiswa.mhsStakmhsrKode";
                                    break;
                case 'angkatan'   : $select  = "mhsAngkatan, COUNT(*) AS jumlah";
                                    $groupby = "mahasiswa.mhsAngkatan";
                                    $having  = "mhsAngkatan >= 2000";
                                    break;
                case 'sumberdana' : $select  = "sbdnNama AS mhsSumberDana, COUNT(*) AS jumlah";
                                    $groupby = "mahasiswa.mhsSbdnrId";
                                    $having  = "mhsSumberDana != ". NULL;
                                    break;
                case 'gender'     : $select  = "mhsJenisKelamin AS mhsGender, COUNT(*) AS jumlah";
                                    $groupby = "mhsJenisKelamin";
                                    $having  = "mhsGender != ". NULL;
                                    break;                                                                                                 
                default           : $select  = "COUNT(*) AS jumlahMahasiswa";
                                    $groupby = "program_studi.prodiKode";
                                    break;  
            }

            $data = $this->Akademika_sia->list_mahasiswa($select, $where, $groupby, $having); 

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
