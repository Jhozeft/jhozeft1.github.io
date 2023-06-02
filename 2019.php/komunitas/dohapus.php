<html>
<head>
<title>exec hapus</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body bgcolor=#def>	

<?

session_start();
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }
include "db.inc";
//echo $_POST['kode'];
mysqli_query($con,"update kas set unit='".$_SESSION['user']."DEL' where unit='".$_SESSION['user']."' and kode2='".$_POST['kode']."'");
echo $_POST['kode'];
//echo "update kas set unit='".$_SESSION['user']."DEL' where unit='".$_SESSION['user']."' and kode2='".$_POST['kode']."'";
header( 'Location: bukuhapus.php' );
?>
</body>
</html>

