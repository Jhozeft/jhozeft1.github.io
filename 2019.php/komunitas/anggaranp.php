<html>
<head>
<title>Edit Anggaran</title>
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

?>
<body>
<h3>Edit Anggaran  
</h3>
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
for ($i=1;$i<$_POST['jumlah']+1;$i++)
{
$kode[$i]=$_POST['kode'][$i];
$nama[$i]=$_POST['nama'][$i];
$anggaran[$i]=$_POST['anggaran'][$i];
mysqli_query($con,"update anggaran set anggaran=".$anggaran[$i]." where kelompok='".$_SESSION['user']."' and rekening ='".$kode[$i]."'");
?>
<tr>
<td><? echo $i; ?></td>
<td><? echo $kode[$i]; ?></td>
<td><? echo $nama[$i]; ?></td>
<td align="right"><? echo number_format($anggaran[$i],0,',','.') ; ?></td>
</tr>
<?
}
header ("Location:anggaran2.php");
?>
</table>
<hr>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="Menu Utama"></a>
</body>
