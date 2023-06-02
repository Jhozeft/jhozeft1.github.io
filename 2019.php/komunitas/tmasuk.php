<html>
<head>
<title>Tran Masuk</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body bgcolor=#def>	

<?


session_start();
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }
//echo "Selamat datang : ".$_SESSION['user'];
$kdkas="1110";
$banko="1120";


if ($_GET['id']=="kas") { $rekdeb="1110";}
if ($_GET['id']=="banko") { $rekdeb="1120";}
//echo "dddd".$rekdeb;

?>
<h3>Transaksi <? echo strtoupper($_GET['id']); ?> Masuk </h3>
<hr>
<table>
 <form action="tmasukp.php" method="post">

<tr>
<td> Tgl</td>
<td> <input type="date" name="tgl1" value="<? echo date("Y-m-d"); ?>" style="height:35px; width:160px; font-size:14pt;"></td>
</tr>

<tr>
<td>
 Reff </td><td><input type="text" size=40 name="reff" style="height:35px; font-size:14pt;">
</td>
</tr> 

<tr>
<td>
BTU </td><td><input type="text" size=40 name="voucher" style="height:35px; font-size:14pt;">
</td>
</tr> 


<tr>
<td>  POS</td><td><select name="kredit" style="height:35px; font-size:12pt;">
  <option name="kredit" value="1141">MENDAPAT ARISAN</option>

<?
include "db.inc";
$strsql3="select * from rekening where rekening like '4%' and k=1 and kelompok='komunitas' order by nama_rekening asc";
$result3 = mysqli_query($con,$strsql3);
while($row = mysqli_fetch_array($result3))
{
?>
  <option name="kredit" value="<? echo $row['rekening'];?>"><? echo $row['nama_rekening'];?></option>
<?
}
  
?>
 </select>
</td>
</tr>
<tr>
<td>
 Rp. </td><td><input type="Number" step="any" name="rp" style="height:35px; font-size:14pt;">
</td>
</tr>

<tr>
<td></td><td>

 <input type=hidden name=debet value=<? echo $rekdeb; ?> >  
 <input class="green" type=submit value="SIMPAN" style="height:35px; font-size:14pt;">
</td>
</tr>

 </form>
</table>

<br><br>
<a href="halamanutama.php"><input class="yel" type="submit" value="<<< Batal"></a>
 </body>
</html>