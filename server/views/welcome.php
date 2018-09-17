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
			<td rowspan="4">I.</td>
			<td rowspan="4">Data mahasiswa</td>
			<td rowspan="4"><pre>mahasiswa</pre></td>
			<td><pre>index()</pre></td>
			<td>Detail mahasiswa untuk nim tertentu</td>
			<td><pre>nim={nim mahasiswa}</pre></td>
			<td><pre>{server_url}/mahasiswa?nim={nim mahasiswa}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('mahasiswa?nim=12345');?>"><?php echo site_url('mahasiswa?nim=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>prodi()</code></pre></td>
			<td>List mahasiswa prodi tertentu, difilter s</td>
			<td><pre>kode={kode prodi}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/mahasiswa/prodi?kode={kode prodi}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('mahasiswa/prodi?kode=77');?>"><?php echo site_url('mahasiswa/prodi?kode=77');?></a></pre></td>		
		</tr>
		<tr>
			<td><pre><code>jurusan()</code></pre></td>
			<td>List mahasiswa jurusan tertentu</td>
			<td><pre>kode={kode jurusan}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/mahasiswa/jurusan?kode={kode jurusan}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('mahasiswa/jurusan?kode=43');?>"><?php echo site_url('mahasiswa/jurusan?kode=43');?></a></pre></td>	
		</tr>
		<tr>
			<td><pre><code>fakultas()</code></pre></td>
			<td>List mahasiswa fakultas tertentu</td>
			<td><pre>kode={kode fakultas}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/mahasiswa/fakultas?kode={kode fakultas}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('mahasiswa/fakultas?kode=2');?>"><?php echo site_url('mahasiswa/fakultas?kode=2');?></a></pre></td>
		</tr>

		<tr>
			<td rowspan="4">II.</td>
			<td rowspan="4">Data dosen</td>
			<td rowspan="4"><pre>dosen</pre></td>
			<td><pre><code>index()</code></pre></td>
			<td>Detail dosen untuk nip tertentu</td>
			<td><pre>nip={nip dosen}</pre></td>
			<td><pre>{server_url}/dosen?nip={nip dosen}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('dosen?nip=12345');?>"><?php echo site_url('dosen?nip=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>prodi()</code></pre></td>
			<td>List dosen prodi tertentu</td>
			<td><pre>kode={kode prodi}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/dosen/prodi?kode={kode prodi}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('dosen/prodi?kode=77');?>"><?php echo site_url('dosen/prodi?kode=77');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>jurusan()</code></pre></td>
			<td>List dosen jurusan tertentu</td>
			<td><pre>kode={kode jurusan}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/dosen/jurusan?kode={kode jurusan}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('dosen/jurusan?kode=43');?>"><?php echo site_url('dosen/jurusan?kode=43');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>fakultas()</code></pre></td>
			<td>List dosen fakultas tertentu</td>
			<td><pre>kode={kode fakultas}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/dosen/fakultas?kode={kode fakultas}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('dosen/fakultas?kode=2');?>"><?php echo site_url('dosen/fakultas?kode=2');?></a></pre></td>
		</tr>

		<tr>
			<td rowspan="4">III.</td>
			<td rowspan="4">Data alumni</td>
			<td rowspan="4"><pre>alumni</pre></td>
			<td><pre><code>index()</code></pre></td>
			<td>Detail alumni untuk nim tertentu</td>
			<td><pre>nim={nim alumni}</pre></td>
			<td><pre>{server_url}/alumni?nim={nim alumni}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('alumni?nim=12345');?>"><?php echo site_url('alumni?nim=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>prodi()</code></pre></td>
			<td>List alumni prodi tertentu</td>
			<td><pre>kode={kode prodi}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/alumni/prodi?kode={kode prodi}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('alumni/prodi?kode=77');?>"><?php echo site_url('alumni/prodi?kode=77');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>jurusan()</code></pre></td>
			<td>List alumni jurusan tertentu</td>
			<td><pre>kode={kode jurusan}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/alumni/jurusan?kode={kode jurusan}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('alumni/jurusan?kode=43');?>"><?php echo site_url('alumni/jurusan?kode=43');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>fakultas()</code></pre></td>
			<td>List alumni fakultas tertentu</td>
			<td><pre>kode={kode fakultas}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/alumni/fakultas?kode={kode fakultas}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('alumni/fakultas?kode=2');?>"><?php echo site_url('alumni/fakultas?kode=2');?></a></pre></td>
		</tr>

		<tr>
			<td rowspan="4">IV.</td>
			<td rowspan="4">Data pegawai</td>
			<td rowspan="4"><pre>pegawai</pre></td>
			<td><pre><code>index()</code></pre></td>
			<td>Detail pegawai untuk nip tertentu</td>
			<td><pre>nip={nip pegawai}</pre></td>
			<td><pre>{server_url}/pegawai?nip={nip pegawai}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('pegawai?nip=12345');?>"><?php echo site_url('pegawai?nip=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>satker()</code></pre></td>
			<td>List pegawai satker tertentu</td>
			<td><pre>kode={kode satker}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/pegawai/satker?kode={kode satker}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('pegawai/satker?kode=13');?>"><?php echo site_url('pegawai/satker?kode=13');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>academic()</code></pre></td>
			<td>List pegawai akademik (Tenaga pendidik) pada satker tertentu</td>
			<td><pre>kode={kode satker}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/pegawai/academic?kode={kode satker}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('pegawai/academic?kode=13');?>"><?php echo site_url('pegawai/academic?kode=13');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>non_academic()</code></pre></td>
			<td>List pegawai non-akademik (Tenaga kependidikan) pada satker tertentu</td>
			<td><pre>kode={kode satker}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/pegawai/non-academic?kode={kode satker}[&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('pegawai/non-academic?kode=13');?>"><?php echo site_url('pegawai/non-academic?kode=13');?></a></pre></td>
		</tr>

		<tr>
			<td rowspan="3">V.</td>
			<td rowspan="3">Jumlah mahasiswa</td>
			<td rowspan="3"><pre>jumlah/mahasiswa</pre></td>
			<td><pre>fakultas()</pre></td>
			<td>Jumlah mahasiswa fakultas tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode fakultas}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/mahasiswa/fakultas?kode={kode fakultas}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/mahasiswa/fakultas?kode=2&groupby=jurusan');?>"><?php echo site_url('jumlah/mahasiswa/fakultas?kode=2&groupby=jurusan');?></a></pre></td>
		</tr>
		<tr>
			<td><pre>jurusan()</pre></td>
			<td>Jumlah mahasiswa jurusan tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode jurusan}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/mahasiswa/jurusan?kode={kode jurusan}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/mahasiswa/jurusan?kode=43&groupby=status');?>"><?php echo site_url('jumlah/mahasiswa/jurusan?kode=43&groupby=status');?></a></pre></td>		
		</tr>
		<tr>
			<td><pre>prodi()</pre></td>
			<td>Jumlah mahasiswa prodi tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode prodi}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/mahasiswa/prodi?kode={kode prodi}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/mahasiswa/prodi?kode=77&groupby=status');?>"><?php echo site_url('jumlah/mahasiswa/prodi?kode=77&groupby=status');?></a></pre></td>		
		</tr>

		<tr>
			<td rowspan="3">VI.</td>
			<td rowspan="3">Jumlah alumni</td>
			<td rowspan="3"><pre>jumlah/alumni</pre></td>
			<td><pre>fakultas()</pre></td>
			<td>Jumlah alumni fakultas tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode fakultas}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/alumni/fakultas?kode={kode fakultas}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/alumni/fakultas?kode=2&groupby=jurusan');?>"><?php echo site_url('jumlah/alumni/fakultas?kode=2&groupby=jurusan');?></a></pre></td>
		</tr>
		<tr>
			<td><pre>jurusan()</pre></td>
			<td>Jumlah alumni jurusan tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode jurusan}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/alumni/jurusan?kode={kode jurusan}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/alumni/jurusan?kode=43&groupby=tahun');?>"><?php echo site_url('jumlah/alumni/jurusan?kode=43&groupby=tahun');?></a></pre></td>		
		</tr>
		<tr>
			<td><pre>prodi()</pre></td>
			<td>Jumlah alumni prodi tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode prodi}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/alumni/prodi?kode={kode prodi}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/alumni/prodi?kode=77&groupby=angkatan');?>"><?php echo site_url('jumlah/alumni/prodi?kode=77&groupby=angkatan');?></a></pre></td>		
		</tr>		

		<tr>
			<td rowspan="3">VII.</td>
			<td rowspan="3">Jumlah dosen</td>
			<td rowspan="3"><pre>jumlah/dosen</pre></td>
			<td><pre>fakultas()</pre></td>
			<td>Jumlah dosen fakultas tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode fakultas}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/dosen/fakultas?kode={kode fakultas}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/dosen/fakultas?kode=2&groupby=jurusan');?>"><?php echo site_url('jumlah/dosen/fakultas?kode=2&groupby=jurusan');?></a></pre></td>
		</tr>
		<tr>
			<td><pre>jurusan()</pre></td>
			<td>Jumlah dosen jurusan tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode jurusan}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/dosen/jurusan?kode={kode jurusan}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/dosen/jurusan?kode=43&groupby=prodi');?>"><?php echo site_url('jumlah/dosen/jurusan?kode=43&groupby=prodi');?></a></pre></td>		
		</tr>
		<tr>
			<td><pre>prodi()</pre></td>
			<td>Jumlah dosen prodi tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode prodi}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/dosen/prodi?kode={kode prodi}[&groupby={group}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/dosen/prodi?kode=77&groupby=angkatan');?>"><?php echo site_url('jumlah/dosen/prodi?kode=77&groupby=aktifitas');?></a></pre></td>		
		</tr>

		<tr>
			<td rowspan="3">VIII.</td>
			<td rowspan="3">Jumlah pegawai</td>
			<td rowspan="3"><pre>jumlah/pegawai</pre></td>
			<td><pre><code>satker()</code></pre></td>
			<td>Jumlah pegawai untuk satker tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode satker}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/pegawai/satker?kode={kode satker}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/pegawai/satker?kode=13');?>"><?php echo site_url('jumlah/pegawai/satker?kode=13');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>academic()</code></pre></td>
			<td>Jumlah pegawai akademik (Tenaga pendidik) pada satker tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode satker}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/pegawai/academic?kode={kode satker}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/pegawai/academic?kode=13&groupby=fungsional');?>"><?php echo site_url('jumlah/pegawai/academic?kode=13&groupby=fungsional');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>non_academic()</code></pre></td>
			<td>Jumlah pegawai non-akademik (Tenaga kependidikan) pada satker tertentu, dikelompokkan berdasarkan group tertentu</td>
			<td><pre>kode={kode satker}<br>groupby={group}<br>filter={kategori}, by={id}</pre></td>
			<td><pre>{server_url}/jumlah/pegawai/non-academic?kode={kode satker}[&groupby={group}][&filter={kategori}&by{id}]</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('jumlah/pegawai/non-academic?kode=13&groupby=pangkat');?>"><?php echo site_url('jumlah/pegawai/non-academic?kode=13&groupby=pangkat');?></a></pre></td>
		</tr>		

		<tr>
			<td rowspan="2">IX.</td>
			<td rowspan="2">Data akademik</td>
			<td rowspan="2"><pre>akademik</pre></td>
			<td><pre><code>mk_tugas_akhir()</code></pre></td>
			<td>Cek MK Tugas Akhir mahasiswa</td>
			<td><pre>nim={nim mahasiswa}</pre></td>
			<td><pre>{server_url}/akademik/mk-tugas-akhir?nim={nim mahasiswa}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('akademik/mk-tugas-akhir?nim=12345');?>"><?php echo site_url('akademik/mk-tugas-akhir?nim=12345');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>total_sks()</code></pre></td>
			<td>Data total sks mahasiswa</td>
			<td><pre>nim={nim mahasiswa}</pre></td>
			<td><pre>{server_url}/akademik/total-sks?nim={nim mahasiswa}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('akademik/total-sks?nim=12345');?>"><?php echo site_url('akademik/total-sks?nim=12345');?></a></pre></td>
		</tr>

		<tr>
			<td rowspan="3">X.</td>
			<td rowspan="3">Data judul skripsi mahasiswa</td>
			<td rowspan="3"><pre>judul</pre></td>
			<td><pre><code>prodi()</code></pre></td>
			<td>List judul skripsi mahasiswa pada prodi tertentu</td>
			<td><pre>kode={kode prodi}</pre></td>
			<td><pre>{server_url}/judul/prodi?kode={kode prodi}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('judul/prodi?kode=77');?>"><?php echo site_url('judul/prodi?kode=77');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>jurusan()</code></pre></td>
			<td>List judul skripsi mahasiswa pada jurusan tertentu</td>
			<td><pre>kode={kode jurusan}</pre></td>
			<td><pre>{server_url}/judul/jurusan?kode={kode jurusan}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('judul/jurusan?kode=43');?>"><?php echo site_url('judul/jurusan?kode=43');?></a></pre></td>
		</tr>
		<tr>
			<td><pre><code>fakultas()</code></pre></td>
			<td>List judul skripsi mahasiswa pada fakultas tertentu</td>
			<td><pre>kode={kode fakultas}</pre></td>
			<td><pre>{server_url}/judul/fakultas?kode={kode fakultas}</pre></td>
			<td><pre><a target="blank" href="<?php echo site_url('judul/fakultas?kode=2');?>"><?php echo site_url('judul/fakultas?kode=2');?></a></pre></td>
		</tr>

		<tr>
			<td rowspan="2">XI.</td>
			<td rowspan="2">Otentifikasi login</td>
			<td rowspan="2"><pre>login</pre></td>
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
<li><a target="_blank" href="<?php echo site_url('welcome/group');?>">Info parameter group</a></li>
<li><a target="_blank" href="<?php echo site_url('welcome/filter');?>">Info parameter kategori filter</a></li>
</ol>


<h2>Output Format</h2>

<p>Format luaran dapat disesuaikan dengan kebutuhan client. Default output format: json</p>
<pre>Output format: json - jsonp - array - csv - html - php - xml - serialized 
URL Parameter: format={output format}
Format URL : {server_url}/{method}?{parameter}&format={output format}
Example: <a target="blank" href="<?php echo site_url('mahasiswa/prodi?kode=77&format=xml');?>"><?php echo site_url('mahasiswa/prodi?kode=77&format=xml');?></a></pre>

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