
<?php 

include_once 'helper/helper.php';

// PDO

$PDO = PDO();
$sql = "SELECT tbproduk.*,tbkategori.* FROM tbproduk INNER JOIN tbkategori ON tbproduk.kategori_id = tbkategori.kategori_id";
$pdoStatementProduk = $PDO->prepare($sql);
$pdoStatementProduk->execute();
$query = $pdoStatementProduk->fetchAll(PDO::FETCH_ASSOC);

$pdoStatementKtg = $PDO->prepare("SELECT * FROM tbkategori");
$pdoStatementKtg->execute();
$kategori = $pdoStatementKtg->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET['id'])){

    $sql = "SELECT tbproduk.*,tbkategori.* FROM tbproduk INNER JOIN tbkategori ON tbproduk.kategori_id = tbkategori.kategori_id WHERE tbproduk.kategori_id = :kategori_id";
    $pdoStatementProduk = $PDO->prepare($sql);
    $pdoStatementProduk->bindParam(':kategori_id',intval($_GET['id']));
    // $query_execute[':kategori_id'] = intval($_GET['id']);
    $pdoStatementProduk->execute();
    $query = $pdoStatementProduk->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($pdoStatementProduk->execute());

}


// mysqli
// $query = getAll("SELECT tbproduk.*,tbkategori.* FROM tbproduk INNER JOIN tbkategori ON tbproduk.kategori_id = tbkategori.kategori_id");
// $kategori = getAll("SELECT * FROM tbkategori");

// if(isset($_GET['id'])){
//     $id = $_GET['id'];
//     $query = getAll("SELECT tbproduk.*,tbkategori.* FROM tbproduk INNER JOIN tbkategori ON tbproduk.kategori_id = tbkategori.kategori_id WHERE tbproduk.kategori_id = $id");
// }

?>

<div id="header-frame-content">

    <h3 class="text-center blue-color">Our Coffe Menu</h3>
    
    <div class="underline"></div>

</div>

<div class="frame-content">

    <div class="row mt-5">

        <div class="col-md-3 col-sm-6 col-12">

        <!-- untuk layar mobile menggunakan dropdown -->
            <div class="dropdown hidden">
                
                <button onclick="Myfunction()" class="btn btn-dropdown">kategori</button>

                <div id="drop-item" class="dropdown-content">
                    <?php foreach($kategori AS $key): ?>
                    <a href="index.php?page=menu&id=<?=$key['kategori_id']?>"><?= $key['nama_ktg']; ?></a>
                    <?php endforeach; ?>

                </div>

            </div>
        <!-- untuk layar desktop = tablet menggunakan sidebar -->

            <div id="sidebar-desktop">
                <ul>
                    
                    <?php foreach($kategori AS $key): ?>
                    <li>

                        <a href="index.php?page=menu&id=<?=$key['kategori_id']?>"><?= $key['nama_ktg'] ?></a>
                        
                    </li>
                    <?php endforeach; ?>

                </ul>


            </div>

        </div>

        <div class="col-md-9 col-sm-6 col-12">
            
            <div class="frame-content-menu">
                <?php foreach($query AS $key): ?>
                <div class="card-menu">

                    <a href="index.php?page=menu_detail&id=<?=$key['produk_id']?>">

                        <img src="menu/view-image.php?id=<?=$key['produk_id']?>" alt="<?=$key['nama_produk']?>">

                    </a>
                    
                    <p id="label-product"><?=$key['nama_produk'];?></p>
                    <p id="label-harga"><?=$key['harga'];?></p>
                    <p id="label-kategori"><?= $key['nama_ktg']; ?></p>
                    <div class="underline"></div>
                </div>
                <?php endforeach; ?>
            </div>
            
        </div>

    </div>

</div>

<script>

    function Myfunction(){
        document.getElementById("drop-item").classList.toggle("show");
    }

</script>