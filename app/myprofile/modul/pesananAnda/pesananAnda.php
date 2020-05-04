<?php 

include_once '../helper/helper.php';

$userId = $_SESSION['user'];

$pdo = PDO();

$pdoStatementView = $pdo->prepare("SELECT proses_id FROM tbonproses WHERE user_id = :userId");

$pdoStatementView->bindParam(":userId",$userId);

$pdoStatementView->execute();

$pesanan = $pdoStatementView->fetchAll(PDO::FETCH_ASSOC);

var_dump($pesanan);

if(!empty($pesanan)){
    header('Location:modul/pesananAnda/invoice.php');
}

?>