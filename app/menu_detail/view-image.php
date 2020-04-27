<?php 

include_once '../helper/helper.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $PDO = PDO();
    $pdoStatementView = $PDO->prepare("SELECT * FROM tbproduk WHERE produk_id = :id");
    $pdoStatementView->bindParam(":id",$id);
    $pdoStatementView->execute();
    $result = $pdoStatementView->fetchAll(PDO::FETCH_ASSOC);
    foreach($result AS $row){

        Header("Content-Type:".$row['tipe_file']);
        echo $row['gambar'];
    }
}else{
    header('Location:../index.php');
}


?>