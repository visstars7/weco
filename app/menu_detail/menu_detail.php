<?php 

session_start();

include_once 'helper/helper.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $pdo = PDO();
    $pdoStatementProduk = $pdo->prepare("SELECT tbproduk.*,tbkategori.nama_ktg FROM tbproduk INNER JOIN tbkategori ON tbproduk.kategori_id = tbkategori.kategori_id WHERE produk_id = :id");
    $pdoStatementProduk->bindParam(":id",$id);
    $pdoStatementProduk->execute();
    $result = $pdoStatementProduk->fetchAll(PDO::FETCH_ASSOC);

}else{
    header('Location:../menu/menu.php');
}

?>

<div id="frame-card-product">
    <?php foreach($result AS $row): ?>
    <div class="card-product">

        <img class="gambar-content mt-3 mb-2" src="menu_detail/view-image.php?id=<?=$row['produk_id'];?>" alt="<?=$row['nama_produk'];?>">

        <div class="row">

            <div class="col-md-6 col-xs-6 col-6">
                <p class="nama-produk abel-font text-brown"><?=$row['nama_produk'];?></p>
            </div>
            <?php if(!isset($_SESSION['user'])): ?>
            <div class="col-md-6 col-xs-6 col-6 btn-keranjang">
                <a class="btn btn-primary btn-md" href="#">+Login dahulu</a>
            </div>
            <?php else: ?>
            <div class="col-md-6 col-xs-6 col-6 btn-keranjang">
            <a class="btn btn-primary btn-md" href="keranjang/insertKeranjang.php?id=<?=$row['produk_id']?>">+tambah keranjang</a>
            </div>
            <?php endif; ?>
        </div>

        <div class="row">
        
            <div class="col-md-6 col-xs-6 col-6">
                <p class="kategori-produk abel-font text-brown"><?=$row['nama_ktg'];?></p>
            </div>

            <div class="col-md-6 col-xs-6 col-6">
                <p class="harga-product abel-font text-brown" ><?=rupiah($row['harga']);?></p>
            </div>
        
        </div>

    </div>
    <?php endforeach; ?>


</div>
<?php foreach($result AS $row): ?>
    <div id="frame-content" class="text-brown ubuntu-font"><?= $row['deskripsi'] ?></div>
<?php endforeach; ?>