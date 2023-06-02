<html>
<head>
<title>Mobile Accounting</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body bgcolor=#def>	
<?
session_start();
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }

?>
<p style="float: right;display:inline;">User : <? echo $_SESSION['user']."/".$_SESSION['hak']; ?></p>
<br><h3 style="display:inline;">Mobile Accounting</h3><br>
<marquee width="250">
Have a Nice Day... Tuhan Memberkati... 
 </marquee>
<hr>
<ul>
<li><a href="menumasuk.php"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"


 type="submit" value="Trans Masuk"></a></li>
<li><a href="menukeluar.php"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Trans Keluar"></a></li>
<li><a href="jurnalumum.php"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Jurnal Umum"></a></li>
<hr>
<h3>LAPORAN</H3>
<hr>

<li><a href="aruskas.php?bl=01"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Arus Kas"></a></li>


<li><a href="neracasaldotgl.php?tgl1=<? echo date("Y-m-d"); ?>"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Neraca Saldo"></a></li>
 
 <li><a href="bukujurnal.php"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Buku Jurnal"></a></li>
<hr>
<form action="bukujurnal4.php" method="post">
<input type="date" name="tgl1"  value="<? echo date("Y-m-d"); ?>"  style="height:35px; width:130px; font-size:11pt;"> Sd
<input type="date" name="tgl2"  value="<? echo date("Y-m-d"); ?>" style="height:35px; width:130px; font-size:11pt;"><br> 
<input type="submit" value="Buku Jurnal Antara" 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"

>
</form>
<hr>
 <li><a href="neracasaldotgl4.php?tgl1=<? echo date("Y-m-d"); ?>"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="LAPORAN KEUANGAN"></a></li>



 <li><a href="bukuhapus.php"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Lihat/Hapus Bulan ini"></a></li>

 <li><a href="anggaran2.php"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Rekening/Anggaran"></a></li>

 <hr>
<br>
<?
if ($_SESSION['hak']==9)
{
	?>
  <li><a href="listuser.php"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Pilih Komunitas"></a></li>
	<?
}
?>

<li><a href="logout.php"><input 
style="height:35px; font-size:14pt;width: 150px;padding: 10px 24px;border-radius: 8px;background-color: RED;"


type="submit" value="KELUAR"></a></li>
</ul>
</body>
</html>