<head>
<title>Admin MobAcc</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>

</head>
<?
session_start();
$passwordinput=$_POST['password'];
include "db.inc";


if ($_SESSION['hak']==9)
{
?>
<p style="float: right;display:inline;">User : <? echo $_SESSION['admin']."/".$_SESSION['hak']; ?></p>
<br><h3 style="display:inline;">Halaman Admin</h3><br>
<?

$strsql3="select * from user where ket='1'";
$result3 = mysqli_query($con,$strsql3);
//echo "aaa";
while($row3 = mysqli_fetch_array($result3))
{
//echo $row3['namalengkap'];
?>
<form action="menuadmin.php" method="post">
<input 
style="height:35px; font-size:14pt;width: 350px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
type="submit" value="<? echo $row3['namalengkap']; ?>">
<input type="hidden" name="unit" value="<? echo $row3['user']; ?>">
</form>

<?	
}
	
//echo "benar";
//		header( 'Location: ../halamanutama.php' );	
}
else
{
echo "Tidak berhak ";	
}


?>
<hr>
<a href="neracasaldotgl3.php?tgl1=<? echo date("Y-m-d"); ?>"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="LAPORAN KEUANGAN"></a>
 <br>
 <a href="editpas2.php?tgl1=<? echo date("Y-m-d"); ?>"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Manage Password"></a>