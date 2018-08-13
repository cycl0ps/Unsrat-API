<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	function akademika_portal($username, $password) {
		
		$this->dbPortal = $this->load->database('akademika_portal', TRUE);
		$this->dbPortal->where('tusrNama', $username);
		$this->dbPortal->where('tusrPassword', md5($password));
		$query = $this->dbPortal->get('t_user');
		$result = $query->row_array();
		//echo $this->dbPortal->last_query(); die;
		
		return $result;
	}


}
