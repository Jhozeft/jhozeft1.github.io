<html>
<head>
<title>Daftar Rekening</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="smart.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body bgcolor=#def>	

<?
session_start();
if (empty($_SESSION['user']))
{ 	echo "User Kosong"; header( 'Location: index.html' ); }
$tanggal=date('d-m-Y');
include "db.inc";
$today = date("Y-m-d");
$today2 = date("Y-m");
?>
<body>
<h3>Daftar Rekening  
</h3>
<? 


//$today=$tg1."-".$tg2."-".$tg3;
//echo "<br>";
// Create connection


//$result = mysqli_query($con,"SELECT * FROM bayar where tgljam like '2014-08-28%'");
//$result = mysqli_query($con,"select uraian,jumlah,tarif,jumlah*tarif as total,polidok,jenis from tagihan where tglkasir like '".$today."%' order by polidok asc, uraian asc");
//$result = mysqli_query($con,"SELECT * FROM kas2 where tanggal like '".$today."%'");
//$result = mysqli_query($con,"SELECT * FROM kas where Tanggal like '".$today2."%' and unit='".$_SESSION['user']."' order by Tanggal, id asc");

$result = mysqli_query($con,"SELECT * FROM rekening where  kelompok='komunitas' order by rekening asc");

$tdeb=0;
$tkre=0;
?>
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
echo "<td>No</td><td>Rekening</td><td>Nama Rekening</td>";
while($row = mysqli_fetch_array($result))
  {

 $no=$no+1; 



  echo "<tr>";
  echo "<td>".$no . "</td>";
  echo "<td>".$row['rekening'] . "</td>";
  echo "<td>".$row['nama_rekening'] . "</td>";
  echo "</tr>";
  }
  
  
echo "</table>";
mysqli_close($con);
echo "<br><br>";
?>


<br><br><br><b>
</b><hr>
<a href="halamanutama.php"><input style="height:35px; font-size:14pt;"type="submit" value="Menu Utama"></a>

</body>
</html>
