<?php 

include '../helper/helper.php';
session_start();

// cek apakah terdapat user id
if(isset($_GET['id'])){

    // masukan user id kedalam variable
    $id = $_GET['id'];
    // cek apakah ada session keranjang
    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang']:array();
    // menampilkan produk yang dipilih user
    $pdo = PDO();
    $pdoStatementView = $pdo->prepare("SELECT produk_id,nama_produk,gambar,tipe_file,harga,berat,stok FROM tbproduk WHERE produk_id = :id");
    $pdoStatementView->bindParam(":id",$id);
    $pdoStatementView->execute();
    $result = $pdoStatementView->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($result AS $key){
        
        // memasukan produk kedalam array dengan index id barang
        $keranjang[$id] = array("produk_id"=>$key['produk_id'],
                                "nama_produk"=>$key['nama_produk'],        
                                "gambar"=>$key['gambar'],
                                "tipe_file" => $key['tipe_file'],
                                "harga"=>$key['harga'],
                                "berat"=>$key['berat'],
                                "stok"=>$key['stok'],
                                "qty"=>1);

    }

    // array dimaksukkan kedalam session keranjang
    $_SESSION['keranjang'] = $keranjang;
    header('Location:../index.php?page=menu');
}else{
    header('Location:../index.php?page=menu');
}

?>