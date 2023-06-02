<html>
<head>
<title>Laporan Semua</title>
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

<h3>REKAPITALASI NERACA SALDO SELURUH UNIT 2019</h3>
<style>
table.stat {
    border-collapse: collapse;
    width: 100%;
}

th.stat, td.stat {
    padding: 0px;
}
tr:nth-child(even) {background-color: #f2f2f2;}


h3 {
    display:inline;
}


</style>
<br><br>
<table class="stat"  border=1 width=95% >
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>Total Debet</th><th width=150>Total Kedit</th><th width=150>SALDO</th></tr>

<? 
include "db.inc";
//hapus temp
mysqli_query($con,"delete from neracasaldo where user='".$_SESSION['user']."'");
mysqli_query($con,"ALTER TABLE `neracasaldo` AUTO_INCREMENT=1");

$today = "2019-12-31";
$result = mysqli_query($con,"select distinct rekening FROM kas where tanggal <= '".$today."' and
 unit not like '%DEL%' 
 order by rekening asc");
while($row = mysqli_fetch_array($result))
{
$no2=$no2+1;	
$result2 = mysqli_query($con,"select nama FROM rekening where rekening='".$row[0]."'");
$row2 = mysqli_fetch_array($result2);
$namarekening=$row2[0];	
$result2 = mysqli_query($con,"select sum(debet), sum(kredit),Nama_Rek_Debet,Nama_Rek_Kredit  FROM kas where 
unit not like '%DEL%' and tanggal <= '".$today."' and rekening='".$row[0]."'");
$row2 = mysqli_fetch_array($result2);
$deb=0;
$kre=0;

if (is_null($row2[0])==true) { $deb=0;  } else { $deb=$row2[0];}
if (is_null($row2[1])==true) { $kre=0 ; } else { $kre=$row2[1];}
if (is_null($row2[2])==false) {  $nama=$row2[2]; } else { $nama=$row2[3];}
//if (is_null($row2[3])==true) {  ; } else { $nama=$row2[2];}
//echo substr($row[0],0,1)."<BR>";
if ( substr($row[0],0,1)==1 or substr($row[0],0,1)==5)
{
$saldo=$deb-$kre;
//echo "15<br>";
}
if ( substr($row[0],0,1)==2 or substr($row[0],0,1)==3 or substr($row[0],0,1)==4 or  substr($row[0],0,1)==6)
{
$saldo=$kre-$deb;
//echo "2<br>";
}	


?> 
<tr>
<td><? echo $no2 ;?></td>
<td><? echo $nama; ?></td>
<td> <a href="arusall.php?rek=<? echo $row[0];?>"> <? echo $row[0]; ?></a></td>
<td align='right'> <? echo number_format($deb,0,',','.');?></td>
<td align='right'><? echo number_format($kre,0,',','.');?></td>
<td align='right'><b><? echo number_format($saldo,0,',','.'); ?></b>
</td>
</tr>

<?	
$tdeb=$tdeb+$deb;
$tkre=$tkre+$kre;

//simpan ditemplate
   mysqli_query($con,"INSERT INTO neracasaldo 
  (ket,rekening,debet,kredit,debet2,kredit2,bulan,user) VALUES 
  ('".$nama."','". $row[0]."',".$deb.",".$kre.",0,0,2,'".$_SESSION['user']."')");


}
echo "<tr><td colspan='3' align='right'><b>Total</b></td><td align='right'><b>".number_format($tdeb,0,',','.')."</b></td><td align='right'><b>".number_format($tkre,0,',','.')."</b></td></tr>";	

echo "</table><br><br>";
$no3=0;
$tpendapatan=0;
?>


<h2>LAPORAN KEUANGAN 2019</h2>
<br>
<h3>Pendapatan</h3>
<table class="stat"  border=1 width=95% >
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>SALDO</th></tr>
<?
//Pendapatan
$result = mysqli_query($con,"select ket,rekening,debet,kredit  FROM neracasaldo where rekening like '4%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$no3++;
	$tpendapatan=$tpendapatan+$row['kredit']-$row['debet'];
?>
<tr>
<td><? echo $no3; ?></td>
<td><? echo $row['ket']; ?></td>
<td><? echo $row['rekening']; ?></td>
<td align='right'> <? echo number_format($row['kredit']-$row['debet'],0,',','.');?></td>
</tr>
<?
}
?>
<tr><td colspan="3" align='right'>Total Pendapatan</td><td align='right'><? echo number_format($tpendapatan,0,',','.');?></td></tr>
</table>
<?
$gtpendapatan=$tpendapatan;
//BIAYA
?>
<br>
<h3>Pengeluaran/Biaya</h3>
<table class="stat"  border=1 width=95% >
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>SALDO</th></tr>
<?
$no3=0;
$tpendapatan=0;
//Pendapatan
$result = mysqli_query($con,"select ket,rekening,debet,kredit  FROM neracasaldo where rekening like '5%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$no3++;
	$tpendapatan=$tpendapatan+$row['debet']-$row['kredit'];
?>
<tr>
<td><? echo $no3; ?></td>
<td><? echo $row['ket']; ?></td>
<td><? echo $row['rekening']; ?></td>
<td align='right'> <? echo number_format($row['debet']-$row['kredit'],0,',','.');?></td>
</tr>
<?
}
?>
<tr><td colspan="3" align='right'>Total Biaya</td><td align='right'><? echo number_format($tpendapatan,0,',','.');?></td></tr>
</table>
<?
$gtbiaya=$tpendapatan;
//====================akhir surplus minus ?>
<br>
<h3>SURPLUS DEFISIT</h3>
<table border=1>
<tr>
<th align=left width="200px" >Total Pendapatan</th><td align=right width="200px"><? echo number_format($gtpendapatan,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left>Total Biaya</th><td  align=right ><? echo number_format($gtbiaya,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left>SURPLUS DEFISIT</th><td  align=right ><? echo number_format($gtpendapatan-$gtbiaya,0,',','.'); ?> </td>
</tr>
</table>

<? //===========================================

// Aktiva lancar =====================================
?>
<hr>
<h2>AKTIVA</h2>
<h3>A. AKTIVA LANCAR</h3>
<table class="stat"  border=1 width=95% >
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>SALDO</th></tr>
<?
$no3=0;
$tpendapatan=0;
//Pendapatan
$result = mysqli_query($con,"select ket,rekening,debet,kredit  FROM neracasaldo where rekening like '11%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$no3++;
	$tpendapatan=$tpendapatan+$row['debet']-$row['kredit'];
?>
<tr>
<td><? echo $no3; ?></td>
<td><? echo $row['ket']; ?></td>
<td><? echo $row['rekening']; ?></td>
<td align='right'> <? echo number_format($row['debet']-$row['kredit'],0,',','.');?></td>
</tr>
<?
}
?>
<tr><td colspan="3" align='right'>Total AKTIVA lancar</td><td align='right'><? echo number_format($tpendapatan,0,',','.');?></td></tr>
</table>
<?
$gtaktivalancar=$tpendapatan;
// End Aktiva lancar =====================================

// Aktiva Tetap =====================================
?>
<br>

<h3>B. AKTIVA TETAP</h3>
<table class="stat"  border=1 width=95% >
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>SALDO</th></tr>
<?
$no3=0;
$tpendapatan=0;
//Pendapatan
$result = mysqli_query($con,"select ket,rekening,debet,kredit  FROM neracasaldo where rekening like '13%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$no3++;
	$tpendapatan=$tpendapatan+$row['debet']-$row['kredit'];
?>
<tr>
<td><? echo $no3; ?></td>
<td><? echo $row['ket']; ?></td>
<td><? echo $row['rekening']; ?></td>
<td align='right'> <? echo number_format($row['debet']-$row['kredit'],0,',','.');?></td>
</tr>
<?
}
$gtaktivatetap=$tpendapatan;
?>
<tr><td colspan="3" align='right'>Total AKTIVA Tetap</td><td align='right'><? echo number_format($tpendapatan,0,',','.');?></td></tr>
</table>


<br>
<h3>Total Aktiva</h3>
<table  border=1>
<tr>
<th align=left width="200px" >Total Aktiva Lancar</th><td align=right width="200px"><? echo number_format($gtaktivalancar,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left width="200px" >Total Aktiva Tetap</th><td align=right width="200px"><? echo number_format($gtaktivatetap,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left width="200px" >Total Aktiva</th><td align=right width="200px"><? echo number_format($gtaktivalancar+$gtaktivatetap,0,',','.'); ?> </td>
</tr>
</table>
<?
// End Aktiva Tetap =====================================
// Kewajiban =====================================
?>
<hr>
<h2>PASIVA</h2>
<h3>A. KEWAJIBAN/HUTANG</h3>
<table class="stat"  border=1 width=95% >
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>SALDO</th></tr>
<?
$no3=0;
$tpendapatan=0;
//Pendapatan
$result = mysqli_query($con,"select ket,rekening,debet,kredit  FROM neracasaldo where rekening like '2%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$no3++;
	$tpendapatan=$tpendapatan-$row['debet']+$row['kredit'];
?>
<tr>
<td><? echo $no3; ?></td>
<td><? echo $row['ket']; ?></td>
<td><? echo $row['rekening']; ?></td>
<td align='right'> <? echo number_format(-$row['debet']+$row['kredit'],0,',','.');?></td>
</tr>
<?
}
$gthutang=$tpendapatan;
?>






<tr><td colspan="3" align='right'>Total KEWAJIBAN/HUTANG</td><td align='right'><? echo number_format($tpendapatan,0,',','.');?></td></tr>
</table>
<?
//======== end kewajiban

// Modal =====================================
?>
<br>
<h3>B. MODAL</h3>
<table class="stat"  border=1 width=95% >
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>SALDO</th></tr>
<?
$no3=0;
$tpendapatan=0;
//Pendapatan
$result = mysqli_query($con,"select ket,rekening,debet,kredit  FROM neracasaldo where rekening like '3%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$no3++;
	$tpendapatan=$tpendapatan-$row['debet']+$row['kredit'];
?>
<tr>
<td><? echo $no3; ?></td>
<td><? echo $row['ket']; ?></td>
<td><? echo $row['rekening']; ?></td>
<td align='right'> <? echo number_format(-$row['debet']+$row['kredit'],0,',','.');?></td>
</tr>
<?
}
$gtmodal=$tpendapatan+$gtpendapatan-$gtbiaya;
?>
<tr>
<td><? echo $no3+1; ?></td>
<td><? echo "Modal Pengembangan"; ?></td>
<td><? //echo $row['rekening']; ?></td>
<td align='right'> <? echo number_format($gtpendapatan-$gtbiaya,0,',','.');?></td>
</tr>
<tr><td colspan="3" align='right'>Total Modal</td><td align='right'><? echo number_format($tpendapatan,0,',','.');?></td></tr>
</table>
<br>
<h3>Total PASIVA</h3>
<table  border=1>
<tr>
<th align=left width="200px" >Total Kewajiban/Hutang</th><td align=right width="200px"><? echo number_format($gthutang,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left width="200px" >Total Modal</th><td align=right width="200px"><? echo number_format($gtmodal,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left width="200px" >Total Aktiva</th><td align=right width="200px"><? echo number_format($gthutang+$gtmodal,0,',','.'); ?> </td>
</tr>
</table>
<br>


<br>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="Menu Utama"></a>
