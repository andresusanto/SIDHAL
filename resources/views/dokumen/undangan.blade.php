<html>
<body>
<table style="width: 100%">
<tr>
<td style="width: 1%; white-space:nowrap;"><img width="80px" src="img/logo_doc.png"/></td>
<td align="center"><font size="+2"><strong>KEMENTRIAN KOORDINATOR<br/>BIDANG POLITIK, HUKUM, DAN KEAMANAN<br/>REPUBLIK INDONESIA</strong></font><br/><strong>JALAN MEDAN MERDEKA BARAT NOMOR 15, JAKARTA 10110<br/>TELEPON (021) 3521121, 3520145; FAKSIMILE (021) 34830612</strong></td>
</tr>
</table>
<hr/>
<table style="width: 100%;"><tr>
<td>
<table>
	<tr>
		<td>Nomor</td>
		<td>: UN-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/Polhukam/De-VII/HM.00.{{getdate()['mday']}}/{{getdate()['mon']}}/{{getdate()['year']}}</td>
	</tr>
	<tr>
		<td>Sifat </td>
		<td>: Biasa</td>
	</tr>
	<tr>
		<td>Lampiran</td>
		<td>: 1 (satu) lembar</td>
	</tr>
	<tr>
		<td>Hal </td>
		<td>: Undangan {{$jenis}}</td>
	</tr>
</table>
</td>
<td style="width: 1%; white-space:nowrap;" valign="top">
Jakarta, &nbsp;&nbsp;&nbsp;&nbsp; {{$bulan}} {{getdate()['year']}}
</td>
</tr></table>
<br/><br/>
Yth. Daftar Undangan Terlampir<br/>
di -<br/>
Jakarta<br/>
<br/><br/>
Dalam rangka {{$pembahasan}}, diharapkan kehadiran Bapak/Ibu dalam {{$jenis}} yang dilaksanakan:<br/><br/>
<table>
	<tr>
		<td>pada hari, tanggal </td>
		<td>: {{$tanggal}}</td>
	</tr>
	<tr>
		<td>pukul </td>
		<td>: {{$waktu}} s.d selesai</td>
	</tr>
	<tr>
		<td valign="top">tempat</td>
		<td>: <?php echo str_replace("\n","\n<br/>&nbsp;&nbsp;", $tempat); ?></td>
	</tr>
	<tr>
		<td>Acara </td>
		<td>: {{$pembahasan}}</td>
	</tr>
	<tr>
		<td>Pimpinan </td>
		<td>: {{$pimpinan}}</td>
	</tr>
</table><br/>
Demikian dan atas kehadirannya diucapkan terima kasih.<br/><br/>
<div style="padding-left: 460px;">
Deputi Budang Koordinasi<br/>
Komunikasi, Informasi, dan Aparatur<br/><br/><br/><br/><br/>
Agus R. Barnas
</div>
Tembusan:<br/>
1. Sesmenko Polhukam<br/>
2. Karo Sidhal
<div style="page-break-after: always;"></div>
<strong>NAMA PEJABAT YANG DIKIRIMI SURAT UNDANGAN</strong>
<ol>
	@foreach ($pesertas as $peserta)
    <li>{{$peserta->nama}}, {{$peserta->jabatan}}, {{$peserta->instansi}}</li>
	@endforeach
</ol>
<br/><br/>
<div style="padding-left: 460px;">
Deputi Budang Koordinasi<br/>
Komunikasi, Informasi, dan Aparatur<br/><br/><br/><br/><br/>
Agus R. Barnas
</div>
</body>
</html>
