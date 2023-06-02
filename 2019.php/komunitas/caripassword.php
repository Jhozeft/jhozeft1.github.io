
<?
session_start();
$ada="tidak";
$passwordinput=$_POST['password'];
include "db.inc";
$strsql2="select password from user where user='".$_POST['nama']. "'";
$result = mysqli_query($con,$strsql2);
while($row = mysqli_fetch_array($result))
{
	$passworddidb= $row['password'];
	$ada="ada";
}
//echo "Pasword input =".$passwordinput;
//echo "<br>Pasword database = ".$passworddidb;

if ($passwordinput==$passworddidb and $ada=="ada" )
{
$_SESSION['user'] =$_POST['nama'] ;
$_SESSION['hak'] =1 ;	
echo "benar";
		header( 'Location: halamanutama.php' );	
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
