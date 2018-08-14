<?php
class Model_dosen extends CI_Model {

	private $shortListDsn = "pegKodeResmi AS nip, 
							pegId AS kodePegawai,
							pegKodeLain AS nidn,
							pegNama AS nama,
							pegFoto AS foto,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,";

	private $longListDsn = "pegKodeResmi AS nip, 
							pegId AS kodePegawai,
							pegKodeLain AS nidn,
							pegNama AS nama,
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
							pegHobby AS hobi,
							statrPegawai AS statusPegawai,
							pegThnSer AS tahunSerdos,
							jabfungrNama AS jabatanFungsional,
							CONCAT(pktgolrId,' - ',pktgolrNama) AS pangkatGolongan,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,";					
	
	public function __construct() {
		parent::__construct();
		$this->dbSdm = $this->load->database('akademika_sdm', TRUE);
	}
	
	public function list_dosen($condition = FALSE) {

		$this->dbSdm->select($this->shortListDsn);
		if ($condition) $this->dbSdm->where($condition);
		$this->dbSdm->join('Akademika_sia.dosen', 'Akademika_sia.dosen.dsnPegNip = Akademika_sdm.pub_pegawai.pegKodeResmi');
    	$this->dbSdm->join('Akademika_sia.program_studi', 'Akademika_sia.program_studi.prodiKode = Akademika_sia.dosen.dsnProdiKode');
		$this->dbSdm->join('Akademika_sia.jurusan', 'Akademika_sia.jurusan.jurKode = Akademika_sia.program_studi.prodiJurKode');
		$this->dbSdm->join('Akademika_sia.fakultas', 'Akademika_sia.fakultas.fakKode = Akademika_sia.program_studi.prodiFakKode');
		$this->dbSdm->join('sdm_pegawai_detail', 'sdm_pegawai_detail.pegdtPegId = pub_pegawai.pegId');
		$this->dbSdm->where('sdm_pegawai_detail.pegdtKategori','Academic');
		$query = $this->dbSdm->get('pub_pegawai');
		$result = $query->result_array();
		//$this->debugSql();
		
		return $result;
	}    

    public function detail_dosen($nip) {
    	
    	$this->dbSdm->select($this->longListDsn);
		$this->dbSdm->join('Akademika_sia.dosen', 'Akademika_sia.dosen.dsnPegNip = pub_pegawai.pegKodeResmi');
    	$this->dbSdm->join('Akademika_sia.program_studi', 'Akademika_sia.program_studi.prodiKode = Akademika_sia.dosen.dsnProdiKode');
		$this->dbSdm->join('Akademika_sia.jurusan', 'Akademika_sia.jurusan.jurKode = Akademika_sia.program_studi.prodiJurKode');
		$this->dbSdm->join('Akademika_sia.fakultas', 'Akademika_sia.fakultas.fakKode = Akademika_sia.program_studi.prodiFakKode');
		$this->dbSdm->join('sdm_pegawai_detail', 'sdm_pegawai_detail.pegdtPegId = pub_pegawai.pegId');
		$this->dbSdm->join("(SELECT jbtnPegKode, jbtnJabfungrId FROM sdm_jabatan_fungsional WHERE jbtnStatus = 'Aktif') a", "a.jbtnPegKode = pub_pegawai.pegId");
		$this->dbSdm->join('pub_ref_jabatan_fungsional', 'pub_ref_jabatan_fungsional.jabfungrId = a.jbtnJabfungrId');
		$this->dbSdm->join("(SELECT pktgolPegKode, pktgolPktgolrId FROM sdm_pangkat_golongan WHERE pktgolStatus = 'Aktif') b", "b.pktgolPegKode = pub_pegawai.pegId");
		$this->dbSdm->join('sdm_ref_pangkat_golongan', 'sdm_ref_pangkat_golongan.pktgolrId = b.pktgolPktgolrId');
		$this->dbSdm->join('pub_ref_agama', 'pub_ref_agama.agmId = pub_pegawai.pegAgamaId','left');
		$this->dbSdm->join('pub_ref_status_nikah', 'pub_ref_status_nikah.statnkhId = pub_pegawai.pegStatnikahId','left');
		$this->dbSdm->join('sdm_ref_status_pegawai', 'sdm_ref_status_pegawai.statrId = pub_pegawai.pegStatrId');
		$this->dbSdm->where('sdm_pegawai_detail.pegdtKategori','Academic');
		$this->dbSdm->where('pub_pegawai.pegKodeResmi',$nip);
		$query = $this->dbSdm->get('pub_pegawai');
		$result = $query->row_array();
		//$this->debugSql();

		return $result;
	}	

    private function debugSql() {
		
		echo $this->dbSdm->last_query(); die;
		//$this->dbSdm->select("dsnPegNip as NIP, CONCAT(COALESCE(pegGelarDepan,''),pegNama,', ',COALESCE(pegGelarBelakang,'')) as Nama",FALSE);
    }
}