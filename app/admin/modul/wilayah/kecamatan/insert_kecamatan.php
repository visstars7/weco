
<?php 

$query = getAll("SELECT * FROM tbkecamatan");
if(isset($_POST['insert'])){
	$nama = $_POST['name'];
	$conn = conn();
	mysqli_query($conn,"INSERT INTO tbkecamatan (`kec_id`,`nama_kec`,`status`) VALUES (NULL,'$nama','on')");
	if(mysqli_affected_rows($conn)){
		$_SESSION['message'] = "<script>alert('Data kecamatan telah ditambahkan')</script>";
		Header('Location:index.php?page=wilayah');
	}
}

?>
<div id="frame-insert-kategori">
	
	<div id="main-frame">
		
		<form action="" method="post">
			
			<div class="form-group">
				
				<input class="form-control w-50" type="text" name="name" placeholder="Nama Kecamatan">

			</div>

			<div class="form-group">
				
				<button name="insert" onclick="return confirm('Tekan oke untuk melanjutkan')" class=" btn btn-success form-control w-50" >Submit</button>

			</div>

		</form>

	</div>


</div>