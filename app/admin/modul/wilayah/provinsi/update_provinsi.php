
<?php 

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$query = getAll("SELECT * FROM tbprovinsi WHERE prov_id = $id");
	if(isset($_POST['submit'])){
		
		$conn = conn();	
		$prov = $_POST['provinsi'];
		$jarak = $_POST['jarak'];
		$status = $_POST['status'];
		mysqli_query($conn,"UPDATE tbprovinsi SET `nama_prov`='$prov',`jarak`=$jarak,`status`='$status'");
		if(mysqli_affected_rows($conn)>0){
			$_SESSION['message'] = "<script>alert('data provinsi berhasil terupdate')</script>";
			header('Location:index.php?page=wilayah');
		}

	}
}else{
    header('Location:index.php?page=wilayah');
}

?>

<div id="frame-form">
	<?php foreach($query AS $key): ?>
	<div id="form-content">
		
		<form method="post" action="">
			<div class="form-group">
				
				<input type="text" name="provinsi" class="form-control w-50" autocomplete="off" value="<?=$key['nama_prov']?>">

			</div>

			<div class="form-group">
				
				<input type="number" name="jarak" class="form-control w-50" autocomplete="off" value="<?=$key['jarak']?>">

			</div>

			<div class="form-group">

				<label class="noto-sans-font text-brown">on</label>
				<input type="radio" <?php if($key['status'] == "on") echo "checked"?> name="status" value="on">
				<label class="noto-sans-font text-brown">off</label> 
				<input type="radio" <?php if($key['status'] == "off") echo "checked"?> name="status" value="off">

			</div>

			<div class="form-group">
				
				<button class="btn btn-success w-50" name="submit">Submit</button>

			</div>

		</form>

	</div>
	<?php endforeach; ?>

</div>