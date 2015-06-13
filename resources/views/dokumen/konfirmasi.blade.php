<html>
<body>
<center><strong><u><font size="+2">KONFIRMASI KEHADIRAN</font></u></strong></center>
<br/>
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
		<td valign="top">Tempat </td>
		<td>: <?php echo str_replace("\n","\n<br/>&nbsp;&nbsp;", $tempat); ?></td>
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
<th width="15px">NO.</th>
<th>PESERTA</th>
<th width="60px">HADIR</th>
<th width="60px">TIDAK HADIR</th>
<th>KETERANGAN</th>
</tr>
</thead>
<tbody>
@foreach ($pesertas as $peserta)
<tr><td align="center" height="40px">{{$i++}}</td>
<td>{{$peserta->pejabat->nama}}</td>
<td align="center">{{$peserta->hadir ? '*' : ''}}</td>
<td align="center">{{$peserta->hadir ? '' : '*'}}</td>
<td><?php echo str_replace("\n","\n<br/>", $peserta->keterangan); ?></td></tr>
@endforeach
</tbody>
</table>
</body>
</html>
