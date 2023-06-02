<html>
<head>
<title>Neraca Saldo</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body bgcolor=#def>	

<?
session_start();
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }
echo "Selamat datang : ".$_SESSION['user']."<br>";
$tanggal=date('d-m-Y');
?>

<body>

<form method="post">
<input type="date" name="tgl1" value="<? echo date("Y-m-d"); ?>" style="height:35px; width:160px; font-size:14pt;">
<input type="submit" value="Neraca Saldo">
</form>
<br>
<h3>NERACA SALDO   
<? echo $_POST['tgl1']; ?>
</h3>
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
<table class="stat"  border=1 width=95% >
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>Total Debet</th><th width=150>Total Kedit</th><th width=150>SALDO</th></tr>

<? 
include "db.inc";
//hapus temp
mysqli_query($con,"delete from neracasaldo where user='".$_SESSION['user']."'");
mysqli_query($con,"ALTER TABLE `neracasaldo` AUTO_INCREMENT=1");

$today = $_POST['tgl1'];
$result = mysqli_query($con,"select distinct rekening FROM kas where tanggal <= '".$today."' and
 unit='".$_SESSION['user']."' 
and rekening like '".$_POST['rek']."%' order by rekening asc");
while($row = mysqli_fetch_array($result))
{
$no2=$no2+1;	
$result2 = mysqli_query($con,"select nama FROM rekening where rekening='".$row[0]."'");
$row2 = mysqli_fetch_array($result2);
$namarekening=$row2[0];	
$result2 = mysqli_query($con,"select sum(debet), sum(kredit),Nama_Rek_Debet,Nama_Rek_Kredit  FROM kas where 
 unit='".$_SESSION['user']."' and 
tanggal <= '".$today."' and rekening='".$row[0]."'");
$row2 = mysqli_fetch_array($result2);
$deb=0;
$kre=0;

if (is_null($row2[0])==true) { $deb=0;  } else { $deb=$row2[0];}
if (is_null($row2[1])==true) { $kre=0 ; } else { $kre=$row2[1];}
if (is_null($row2[2])==false) {  $nama=$row2[2]; } else { $nama=$row2[3];}
//if (is_null($row2[3])==true) {  ; } else { $nama=$row2[2];}
//echo substr($row[0],0,1)."<BR>";
if (substr($row[0],0,1)==1 or substr($row[0],0,1)==5)
{
$saldo=$deb-$kre;
//echo "15<br>";
}
if (substr($row[0],0,1)==4 or substr($row[0],0,1)==3)
{
$saldo=$kre-$deb;
//echo "2<br>";
}	
echo "<tr><td>".$no2."</td><td>".$nama."</td><td>".$row[0]."</td><td align='right'>".number_format($deb,0,',','.')."</td><td align='right'>".number_format($kre,0,',','.')."</td><td align='right'><b>".number_format($saldo,0,',','.')."</b></td></tr>";	
$tdeb=$tdeb+$deb;
$tkre=$tkre+$kre;

//simpan ditemplate
   mysqli_query($con,"INSERT INTO neracasaldo 
  (ket,rekening,debet,kredit,debet2,kredit2,bulan,user) VALUES 
  ('".$nama."','". $row[0]."',".$deb.",".$kre.",0,0,2,'".$_SESSION['user']."')");


}
echo "<tr><td colspan='3' align='right'><b>Total</b></td><td align='right'><b>".number_format($tdeb,0,',','.')."</b></td><td align='right'><b>".number_format($tkre,0,',','.')."</b></td></tr>";	

echo "</table><br><br>";
?>

<?
//Mencari total keluar dan total masuk
$result = mysqli_query($con,"select sum(kredit-kredit2) FROM neracasaldo where rekening like '4%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$pendapatan=$row[0];
}
$result = mysqli_query($con,"select sum(debet-debet2) FROM neracasaldo where rekening like '5%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$biaya=$row[0];
}

$result = mysqli_query($con,"select sum(kredit-kredit2),sum(debet-debet2)  FROM neracasaldo where rekening like '1%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$aktiva=$row[1]-$row[0];
}

$result = mysqli_query($con,"select sum(kredit-kredit2),sum(debet-debet2)  FROM neracasaldo where rekening like '2%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$hutang=$row[0]-$row[1];
}



$result = mysqli_query($con,"select sum(kredit-kredit2),sum(debet-debet2)  FROM neracasaldo where rekening like '3%' and user='".$_SESSION['user']."'");
while($row = mysqli_fetch_array($result))
{
	$modal=$row[0]-$row[1];
}

?>

<br>
<h3>Sisa Hasil Kegiatan</h3>
<table border=1>
<tr>
<th align=left width="200px" >Total Pendapatan</th><td align=right width="200px"><? echo number_format($pendapatan,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left>Total Biaya</th><td  align=right ><? echo number_format($biaya,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left>Total Sisa Usaha</th><td  align=right ><? echo number_format($pendapatan-$biaya,0,',','.'); ?> </td>
</tr>
</table>

<br>
<h3>Total Aktiva</h3>
<table  border=1>
<tr>
<th align=left width="200px" >Total Aktiva</th><td align=right width="200px"><? echo number_format($aktiva,0,',','.'); ?> </td>
</tr>

</table>


<br>
<h3>MODAL</h3>
<table  border=1>
<tr>
<th align=left width="200px" >Modal</th><td align=right width="200px"><? echo number_format($modal,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left width="200px" >Modal Pengembangan</th><td align=right width="200px"><? echo number_format($pendapatan-$biaya,0,',','.'); ?> </td>
</tr>

<tr>
<th align=left width="200px" >Total Modal </th><td align=right width="200px"><? echo number_format($modal+$pendapatan-$biaya,0,',','.'); ?> </td>
</tr>
</table>

<br>
<h3>PASIVA</h3>
<table  border=1>
<tr>
<th align=left width="200px" >Modal</th><td align=right width="200px"><? echo number_format($modal+$pendapatan-$biaya,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left width="200px" >HUTANG</th><td align=right width="200px"><? echo number_format($hutang,0,',','.'); ?> </td>
</tr>

<tr>
<th align=left width="200px" >PASIVA</th><td align=right width="200px"><? echo number_format($hutang+$modal+$pendapatan-$biaya,0,',','.'); ?> </td>
</tr>
</table>















<br>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="Menu Utama"></a>
