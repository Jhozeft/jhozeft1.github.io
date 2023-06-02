<html>
<head>
<title>Konfirmasi hapus</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body bgcolor=#def>	
<?
session_start();
include "db.inc";
$today = date("Y-m-d");
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }
$result = mysqli_query($con,"SELECT * FROM kas where kode2='".$_GET['kode']."' order by Tanggal, id asc");
?>
<p style="float: right;display:inline;">User : <? echo $_SESSION['user']; ?></p>
<br><h3 style="display:inline;">Yakin akan menghapus? :</h3>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 0px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>
<table  border=1 width=95% " >
<?
echo "<td>No</td><td>Tgl</td><td>Kode Rek</td><td>DEBET/KREDIT</td><td>Keterangan</td><td>Rp. DEBET</td><td>Rp. KREDIT</td>";
while($row = mysqli_fetch_array($result))
  {

 $no=$no+1; 
 $tgl = date("d/m", strtotime($row[1]));
$gkurang=$gkurang+$kurang;
$gbayar=$gbayar+$bayar;
$id=$row['notag'];

  echo "<tr>";
  echo "<td>".$no . "</td>";
  echo "<td>".$tgl . "</td>";
  echo "<td>".$row[2]."</td>";
  echo "<td>".$row[3].$row[4]."</td>";
  echo "<td align='left'>".$row[5]. "</td>";
  echo "<td align='right'>".number_format($row[6],0,',','.')."</td>";
  echo "<td align='right'>".number_format($row[7],0,',','.')."</td>";
  echo "</tr>";
  }
   ?>
 </table>
 <br>
 <br>
 

 
 



<table cellspacing="10">
<tr><td>

<form action="dohapus.php" method="post">
<input type="hidden" name="kode" value="<? echo $_GET['kode']; ?>">
<input class="statx" type="submit" value="Yakin">
</form>


</td></tr>
<tr><td>

<a href="bukuhapus.php"><input class="yel" type="submit" value="Batal"></a>
</td></tr>

</table>
</body>
</html>