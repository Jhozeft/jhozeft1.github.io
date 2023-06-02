<html>
<head>
<title>Menu Utama</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body bgcolor=#def>	

<?
session_start();
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }
echo "Selamat datang : ".$_SESSION['user'];
?>
<body>
<h3>BUKU JURNAL  
<? echo $tg1."-".$tg2."-".$tg3; ?>
</h3>
<? 
include "db.inc";
$today = date("Y-m-d");
//$today=$tg1."-".$tg2."-".$tg3;
//echo "<br>";
// Create connection


//$result = mysqli_query($con,"SELECT * FROM bayar where tgljam like '2014-08-28%'");
//$result = mysqli_query($con,"select uraian,jumlah,tarif,jumlah*tarif as total,polidok,jenis from tagihan where tglkasir like '".$today."%' order by polidok asc, uraian asc");
//$result = mysqli_query($con,"SELECT * FROM kas2 where tanggal like '".$today."%'");
$result = mysqli_query($con,"SELECT * FROM kas order by ID asc");

$tdeb=0;
$tkre=0;
echo "<table  class='stat' width=95%>";
echo "<td>No</td><td>REKENING</td><td>DEBET</td><td>KREDIT</td><td>Keterangan</td><td>Rp. DEBET</td><td>Rp. KREDIT</td>";
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


$gkurang=$gkurang+$kurang;
$gbayar=$gbayar+$bayar;
$id=$row['notag'];

  echo "<tr>";
  echo "<td>".$no . "</td>";
  echo "<td>".$row[2]."</td>";
  echo "<td>".$row[3] . "</td>";
  echo "<td>".$row[4]. "</td>";
  echo "<td align='left'>".$row[5]. "</td>";
  echo "<td align='right'>".number_format($row[6],0,',','.')."</td>";
  echo "<td align='right'>".number_format($row[7],0,',','.')."</td>";
  echo "</tr>";
  }
echo "</table>";
mysqli_close($con);
echo "<br><br>";
?>
<table>
<tr>
<td> <? echo "<b><h3> >>> Total Debet: Rp.   </h3>" ?> </td><td align=right><h3> <? echo number_format($tdeb,0,',','.') ?></h3></b></td>
<tr>
<tr>
<td> <? echo "<b><h3> >>> Total Kedit: Rp.   </h3>" ?> </td><td align=right><h3> <? echo number_format($tkre,0,',','.') ?></h3></b></td>
<tr>

</table>

<br><br><br><b><u>Catatan</u><br>
Untuk pengolahan di XLS,silahkan blok, copy, paste-spesial, text.
</b><hr>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="Menu Utama"></a>

</body>
</html>
