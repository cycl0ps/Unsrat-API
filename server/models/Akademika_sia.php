<?php
class Akademika_sia extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->dbSia = $this->load->database('akademika_sia', TRUE);
	}

	public function list_dosen($condition = FALSE) {

		$shortListDsn = "dsnPegNip AS nip, 
							dsnNidn AS nidn,
							CONCAT_WS(' ', NULLIF(pegGelarDepan,''), pegNama, NULLIF(pegGelarBelakang,'')) AS nama,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,
							sikjNama AS statusIkatanKerja,
							sadrNama AS statusAktifitas,
							stpegrNama AS statusPegawai,
							jnpegrNama AS jenisPegawai";		

		$this->dbSia->select($shortListDsn);
		if ($condition) $this->dbSia->where($condition);
		$this->dbSia->join('pegawai', 'pegawai.pegNip = dosen.dsnPegNip');
    	$this->dbSia->join('program_studi', 'program_studi.prodiKode = dosen.dsnProdiKode','left');
		$this->dbSia->join('jurusan', 'jurusan.jurKode = program_studi.prodiJurKode','left');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode','left');
		$this->dbSia->join('pg_status_ikatan_kerja_dosen', 'pg_status_ikatan_kerja_dosen.sikjKode = dosen.dsnSikjKode','left');
		$this->dbSia->join('pg_status_aktivitas_dosen_ref', 'pg_status_aktivitas_dosen_ref.sadrKode = dosen.dsnSadrKode','left');
		$this->dbSia->join('pg_status_pegawai_ref', 'pg_status_pegawai_ref.stpegrId = pegawai.pegStpegrId','left');
		$this->dbSia->join('pg_jenis_pegawai_ref', 'pg_jenis_pegawai_ref.jnpegrId = pegawai.pegJnpegrId','left');
		$query = $this->dbSia->get('dosen');
		$result = $query->result_array();
		//$this->debugSql();
		
		return $result;
	}

    public function detail_dosen($nip) {

		$longListDsn = "dsnPegNip AS nip, 
							dsnNidn AS nidn,
							CONCAT_WS(' ', NULLIF(pegGelarDepan,''), pegNama, NULLIF(pegGelarBelakang,'')) AS nama,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,
							sikjNama AS statusIkatanKerja,
							sadrNama AS statusAktifitas,
							stpegrNama AS statusPegawai,
							jnpegrNama AS jenisPegawai,
							pegTanggalPengubahan AS lastUpdate"; 	
    	
    	$this->dbSia->select($longListDsn);
		$this->dbSia->join('pegawai', 'pegawai.pegNip = dosen.dsnPegNip');
    	$this->dbSia->join('program_studi', 'program_studi.prodiKode = dosen.dsnProdiKode','left');
		$this->dbSia->join('jurusan', 'jurusan.jurKode = program_studi.prodiJurKode','left');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode','left');
		$this->dbSia->join('pg_status_ikatan_kerja_dosen', 'pg_status_ikatan_kerja_dosen.sikjKode = dosen.dsnSikjKode','left');
		$this->dbSia->join('pg_status_aktivitas_dosen_ref', 'pg_status_aktivitas_dosen_ref.sadrKode = dosen.dsnSadrKode','left');
		$this->dbSia->join('pg_status_pegawai_ref', 'pg_status_pegawai_ref.stpegrId = pegawai.pegStpegrId','left');
		$this->dbSia->join('pg_jenis_pegawai_ref', 'pg_jenis_pegawai_ref.jnpegrId = pegawai.pegJnpegrId','left');
		$this->dbSia->where('dsnPegNip',$nip);
		$query = $this->dbSia->get('dosen');
		$result = $query->row_array();
		//$this->debugSql();

		return $result;
	}

	public function list_mahasiswa($condition = FALSE) {

		$shortListMhs = "mhsNiu AS nim,
							mhsNama AS nama,
							mhsFoto AS foto,
							mhsAngkatan AS angkatan,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,";		

		$this->dbSia->select($shortListMhs);
		if ($condition) $this->dbSia->where($condition);
		$this->dbSia->join('program_studi', 'mahasiswa.mhsProdiKode = program_studi.prodiKode');
		$this->dbSia->join('jurusan', 'program_studi.prodiJurKode = jurusan.jurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$query = $this->dbSia->get('mahasiswa');
		$result = $query->result_array();
		//$this->debugSql();

		foreach ($result as $key => $value) {
			if (!empty($result[$key]['foto'])) $result[$key]['foto'] = URL_FOTO_MHS.$result[$key]['foto'];
		}

		return $result;
	}

	public function detail_mahasiswa($nim) {

		$longListMhs = "mhsNiu AS nim, 
							mhsNama AS nama,
							mhsTanggalLahir AS tanggalLahir,
							mhsTempatLahirTranskrip AS tempatLahir,
							mhsAlamatMhs AS alamat,
							mhsJenisKelamin AS jenisKelamin,
							agmrNama AS agama,
							stnkrNama AS statusNikah,
							mhsNoHp AS noHp,
							mhsEmail AS email,
							mhsFoto AS foto,
							mhsHobi AS hobi,
							mhsAngkatan AS angkatan,
							stakmhsrNama AS statusMahasiswa,
							jllrNama AS jalurMasuk,
							sbdnNama AS sumberDana,
							pegNama AS dosenPembimbingAkademik,
							pegNip AS nipDosenPembimbingAkademik,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,";		

		$this->dbSia->select($longListMhs);
		$this->dbSia->join('program_studi', 'program_studi.prodiKode = mahasiswa.mhsProdiKode');
		$this->dbSia->join('jurusan', 'jurusan.jurKode = program_studi.prodiJurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$this->dbSia->join('kota_ref', 'kota_ref.kotaKode = mahasiswa.mhsKotaKodeLahir','left');
		$this->dbSia->join('agama_ref', 'agama_ref.agmrId = mahasiswa.mhsAgmrId','left');
		$this->dbSia->join('status_nikah_ref', 'status_nikah_ref.stnkrId = mahasiswa.mhsStnkrId','left');
		$this->dbSia->join('status_aktif_mahasiswa_ref', 'status_aktif_mahasiswa_ref.stakmhsrKode = mahasiswa.mhsStakmhsrKode','left');
		$this->dbSia->join('s_jalur_ref', 's_jalur_ref.jllrKode = mahasiswa.mhsJlrrKode','left');
		$this->dbSia->join('s_sumber_dana_ref', 's_sumber_dana_ref.sbdnrId = mahasiswa.mhsSbdnrId','left');
		$this->dbSia->join('pegawai', 'pegawai.pegNip = mahasiswa.mhsDsnPegNipPembimbingAkademik','left');
		$this->dbSia->where('mhsNiu',$nim);
		$query = $this->dbSia->get('mahasiswa');
		$result = $query->row_array();
		if (!empty($result['foto'])) $result['foto'] = URL_FOTO_MHS.$result['foto'];
		//$this->debugSql();

		return $result;
	}

	public function list_alumni($condition = FALSE) {

		$shortListAlu = "mhsNiu AS nim,
							mhsNama AS nama,
							mhsFoto AS foto,
							mhsAngkatan AS angkatan,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,";		

		$this->dbSia->select($shortListAlu);
		if ($condition) $this->dbSia->where($condition);
		$this->dbSia->where('mhsStakmhsrKode', 'L'); // Status mahasiswa Lulus
		$this->dbSia->join('program_studi', 'mahasiswa.mhsProdiKode = program_studi.prodiKode');
		$this->dbSia->join('jurusan', 'program_studi.prodiJurKode = jurusan.jurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$query = $this->dbSia->get('mahasiswa');
		$result = $query->result_array();
		//$this->debugSql();

		foreach ($result as $key => $value) {
			if (!empty($result[$key]['foto'])) $result[$key]['foto'] = URL_FOTO_MHS.$result[$key]['foto'];
		}

		return $result;
	}

	public function detail_alumni($nim) {

		$longListAlu = "mhsNiu AS nim, 
							mhsNama AS nama,
							taJudul AS judulTa,
							mhsTanggalLulus AS tanggalLulus,
							wsdTanggal AS tanggalWisuda,
							mhsNoIjasah AS noIjazah,
							mhsTanggalIjasah AS tanggalIjazah,
							mhsPrlsrNama AS predikatKelulusan,
							mhsProdiGelarKelulusan AS gelar,
							mhsAlamatMhs AS alamat,
							mhsJenisKelamin AS jenisKelamin,
							mhsNoHp AS noHp,
							mhsEmail AS email,
							mhsFoto AS foto,
							mhsAngkatan AS angkatan,
							stakmhsrNama AS statusMahasiswa,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,";	

		$this->dbSia->select($longListAlu);
		$this->dbSia->where('mhsStakmhsrKode', 'L'); // Status mahasiswa Lulus
		$this->dbSia->join('program_studi', 'program_studi.prodiKode = mahasiswa.mhsProdiKode');
		$this->dbSia->join('jurusan', 'jurusan.jurKode = program_studi.prodiJurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$this->dbSia->join('kota_ref', 'kota_ref.kotaKode = mahasiswa.mhsKotaKodeLahir','left');
		$this->dbSia->join('status_aktif_mahasiswa_ref', 'status_aktif_mahasiswa_ref.stakmhsrKode = mahasiswa.mhsStakmhsrKode','left');
		$this->dbSia->join('s_tugas_akhir', 's_tugas_akhir.taMhsNiu = mahasiswa.mhsNiu','left');
		$this->dbSia->join('s_wisuda', 's_wisuda.wsdId = mahasiswa.mhsWsdId','left');
		$this->dbSia->where('mhsNiu',$nim);
		$query = $this->dbSia->get('mahasiswa');
		$result = $query->row_array();
		if (!empty($result['foto'])) $result['foto'] = URL_FOTO_MHS.$result['foto'];
		//$this->debugSql();

		return $result;
	}

	public function get_pembimbing($nim) {

		$pembimbing = "pegNip AS nip,
							pegNama AS nama,
							dsnprntaNama AS peran";		

		$this->dbSia->select($pembimbing);
		$this->dbSia->order_by('dsnprntaId');
		$this->dbSia->where('mhsNiu', $nim); // ID Tugas Akhir
		$this->dbSia->where('mhsStakmhsrKode', 'L'); // Status mahasiswa Lulus
		$this->dbSia->join('s_tugas_akhir', 's_tugas_akhir.taId = s_dosen_tugas_akhir.dsntaTaId');
		$this->dbSia->join('mahasiswa', 'mahasiswa.mhsNiu = s_tugas_akhir.taMhsNiu');
		$this->dbSia->join('pegawai', 'pegawai.pegNip = s_dosen_tugas_akhir.dsntaPegNip');
		$this->dbSia->join('s_dosen_peran_ta_ref', 's_dosen_peran_ta_ref.dsnprntaId = s_dosen_tugas_akhir.dsntaDsnprntaId');
		$query = $this->dbSia->get('s_dosen_tugas_akhir');
		$result = $query->result_array();
		//$this->debugSql();

		return $result;
	}

	public function list_judul($condition = FALSE) {

		$judul = "mhsNiu AS nim, 
							mhsNama AS nama,
							taJudul AS judulTa,
							mhsAngkatan AS angkatan";		

		$this->dbSia->select($judul);
		if ($condition) $this->dbSia->where($condition);
		$this->dbSia->join('mahasiswa', 'mahasiswa.mhsNiu = s_tugas_akhir.taMhsNiu');
		$this->dbSia->join('program_studi', 'program_studi.prodiKode = mahasiswa.mhsProdiKode');
		$this->dbSia->join('jurusan', 'jurusan.jurKode = program_studi.prodiJurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$query = $this->dbSia->get('s_tugas_akhir');
		$result = $query->result_array();
		//$this->debugSql();

		return $result;
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

	public function get_table($table, $select = FALSE, $condition = FALSE) {

		if ($select) $this->dbSia->select($select);
		if ($condition) $this->dbSia->where($condition);
		$query = $this->dbSia->get($table);
		$result = $query->result_array();
		//$this->debugSql();

		return $result;
	}

	public function count_mhs($select, $condition, $groupby, $having=FALSE) {
		$this->dbSia->select($select);
		$this->dbSia->where($condition);
		$this->dbSia->join('program_studi', 'program_studi.prodiKode = mahasiswa.mhsProdiKode');
		$this->dbSia->join('jurusan', 'jurusan.jurKode = program_studi.prodiJurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$this->dbSia->join('agama_ref', 'agama_ref.agmrId = mahasiswa.mhsAgmrId','left');
		$this->dbSia->join('status_nikah_ref', 'status_nikah_ref.stnkrId = mahasiswa.mhsStnkrId','left');
		$this->dbSia->join('status_aktif_mahasiswa_ref', 'status_aktif_mahasiswa_ref.stakmhsrKode = mahasiswa.mhsStakmhsrKode','left');
		$this->dbSia->join('s_sumber_dana_ref', 's_sumber_dana_ref.sbdnrId = mahasiswa.mhsSbdnrId','left');
		$this->dbSia->join('s_jalur_ref', 's_jalur_ref.jllrKode = mahasiswa.mhsJlrrKode','left');
		$this->dbSia->join('s_tugas_akhir', 's_tugas_akhir.taMhsNiu = mahasiswa.mhsNiu','left');
		$this->dbSia->join('s_wisuda', 's_wisuda.wsdId = mahasiswa.mhsWsdId','left');
		$this->dbSia->group_by($groupby);
		if ($having) $this->dbSia->having($having);
		$query = $this->dbSia->get('mahasiswa');
		$result = $query->result_array();
		//$this->debugSql();
		
		return $result;
	}	

	public function count_dosen($select, $condition, $groupby, $having=FALSE) {
		$this->dbSia->select($select);
		$this->dbSia->where($condition);
		$this->dbSia->join('pegawai', 'pegawai.pegNip = dosen.dsnPegNip');
    	$this->dbSia->join('program_studi', 'program_studi.prodiKode = dosen.dsnProdiKode','left');
		$this->dbSia->join('jurusan', 'jurusan.jurKode = program_studi.prodiJurKode','left');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode','left');
		$this->dbSia->join('pg_status_ikatan_kerja_dosen', 'pg_status_ikatan_kerja_dosen.sikjKode = dosen.dsnSikjKode','left');
		$this->dbSia->join('pg_status_aktivitas_dosen_ref', 'pg_status_aktivitas_dosen_ref.sadrKode = dosen.dsnSadrKode','left');
		$this->dbSia->join('pg_status_pegawai_ref', 'pg_status_pegawai_ref.stpegrId = pegawai.pegStpegrId','left');
		$this->dbSia->join('pg_jenis_pegawai_ref', 'pg_jenis_pegawai_ref.jnpegrId = pegawai.pegJnpegrId','left');
		$this->dbSia->group_by($groupby);
		if ($having) $this->dbSia->having($having);
		$query = $this->dbSia->get('dosen');
		$result = $query->result_array();
		//$this->debugSql();
		
		return $result;
	}

    private function debugSql() {
		
		echo $this->dbSia->last_query(); die;
    }

}