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
    
        $id         = $this->get('kode');
        $groupby    = $this->get('groupby');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('satkerpegSatkerId' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'status'	  : $select  = "statrPegawai AS status, COUNT(*) AS jumlah";
                					$groupby = "pegStatrId";
                					break;
                case 'kategori'   : $select  = "pegdtKategori AS kategori, COUNT(*) AS jumlah";
                        			$groupby = "pegdtKategori";
                     				break;                                            
                case 'jenis'      : $select  = "jnspegrNama AS jenis, COUNT(*) AS jumlah";
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
                default      	  : $select  = "COUNT(*) AS jumlah";
                    				$groupby = "satkerpegSatkerId";
                           			break;  
            }

            $data = $this->Akademika_sdm->get_pegawai($select, $where, $groupby, $having); 

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
	
        $id         = $this->get('kode');
        $groupby    = $this->get('groupby');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('pegdtKategori' => 'Academic', 'satkerpegSatkerId' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'status'     : $select  = "statrPegawai AS status, COUNT(*) AS jumlah";
                                    $groupby = "pegStatrId";
                                    break;
                case 'kategori'   : $select  = "pegdtKategori AS kategori, COUNT(*) AS jumlah";
                                    $groupby = "pegdtKategori";
                                    break;                                            
                case 'jenis'      : $select  = "jnspegrNama AS jenis, COUNT(*) AS jumlah";
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
                default           : $select  = "COUNT(*) AS jumlah";
                                    $groupby = "satkerpegSatkerId";
                                    break;  
            }

            $data = $this->Akademika_sdm->get_pegawai($select, $where, $groupby, $having); 

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
	
        $id         = $this->get('kode');
        $groupby    = $this->get('groupby');
        $condition  = $this->get('filter');
        $code       = $this->get('by');
        $where      = array('pegdtKategori' => 'Non-Academic', 'satkerpegSatkerId' => $id);

        if ($condition && $code) $where += $this->set_where($condition, $code);

        if ($id === NULL)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        } else {
            $having  = FALSE;
            switch ($groupby) {
                case 'status'     : $select  = "statrPegawai AS status, COUNT(*) AS jumlah";
                                    $groupby = "pegStatrId";
                                    break;
                case 'kategori'   : $select  = "pegdtKategori AS kategori, COUNT(*) AS jumlah";
                                    $groupby = "pegdtKategori";
                                    break;                                            
                case 'jenis'      : $select  = "jnspegrNama AS jenis, COUNT(*) AS jumlah";
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
                default           : $select  = "COUNT(*) AS jumlah";
                                    $groupby = "satkerpegSatkerId";
                                    break;  
            }

            $data = $this->Akademika_sdm->get_pegawai($select, $where, $groupby, $having);

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
        if ($kategori == "status") return array('pegStatrId' => $kode);
        else if ($kategori == "fungsional") return array('jabfungrId' => $kode);
        else if ($kategori == "pangkat") return array('pktgolrId' => $kode);
        
        else $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
    } 

}
