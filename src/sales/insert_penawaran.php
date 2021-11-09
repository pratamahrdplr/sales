<?php
include('../dbcon.php');
dbcon();
				
$oras = strtotime("now");
$newdate2 = strtotime ( 'next month' , $oras  ) ; 
$newdate = date("Y/m/d H:m:s",$newdate2);

$query1=mysql_query("update tb_kontak_all set id_user ='$_POST[id_usr]', nama_kontak = '$_POST[nama]', alamat_kontak = '$_POST[alamat]', kota_kontak = '$_POST[kota]', provinsi_kontak = '$_POST[provinsi]', telepon_kontak = '$_POST[telepon]', telepon_kontak2 = '$_POST[telepon2]', fax_kontak = '$_POST[fax]', email_kontak = '$_POST[email]',  cp_kontak = '$_POST[cp]', status_kontak = 'telah dihubungi' ,  tanggal_telp = NOW(), tanggal_tempo = '$newdate', report_kontak = 'I' , ket_kontak = 'penawaran', tanggal_bagi = NOW() where id_kontak = '$_POST[id_pel]'") or die (mysql_error());


$query=mysql_query("insert into tb_penawaran (id_kontak ,id_user, harga_penawaran, tanggal_penawaran, tempo_penawaran, pajak, pembayaran, status_penawaran, ket_penawaran, syarat_penawaran) values ('$_POST[id_pel]', '$_POST[id_usr]','$_POST[harga]',NOW(), '$newdate', '$_POST[pajak]','$_POST[pembayaran]', 'pending' , '$_POST[respon]', '$_POST[respon]' )") or die (mysql_error());


$query_user = mysql_query("SELECT * FROM tb_admin WHERE username_admin ='$username' AND password_admin='$password'")or die(mysql_error());
		$num_row_user = mysql_num_rows($query_user);
		$row_user = mysql_fetch_array($query_user);





if($query){
$query2=mysql_query("insert into tb_set (id_user, id_kontak, tgl_set) values ('$_POST[id_usr]','$_POST[id_pel]', NOW())") or die (mysql_error());

echo"<script>alert('Berhasil Membuat Penawaran')</script>";
	echo"<meta http-equiv='refresh' content='0;url=./?page=penawaran_pending'>";
	
} else {
echo"<script>alert('Gagal Membuat Penawaran')</script>";
	echo"<meta http-equiv='refresh' content='0;url=./?page=data_kontak'>";

}

?>
