<?php
class Model_akademik extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->dbSia = $this->load->database('akademika_sia', TRUE);
	}	

	//Model function untuk mengambil data total sks dan IPK dari mahasiswa $nim
	public function total_sks($nim){

		$sql = "SELECT
				    `mhsNiu` AS 'nim',
				    `mhsSksTranskrip` AS `sks_total`,
				    ROUND(mhsIpkTranskrip, 2) AS ipk
				FROM
				    `mahasiswa`
				WHERE
				    `mhsNiu` = '$nim'";
		
		$result = $this->dbSia->query($sql);
		//$this->debug();
		return $result->row_array();
	}

	//Model function untuk mengecek apakah sudah mengontrak mata kuliah Tugas Akhir
	public function cek_mk_ta($nim) {

		$sql = "SELECT
				    b.krsMhsNiu AS nim,
				    d.sempSemId,
				    c.mkkurKode,
				    c.mkkurNamaResmi,
				    SUM(a.krsdtSksMatakuliah) AS 'sks_kontrak',
				    IF(
				        b.krsApprovalKe != '0',
				        'Sudah',
				        'Belum'
				    ) AS 'approve'
				FROM
				    akademika_sia.s_krs_detil a
				LEFT JOIN akademika_sia.s_krs b ON b.krsId = a.krsdtKrsId
				LEFT JOIN akademika_sia.s_matakuliah_kurikulum c ON c.mkkurId = a.krsdtMkkurId
				LEFT JOIN akademika_sia.s_semester_prodi d ON d.sempId = b.krsSempId
				LEFT JOIN akademika_sia.s_kelas e ON e.klsId = a.krsdtKlsId
				WHERE
					b.krsMhsNiu = '$nim' AND d.sempIsAktif = '1' AND a.krsdtIsBatal = '0' AND e.klsIsBatal = '0' 
					AND (
				        c.mkkurNamaResmi LIKE '%TESIS%' OR c.mkkurNamaResmi LIKE 'Tugas%Akhir%' OR c.mkkurNamaResmi LIKE 'THESIS%' OR c.mkkurNamaResmi LIKE '%SKRIPSI%' OR c.mkkurNamaResmi LIKE 'KOMPREHENSIF%'
				    )";
		
		$result = $this->dbSia->query($sql);
		//$this->debug();
		return $result->row_array();
	}

    private function debug() {
		
		echo $this->dbSia->last_query(); die;
		//$this->db->select("dsnPegNip as NIP, CONCAT(COALESCE(pegGelarDepan,''),pegNama,', ',COALESCE(pegGelarBelakang,'')) as Nama",FALSE);
    }
}