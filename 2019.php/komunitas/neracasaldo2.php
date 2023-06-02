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
include "db.inc";
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }
echo "Selamat datang : ".$_SESSION['user'];
$tanggal=date('d-m-Y');
//hapus temp
mysqli_query($con,"delete from neracasaldo where user='".$_SESSION['user']."'");
mysqli_query($con,"ALTER TABLE `neracasaldo` AUTO_INCREMENT=1");
?>

<body>
<h3>NERACA SALDO BULAN</h3>
<form method="post">
Bulan <select name="bulan">
<option name="bulan" value="1">Jan</option>
<option name="bulan" value="2">Feb</option>
<option name="bulan" value="3">Mar</option>
<option name="bulan" value="4">Apr</option>
<option name="bulan" value="5">Mei</option>
<option name="bulan" value="6">Jun</option>
<option name="bulan" value="7">Jul</option>
<option name="bulan" value="8">Agt</option>
<option name="bulan" value="9">Sep</option>
<option name="bulan" value="10">Okt</option>
<option name="bulan" value="11">Nop</option>
<option name="bulan" value="12">Des</option>
</select>
<input type="submit" value="Neraca Saldo">
</form>
<br>

<?
//echo "bulan ".$_POST['bulan'];
?>



<style>
table.satu {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 0px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>

<table  class="satu" border=1 width=95% >
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>Total Debet</th><th width=150>Total Kedit</th><th width=150>SALDO</th></tr>

<?

switch ($_POST['bulan']) {
    case 1:
	$tgl1="2018-02-01";
	$tgl2="2018-01-01";
        break;
    case 2:
	$tgl1="2018-03-01";
	$tgl2="2018-02-01";
        break;
    case 3:
	$tgl1="2018-04-01";
	$tgl2="2018-03-01";
        break;
    case 4:
	$tgl1="2018-05-01";
	$tgl2="2018-04-01";
        break;
    case 5:
	$tgl1="2018-06-01";
	$tgl2="2018-05-01";
        break;
    case 6:
	$tgl1="2018-07-01";
	$tgl2="2018-06-01";
        break;
    case 7:
	$tgl1="2018-07-01";
	$tgl2="2018-06-01";
        break;		
    case 8:
	$tgl1="2018-08-01";
	$tgl2="2018-07-01";
        break;		
    case 9:
	$tgl1="2018-09-01";
	$tgl2="2018-08-01";
        break;
    case 10:
	$tgl1="2018-10-01";
	$tgl2="2018-09-01";
        break;
    case 11:
	$tgl1="2018-11-01";
	$tgl2="2018-10-01";
        break;
    case 12:
	$tgl1="2018-12-01";
	$tgl2="2019-01-01";
        break;
}

echo "Neraca saldo Bulan  =".$tgl1."<br>";




 
$today = date("Y-m-d");
$result = mysqli_query($con,"select distinct rekening FROM kas where tanggal < '".$tgl1."' order by rekening asc");
while($row = mysqli_fetch_array($result))
{
$no2=$no2+1;	
$result2 = mysqli_query($con,"select nama FROM rekening where rekening='".$row[0]."'");
$row2 = mysqli_fetch_array($result2);
$namarekening=$row2[0];	
$result2 = mysqli_query($con,"select sum(debet), sum(kredit),Nama_Rek_Debet,Nama_Rek_Kredit  FROM kas where tanggal < '".$tgl1."' and rekening='".$row[0]."'");
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
if (substr($row[0],0,1)==4 )
{
$saldo=$kre-$deb;
//echo "2<br>";
}	
   mysqli_query($con,"INSERT INTO neracasaldo 
  (ket,rekening,debet,kredit,bulan,user) VALUES 
  ('".$nama."','". $row[0]."',".$deb.",".$kre.",2,'".$_SESSION['user']."')");
$tdeb=$tdeb+$deb;
$tkre=$tkre+$kre;
}

//mau cari bulan sebelumnya berdasarkan neraca saldo yang dicari
$result = mysqli_query($con,"select rekening FROM neracasaldo  where user='".$_SESSION['user']."' order by rekening asc");
while($row = mysqli_fetch_array($result))
{
$no2=$no2+1;	
$result2 = mysqli_query($con,"select nama FROM rekening where rekening='".$row[0]."'");
$row2 = mysqli_fetch_array($result2);
$namarekening=$row2[0];	
$result2 = mysqli_query($con,"select sum(debet), sum(kredit),Nama_Rek_Debet,Nama_Rek_Kredit  FROM kas where tanggal <= '".$tgl2."' and rekening='".$row[0]."'");
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
if (substr($row[0],0,1)==4 )
{
$saldo=$kre-$deb;
//echo "2<br>";
}	
mysqli_query($con,
"UPDATE neracasaldo set debet2=".$deb.", kredit2=".$kre." where rekening='".$row[0]."' and user='".$_SESSION['user']."'");
$tdeb=$tdeb+$deb;
$tkre=$tkre+$kre;
}
//Final hitung saldo bulan tersebut
$no=0;
$deb=0;
$kre=0;
$saldo=0;
$result = mysqli_query($con,"select * FROM neracasaldo where user='".$_SESSION['user']."' order by rekening asc");
while($row = mysqli_fetch_array($result))
{
$no++;
$ket=$row['ket'];
$rek=$row['rekening'];
$deb=$row['debet']-$row['debet2'];
$kre=$row['kredit']-$row['kredit2'];
if (substr($row['rekening'],0,1)==1 or substr($row['rekening'],0,1)==5)
{ $saldo=$deb-$kre; }
if (substr($row['rekening'],0,1)==4 )
{ $saldo=$kre-$deb; }	
?>
<tr>
<td><? echo $no; ?> </td>
<td><? echo $ket; ?> </td>
<td><? echo $rek; ?> </td>
<td align="right"><? echo number_format($deb,0,',','.'); ?> </td>
<td align="right"><? echo number_format($kre,0,',','.'); ?> </td>
<td align="right"><? echo number_format($saldo,0,',','.'); ?> </td>
</tr>
<?
}
?>
</table>
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
<table>
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
<h3>Saldo Pengembangan</h3>
<table>
<tr>
<th align=left width="200px" >Total Aktiva</th><td align=right width="200px"><? echo number_format($aktiva,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left>Total Hutang</th><td  align=right ><? echo number_format($hutang,0,',','.'); ?> </td>
</tr>
<tr>
<th align=left>Total Saldo Pengembangan</th><td  align=right ><? echo number_format($aktiva-$hutang,0,',','.'); ?> </td>
</tr>
</table>


<br>
<br>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="Menu Utama"></a>
