<?php 

	if(isset($_GET['id'])){

		$id = intval($_GET['id']);
		$connected = conn();
		// $pean = mysqli_query("DELETE FROM tbkategori WHERE kategori_id = $id");

		// var_dump($pean); 

		if(mysqli_query($connected," DELETE FROM tbkategori WHERE kategori_id = $id") == 1){
			Header('Location:index.php?page=kategori&pesan=deleted');
		}else{
			Header('Location:index.php?page=kategori&pesan=undeleted');
		}
	}

 ?>