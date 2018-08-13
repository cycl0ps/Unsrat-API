<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pegawai extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('akademika_sdm', TRUE);
	}

	public function get_pegawai($condition = FALSE) {

	}

	public function detail_pegawai($nip) {

	}



}
