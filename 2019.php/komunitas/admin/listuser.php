
<?
session_start();
$passwordinput=$_POST['password'];
include "db.inc";


if ($hak==9)
{

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
echo "salah";	
}


?>
