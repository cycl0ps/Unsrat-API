<title>Unsrat RestServer</title>
<h1>Unsrat RestServer</h1>

<p>Proyek pengembangan RestServer Universitas Sam Ratulangi </p>

<h2>HTTP Verb</h2>
<ol>
<li>GET (Avalaible)</li>
<li>PUT (Not avalaible)</li>
<li>PATCH (Not avalaible)</li>
<li>DELETE (Not avalaible)</li>
</ol>

<h2>Resources Architecture</h2>

<h3>A. Data Mahasiswa</h3>

<p><b>1. Detail mahasiswa.</b> Menampilkan detail mahasiswa untuk nim tertentu</p>
<pre><code>Format: {server_url}/mahasiswa/nim/{nim mahasiswa}
URL Parameter: nim
return: Array data
Example: <a target="blank" href="<?php echo site_url('mahasiswa?nim=110216080');?>"><?php echo base_url();?>mahasiswa?nim=110216080</a> or <a target="blank" href="<?php echo site_url('mahasiswa/index/nim/110216080');?>"><?php echo base_url();?>mahasiswa/index/nim/110216080</a>
</code></pre>

<p><b>2. Mahasiswa Prodi.</b> Menampilkan daftar mahasiswa untuk prodi tertentu</p>
<pre><code>Format: {server_url}/mahasiswa/prodi/id/{kode prodi}
URL Parameter: id
return: Array data
Example: <a target="blank" href="<?php echo site_url('mahasiswa/prodi?id=77');?>"><?php echo base_url();?>mahasiswa/prodi?id=77</a> or <a target="blank" href="<?php echo site_url('mahasiswa/prodi/id/77');?>"><?php echo base_url();?>mahasiswa/prodi/id/77</a></code></pre>

<p><b>3. Mahasiswa Jurusan.</b> Menampilkan daftar mahasiswa untuk jurusan tertentu</p>
<pre><code>Format: {server_url}/mahasiswa/jurusan/id/{kode jurusan}
URL Parameter: id
return: Array data
Example: <a target="blank" href="<?php echo site_url('mahasiswa/jurusan?id=43');?>"><?php echo base_url();?>mahasiswa/jurusan?id=43</a> or <a target="blank" href="<?php echo site_url('mahasiswa/jurusan/id/43');?>"><?php echo base_url();?>mahasiswa/jurusan/id/43</a>
</code></pre>

<p><b>4. Mahasiswa Fakultas.</b> Menampilkan daftar mahasiswa untuk fakultas tertentu</p>
<pre><code>Format: {server_url}/mahasiswa/fakultas/id/{kode fakultas}
URL Parameter: id
return: Array data
Example: <a target="blank" href="<?php echo site_url('mahasiswa/fakultas?id=2');?>"><?php echo base_url();?>mahasiswa/fakultas?id=2</a> or <a target="blank" href="<?php echo site_url('mahasiswa/fakultas/id/2');?>"><?php echo base_url();?>mahasiswa/fakultas/id/2</a>
</code></pre>

<p><b>5. Login Mahasiswa.</b> Autentikasi mahasiswa menggunakan database portal</p>
<pre><code>Format: {server_url}/mahasiswa/login/user/{username}/pass/{password}
URL Parameter: user, pass
return: TRUE or FALSE
Example: <a target="blank" href="<?php echo site_url('mahasiswa/login?user=12345&pass=12345');?>"><?php echo base_url();?>mahasiswa/login?user=12345&pass=12345</a> or <a target="blank" href="<?php echo site_url('mahasiswa/login/user/12345/pass/12345');?>"><?php echo base_url();?>mahasiswa/login/user/12345/pass/12345</a>
</code></pre>

<h3>B. Data Dosen</h3>

<p><b>1. Detail dosen.</b> Menampilkan detail dosen untuk nip tertentu</p>
<pre><code>Format: {server_url}/dosen/nip/{nip dosen}
URL Parameter: nim
return: Array data
Example: <a target="blank" href="<?php echo site_url('dosen?nip=110216080');?>"><?php echo base_url();?>dosen?nip=110216080</a> or <a target="blank" href="<?php echo site_url('dosen/index/nip/110216080');?>"><?php echo base_url();?>dosen/index/nip/110216080</a>
</code></pre>

<p><b>2. Dosen Prodi.</b> Menampilkan daftar dosen untuk prodi tertentu</p>
<pre><code>Format: {server_url}/dosen/prodi/id/{kode prodi}
URL Parameter: id
return: Array data
Example: <a target="blank" href="<?php echo site_url('dosen/prodi?id=77');?>"><?php echo base_url();?>dosen/prodi?id=77</a> or <a target="blank" href="<?php echo site_url('dosen/prodi/id/77');?>"><?php echo base_url();?>dosen/prodi/id/77</a>
</code></pre>

<p><b>3. Dosen Jurusan.</b> Menampilkan daftar dosen untuk jurusan tertentu</p>
<pre><code>Format: {server_url}/dosen/jurusan/id/{kode jurusan}
URL Parameter: id
return: Array data
Example: <a target="blank" href="<?php echo site_url('dosen/jurusan?id=43');?>"><?php echo base_url();?>dosen/jurusan?id=43</a> or <a target="blank" href="<?php echo site_url('dosen/jurusan/id/43');?>"><?php echo base_url();?>dosen/jurusan/id/43</a></code></pre>

<p><b>4. Dosen Fakultas.</b> Menampilkan daftar dosen untuk fakultas tertentu</p>
<pre><code>Format: {server_url}/dosen/fakultas/id/{kode fakultas}
URL Parameter: id
return: Array data
Example: <a target="blank" href="<?php echo site_url('dosen/fakultas?id=2');?>"><?php echo base_url();?>dosen/fakultas?id=2</a> or <a target="blank" href="<?php echo site_url('dosen/fakultas/id/2');?>"><?php echo base_url();?>dosen/fakultas/id/2</a>
</code></pre>

<p><b>5. Login Dosen.</b> Autentikasi dosen menggunakan database portal</p>
<pre><code>Format: {server_url}/dosen/login/user/{username}/pass/{password}
URL Parameter: user, pass
return: TRUE or FALSE
Example: <a target="blank" href="<?php echo site_url('dosen/login?user=12345&pass=12345');?>"><?php echo base_url();?>dosen/login?user=12345&pass=12345</a> or <a target="blank" href="<?php echo site_url('dosen/login/user/12345/pass/12345');?>"><?php echo base_url();?>dosen/login/user/12345/pass/12345</a>
</code></pre>

<h3>C. Data Akademik</h3>

<p><b>1. Data akademik mahasiswa.</b> Menampilkan data general akademik mahasiswa</p>
<pre><code>UNDER DEVELOPMENT
</code></pre>

<p><b>2. MK Tugas Akhir.</b> Menampilkan data kontrak mata kuliah tugas akhir mahasiswa</p>
<pre><code>Format: {server_url}/akademik/mk-tugas-akhir/nim/{nim mahasiswa}
URL Parameter: nim
return: Array data
Example: <a target="blank" href="<?php echo site_url('akademik/mk-tugas-akhir?nim=110216080');?>"><?php echo base_url();?>akademik/mk-tugas-akhir?nim=110216080</a> or <a target="blank" href="<?php echo site_url('akademik/mk-tugas-akhir/nim/110216080');?>"><?php echo base_url();?>akademik/mk-tugas-akhir/nim/110216080</a>
</code></pre>

<p><b>3. SKS Mahasiswa.</b> Menampilkan jumlah total sks, sks lulus dan ipk</p>
<pre><code>Format: {server_url}/akademik/total-sks/nim/{nim mahasiswa}
URL Parameter: nim
return: Array data
Example: <a target="blank" href="<?php echo site_url('akademik/total-sks?nim=110216080');?>"><?php echo base_url();?>akademik/total-sks?nim=110216080</a> or <a target="blank" href="<?php echo site_url('akademik/total-sks/nim/110216080');?>"><?php echo base_url();?>akademik/total-sks/nim/110216080</a>
</code></pre>

<h3>D. Data Alumni</h3>

<p><b>1. Detail alumni.</b> Menampilkan detail alumni untuk nim tertentu</p>
<pre><code>Format: {server_url}/alumni/nim/{nim alumni}
URL Parameter: nim
return: Array data
Example: <a target="blank" href="<?php echo site_url('alumni?nim=100216001');?>"><?php echo base_url();?>alumni?nim=100216001</a> or <a target="blank" href="<?php echo site_url('alumni/index/nim/100216001');?>"><?php echo base_url();?>alumni/index/nim/100216001</a>
</code></pre>

<p><b>2. Alumni Prodi.</b> Menampilkan daftar alumni untuk prodi tertentu</p>
<pre><code>Format: {server_url}/alumni/prodi/id/{kode prodi}
URL Parameter: id
return: Array data
Example: <a target="blank" href="<?php echo site_url('alumni/prodi?id=77');?>"><?php echo base_url();?>alumni/prodi?id=77</a> or <a target="blank" href="<?php echo site_url('alumni/prodi/id/77');?>"><?php echo base_url();?>alumni/prodi/id/77</a></code></pre>

<p><b>3. Alumni Jurusan.</b> Menampilkan daftar alumni untuk jurusan tertentu</p>
<pre><code>Format: {server_url}/alumni/jurusan/id/{kode jurusan}
URL Parameter: id
return: Array data
Example: <a target="blank" href="<?php echo site_url('alumni/jurusan?id=43');?>"><?php echo base_url();?>alumni/jurusan?id=43</a> or <a target="blank" href="<?php echo site_url('alumni/jurusan/id/43');?>"><?php echo base_url();?>alumni/jurusan/id/43</a>
</code></pre>

<p><b>4. Alumni Fakultas.</b> Menampilkan daftar alumni untuk fakultas tertentu</p>
<pre><code>Format: {server_url}/alumni/fakultas/id/{kode fakultas}
URL Parameter: id
return: Array data
Example: <a target="blank" href="<?php echo site_url('alumni/fakultas?id=2');?>"><?php echo base_url();?>alumni/fakultas?id=2</a> or <a target="blank" href="<?php echo site_url('alumni/fakultas/id/2');?>"><?php echo base_url();?>alumni/fakultas/id/2</a>
</code></pre>

<h2>Output Format</h2>

<p>Format luaran dapat disesuaikan dengan kebutuhan rest-client. Default output format: json</p>
<pre><code>Output: json - array - csv - html - php - xml - serialized 
URL Parameter: format AND [resource parameter]
Format URL : {resources}/format/{output format}
Example: <a target="blank" href="<?php echo site_url('mahasiswa/prodi?id=77&format=xml');?>"><?php echo base_url();?>mahasiswa/prodi?id=77&format=xml</a> or <a target="blank" href="<?php echo site_url('dosen/jurusan/id/43/format/csv');?>"><?php echo base_url();?>dosen/jurusan/id/43/format/csv</a>
</code></pre>

<h2>Tim Pengembang</h2>

<ul>
<li><strong>Alwin Sambul</strong> - asambul@unsrat.ac.id</li>
<li><strong>Xaverius Najoan</strong> - xnajoan@unsrat.ac.id</li>
</ul>