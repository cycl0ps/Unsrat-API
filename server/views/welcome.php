<title>Unsrat RESTful Web Service</title>
<h1>Unsrat RESTful Web Service</h1>

<p>Proyek pengembangan RESTful Web Service Universitas Sam Ratulangi. API ini dapat digunakan oleh developer lain, sebagai interface untuk mengakses database yang digunakan di Universitas Sam Ratulangi. Untuk menggunakan layanan ini, silahkan menghubungi Tim Pengembang UPT TIK Universitas Sam Ratulangi, untuk mendapatkan valid API-KEY</p>

<h2>API Architecture</h2>

<table border="1" padding="15px">
	<thead>
		<th></th>
		<th>Resources</th>
		<th>Controller Name</th>
		<th>Method Name</th>
		<th>Method Descriptions</th>
		<th>Parameter</th>
		<th>Format</th>
		<th>Example</th>
	</thead>
	<tbody>
		<tr>
			<td rowspan="4">A.</td>
			<td rowspan="4">Data mahasiswa</td>
			<td rowspan="4">Mahasiswa</td>
			<td><pre>index()</pre></td>
			<td>Detail mahasiswa untuk nim tertentu</td>
			<td><pre>nim={nim mahasiswa}</pre></td>
			<td><pre>{server_url}/mahasiswa?nim={nim mahasiswa}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('mahasiswa?nim=12345');?>"><?php echo site_url('mahasiswa?nim=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>prodi()</code></pre></td>
			<td>List mahasiswa prodi tertentu</td>
			<td><pre>id={kode prodi}</pre></td>
			<td><pre>{server_url}/mahasiswa/prodi?id={kode prodi}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('mahasiswa/prodi?id=77');?>"><?php echo site_url('mahasiswa/prodi?id=77');?></a></pre></td>		
		</tr>
		<tr>
			<td><pre><code>jurusan()</code></pre></td>
			<td>List mahasiswa jurusan tertentu</td>
			<td><pre>id={kode jurusan}</pre></td>
			<td><pre>{server_url}/mahasiswa/jurusan?id={kode jurusan}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('mahasiswa/jurusan?id=43');?>"><?php echo site_url('mahasiswa/jurusan?id=43');?></a></pre></td>	
		</tr>
		<tr>
			<td><pre><code>fakultas()</code></pre></td>
			<td>List mahasiswa fakultas tertentu</td>
			<td><pre>id={kode fakultas}</pre></td>
			<td><pre>{server_url}/mahasiswa/fakultas?id={kode fakultas}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('mahasiswa/fakultas?id=2');?>"><?php echo site_url('mahasiswa/fakultas?id=2');?></a></pre></td>
		</tr>

		<tr>
			<td rowspan="4">B.</td>
			<td rowspan="4">Data dosen</td>
			<td rowspan="4">Dosen</td>
			<td><pre><code>index()</code></pre></td>
			<td>Detail dosen untuk nip tertentu</td>
			<td><pre>nip={nip dosen}</pre></td>
			<td><pre>{server_url}/dosen?nip={nip dosen}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('dosen?nip=12345');?>"><?php echo site_url('dosen?nip=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>prodi()</code></pre></td>
			<td>List dosen prodi tertentu</td>
			<td><pre>id={kode prodi}</pre></td>
			<td><pre>{server_url}/dosen/prodi?id={kode prodi}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('dosen/prodi?id=77');?>"><?php echo site_url('dosen/prodi?id=77');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>jurusan()</code></pre></td>
			<td>List dosen jurusan tertentu</td>
			<td><pre>id={kode jurusan}</pre></td>
			<td><pre>{server_url}/dosen/jurusan?id={kode jurusan}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('dosen/jurusan?id=43');?>"><?php echo site_url('dosen/jurusan?id=43');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>fakultas()</code></pre></td>
			<td>List dosen fakultas tertentu</td>
			<td><pre>id={kode fakultas}</pre></td>
			<td><pre>{server_url}/dosen/fakultas?id={kode fakultas}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('dosen/fakultas?id=2');?>"><?php echo site_url('dosen/fakultas?id=2');?></a></pre></td>
		</tr>
		<tr>
			<td rowspan="4">C.</td>
			<td rowspan="4">Data alumni</td>
			<td rowspan="4">Alumni</td>
			<td><pre><code>index()</code></pre></td>
			<td>Detail alumni untuk nim tertentu</td>
			<td><pre>nim={nim alumni}</pre></td>
			<td><pre>{server_url}/alumni?nim={nim alumni}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('alumni?nim=12345');?>"><?php echo site_url('alumni?nim=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>prodi()</code></pre></td>
			<td>List alumni prodi tertentu</td>
			<td><pre>id={kode prodi}</pre></td>
			<td><pre>{server_url}/alumni/prodi?id={kode prodi}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('alumni/prodi?id=77');?>"><?php echo site_url('alumni/prodi?id=77');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>jurusan()</code></pre></td>
			<td>List alumni jurusan tertentu</td>
			<td><pre>id={kode jurusan}</pre></td>
			<td><pre>{server_url}/alumni/jurusan?id={kode jurusan}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('alumni/jurusan?id=43');?>"><?php echo site_url('alumni/jurusan?id=43');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>fakultas()</code></pre></td>
			<td>List alumni fakultas tertentu</td>
			<td><pre>id={kode fakultas}</pre></td>
			<td><pre>{server_url}/alumni/fakultas?id={kode fakultas}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('alumni/fakultas?id=2');?>"><?php echo site_url('alumni/fakultas?id=2');?></a></pre></td>
		</tr>
		<tr>
			<td rowspan="4">D.</td>
			<td rowspan="4">Data pegawai</td>
			<td rowspan="4">Pegawai</td>
			<td><pre><code>index()</code></pre></td>
			<td>Detail pegawai untuk nip tertentu</td>
			<td><pre>nip={nip pegawai}</pre></td>
			<td><pre>{server_url}/pegawai?nip={nip pegawai}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('pegawai?nip=12345');?>"><?php echo site_url('pegawai?nip=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>satker()</code></pre></td>
			<td>List pegawai satker tertentu</td>
			<td><pre>id={kode satker}</pre></td>
			<td><pre>{server_url}/pegawai/satker?id={kode satker}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('pegawai/satker?id=13');?>"><?php echo site_url('pegawai/satker?id=13');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>academic()</code></pre></td>
			<td>List pegawai akademik (Tenaga pendidik) pada satker tertentu</td>
			<td><pre>satker={kode satker}</pre></td>
			<td><pre>{server_url}/pegawai/academic?satker={kode satker}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('pegawai/academic?satker=13');?>"><?php echo site_url('pegawai/academic?satker=13');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>non_academic()</code></pre></td>
			<td>List pegawai non-akademik (Tenaga kependidikan) pada satker tertentu</td>
			<td><pre>satker={kode satker}</pre></td>
			<td><pre>{server_url}/pegawai/non-academic?satker={kode satker}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('pegawai/non-academic?satker=13');?>"><?php echo site_url('pegawai/non-academic?satker=13');?></a></pre></td>
		</tr>		
		<tr>
			<td rowspan="2">E.</td>
			<td rowspan="2">Data akademik</td>
			<td rowspan="2">Akademik</td>
			<td><pre><code>mk_tugas_akhir()</code></pre></td>
			<td>Cek MK Tugas Akhir mahasiswa</td>
			<td><pre>nim={nim mahasiswa}</pre></td>
			<td><pre>{server_url}/akademik/mk-tugas-akhir?nim={nim mahasiswa}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('akademik/mk-tugas-akhir?nim=12345');?>"><?php echo site_url('akademik/mk-tugas-akhir?nim=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>total_sks()</code></pre></td>
			<td>Data total sks mahasiswa</td>
			<td><pre>im={nim mahasiswa}</pre></td>
			<td><pre>{server_url}/akademik/total-sks?nim={nim mahasiswa}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('akademik/total-sks?nim=12345');?>"><?php echo site_url('akademik/total-sks?nim=12345');?></a></pre></td>
		</tr>
		<tr>
			<td rowspan="3">F.</td>
			<td rowspan="3">Data judul skripsi mahasiswa</td>
			<td rowspan="3">Judul</td>
			<td><pre><code>prodi()</code></pre></td>
			<td>List judul skripsi mahasiswa pada prodi tertentu</td>
			<td><pre>id={kode prodi}</pre></td>
			<td><pre>{server_url}/judul/prodi?id={kode prodi}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('judul/prodi?id=77');?>"><?php echo site_url('judul/prodi?id=77');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>jurusan()</code></pre></td>
			<td>List judul skripsi mahasiswa pada jurusan tertentu</td>
			<td><pre>id={kode jurusan}</pre></td>
			<td><pre>{server_url}/judul/jurusan?id={kode jurusan}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('judul/jurusan?id=43');?>"><?php echo site_url('judul/jurusan?id=43');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>fakultas()</code></pre></td>
			<td>List judul skripsi mahasiswa pada fakultas tertentu</td>
			<td><pre>id={kode fakultas}</pre></td>
			<td><pre>{server_url}/judul/fakultas?id={kode fakultas}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('judul/fakultas?id=2');?>"><?php echo site_url('judul/fakultas?id=2');?></a></pre></td>
		</tr>
		<tr>
			<td rowspan="2">G.</td>
			<td rowspan="2">Otentifikasi login</td>
			<td rowspan="2">Login</td>
			<td><pre><code>mahasiswa()</code></pre></td>
			<td>Otentifikasi login mahasiswa</td>
			<td><pre>user={username}, pass={password}</pre></td>
			<td><pre>{server_url}/login/mahasiswa?user={username}&pass={password}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('login/mahasiswa?user=tes&pass=12345');?>"><?php echo site_url('login/mahasiswa?user=tes&pass=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>dosen()</code></pre></td>
			<td>Otentifikasi login dosen</td>
			<td><pre>user={username}, pass={password}</pre></td>
			<td><pre>{server_url}/login/dosen?user={username}&pass={password}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('login/dosen?user=tes&pass=12345');?>"><?php echo site_url('login/dosen?user=tes&pass=12345');?></a></pre></td>
		</tr>											
	</tbody>
</table>

<h2>HTTP Verb</h2>
<ol>
	<li>GET (Avalaible)</li>
	<li>PUT (Not avalaible)</li>
	<li>PATCH (Not avalaible)</li>
	<li>DELETE (Not avalaible)</li>
</ol>

<h2>Parameter Info</h2>

<ol>
<li><a target="_blank" href="<?php echo site_url('welcome/kode-fakultas');?>">Info parameter kode fakultas/jurusan/prodi</a></li>
<li><a target="_blank" href="<?php echo site_url('welcome/kode-satker');?>">Info parameter kode satker</a></li>
</ol>


<h2>Output Format</h2>

<p>Format luaran dapat disesuaikan dengan kebutuhan client. Default output format: json</p>
<pre>Output format: json - jsonp - array - csv - html - php - xml - serialized 
URL Parameter: format={output format}
Format URL : {server_url}/{method}?{parameter}&format={output format}
Example: <a target="blank" href="<?php echo site_url('mahasiswa/prodi?id=77&format=xml');?>"><?php echo site_url('mahasiswa/prodi?id=77&format=xml');?></a></pre>

<h2>URI Request</h2>

<p>Request URI dapat menggunakan default query string atau URI segment</p>
<pre>Format URI segment : {server_url}/{method}/{parameter1}/{parameter2}
Example: <a target="blank" href="<?php echo site_url('login/mahasiswa/user/tes/pass/1234');?>"><?php echo site_url('login/mahasiswa/user/tes/pass/1234');?></a></pre>

<h2>Tim Pengembang</h2>

<p>UPT Teknologi Informasi Universitas Sam Ratulangi</p>
<ul>
<li><strong>Alwin Sambul</strong> - asambul[a]unsrat.ac.id</li>
<li><strong>Xaverius Najoan</strong> - xnajoan[a]unsrat.ac.id</li>
</ul>