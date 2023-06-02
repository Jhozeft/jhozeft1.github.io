<html>
<head>
<title>exec</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body bgcolor=#def>	

<?
$tanggal=date('Y-m-d');
session_start();
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }

$rp=$_POST['rp'];
$rp = str_replace(',', '', $rp);
$rp = str_replace('.', '', $rp);
$rp= filter_var ( $rp, FILTER_SANITIZE_NUMBER_INT);

//echo $_POST['debet']."<br>";
//echo $_POST['kredit']."<br>";
//echo $rp."<br>";
include "db.inc";

$strsql3="select nama_rekening from rekening where rekening='".$_POST['debet']."'";
$result3 = mysqli_query($con,$strsql3);
while($row = mysqli_fetch_array($result3))
{
	$ndebet=$row['nama_rekening'];
}

$strsql3="select nama_rekening from rekening where rekening='".$_POST['kredit']."'";
$result3 = mysqli_query($con,$strsql3);
while($row = mysqli_fetch_array($result3))
{
	$nkredit=$row['nama_rekening'];
}

if($_POST['kode']=="proses")
{	
$tanggal=date($_POST['tgl1']);
$kode=date("Ymdhis");
mysqli_query($con,"INSERT INTO kas(
Tanggal,
Rekening,
Nama_Rek_Debet,
Debet,
kode2,
Reff,voucher, unit)  VALUES ('".$tanggal."','"
.$_POST['debet']."','"
.$ndebet."',"
.$rp.",'"
.$kode."','"
.$_POST['reff']."','"
.$_POST['voucher']."','"
.$_SESSION['user']."')");

mysqli_query($con,"INSERT INTO kas(
Tanggal,
Rekening,
Nama_Rek_Kredit,
Kredit,
kode2,
Reff,voucher, unit)  VALUES ('".$tanggal."','"
.$_POST['kredit']."','"
.$nkredit."',"
.$rp.",'"
.$kode."','"
.$_POST['reff']."','"
.$_POST['voucher']."','"
.$_SESSION['user']."')");


header( 'Location: halamanutama.php' );



}
?>
<h4>Konfirmasi</h4>
<table border=1 cellspacing=0>
<tr>
<td width="75px">Tanggal</td><td width="200px"><? echo $_POST['tgl1'] ?></td>
</tr>

<tr>
<td>Debet</td><td><? echo $ndebet ?></td>
</tr>
<tr>
<td>Kredit</td><td><? echo $nkredit ?></td>
</tr>
<tr>
<td>Reff</td><td><? echo $_POST['reff'] ?></td>
</tr>
<tr>
<td>Voucher</td><td><? echo $_POST['voucher'] ?></td>
</tr>
<tr>
<td>Rp.</td><td><? echo number_format($rp,0,',','.') ?></td>
</tr>
</table>
<form action=jurnalumump.php method=post>
<input type=hidden name=debet value=<? echo $_POST['debet']; ?> >
<input type=hidden name=kredit value=<? echo $_POST['kredit']; ?> >
<input type=hidden name=rp value=<? echo $_POST['rp']; ?> >
<input type=hidden name=reff value="<? echo $_POST['reff']; ?>" >
<input type=hidden name=voucher value="<? echo $_POST['voucher']; ?>" >
<input type=hidden name=tgl1 value="<? echo $_POST['tgl1']; ?>" >
<input type=hidden name=kode value="proses" >
<input type=submit value="YAKIN SIMPAN" class="green">
</form>
<br><br>
<a href="halamanutama.php"><input type=submit class="yel" value=" <<< Batal"></a>
<?

?>


</body>
</html>