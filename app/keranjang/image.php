<?php 

session_start();
include_once '../helper/helper.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $pdo = PDO();
    $pdoStatementView = $pdo->prepare("SELECT gambar,tipe_file FROM tbproduk WHERE produk_id = :id");
    $pdoStatementView->bindParam(":id",$id);
    $pdoStatementView->execute();
    $result = $pdoStatementView->fetchAll(PDO::FETCH_ASSOC);
    foreach($result AS $row){

        Header('Content-Type:'.$row['tipe_file']);
        echo $row['gambar'];
        
    }
}else{
    header('Location:../index.php');
}

?>