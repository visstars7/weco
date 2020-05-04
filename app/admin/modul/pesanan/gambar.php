<?php 

if(isset($_GET['id'])){

    include_once '../../../helper/helper.php';
    $proses_id = $_GET['id'];

    $pdo = PDO();
    $pdoStatementView = $pdo->prepare("SELECT tipe_file,gambar FROM produkView WHERE proses_id = :id");
    $pdoStatementView->bindParam(':id',$proses_id);
    $pdoStatementView->execute();
    $result = $pdoStatementView->fetchAll(PDO::FETCH_ASSOC);
    foreach($result AS $row){
        // var_dump($row);
        header('Content-Type:'.$row['tipe_file']);
        echo $row['gambar'];
    }
}


?>