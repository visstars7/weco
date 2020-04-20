
<?php
	
	// menampilkan data query
	if(isset($_GET['id'])){
		$id = intval($_GET['id']);
		$query = getAll("SELECT * FROM tbkategori WHERE kategori_id = $id");
	}

	// update data
	if(isset($_POST['submit'])){
		$connected = conn();
		$nama = $_POST['kategori'];
		$status = $_POST['status'];

		$sql = "UPDATE `tbkategori` SET `nama_ktg` = '$nama', `status` = '$status' WHERE `kategori_id` = $id";
		echo $sql;
		if(mysqli_query($connected,$sql) ==  1 ){
			header('Location:index.php?page=kategori');
		}else{
			echo "<script>alert('Maaf, gagal mengupdate data')</script>";
		}
	}

?>

<div id="frame-form">
	
	<div id="form-content">
		
		<form method="post" action="">
			<?php foreach ($query AS $key): ?>
			<div class="form-group">
				
				<input type="text" name="kategori" class="form-control w-25" autocomplete="off" value="<?=$key['nama_ktg']?>">

			</div>

			<div class="form-group">

				<label class="noto-sans-font text-brown" >on</label>
				<input type="radio" name="status" value="on" <?php if($key['status']=='on') echo "checked" ?> >
				<label class="noto-sans-font text-brown">off</label> 
				<input type="radio" name="status" value="off" <?php if($key['status']=='off') echo "checked" ?> >

			</div>

			<div class="form-group">
				
				<button class="btn btn-success" name="submit">Submit</button>

			</div>

			<?php endforeach; ?>

		</form>

	</div>

</div>