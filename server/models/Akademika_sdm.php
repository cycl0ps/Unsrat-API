<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akademika_sdm extends CI_Model {					

	public function __construct() {
		parent::__construct();
		$this->dbSdm = $this->load->database('akademika_sdm', TRUE);
	}

	public function list_pegawai($condition = FALSE) {

		$shortListPeg = "pegKodeResmi AS nip, 
							pegId AS kodePegawai,
							CONCAT_WS(' ', NULLIF(pegGelarDepan,''), pegNama, NULLIF(pegGelarBelakang,'')) AS nama,
							pegFoto AS foto,
							statrPegawai AS statusPegawai,
							pegdtKategori AS kategoriPegawai,
							jnspegrNama AS jenisPegawai,";		

		$this->dbSdm->select($shortListPeg);
		if ($condition) $this->dbSdm->where($condition);
    	$this->dbSdm->join('sdm_pegawai_detail', 'sdm_pegawai_detail.pegdtPegId = pub_pegawai.pegId','left');
		$this->dbSdm->join('sdm_ref_status_pegawai', 'sdm_ref_status_pegawai.statrId = pub_pegawai.pegStatrId','left');
		$this->dbSdm->join('sdm_ref_jenis_pegawai', 'sdm_ref_jenis_pegawai.jnspegrId = pub_pegawai.pegJnspegrId','left');
		$this->dbSdm->join("(SELECT satkerpegId, satkerpegPegId, satkerpegSatkerId FROM sdm_satuan_kerja_pegawai WHERE satkerpegAktif = 'Aktif' GROUP BY satkerpegPegId) c", "c.satkerpegPegId = pub_pegawai.pegId");

		$query = $this->dbSdm->get('pub_pegawai');
		$result = $query->result_array();
		//$this->debugSql();
		
		return $result;
	}

	public function detail_pegawai($nip) {

		$longListPeg = "pegKodeResmi AS nip, 
							pegId AS kodePegawai,
							CONCAT_WS(' ', NULLIF(pegGelarDepan,''), pegNama, NULLIF(pegGelarBelakang,'')) AS nama,
							pegKodeLain AS nidn,
							pegFoto AS foto,
							pegTglLahir AS tanggalLahir,
							pegTmpLahir AS tempatLahir,
							CONCAT(pegAlamat,' ',pegDesaRumah,' - ',pegKecRumah,' - ',pegKotaRumah,' - ',pegProvinsiRumah) AS alamat,
							pegKelamin AS jenisKelamin,
							agmNama AS agama,
							statnkhNama AS statusNikah,
							pegNoHp AS noHp,
							pegEmail AS email,
							pegFoto AS foto,
							jabfungrNama AS jabatanFungsional,
							CONCAT(pktgolrId,' - ',pktgolrNama) AS pangkatGolongan,
							pegThnSer AS tahunSerdos,
							pegNoKarpeg AS noKarpeg,
							statrPegawai AS statusPegawai,
							pegdtKategori AS kategoriPegawai,
							jnspegrNama AS jenisPegawai,
							satkerNama AS satuanKerja,";		

		$this->dbSdm->select($longListPeg);
		$this->dbSdm->where('pub_pegawai.pegKodeResmi',$nip);;
    	$this->dbSdm->join('sdm_pegawai_detail', 'sdm_pegawai_detail.pegdtPegId = pub_pegawai.pegId','left');
		$this->dbSdm->join('sdm_ref_status_pegawai', 'sdm_ref_status_pegawai.statrId = pub_pegawai.pegStatrId','left');
		$this->dbSdm->join('sdm_ref_jenis_pegawai', 'sdm_ref_jenis_pegawai.jnspegrId = pub_pegawai.pegJnspegrId','left');

		$this->dbSdm->join("(SELECT jbtnPegKode, jbtnJabfungrId FROM sdm_jabatan_fungsional WHERE jbtnStatus = 'Aktif') a", "a.jbtnPegKode = pub_pegawai.pegId");
		$this->dbSdm->join('pub_ref_jabatan_fungsional', 'pub_ref_jabatan_fungsional.jabfungrId = a.jbtnJabfungrId','left');
		$this->dbSdm->join("(SELECT pktgolPegKode, pktgolPktgolrId FROM sdm_pangkat_golongan WHERE pktgolStatus = 'Aktif') b", "b.pktgolPegKode = pub_pegawai.pegId");
		$this->dbSdm->join("(SELECT satkerpegId, satkerpegPegId, satkerpegSatkerId FROM sdm_satuan_kerja_pegawai WHERE satkerpegAktif = 'Aktif' GROUP BY satkerpegPegId) c", "c.satkerpegPegId = pub_pegawai.pegId");

		$this->dbSdm->join('sdm_ref_pangkat_golongan', 'sdm_ref_pangkat_golongan.pktgolrId = b.pktgolPktgolrId','left');
		$this->dbSdm->join('pub_ref_agama', 'pub_ref_agama.agmId = pub_pegawai.pegAgamaId','left');
		$this->dbSdm->join('pub_ref_status_nikah', 'pub_ref_status_nikah.statnkhId = pub_pegawai.pegStatnikahId','left');
		$this->dbSdm->join('pub_satuan_kerja', 'pub_satuan_kerja.satkerId = c.satkerpegSatkerId','left');	

		$query = $this->dbSdm->get('pub_pegawai');
		$result = $query->row_array();
		//$this->debugSql();
		
		return $result;		

	}

	public function get_pendidikan($nip) {

		$pendidikan = "pendNama AS jenjang, 
							pddkInstitusi AS pt, 
							pddkJurusan AS bidangIlmu , 
							pddkThnLulus AS tahunLulus, 
							pddkTempat AS lokasi,";			
    	
    	$this->dbSdm->select($pendidikan);
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
		//$this->dbSdm->select("dsnPegNip as NIP, CONCAT(COALESCE(pegGelarDepan,''),pegNama,', ',COALESCE(pegGelarBelakang,'')) as Nama",FALSE);
    }	



}
