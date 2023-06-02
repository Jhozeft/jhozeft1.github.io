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
<p style="float: right;display:inline;">User : <? echo $_SESSION['user']; ?></p>
<br><h3 style="display:inline;">Transaksi Keluar :</h3>
<hr>

<table cellspacing="10">
<tr><td>
<a href="tkeluar.php?id=kas"><input class="statx" type="submit" value="Mengeluarkan KAS"></a>
</td></tr>
<tr><td>

<a href="setorbank.php?id=kas"><input class="statx" type="submit" value="Setor ke BANK"></a>
</td></tr>

</table>
<br><br>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="<<< Batal"></a>
</body>
</html>