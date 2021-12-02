<?php
include('../dbcon.php');
dbcon();

$queryp = mysql_query("SELECT * FROM provinsi WHERE id_provinsi = '$_POST[provinsi]'");
$rowp = mysql_fetch_array($queryp);
$provinsi = $rowp['nama_provinsi'];

$queryk = mysql_query("SELECT * FROM kota WHERE id_kota = '$_POST[kota]'");
$rowk = mysql_fetch_array($queryk);
$kota = $rowk['nama_kota'];

$query = mysql_query("insert into tb_kontak_usul(id_user, nama_kontak, alamat_kontak, kota_kontak, provinsi_kontak, cp_kontak, telepon_kontak, fax_kontak, email_kontak, status_kontak, tanggal_kontak, pembuat) values ('$_POST[id_usr]', '$_POST[nama]','$_POST[alamat]','$kota','$provinsi','$_POST[cp]','$_POST[telepon]','$_POST[fax]','$_POST[email]', 'menunggu', NOW(), '$_POST[user]')") or die(mysql_error());

if ($query) {
    header("location:index.php?page=data_usul");
}
