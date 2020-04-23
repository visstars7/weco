<?php 

$query = getAll("SELECT tbproduk.*,tbkategori.* FROM tbproduk INNER JOIN tbkategori ON tbproduk.kategori_id = tbkategori.kategori_id ORDER BY produk_id DESC");

// jika terdapat URL dengan data list maka ambil sebagai file_Name
$fileName = isset($_GET['list']) ? "modul/produk/".$_GET['list'].".php" : false;

$pesan = isset($_GET['pesan']) ? "<script>alert('barang sudah terhapus')</script>" : false ; 

if(isset($_SESSION['error'])){

    echo "<script>alert('".$_SESSION['error'].".')</script>";

    unset($_SESSION['error']);
} 

echo $pesan;

?>

<div id="frame-nav-product" class="row mt-2">
    <?php if(!file_exists($fileName)): ?>
    <div class="col-md-6 col-sm-5 col-3">
            
            <a name="tambah" href="?page=produk&list=insert_produk" class="btn btn-primary noto-sans-font float-left" >+Tambah</a>

    </div>

    <div class="col-md-6 col-sm-7 col-9">
    
        <form action="" method="post">

            <div id="frame-search">
            
                <input type="search" class="input-form noto-sans-font" placeholder="Search Produk..">
                <button name="search" class="search-btn noto-sans-font">search</button>

            </div>

        </form>

    </div>
    <?php endif; ?>

</div>

<div id="frame-main-product">

    <?php if(file_exists($fileName)): ?>

        <?php include_once $fileName; ?>

    <?php else: ?>
        <div class="table-responsive">
            
            <table class="table text-brown table-striped noto-sans-font mt-2">
            
                <tr>

                    <th class="text-center">No</th>
                    <th class="text-center">Produk Id</th>
                    <th class="text-center">Nama Produk</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Berat</th>
                    <th class="text-center">Gambar Produk</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>

                </tr>

                <?php $i = 1 ?>
                <?php foreach($query AS $key): ?>
                <tr>
                        <td class="text-center"><?= $i ?></td>
                        <td class="text-center"><?= $key['produk_id'] ?></td>
                        <td class="text-center"><?= $key['nama_produk'] ?></td>
                        <td class="text-center"><?= $key['nama_ktg'] ?></td>
                        <td class="text-center"><?= number_format($key['berat']) ?>gram</td>
                        <td class="text-center"><img src="modul/produk/view_images.php?id=<?=$key['produk_id']?>" alt="<?=$key['nama_produk']?>.png" style="width:100px"></td>
                        <td class="text-center"><?= rupiah($key['harga']) ?></td>
                        <td class="text-center"><?= $key['stok'] ?>pcs</td>
                        <td class="text-center"><?= $key['status'] ?></td>
                        <td class="text-center"><a class="btn btn-sm btn-info" href="?page=produk&list=update_produk&id=<?=$key['produk_id']?>">Edit</a> | <a class="btn btn-sm btn-danger" onclick="return confirm('yakin menghapus produk?')" href="?page=produk&list=delete_produk&id=<?=$key['produk_id']?>">Delete</a></td>

                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            
            </table>

        </div>

    <?php endif; ?>

</div>

