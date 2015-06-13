<html>
<body>
<center><strong><u><font size="+2">DAFTAR HADIR</font></u></strong></center>
<strong>
<table>
	<tr>
		<td>ACARA</td>
		<td>: {{$pembahasan}}</td>
	</tr>
	<tr>
		<td>Hari, Tanggal </td>
		<td>: {{$tanggal}}</td>
	</tr>
	<tr>
		<td>Pukul</td>
		<td>: {{$waktu}}</td>
	</tr>
	<tr>
		<td>Tempat </td>
		<td>: {{$tempat}}</td>
	</tr>
	<tr>
		<td>Pimpinan </td>
		<td>: {{$pimpinan}}</td>
	</tr>
	
</table>
</strong>
<br/><br/>
<table style="width: 100%; 	border-collapse: collapse;" border="1">
<thead>
<tr style="background: #CACACA">
<th>NO.</th>
<th>NAMA, PANGKAT</th>
<th>JABATAN / INSTANSI</th>
<th>TELP / HP</th>
<th>PARAF</th>
</tr>
</thead>
<tbody>
@for ($i = 1; $i <= $hitung + 5; $i++)
<tr><td align="center">{{$i}}</td>
<td><br/><br/></td>
<td></td>
<td></td>
<td></td></tr>
@endfor
</tbody>
</table>
</body>
</html>
