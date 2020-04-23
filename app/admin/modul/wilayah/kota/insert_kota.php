<?php 

if(isset($_POST['insert'])){
	$conn = conn();
	$nama = $_POST['name'];
	mysqli_query($conn,"INSERT INTO tbkota (`kota_id`,`nama_kota`,`status`) VALUES (NULL,'$nama','on')");
	if(mysqli_affected_rows($conn)>0){
		$_SESSION['message'] = "<script>alert('Data kota telah ditambahkan')</script>";
		Header('Location:index.php?page=wilayah');
	}
	Header('Location:index.php?page=wilayah');
}

?>

<div id="frame-insert-kategori">
	
	<div id="main-frame">
		
		<form action="" method="post">
			
			<div class="form-group">
				
				<input class="form-control w-50" type="text" name="name" placeholder="Nama Kota">

			</div>

			<div class="form-group">
				
				<button name="insert" onclick="return confirm('Tekan oke untuk melanjutkan')" class=" btn btn-success form-control w-50" >Submit</button>

			</div>

		</form>

	</div>


</div>