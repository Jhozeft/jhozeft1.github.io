<?
session_start();
$_SESSION['user'] =$_POST['unit'] ;
//echo $_POST['unit'] ;
		header( 'Location: halamanutama.php' );	
?>