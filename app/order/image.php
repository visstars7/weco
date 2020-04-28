<?php 

include_once '../helper/helper.php';
session_start();

$pdo = PDO();
if(isset($_GET['id'])){

    $id = $_GET['id'];

    $keranjang = $_SESSION['keranjang'];
        header("Content-Type:".$_SESSION['keranjang'][$id]['tipe_file']);
        echo $_SESSION['keranjang'][$id]['gambar'];
}

?>