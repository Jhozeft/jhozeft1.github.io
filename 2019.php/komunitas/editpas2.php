<head>
<title>Ganti Password</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>

</head>
<body bgcolor=#def>			
<?
session_start();
include "db.inc";

if (empty($_SESSION['user']))
{ 	

header( 'Location: index.html' ); 
}

 $result = mysqli_query($con,"SELECT * FROM user where user = '".$_SESSION['admin']."'");
 $row = mysqli_fetch_array($result);	
 

 //$kata=$_GET['id'];
 //$result = mysqli_query($con,"SELECT * FROM kompetensi where id = ".$_GET['id']."");
 //$row = mysqli_fetch_array($result);
?>
<h4>EDIT PASSWORD</h4>
<form action="editpas2.php" method="post">
<table class="stat">

<th align=right>NAMA UNIT</th><td><select name="dosen">
<? $result = mysqli_query($con,"SELECT distinct user FROM user order by user asc");
while($row = mysqli_fetch_array($result))
 { ?>   <option name="dosen" value="<? echo $row[0] ?>"><? echo $row[0] ?></option> <? } ?>
</select> </td></tr>




<tr><th align=right>Password Baru</th><td><input type=password name=baru size=10></td></tr>
<tr><th align=right>Tulis Ulang Password Baru</th><td><input type=password name=ulang size=10></td></tr>

<input type=hidden name=id value="<? echo $row['id']; ?>">
<input type=hidden name=op value="go">

</table>
<input type=submit value="Simpan">
</form>
<? 
 //update
if ($_POST['op']=="go")
{ 

if($_POST['baru']==$_POST['ulang'])
{
	

     mysqli_query($con,"update user set password='".$_POST['baru']."' where user ='".$_POST['dosen']."'");
echo "Password user an :".$_POST['dosen']." Sudah terganti password baru";
?>
<br>
<a href="listuser.php"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="Kembali ke menu"></a>
 <br>
 <a href="./admin/index.html"><input 
style="height:35px; font-size:14pt;width: 250px;padding: 10px 24px;border-radius: 8px;background-color: #4CAF50;"
 type="submit" value="login ulang"></a>

<?
//header ("Location:  menu.php");
}
else
{	
echo "Password baru dan tulis ulang tidak sama";
}


} 
//====jika vaiabel sesi tidak ada=========

//=
//==================================
?>

</body>
</html>
