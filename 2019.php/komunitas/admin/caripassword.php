
<?
session_start();
$ada="tidak";
$passwordinput=$_POST['password'];
include "db.inc";
$strsql2="select password,hakakses from user where user='".$_POST['nama']. "'";
$result = mysqli_query($con,$strsql2);
while($row = mysqli_fetch_array($result))
{
	$passworddidb= $row['password'];
	$hak= $row['hakakses'];
		$ada="ada";
	
}
//echo "Pasword input =".$passwordinput;
//echo "<br>Pasword database = ".$passworddidb;

if ($passwordinput==$passworddidb and $hak==9 and $ada=="ada" )
{
$_SESSION['user'] =$_POST['nama'] ;
$_SESSION['hak'] =9 ;
		header( 'Location: ../listuser.php' );	

$strsql3="select * from user where ket='1'";
$result3 = mysqli_query($con,$strsql3);
//echo "aaa";
while($row3 = mysqli_fetch_array($result3))
{
//echo $row3['namalengkap'];
?>
<form action="menuadmin.php" method="post">
<input type="submit" value="<? echo $row3['namalengkap']; ?>">
<input type="hidden" name="unit" value="<? echo $row3['user']; ?>">
</form>

<?	
}
	
//echo "benar";
//		header( 'Location: ../halamanutama.php' );	
}
else
{
	?>
<head>
<title>Mobile Accounting</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<h1>Password Salah</H1>
<a href="index.html">Login</a>	
	<?
}


?>
