
<?php 

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$conn = conn();
	$query = getAll("SELECT * FROM tbkota WHERE kota_id = $id");
	if(isset($_POST['submit'])){
		$kota = $_POST['kota'];
		$status = $_POST['status'];
		mysqli_query($conn,"UPDATE tbkota SET `nama_kota`='$kota',`status`='$status'");
		if(mysqli_affected_rows($conn)){
			$_SESSION['message'] = "<script>alert('Data kota telah diupdate')</script>";
			Header('Location:index.php?page=wilayah');
		}
	}
}else{
	$_SESSION['message'] = "<script>alert('tidak ada data id')</script>";
	Header('Location:index.php?page=wilayah');
}

?>
<div id="frame-form">
	<?php foreach($query AS $key): ?>
	<div id="form-content">
		
		<form method="post" action="">
			<div class="form-group">
				
				<input type="text" name="kota" class="form-control w-50" autocomplete="off" value="<?=$key['nama_kota']?>">

			</div>

			<div class="form-group">

				<label class="noto-sans-font text-brown">on</label>
				<input type="radio" <?php if($key['status']=="on") echo "checked" ?> name="status" value="on">
				<label class="noto-sans-font text-brown">off</label> 
				<input type="radio" <?php if($key['status']=="off") echo "checked" ?> name="status" value="off">

			</div>

			<div class="form-group">
				
				<button class="btn btn-success w-50" name="submit">Submit</button>

			</div>

		</form>

	</div>
	<?php endforeach; ?>

</div>