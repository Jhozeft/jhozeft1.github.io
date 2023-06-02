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
echo "Selamat datang : ".$_SESSION['user'];
$tanggal=date('d-m-Y');
?>

<body>
<h3>NERACA SALDO   
<? echo $tanggal; ?>
</h3>
<br>
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
<tr><th>No</th><th>KETERANGAN</th><th>Rekening</th><th width=150>Total Debet</th><th width=150>Total Kedit</th><th width=150>SALDO</th></tr>

<? 
include "db.inc";
$today = date("Y-m-d");
$result = mysqli_query($con,"select distinct rekening FROM kas where tanggal <= '".$today."' and rekening like '".$_POST['rek']."%' order by rekening asc");
while($row = mysqli_fetch_array($result))
{
$no2=$no2+1;	
$result2 = mysqli_query($con,"select nama FROM rekening where rekening='".$row[0]."'");
$row2 = mysqli_fetch_array($result2);
$namarekening=$row2[0];	
$result2 = mysqli_query($con,"select sum(debet), sum(kredit),Nama_Rek_Debet,Nama_Rek_Kredit  FROM kas where tanggal <= '".$today."' and rekening='".$row[0]."'");
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
echo "<tr><td>".$no2."</td><td>".$nama."</td><td>".$row[0]."</td><td align='right'>".number_format($deb,0,',','.')."</td><td align='right'>".number_format($kre,0,',','.')."</td><td align='right'><b>".number_format($saldo,0,',','.')."</b></td></tr>";	
$tdeb=$tdeb+$deb;
$tkre=$tkre+$kre;
}
echo "<tr><td colspan='3' align='right'><b>Total</b></td><td align='right'><b>".number_format($tdeb,0,',','.')."</b></td><td align='right'><b>".number_format($tkre,0,',','.')."</b></td></tr>";	

echo "</table><br><br>";


?>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="Menu Utama"></a>
