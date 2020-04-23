<?php 

if(isset($_POST['insert'])){
	$ktg_name = $_POST['name'];
	$koneksi = conn();
	$sql = "INSERT INTO tbkategori (`kategori_id`,`nama_ktg`,`status`) VALUES (NULL,'$ktg_name','on')";
	$query = mysqli_query($koneksi,$sql);

	if(mysqli_affected_rows($koneksi) > 0){
		Header('Location:index.php?page=kategori');
	}else{
		echo "<script>alert('Maaf, gagal menambah kategori')</script>";
	}
}

 ?>

<div id="frame-insert-kategori">
	
	<div id="main-frame">
		
		<form action="" method="post">
			
			<div class="form-group">
				
				<input class="form-control w-50 ml-3" type="text" name="name" placeholder="Nama Kategori">

			</div>

			<div class="form-group">
				
				<button name="insert" onclick="return confirm('Tekan oke untuk melanjutkan')" class=" btn btn-success form-control w-50 ml-3" >Submit</button>

			</div>

		</form>

	</div>


</div>