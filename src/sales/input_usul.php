<link rel="stylesheet" href="js/jquery-ui.css">
  <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-1.6.4.js"></script>
  <script src="js/jquery-ui.js"></script>

  <?php
   $user_query = mysql_query("select nama_kontak from tb_kontak_all ")or die(mysql_error());
                    while($row_user = mysql_fetch_array($user_query, MYSQL_ASSOC)){

					
					$output[] = $row_user['nama_kontak'];
			
					}
					
					
					
?>					

<script>
var data = <?php echo json_encode($output); ?>;
  $( function() {
    $( "#nama" ).autocomplete({
      source: data
    });
  } );
  </script>
</head>
<body>
  <?php
						$session_user = $_SESSION['user'];

	
		?>  
<div class="ui-widget">
   <form role="form" action="insert_usul.php" enctype="multipart/form-data" method="post">
                  <input name="id_usr" type="hidden" value="<?php echo $session_user; ?>" />
                                   <input name="user" type="hidden" value="<?php echo $user_username; ?>" />

                    <!-- text input -->
                                        <div class="form-group">
                      <label>Nama Perusahaan </label>
                      <input type="text" class="form-control" placeholder="Masukan Nama..." name="nama" value="" required>
                    </div>
                    <div class="form-group">
                      <label>Alamat</label>
                      <input type="text" class="form-control" placeholder="Masukan Alamat..." name="alamat" value="" required>
                    </div>
					 <div class="form-group">
                     <label>Provinsi</label>
                      <select id="provinsi" name="provinsi">
                <option value="">Pilih Provinsi</option>
                <?php
                $query = mysql_query("SELECT * FROM provinsi ORDER BY nama_provinsi");
                while ($row = mysql_fetch_array($query)) {
                ?>
                    <option value="<?php echo $row['id_provinsi']; ?>">
                        <?php echo $row['nama_provinsi']; ?>
                    </option>
                <?php
                }
                ?>
            </select>
                    </div>
                     <div class="form-group">
                     <label>Kota</label>
                      <select id="kota" name="kota">
                <option value="">Pilih Kota</option>
                <?php
                $query = mysql_query("SELECT * FROM kota INNER JOIN provinsi ON kota.id_provinsi = provinsi.id_provinsi ORDER BY nama_kota");
                while ($row = mysql_fetch_array($query)) {
                ?>
                    <option id="kota" class="<?php echo $row['id_provinsi']; ?>" value="<?php echo $row['id_kota']; ?>">
                        <?php echo $row['nama_kota']; ?>
                    </option>
                <?php
                }
                ?>
            </select>
                      </div>
					 
					<div class="form-group">
                      <label>Nama Purchasing</label>
                      <input type="text" class="form-control" placeholder="Masukan Nama Purchasing ..." name="cp" value="" required>
                    </div>
                    <div class="form-group">
                      <label>Telp. Perusahaan</label>
                      <input type="text" class="form-control" placeholder="Masukan Telp..." name="telepon" value="" required>
                    </div>
                     <div class="form-group">
                      <label>Fax</label>
                      <input type="text" class="form-control" placeholder="Masukan Fax ..." name="fax" value="" >
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control " placeholder="Masukan Email ..." name="email" value="" >
                    </div>
                    
                   
                  
<div class="panel-footer">
                    <button type="submit" class="btn btn-success">Usulkan</button>
                  </div>


                  </form>
                  <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#kota").chained("#provinsi");
            $("#kecamatan").chained("#kota");
        </script>
  </div>