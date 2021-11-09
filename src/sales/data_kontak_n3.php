
 <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
    <div class="x_title">
        <h2>Searching Data</h2>
    <div class="clearfix"></div>
    </div>
    <div class="x_content">   
        <?php
            $pencarian_nama = $_POST["pencarian_nama"];
            $pencarian_kota = $_POST["pencarian_kota"];
        ?> 
<p class="text-muted font-13 m-b-30">
<div class="btn-group">
<a class="btn btn-primary" href="?page=data_kontak"> Tracking </a>
<a class="btn btn-warning" href="?page=data_s"> Searching Data </a>
 <a class="btn btn-primary" href="?page=data_kontak_th"> Telah dihubungi </a>
  <a class="btn btn-primary" href="?page=data_penawaran"> Penawaran Anda</a>
    <a class="btn btn-primary" href="?page=data_po"> PO Anda</a>
      <a class="btn btn-primary" href="?page=data_kirim"> Pengiriman</a>
        <a class="btn btn-primary" href="?page=data_bayar"> Pembayaran</a>
  </div>
</p>
<p class="text-muted font-13 m-b-30">
<div class="btn-group"></div>
</p>
<form action="" class="form-horizontal form" enctype="multipart/form-data" method="post">
<div class="form-group">
<label for="pencarian">Pencarian : </label>
<input type="text" class="input" id="pencarian_nama" name="pencarian_nama"/>
<label>Kota</label>
                <select id="pencarian_kota" name="pencarian_kota" >
                <option value="">Please Select</option>
                <?php
                $queryk = mysql_query("SELECT * FROM kota  where id_provinsi IN ('3', '6') ORDER BY nama_kota ");
                while ($rowk = mysql_fetch_array($queryk)) {
                ?>
                    <option  value="<?php echo $rowk['nama_kota']; ?>">
                        <?php echo $rowk['nama_kota']; ?>
                    </option>
                <?php
                }
		
                ?>
</select>
<button type="submit" class="btn btn-xs btn-success" > Cari </button>
</div>
</form>
<table id="datatable-responsive"class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th width="20%">Nama</th>
        <th width="12%">status</th>
        <th width="15%">ket</th>
        <th width="16%">sales</th>
        <th width="16%">experied</th>
        <th width="7%">Telepon</th>
    </tr>
    </thead>
    <tbody>
    
    <?php
        $session_user=$_SESSION['user'];

        // Searching processing
        if(!empty($pencarian_nama)){
$kontak_query = mysql_query("select * from tb_kontak_all where  nama_kontak like '%$pencarian_nama%' and kode_kontak not like 'PO %' and kota_kontak IN ('majalengka','kuningan','karawang','indramayu','garut','cianjur','ciamis','bandung barat','purwakarta','subang','tasikmalaya','sukabumi','depok','cimahi','cirebon','bogor','bekasi','banjar','sumedang','bandung','banten','tangerang')  or telepon_kontak like '%$pencarian_nama%' and kode_kontak not like 'PO %' and  kota_kontak IN ('majalengka','kuningan','karawang','indramayu','garut','cianjur','ciamis','bandung barat','purwakarta','subang','tasikmalaya','sukabumi','depok','cimahi','cirebon','bogor','bekasi','banjar','sumedang','bandung','banten','tangerang') or email_kontak like '%$pencarian_nama%' and kota_kontak IN ('majalengka','kuningan','karawang','indramayu','garut','cianjur','ciamis','bandung barat','purwakarta','subang','tasikmalaya','sukabumi','depok','cimahi','cirebon','bogor','bekasi','banjar','sumedang','bandung','banten','tangerang') or alamat_kontak like '%$pencarian_nama%' and kota_kontak IN ('majalengka','kuningan','karawang','indramayu','garut','cianjur','ciamis','bandung barat','purwakarta','subang','tasikmalaya','sukabumi','depok','cimahi','cirebon','bogor','bekasi','banjar','sumedang','bandung','banten','tangerang') limit 500 ")or die(mysql_error());
            $pencarian_nama = '';
        }else {
			$kontak_query = mysql_query("select * from tb_kontak_all where kota_kontak like '%$pencarian_kota%' and kode_kontak not like 'PO %' and kota_kontak IN ('majalengka','kuningan','karawang','indramayu','garut','cianjur','ciamis','bandung barat','purwakarta','subang','tasikmalaya','sukabumi','depok','cimahi','cirebon','bogor','bekasi','banjar','sumedang','bandung','banten','tangerang')  limit 500")or die(mysql_error());
		} 

        while($row = mysql_fetch_array($kontak_query)){

            $user_query = mysql_query("select id_user , nama_user from tb_user where id_user = '$row[id_user]'")or die(mysql_error());
            $row_user = mysql_fetch_array($user_query);
            $penawaran_query = mysql_query("select tempo_penawaran from tb_penawaran where id_kontak = '$row[id_kontak]' order by tempo_penawaran DESC LIMIT 1")or die(mysql_error());
            $row_penawaran = mysql_fetch_array($penawaran_query);
        
		$user_query = mysql_query("select * from tb_user where id_user = '$session_id'")or die(mysql_error());
$user_row = mysql_fetch_array($user_query);
    ?>
    <tr>
        <td><?php echo $row['nama_kontak']; ?>(<?php echo $row['telepon_kontak']; ?>)</a><br />
    <?php echo $row['kota_kontak']; ?> (<?php echo $row['email_kontak']; ?>)</td>
        <td><?php 
    if($row['status_kontak']=='telah dihubungi')
    {
    echo '<div class="label label-success"><i class="icon-check"></i><strong>'.$row['status_kontak'].'</strong></div>';
    }
    else if($row['status_kontak']=='belum dihubungi')
    {
    echo '<div class="label label-danger"><i class="icon-ok"></i><strong>'.$row['status_kontak'].'</strong></div>';
    }
    else
    {
    echo '<div class="success"><i class="icon-remove-sign"></i><strong>'.$row['status_kontak'].'</strong></div>';
    };
    
    ?></td>
        <td><?php echo $row['report_kontak']; ?></td>
        <td><?php echo $row_user['nama_user']; ?>
        <?php echo "<br/><small>(" . $row_user['kota'] . ")</small>";  ?></td>
        <td><?php echo $row['tanggal_tempo']; ?></td>
        <td><?php 
	
$oras = strtotime("now");
$ora = date("Y-m-d",$oras);
    if($row['report_kontak']=='I')
    {if($row['tanggal_tempo']>$ora){
		echo '<a href="#" class="btn btn-danger disabled btn-block" data-toggle="modal" data-target="#telepon'.$row['id_kontak'].'" ><i class="fa fa-phone" > sedang penawaran</i>';
	}else {
    echo '<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#telepon'.$row['id_kontak'].'" ><i class="fa fa-phone" > telpon</i>';
    }
	}
    else if($row['report_kontak']=='po')
    {
		echo '<a href="#" class="btn btn-danger disabled btn-block" data-toggle="modal" data-target="#telepon'.$row['id_kontak'].'" ><i class="fa fa-phone" > sudah PO </i>';
    }else{
		echo '<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#telepon'.$row['id_kontak'].'" ><i class="fa fa-phone">Telpon</i></td>';
	}    ;
				
    ?></td>
       
    </tr>
	<!--MOdalll awallll  -->   
<div class="modal fade" id="telepon<?php echo $row['id_kontak']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-color-blue">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">1.) Telepon Perusahaan </h4>
</div>
<div class="modal-body">
<h3>Calling <?php echo $row['telepon_kontak']; ?> ( <?php echo $row['nama_kontak']; ?> )</h3>
</div>
<div class="modal-footer">

<input name="Tidak Terhubung" type="submit" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#tidak_terhubung<?php echo $row['id_kontak']; ?>" value="Tidak Terhubung"/>

<a href="#" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" data-target="#terhubung<?php echo $row['id_kontak']; ?>" >Terhubung</a>
</div>
</div>
</div>
</div>         

<!--Modal 2 -->
<div class="modal fade" id="terhubung<?php echo $row['id_kontak']; ?>" tabindex="-2" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-color-blue">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">2.) Penawaran </h4>
</div>
<div class="modal-body">
<h3><?php echo $user_row['nama_user']; ?> Selling... <?php echo $row['nama_kontak']; ?></h3>

</div>
<div class="modal-footer">
<a href="#" class="btn btn-danger" data-toggle="modal" data-dismiss="modal" data-target="#penawaran_ditolak<?php echo $row['id_kontak']; ?>" >Penawaran di Tolak</a>

<a href="?page=telpon&id_kontak=<?php echo $row['id_kontak']; ?>" class="btn btn-primary">Penawaran Diterima</a>
</div>
</div>
</div>
</div>         
<!--Akhir Modal 2-->        


 <!--Modal 3    -->
  <div class="modal fade" id="penawaran_ditolak<?php echo $row['id_kontak']; ?>" tabindex="-3" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-color-blue">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Penawaran ditolak</h4>
</div>
<div class="modal-body">
<div class="panel panel-danger">
<div class="panel-heading">

</div><!-- /.panel-header -->
<div class="panel-body">
<form role="form" action="insert_feedback.php" enctype="multipart/form-data" method="post">
<!-- text input -->
<input name="id_pel" type="hidden" value="<?php echo $row['id_kontak']; ?>" />
<div class="form-group">
<label>Keterangan Feedback</label>
<p>
<label>
<input type="radio" name="respon" value="P" id="res0" checked="checked"/>
Tidak Pakai Solar</label>
<br />
<label>
<input type="radio" name="respon" value="S" id="res1" />
Kontrak PT Lain</label>
<br />
<label>
<input type="radio" name="respon" value="E" id="res2"/>
Pemakaian Minim</label>
<br />
<label>
<input type="radio" name="respon" value="O" id="res3"/>
Harga Kalah</label>
<br />

Keterangan :
<textarea name="ket" cols="50" rows="6"  class="form-control"></textarea>

</p>
</div>                                
    



<div class="panel-footer">
<button type="submit" class="btn btn-success">Submit </button>
</div>


</form>


</div><!-- /.panel-body -->
</div>

</div>
</div>
</div>
</div>  


<!--Modal 4 -->
<div class="modal fade" id="tidak_terhubung<?php echo $row['id_kontak']; ?>" tabindex="-4" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-color-blue">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> Keterangan Tidak Terhubung</h4>
</div>
  <form action="insert_tidak_terhubung.php" method="post">
  <input name="pelang" type="hidden" value="<?php echo $row['id_kontak']; ?>" />
<div class="modal-body">
<textarea name="respon" cols="50" rows="6"  class="form-control"></textarea>
</div>
<div class="modal-footer">
<input name="submit" type="submit" value="Submit" class="btn btn-danger" />

</form>
</div>
</div>
</div>
</div>         
<!--Akhir Modal 4-->   
<!--Modal 5 -->
<div class="modal fade" id="telepon_ulang<?php echo $row['id_kontak']; ?>" tabindex="-5" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-color-red">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> Keterangan Telepon Ulang</h4>
</div>
  <form action="insert_telepon_ulang.php" method="post">
  <input name="pelang" type="hidden" value="<?php echo $row['id_kontak']; ?>" />
<div class="modal-body">
<textarea name="respon" cols="50" rows="6"  class="form-control"></textarea>
</div>
<div class="modal-footer">
<input name="submit" type="submit" value="Submit" class="btn btn-danger" />

</form>
</div>
</div>
</div>
</div>         
<!--Akhir Modal 5-->   

   <?php } ?>  
    </tbody>
  </table>
</div>
</div>
</div>