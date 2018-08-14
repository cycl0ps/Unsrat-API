<?php
class Model_mahasiswa extends CI_Model {
	
	private $shortListMhs = "mhsNiu AS nim,
							mhsNama AS nama,
							mhsFoto AS foto,
							mhsAngkatan AS angkatan,
							prodiNamaResmi AS prodi,
							prodiKode AS kodeProdi,
							jurNamaResmi AS jurusan,
							jurKode AS kodeJurusan,
							fakNamaResmi AS fakultas,
							fakKode AS kodeFakultas,";

	private $longListMhs = "mhsNiu AS nim, 
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
							pegNama AS dosenPembimbingAkademik,
							pegNip AS nipDosenPembimbingAkademik,
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
	
	public function list_mahasiswa($condition = FALSE) {

		$this->dbSia->select($this->shortListMhs);
		if ($condition) $this->dbSia->where($condition);
		$this->dbSia->join('program_studi', 'mahasiswa.mhsProdiKode = program_studi.prodiKode');
		$this->dbSia->join('jurusan', 'program_studi.prodiJurKode = jurusan.jurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$query = $this->dbSia->get('mahasiswa');
		$result = $query->result_array();
		//$this->debugSql();

		return $result;
	}

	public function detail_mahasiswa($nim) {

		$this->dbSia->select($this->longListMhs);
		$this->dbSia->join('program_studi', 'program_studi.prodiKode = mahasiswa.mhsProdiKode');
		$this->dbSia->join('jurusan', 'jurusan.jurKode = program_studi.prodiJurKode');
		$this->dbSia->join('fakultas', 'fakultas.fakKode = program_studi.prodiFakKode');
		$this->dbSia->join('kota_ref', 'kota_ref.kotaKode = mahasiswa.mhsKotaKodeLahir','left');
		$this->dbSia->join('agama_ref', 'agama_ref.agmrId = mahasiswa.mhsAgmrId');
		$this->dbSia->join('status_nikah_ref', 'status_nikah_ref.stnkrId = mahasiswa.mhsStnkrId','left');
		$this->dbSia->join('status_aktif_mahasiswa_ref', 'status_aktif_mahasiswa_ref.stakmhsrKode = mahasiswa.mhsStakmhsrKode');
		$this->dbSia->join('s_jalur_ref', 's_jalur_ref.jllrKode = mahasiswa.mhsJlrrKode');
		$this->dbSia->join('pegawai', 'pegawai.pegNip = mahasiswa.mhsDsnPegNipPembimbingAkademik');
		$this->dbSia->where('mhsNiu',$nim);
		$query = $this->dbSia->get('mahasiswa');
		$result = $query->row_array();
		//$this->debugSql();

		return $result;
	}

    private function debugSql() {
		
		echo $this->dbSia->last_query(); die;
		//$this->dbSia->select("dsnPegNip as NIP, CONCAT(COALESCE(pegGelarDepan,''),pegNama,', ',COALESCE(pegGelarBelakang,'')) as Nama",FALSE);
    }
}