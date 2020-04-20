<?php 

$query = getAll("SELECT * FROM tbuser WHERE status ='on'");

// jika terdapat URL dengan data list maka ambil sebagai file_Name
$fileName = isset($_GET['list']) ? "modul/produk/".$_GET['list'].".php" : false;

?>

<div id="frame-nav-product" class="row mt-2">

    <div class="col-md-6 col-sm-6">
            
            <a name="tambah" href="?page=produk&list=insert_produk" class="btn btn-primary noto-sans-font float-left" >+Tambah</a>

    </div>

    <div class="col-md-6 col-sm-6">
    
        <form action="" method="post">

            <div id="frame-search">
            
                <input type="search" class="input-form noto-sans-font" placeholder="Search Produk..">
                <button name="search" class="search-btn noto-sans-font">search</button>

            </div>

        </form>

    </div>


</div>

<div id="frame-main-product">

    <?php if(file_exists($fileName)): ?>

        <?php include_once $fileName; ?>

    <?php else: ?>
        <div class="table-responsive">
            
            <table class="table table-striped noto-sans-font mt-2">
            
                <tr>

                    <th class="text-center">No</th>
                    <th class="text-center">Produk Id</th>
                    <th class="text-center">Nama Produk</th>
                    <th  class="text-center">kategori</th>
                    <th class="text-center">Gambar Produk</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">stok</th>
                    <th class="text-center">status</th>
                    <th class="text-center">Aksi</th>

                </tr>

                <?php $i = 1 ?>
                <?php foreach($query AS $key): ?>
                <tr>
                        <td class="text-center"><?= $i ?></td>
                        <td class="text-center"><?= $key['produk_id'] ?></td>
                        <td class="text-center"><?= $key['nama_produk'] ?></td>
                        <td class="text-center"><?= $key['kategori_id'] ?></td>
                        <td class="text-center"><img src="<?=BASE_URL?>/resource/img/<?=$key['gambar']?>" alt="<?=$key['nama_produk']?>.png"></td>
                        <td class="text-center"><?= $key['harga'] ?></td>
                        <td class="text-center"><?= $key['stok'] ?></td>
                        <td class="text-center"><?= $key['status'] ?></td>
                        <td class="text-center"><a class="btn btn-sm btn-info" href="?page=produk&list=update_produk">Edit</a> | <a class="btn btn-sm btn-danger" href="?page=produk&list=delete_produk">Delete</a></td>

                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            
            </table>

        </div>

    <?php endif; ?>

</div>

