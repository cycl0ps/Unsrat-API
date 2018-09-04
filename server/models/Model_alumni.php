<?php
class Model_alumni extends CI_Model {
	
	private $shortListMhs = "mhsNiu AS nim,
							mhsNama AS nama,
							mhsAngkatan AS angkatan,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,";

	private $longListMhs = "mhsNiu AS nim, 
							mhsNama AS nama,
							mhsTanggalLulus AS tanggalLulus,
							taJudul AS judulTa,
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

	public function __construct() {
		parent::__construct();
		$this->dbSia = $this->load->database('akademika_sia', TRUE);
	}
	
	public function list_alumni($condition = FALSE) {

		$this->dbSia->select($this->shortListMhs);
		if ($condition) $this->dbSia->where($condition);
		$this->dbSia->where('mhsStakmhsrKode', 'L'); // Status mahasiswa Lulus
		$this->dbSia->join('program_studi', 'mahasiswa.mhsProdiKode = program_studi.prodiKode');
		$this->dbSia->join('jurusan', 'program_studi.prodiJurKode = jurusan.jurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$query = $this->dbSia->get('mahasiswa');
		$result = $query->result_array();
		//$this->debugSql();

		return $result;
	}

	public function detail_alumni($nim) {

		$this->dbSia->select($this->longListMhs);
		$this->dbSia->where('mhsStakmhsrKode', 'L'); // Status mahasiswa Lulu
		$this->dbSia->join('program_studi', 'program_studi.prodiKode = mahasiswa.mhsProdiKode');
		$this->dbSia->join('jurusan', 'jurusan.jurKode = program_studi.prodiJurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$this->dbSia->join('kota_ref', 'kota_ref.kotaKode = mahasiswa.mhsKotaKodeLahir','left');
		$this->dbSia->join('status_aktif_mahasiswa_ref', 'status_aktif_mahasiswa_ref.stakmhsrKode = mahasiswa.mhsStakmhsrKode','left');
		$this->dbSia->join('s_tugas_akhir', 's_tugas_akhir.taMhsNiu = mahasiswa.mhsNiu','left');
		$this->dbSia->where('mhsNiu',$nim);
		$query = $this->dbSia->get('mahasiswa');
		$result = $query->row_array();
		if (!empty($result['foto'])) $result['foto'] = URL_FOTO_MHS.$result['foto'];
		//$this->debugSql();

		return $result;
	}

    private function debugSql() {
		
		echo $this->dbSia->last_query(); die;
		//$this->dbSia->select("dsnPegNip as NIP, CONCAT(COALESCE(pegGelarDepan,''),pegNama,', ',COALESCE(pegGelarBelakang,'')) as Nama",FALSE);
    }
}