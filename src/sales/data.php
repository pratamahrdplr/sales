<?php
include('../dbcon.php');
dbcon()
$term = trim(strip_tags($_GET['term']));
��
$qstring = "SELECT * FROM tb_kontak_all WHERE nama_anime LIKE '".$term."%'";
//query database untuk mengecek tabel anime 
$result = mysql_query($qstring);
��
while ($row = mysql_fetch_array($result))
{
����$row['value']=htmlentities(stripslashes($row['nama_kontak']));
����$row['id']=(int)$row['id_kontak'];
//buat array yang nantinya akan di konversi ke json
����$row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>