
<?php 

	$fileName = isset($_GET['list']) ? "modul/kategori/".$_GET['list'].".php" : false;
	$query = getAll("SELECT * FROM tbkategori ORDER BY kategori_id DESC");

	if(isset($_GET['pesan'])){
		$deleted = $_GET['pesan'] == "deleted" ? "<script>alert('sukses menghapus data')</script>" : "<script>alert('gagal menghapus data')</script>";

		echo $deleted;
	}

 ?>


<div id="frame-kategori">
	
	<div id="header-nav">
		
		<div class="row mt-2 mb-2">
			
			<div class="col-md-6 col-3">
				
				<?php if(!file_exists($fileName)): ?>

					<a href="index.php?page=kategori&list=insert_kategori" class="btn btn-primary noto-sans-font" >+Tambah</a>

				<?php endif; ?>

			</div>

			<div class="col-md-6 col-9">

				<form action="" method="post">

					<div id="frame-search">
						
						<input type="search" class="input-form noto-sans-font" name="search" placeholder="search kategori...">

						<button class="search-btn noto-sans-font"> Search </button>

					</div>
					

				</form>

			</div>

		</div>

	</div>


	<?php if(file_exists($fileName)): ?>

		<?php include_once $fileName; ?>

	<?php else: ?>

		<div class="main-content">
			
			<table class="table table-striped noto-sans-font text-brown">
				
				<tr>
					<th>No</th>
					<th>Kategori_id</th>
					<th class="text-center">Nama Kategori</th>
					<th class="text-center">Status</th>
					<th class="text-center">Action</th>

				</tr>

				<?php $i = 1 ?>
				<?php foreach($query AS $key): ?>
				<tr>

					<td><?= $i ?></td>
					<td><?=$key['kategori_id']?></td>
					<td class="text-center"><?= $key['nama_ktg'] ?></td>
					<td class="text-center"><?= $key['status'] ?></td>
					<td class="text-center">

						<a class="btn btn-info btn-sm" href="index.php?page=kategori&list=update_kategori&id=<?=$key['kategori_id']?>">Edit</a> | 

						<a class="btn btn-danger btn-sm" onclick="return confirm('yakin menghapus: <?=$key['nama_ktg']?> ')" href="index.php?page=kategori&list=delete_kategori&id=<?=$key['kategori_id']?>">Delete</a>

					</td>

				</tr>
				<?php $i++ ?>
				<?php endforeach; ?>

			</table>

		</div>

	<?php endif; ?>


</div>