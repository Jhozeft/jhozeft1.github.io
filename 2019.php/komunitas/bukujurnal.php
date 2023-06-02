<html>
<head>
<title>Buku Jurnal</title>
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
<h3>BUKU JURNAL  
<? echo $tanggal; ?>
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
$result = mysqli_query($con,"SELECT * FROM kas where unit='".$_SESSION['user']."' order by Tanggal, id asc");

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
<?
echo "<td>No</td><td>Tgl</td><td>Kode Rek</td><td>DEBET/KREDIT</td><td>Keterangan(Voucher)</td><td>Rp. DEBET</td><td>Rp. KREDIT</td>";
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
  <td> 
  <? echo $row[2]; ?> 
  <!--
  <a href="konfirmasihapus.php?kode=<? //echo $row['kode2'] ?>">Hapus</a>
  -->
  
  </td>
  <?
    echo "<td>".$row[3].$row[4]."</td>";
  echo "<td align='left'>".$row[5]." (".$row['voucher'].")</td>";
  echo "<td align='right'>".number_format($row[6],0,',','.')."</td>";
  echo "<td align='right'>".number_format($row[7],0,',','.')."</td>";
  echo "</tr>";
  }
?>  
<tr>
<td colspan=5 align="right"> Total  Rp.</td ></td><td align=right><h3 style="display:inline;"> <? echo number_format($tdeb,0,',','.') ?></h3></b></td></td><td align=right><h3  style="display:inline;"> <? echo number_format($tkre,0,',','.') ?></h3></b></td></tr>
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

</table>

<br><br><br><b>
</b><hr>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="Menu Utama"></a>

</body>
</html>
