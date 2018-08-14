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
				    `mhsSksTranskrip` AS `sksTotal`,
				    ROUND(mhsIpkTranskrip, 2) AS ipk
				FROM
				    `mahasiswa`
				WHERE
				    `mhsNiu` = '$nim'";
		
		$result = $this->dbSia->query($sql);
		//$this->debugSql();
		return $result->row_array();
	}

	public function total_sks_lulus($nim){

		$sql = "SELECT
				    SUM(krsdtSksMatakuliah) AS sksLulus
				FROM
				    (SELECT
				        *
				    	FROM
				        s_krs
				    JOIN s_krs_detil ON s_krs_detil.krsdtKrsId = s_krs.krsId
				    JOIN s_matakuliah_kurikulum ON s_matakuliah_kurikulum.mkkurId = s_krs_detil.krsdtMkkurId
				    WHERE
				        krsMhsNiu = '$nim' AND krsdtKodeNilai IN('A', 'B+', 'B', 'C+', 'C')
				    GROUP BY
				        krsdtMkkurId
				) temp";
		
		$result = $this->dbSia->query($sql);
		//$this->debugSql();
		return $result->row_array();
	}	

	//Model function untuk mengecek apakah sudah mengontrak mata kuliah Tugas Akhir
	public function cek_mk_ta($nim) {

		$sql = "SELECT
				    krsMhsNiu AS nim,
				    sempSemId AS semKontrak,
				    mkkurKode AS kodeMK,
				    mkkurNamaResmi AS namaMK,
				    IF(
				        krsApprovalKe != '0',
				        'Sudah',
				        'Belum'
				    ) AS 'approve'
				FROM
				    s_krs
				JOIN s_krs_detil ON s_krs_detil.krsdtKrsId = s_krs.krsId
				JOIN s_matakuliah_kurikulum ON s_matakuliah_kurikulum.mkkurId = s_krs_detil.krsdtMkkurId
				JOIN s_kelas ON s_kelas.klsId = s_krs_detil.krsdtKlsId
				JOIN s_semester_prodi ON s_semester_prodi.sempId = s_krs.krsSempId
				WHERE
				    krsMhsNiu = '$nim' AND sempIsAktif = '1' AND krsdtIsBatal = '0' AND klsIsBatal = '0' AND mkkurNamaResmi REGEXP 'TESIS|Tugas Akhir|THESIS|SKRIPSI|KOMPREHENSIF'";
		
		$result = $this->dbSia->query($sql);
		//$this->debugSql();
		return $result->row_array();
	}

    private function debugSql() {
		
		echo $this->dbSia->last_query(); die;
    }	

}