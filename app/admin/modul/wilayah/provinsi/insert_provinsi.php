<?php

if(isset($_POST['insert'])){

	$name = $_POST['name'];
	$conn = conn();
	$jarak = $_POST['jarak'];
	mysqli_query($conn,"INSERT INTO tbprovinsi (`prov_id`,`nama_prov`,`jarak`,`status`) VALUES (NULL,'$name',$jarak,'on')");

	if(mysqli_affected_rows($conn) > 0){
		$_SESSION['message'] = "<script>alert('data provinsi berhasil ditambahkan')</script>";
		header('Location:index.php?page=wilayah');
	}
}
?>

<div id="frame-insert-kategori">
	
	<div id="main-frame">
		
		<form action="" method="post">
			
			<div class="form-group">
				
				<input class="form-control w-50" type="text" name="name" placeholder="Nama provinsi">

			</div>

			<div class="form-group">
				
				<input class="form-control w-50" type="number" name="jarak" placeholder="jarak">

			</div>

			<div class="form-group">
				
				<button name="insert" onclick="return confirm('Tekan oke untuk melanjutkan')" class=" btn btn-success form-control w-50" >Submit</button>

			</div>

		</form>

	</div>


</div>