<html>
<head>
<title>Arus Transaksi Bulanan</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body bgcolor=#def>	

<?
session_start();
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }
$tanggal=date('d-m-Y');
?>
<body>
<h3>ARUS TRANSAKSI BULAN 
<? echo $_GET['bl']; ?>
</h3>
<form action="aruskas.php" method="GET">
<select name="bl" style="height:35px; font-size:12pt;">
<option name="bl" value="01">Januari</option>
<option name="bl" value="02">Februari</option>
<option name="bl" value="03">Maret</option>
<option name="bl" value="04">April</option>
<option name="bl" value="05">Mei</option>
<option name="bl" value="06">Juni</option>
<option name="bl" value="07">Juli</option>
<option name="bl" value="08">Agustus</option>
<option name="bl" value="09">September</option>
<option name="bl" value="10">Oktober</option>
<option name="bl" value="11">Nopember</option>
<option name="bl" value="12">Desember</option>
</select>
<input class="green" type=submit value="Tampilkan" style="height:25px; font-size:12pt;">
</form>
<? 
include "db.inc";
$today = date("Y-m-d");
//$today=$tg1."-".$tg2."-".$tg3;
//echo "<br>";
// Create connection
$result = mysqli_query($con,
"SELECT sum(debet),sum(kredit) FROM kas where 
tanggal < '2019-".$_GET['bl']."-01' and 
rekening='1110' and unit='".$_SESSION['user']."' order by Tanggal, id asc");
$row = mysqli_fetch_array($result);
$saldeb=$row[0];
$salkre=$row[1];



//$result = mysqli_query($con,"SELECT * FROM bayar where tgljam like '2014-08-28%'");
//$result = mysqli_query($con,"select uraian,jumlah,tarif,jumlah*tarif as total,polidok,jenis from tagihan where tglkasir like '".$today."%' order by polidok asc, uraian asc");
//$result = mysqli_query($con,"SELECT * FROM kas2 where tanggal like '".$today."%'");
$result = mysqli_query($con,
"SELECT * FROM kas where 
tanggal like '2019-".$_GET['bl']."%' and 
rekening='1110' and unit='".$_SESSION['user']."' order by Tanggal, id asc");

$tdeb=0;
$tkre=0;
?>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 0px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>
<table  border=1 width=95% " >
<tr>
<?
echo "<td>No</td><td>Tgl</td><td>Voucher</td><td>Keterangan</td><td>Rp. DEBET</td><td>Rp. KREDIT</td>";
?>
</tr>
<tr>
<td></td><td></td><td></td><td>Saldo Bulan lalu</td>
<td align='right'><? echo number_format($saldeb,0,',','.');$tdeb=$saldeb; ?></td>
<td align='right'><? echo number_format($salkre,0,',','.');$tkre=$salkre;  ?></td>

</tr>


<?
while($row = mysqli_fetch_array($result))
  {

 $no=$no+1; 
  if ($row['kurang']<0)
  {
  $kurang=0;
  $bayar=$row['total'];
  }
else
  {
  $kurang=$row['kurang'];
  $bayar=$row['bayar'];
//$duit=number_format($gaji,2,’,’,’.’);
 }
$tdeb=$tdeb+$row[6];
$tkre=$tkre+$row[7];

$tgl = date("d/m", strtotime($row[1]));
$gkurang=$gkurang+$kurang;
$gbayar=$gbayar+$bayar;
$id=$row['notag'];

  echo "<tr>";
  echo "<td>".$no . "</td>";
  echo "<td>".$tgl . "</td>";
  ?>
  <td> <? echo $row['voucher']; ?> </td>
  <?
    //echo "<td>".$row[3].$row[4]."</td>";
  echo "<td align='left'>".$row[5]. "</td>";
  echo "<td align='right'>".number_format($row[6],0,',','.')."</td>";
  echo "<td align='right'>".number_format($row[7],0,',','.')."</td>";
  echo "</tr>";
  }
?>  
<tr>
<td colspan=4 align="right"> Total  Rp.</td ></td><td align=right><h3 style="display:inline;"> <? echo number_format($tdeb,0,',','.') ?></h3></b></td></td><td align=right><h3  style="display:inline;"> <? echo number_format($tkre,0,',','.') ?></h3></b></td></tr>
<?    
  
echo "</table>";
mysqli_close($con);
echo "<br><br>";
?>
<table>
<tr>
<td> <? echo "<b><h3  style='display:inline;'> >>> Total Debet: Rp.   </h3>" ?> </td><td align=right><h3 style="display:inline;"> <? echo number_format($tdeb,0,',','.') ?></h3></b></td>
<tr>
<tr>
<td> <? echo "<b><h3 style='display:inline;'> >>> Total Kedit: Rp.   </h3>" ?> </td><td align=right><h3  style="display:inline;"> <? echo number_format($tkre,0,',','.') ?></h3></b></td>
<tr>
<tr>
<td> <? echo "<b><h3 style='display:inline;'> >>> Total SALDO: Rp.   </h3>" ?> </td><td align=right><h3  style="display:inline;"> <? echo number_format($tdeb-$tkre,0,',','.') ?></h3></b></td>
<tr>

</table>

<br><br><br><b>
</b><hr>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="Menu Utama"></a>

</body>
</html>
