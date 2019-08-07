<?php 
		include 'database.php';  // jika beda sesuai dengan config anda

		if(isset($_POST['submit'])){
			
			$tanggal = date('d F Y');
			$id_member = $_POST['id_member']; 
			$toko = $_POST['toko'];
			$ekstensi_diperbolehkan	= array('png','jpg');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];	
 
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, '../images/'.$nama);
					$query = mysqli_query($koneksi, "INSERT INTO struk(tanggal, id_member  ,toko,  foto,totalbelanja, status, keterangan) VALUES('$tanggal', '$id_member', '$toko', '$nama', 'Proses', 'Sedang di Proses','Sedang di Proses' )");
					if($query){
						echo ' 
						 <script>
        					alert("Berhasil Ditambahkan!");
        					window.location = "../use/inputstruk.php"
      					 </script>';
					}else{
						echo '<script>
        					alert("Gagal Ditambahkan!");
        					window.location = "../admin/page/konseling.php"
      					 	</script>';
					}
				}else{
					echo '<script>
        					alert("File Terlalu Besar!!!");
        					
      					 </script>';
				}
			}
			else{
				echo '<script>
        					alert(Ekstensi File Tidak Diperbolehkan!!);
        			  </script>';
			}
		}
		?>
