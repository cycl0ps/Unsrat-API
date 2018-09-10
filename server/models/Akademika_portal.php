<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akademika_portal extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->dbPortal = $this->load->database('akademika_portal', TRUE);
	}

	function get_login_mahasiswa($username, $password) {

		$this->dbPortal->where('tusrNama', $username);
		$this->dbPortal->where('tusrPassword', md5($password));
		$this->dbPortal->where('tusrThakrId', 1);
		$query = $this->dbPortal->get('t_user');
		$result = $query->row_array();
		//echo $this->dbPortal->last_query(); die;
		
		return $result;
	}

	function get_login_dosen($username, $password) {

		$this->dbPortal->where('tusrNama', $username);
		$this->dbPortal->where('tusrPassword', md5($password));
		$this->dbPortal->where('tusrThakrId', 2);
		$query = $this->dbPortal->get('t_user');
		$result = $query->row_array();
		//echo $this->dbPortal->last_query(); die;
		
		return $result;
	}

    private function debugSql() {
		
		echo $this->dbPortal->last_query(); die;
		//$this->dbSdm->select("dsnPegNip as NIP, CONCAT(COALESCE(pegGelarDepan,''),pegNama,', ',COALESCE(pegGelarBelakang,'')) as Nama",FALSE);
    }		


}
