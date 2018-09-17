<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akademika_sdm extends CI_Model {					

	public function __construct() {
		parent::__construct();
		$this->dbSdm = $this->load->database('akademika_sdm', TRUE);
	}

	public function get_pegawai($select = FALSE, $condition = FALSE, $groupby = FALSE, $having = FALSE) {

		if ($select)	$this->dbSdm->select($select);
		if ($condition)	$this->dbSdm->where($condition);
		if ($groupby) 	$this->dbSdm->group_by($groupby);
		if ($having) 	$this->dbSdm->having($having);
    	
    	$this->dbSdm->join('sdm_pegawai_detail', 'sdm_pegawai_detail.pegdtPegId = pub_pegawai.pegId','left');
		$this->dbSdm->join('sdm_ref_status_pegawai', 'sdm_ref_status_pegawai.statrId = pub_pegawai.pegStatrId','left');
		$this->dbSdm->join('sdm_ref_jenis_pegawai', 'sdm_ref_jenis_pegawai.jnspegrId = pub_pegawai.pegJnspegrId','left');
		$this->dbSdm->join('pub_ref_agama', 'pub_ref_agama.agmId = pub_pegawai.pegAgamaId','left');
		$this->dbSdm->join('pub_ref_status_nikah', 'pub_ref_status_nikah.statnkhId = pub_pegawai.pegStatnikahId','left');		
		
		//join tabel satker pegawai
		$this->dbSdm->join("(SELECT satkerpegId, satkerpegPegId, satkerpegSatkerId FROM sdm_satuan_kerja_pegawai WHERE satkerpegAktif = 'Aktif' GROUP BY satkerpegPegId) c", "c.satkerpegPegId = pub_pegawai.pegId");
		$this->dbSdm->join('pub_satuan_kerja', 'pub_satuan_kerja.satkerId = c.satkerpegSatkerId','left');

		//join tabel jabatan fungsional.  
		$this->dbSdm->join("(SELECT jbtnPegKode, jbtnJabfungrId, jbtnTglMulai FROM sdm_jabatan_fungsional WHERE jbtnStatus = 'Aktif') a", "a.jbtnPegKode = pub_pegawai.pegId AND a.jbtnTglMulai = (SELECT MAX(a2.jbtnTglMulai) FROM sdm_jabatan_fungsional a2 WHERE a2.jbtnPegKode = pub_pegawai.pegId)", 'left');
		$this->dbSdm->join('pub_ref_jabatan_fungsional', 'pub_ref_jabatan_fungsional.jabfungrId = a.jbtnJabfungrId','left');
		
		//joint tabel golongan pangkat
		$this->dbSdm->join("(SELECT pktgolPegKode, pktgolPktgolrId, pktgolTmt FROM sdm_pangkat_golongan WHERE pktgolStatus = 'Aktif') b", "b.pktgolPegKode = pub_pegawai.pegId AND b.pktgolTmt = (SELECT MAX(b2.pktgolTmt) FROM sdm_pangkat_golongan b2 WHERE b2.pktgolPegKode = pub_pegawai.pegId )","left");
		$this->dbSdm->join('sdm_ref_pangkat_golongan', 'sdm_ref_pangkat_golongan.pktgolrId = b.pktgolPktgolrId','left');

		$query = $this->dbSdm->get('pub_pegawai');
		$result = $query->result_array();
		//$this->debugSql();
		return $result;
	}

	public function detail_pegawai($select = FALSE, $condition = FALSE) {

		if ($select)	$this->dbSdm->select($select);
		if ($condition)	$this->dbSdm->where($condition);		

    	$this->dbSdm->join('sdm_pegawai_detail', 'sdm_pegawai_detail.pegdtPegId = pub_pegawai.pegId','left');
		$this->dbSdm->join('sdm_ref_status_pegawai', 'sdm_ref_status_pegawai.statrId = pub_pegawai.pegStatrId','left');
		$this->dbSdm->join('sdm_ref_jenis_pegawai', 'sdm_ref_jenis_pegawai.jnspegrId = pub_pegawai.pegJnspegrId','left');
		$this->dbSdm->join('pub_ref_agama', 'pub_ref_agama.agmId = pub_pegawai.pegAgamaId','left');
		$this->dbSdm->join('pub_ref_status_nikah', 'pub_ref_status_nikah.statnkhId = pub_pegawai.pegStatnikahId','left');		
		
		//join tabel satker pegawai
		$this->dbSdm->join("(SELECT satkerpegId, satkerpegPegId, satkerpegSatkerId FROM sdm_satuan_kerja_pegawai WHERE satkerpegAktif = 'Aktif' GROUP BY satkerpegPegId) c", "c.satkerpegPegId = pub_pegawai.pegId");
		$this->dbSdm->join('pub_satuan_kerja', 'pub_satuan_kerja.satkerId = c.satkerpegSatkerId','left');

		//join tabel jabatan fungsional.  
		$this->dbSdm->join("(SELECT jbtnPegKode, jbtnJabfungrId, jbtnTglMulai FROM sdm_jabatan_fungsional WHERE jbtnStatus = 'Aktif') a", "a.jbtnPegKode = pub_pegawai.pegId AND a.jbtnTglMulai = (SELECT MAX(a2.jbtnTglMulai) FROM sdm_jabatan_fungsional a2 WHERE a2.jbtnPegKode = pub_pegawai.pegId)", 'left');
		$this->dbSdm->join('pub_ref_jabatan_fungsional', 'pub_ref_jabatan_fungsional.jabfungrId = a.jbtnJabfungrId','left');
		
		//joint tabel golongan pangkat
		$this->dbSdm->join("(SELECT pktgolPegKode, pktgolPktgolrId, pktgolTmt FROM sdm_pangkat_golongan WHERE pktgolStatus = 'Aktif') b", "b.pktgolPegKode = pub_pegawai.pegId AND b.pktgolTmt = (SELECT MAX(b2.pktgolTmt) FROM sdm_pangkat_golongan b2 WHERE b2.pktgolPegKode = pub_pegawai.pegId )","left");
		$this->dbSdm->join('sdm_ref_pangkat_golongan', 'sdm_ref_pangkat_golongan.pktgolrId = b.pktgolPktgolrId','left');

		$query = $this->dbSdm->get('pub_pegawai');
		$result = $query->row_array();
		//$this->debugSql();
		return $result;
	}

	public function get_pendidikan($nip) {
  	
    	$this->dbSdm->select( "pendNama AS jenjang, pddkInstitusi AS pt, pddkJurusan AS bidangIlmu, pddkThnLulus AS tahunLulus, pddkTempat AS lokasi,");
    	$this->dbSdm->order_by('pddkThnLulus DESC');
		$this->dbSdm->join('pub_pegawai', 'pub_pegawai.pegId = sdm_pendidikan.pddkPegKode');
		$this->dbSdm->join('pub_ref_pendidikan', 'pub_ref_pendidikan.pendId = sdm_pendidikan.pddkTkpddkrId');
		$this->dbSdm->join('pub_ref_pendidikan_kelompok', 'pub_ref_pendidikan_kelompok.pendkelId = pub_ref_pendidikan.pendPendkelId','left');
		$this->dbSdm->where('pub_pegawai.pegKodeResmi',$nip);
		$query = $this->dbSdm->get('sdm_pendidikan');
		$result = $query->result_array();
		//$this->debugSql();
		return $result;
	}

	public function get_table($table, $select = FALSE, $condition = FALSE) {

		if ($select) $this->dbSdm->select($select);
		if ($condition) $this->dbSdm->where($condition);
		$query = $this->dbSdm->get($table);
		$result = $query->result_array();
		//$this->debugSql();
		return $result;
	}			

    private function debugSql() {
		
		echo $this->dbSdm->last_query(); die;
    }	



}
