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
<br><h3 style="display:inline;">Trans Masuk melalui :</h3>
<hr>

<table cellspacing="10">
<tr><td>
<a href="tmasuk.php"><input class="stat" type="submit" value="KAS"></a>
</td></tr>
<tr><td>

<a href="tkeluar.php"><input class="stat" type="submit" value="BANK Operasional"></a>
</td></tr>
<tr><td>
<a href="tkeluar.php"><input class="stat" type="submit" value="BANK Donasi"></a>
</td></tr>
</table>
</body>
</html>