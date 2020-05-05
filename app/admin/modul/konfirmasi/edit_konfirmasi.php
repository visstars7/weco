<?php 

if(isset($_GET['id'])){
    $prosesID = $_GET['id'];
    $pdo = PDO();
    $pdoStatementOrder = $pdo->prepare("SELECT * FROM tbonproses WHERE proses_id = :proses_id");
    $pdoStatementOrder->bindParam(":proses_id",$prosesID);
    $pdoStatementOrder->execute();
    $order = $pdoStatementOrder->fetchAll(PDO::FETCH_ASSOC);

    $qty = $order[0]['qty'];
    $produkID = $order[0]['produk_id'];

    $pdoStatementProduk = $pdo->prepare("SELECT * FROM tbproduk WHERE produk_id = :produk_id");
    $pdoStatementProduk->bindParam(":produk_id",$produkID);
    $pdoStatementProduk->execute();
    $Produk = $pdoStatementProduk->fetchAll(PDO::FETCH_ASSOC);

    $stok = $Produk[0]['stok'];
    $total = $stok - $qty;


    if(isset($_POST['kirim'])){
        $status = $_POST['opsi'];
        $pdoStatementUpdate = $pdo->prepare("UPDATE tbonproses SET status=:status WHERE proses_id = :proses_id");
        $pdoStatementUpdate->bindParam(":proses_id",$prosesID);
        $pdoStatementUpdate->bindParam(":status",$status);
        if($pdoStatementUpdate->execute()){
            if($order[0]['status'] > 2){
                 $pdoStatementProdukUpdate = $pdo->prepare("UPDATE tbproduk SET stok = :total WHERE produk_id = :produk_id");
                $pdoStatementProdukUpdate->bindParam(":produk_id",$produkID);
                $pdoStatementProdukUpdate->bindParam(":total",$total);
                if($pdoStatementProdukUpdate->execute()){
                    $_SESSION['alert'] = "sukses,mengupdate data";
                    header('Location:index.php?page=konfirmasi');
                }
            }
        }else{
            $_SESSION['alert'] = "gagal,mengupdate data";
            header('Location:index.php?page=konfirmasi');
        }

    }
}else{
    $_SESSION['alert'] = "Tidak boleh";
    header('Location:index.php?page=konfirmasi');
}


?>

<div class="container">


    <div class="row">

        <form action="" method="post">

            <div class="form-group">
            
                <select class="custom-select" name="opsi" id="opsi">
                
                    <option value="0">Belum Bayar</option>
                    <option value="1">Sedang Divalidasi</option>
                    <option value="2">Sedang Di proses</option>
                    <option value="3">Sedang Dikirim</option>
                
                </select>

            </div>

            <div class="from-group">
            
                <button name="kirim" class="btn btn-success">Edit</button>
            
            </div>

        </form>
    
    </div>


</div>